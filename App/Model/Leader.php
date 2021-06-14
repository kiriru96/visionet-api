<?php
namespace App\Model;
use System\Model as Model;

class Leader extends Model {
    public function login(string $username, string $password) {
        $leader = $this->checkAccountLeaderExists($username);
        
        if($leader) {
            $hash_password = $leader['password'];

            if(password_verify($password, $hash_password)) {
                return array('status'=> true, 'data'=> array('id'=> $leader['id'], 'type'=> 1, 'username'=> $leader['username'], 'location'=> $leader['location'],'name'=> $leader['first_name'].' '.$leader['last_name']));
            }
        }

        return array('status'=> false, 'msg'=> 'Username atau password salah.');
    }

    private function checkAccountLeaderExists($username) {
        $leaders = $this->db->selectColumns(array('id', 'first_name', 'last_name', 'username', 'password', 'location'), 'leader', 'username = ?', array($username));

        if($leaders) {
            return $leaders[0];
        } else {
            return null;
        }
    }

    public function addRecord(string $first_name, string $last_name, string $username, string $password, int $location) {
        $checkusername = $this->checkAccountLeaderExists($username);

        if($checkusername) {
            return array('status'=> false, 'msg'=> 'username sudah terpakai.');
        } else {
            $fields = array('first_name', 'last_name', 'username', 'password', 'location');
            $values = array($first_name, $last_name, $username, password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]), $location);
            
            $leader_insert = $this->db->insert('leader', $fields, $values);
    
            if($leader_insert) {
                return array('status'=> true, 'id'=> $leader_insert);
            } else {
                return array('status'=> false, 'msg'=> 'failed to insert data.');
            }
        }
    }

    public function editRecord(int $id_leader, string $first_name, string $last_name, string $username, int $location) {
        $checkusername = $this->checkAccountLeaderExists($username);

        if($checkusername) {
            return array('status'=> false, 'msg'=> 'username sudah terpakai.');
        } else {
            $fields = array('first_name', 'last_name', 'username', 'location');
            $values = array($first_name, $last_name, $username, $location);

            $leader_update = $this->db->update('leader', $fields, $values, 'id = '.$id_leader);

            if($leader_update > 0) {
                return array('status'=> true, 'msg'=> 'berhasil memperbaharui.', 'data'=> array('id'=> $id_leader, 'firstname'=> $first_name, 'lastname'=> $last_name, 'username'=> $username));
            } else {
                return array('status'=> false, 'msg'=> 'gagal memperbaharui.');
            }
        }
    }

    public function deleteRecord(int $id_leader) {
        $leader_delete = $this->db->delete('leader', 'id = ?', array($id_leader));

        if($leader_delete) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus data.');
        }
    }

    public function listRecord(string $search, int $page, string $orderby, string $order, int $limit) {
        $index = ($page - 1) * $limit;

        $src = '%'.trim($search).'%';

        $query_leaders = 'SELECT
        leader.id,
        leader.first_name,
        leader.last_name,
        leader.username,
        `location`.`name` as locationname,
        leader.location
        FROM leader
        INNER JOIN `location` ON leader.location = `location`.id
        WHERE leader.first_name LIKE ? OR leader.last_name LIKE ? OR leader.username LIKE ?
        ORDER BY '.$orderby.' DESC LIMIT '.$index.', '.$limit;

        $list_leaders = $this->db->rawQueryType('select', $query_leaders, array($src, $src, $src));

        if($list_leaders) {
            return array('status'=> true, 'data'=> $list_leaders);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find list data.');
        }
    }

    public function getRecord(int $id_leader) {
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

        if($list_leaders) {
            return array('status'=> true, 'data'=> $list_leaders[0]);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find any data.');
        }
    }
    
    public function allRows(string $search) {
        $src = '%'.trim($search).'%';

        $query = 'SELECT count(*) AS len 
        FROM leader
        INNER JOIN `location` ON leader.location = `location`.id
        WHERE leader.first_name LIKE ? OR leader.last_name LIKE ? OR leader.username LIKE ?';

        $res = $this->db->rawQueryType('select', $query, array($src, $src, $src));

        return $res[0]['len'];
    }
 }