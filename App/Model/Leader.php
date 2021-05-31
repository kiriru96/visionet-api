<?php
namespace App\Model;
use System\Model as Model;

class Leader extends Model {
    public function login(string $username, string $password) {
        $leader = $this->checkAccountLeaderExists($username);
        
        if($leader) {
            $hash_password = $leader['password'];

            if(password_verify($password, $hash_password)) {
                return array('status'=> true, 'data'=> array('id'=> $leader['id'], 'type'=> 1, 'username'=> $leader['username'], 'name'=> $leader['first_name'].' '.$leader['last_name']));
            }
        }

        return array('status'=> false, 'msg'=> 'Username atau password salah.');
    }

    private function checkAccountLeaderExists($username) {
        $leaders = $this->db->selectColumns(array('id', 'first_name', 'last_name', 'username', 'password'), 'leader', 'username = ?', array($username));

        return $leaders[0];
    }

    public function createLeader(string $first_name, string $last_name, string $username, string $password, int $location) {
        $checkusername = $this->checkAccountLeaderExists($username);

        if($checkusername) {
            return array('status'=> false, 'msg'=> 'username sudah terpakai.');
        } else {
            $fields = array('first_name', 'last_name', 'username', 'password', 'location');
            $values = array($first_name, $last_name, $username, $password, $location);
            
            $leader_insert = $this->db->insert('leader', $fields, $values);
    
            return array('status'=> true, 'id'=> $leader_insert);
        }
    }

    public function editLeader(int $id_leader, string $first_name, string $last_name, string $username, string $password, int $location) {
        $fields = array('first_name', 'last_name', 'username', 'password', 'location');
        $values = array($first_name, $last_name, $username, $password, $location);

        $leader_update = $this->db->update('leader', $fields, $values, 'id = '.$id_leader);

        return $leader_update;
    }

    public function deleteLeader(int $id_leader) {
        $leader_delete = $this->db->delete('leader', 'id = ?', array($id_leader));

        return $leader_delete;
    }

    public function listLeader(string $order, int $limit, int $index_start) {
        $query_leaders = 'SELECT
        leader.id,
        leader.first_name,
        leader.last_name,
        leader.username,
        `location`.`name` as locationname
        FROM leader
        INNER JOIN `location` ON leader.location = `location`.id
        ORDER BY '.$order.' LIMIT '.$index_start.', '.$limit;

        $list_leaders = $this->db->rawQueryType('select', $query_leaders, array());

        return $list_leaders;
    }

    public function getLeader(int $id_leader) {
        $query_leaders = 'SELECT
        leader.id,
        leader.first_name,
        leader.last_name,
        leader.username,
        leader.location,
        `location`.`name` as locationname
        FROM leader
        INNER JOIN `location` ON leader.location = `location`.id
        ORDER BY '.$order.' LIMIT '.$index_start.', '.$limit;

        $list_leaders = $this->db->rawQueryType('select', $query_leaders, array());

        return $list_leaders[0];
    }
 }