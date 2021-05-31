<?php
namespace App\Model;
use System\Model as Model;

class Engginer extends Model {
    public function login(string $username, string $password) {
        $engginer = $this->checkAccountEngginerExists($username);
        
        if($engginer) {
            $hash_password = $engginer['password'];

            if(password_verify($password, $hash_password)) {
                return array('status'=> true, 'data'=> array('id'=> $engginer['id'], 'type'=> 3, 'username'=> $engginer['username'], 'name'=> $engginer['first_name'].' '.$engginer['last_name']));
            }
        }

        return array('status'=> false, 'msg'=> 'Username atau password salah.');
    }

    private function checkAccountEngginerExists($username) {
        $engginers = $this->db->selectColumns(array('id', 'first_name', 'last_name', 'username', 'password'), 'engginer', 'username = ?', array($username));

        return $engginers[0];
    }

    public function createEngginer(string $first_name, string $last_name, string $username, string $password, int $location) {
        $checkusername = $this->checkAccountEngginerExists($username);

        if($checkusername) {
            return array('status'=> false, 'msg'=> 'username sudah terpakai.');
        } else {
            $fields = array('first_name', 'last_name', 'username', 'password', 'location');
            $values = array($first_name, $last_name, $username, $password, $location);
            
            $engginer_insert = $this->db->insert('engginer', $fields, $values);
    
            return array('status'=> true, 'id'=> $engginer_insert);
        }
    }

    public function editEngginer(int $id_engginer, string $first_name, string $last_name, string $username, string $password, int $location) {
        $fields = array('first_name', 'last_name', 'username', 'password', 'location');
        $values = array($first_name, $last_name, $username, $password, $location);

        $engginer_update = $this->db->update('engginer', $fields, $values, 'id = '.$id_engginer);

        return $engginer_update;
    }

    public function deleteEngginer(int $id_engginer) {
        $engginer_delete = $this->db->delete('engginer', 'id = ?', array($id_engginer));

        return $engginer_delete;
    }

    public function listEngginer(string $order, int $limit, int $index_start) {
        $query_engginers = 'SELECT
        engginer.id,
        engginer.first_name,
        engginer.last_name,
        engginer.username,
        `location`.`name` as locationname
        FROM engginer
        INNER JOIN `location` ON engginer.location = `location`.id
        ORDER BY '.$order.' LIMIT '.$index_start.', '.$limit;

        $list_engginers = $this->db->rawQueryType('select', $query_engginers, array());

        return $list_engginers;
    }

    public function getEngginer(int $id_engginer) {
        $query_engginers = 'SELECT
        engginer.id,
        engginer.first_name,
        engginer.last_name,
        engginer.username,
        engginer.location,
        `location`.`name` as locationname
        FROM engginer
        INNER JOIN `location` ON engginer.location = `location`.id
        ORDER BY '.$order.' LIMIT '.$index_start.', '.$limit;

        $list_engginers = $this->db->rawQueryType('select', $query_engginers, array());

        return $list_engginers[0];
    }
}