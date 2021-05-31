<?php
namespace App\Model;
use System\Model as Model;

class Backupleader extends Model {
    public function login(string $username, string $password) {
        $backupleader = $this->checkAccountBackupLeaderExists($username);

        if($backupleader) {
            $hash_password = $backupleader['password'];

            if(password_verify($password, $hash_password)) {
                return array('status'=> true, 'data'=> array('id'=> $backupleader['id'], 'type'=> 2, 'username'=> $backupleader['username'], 'name'=> $backupleader['first_name'].' '.$backupleader['last_name']));
            }
        }

        return array('status'=> false, 'msg'=> 'Username atau password salah.');
    }

    private function checkAccountBackupLeaderExists($username) {
        $backupleaders = $this->db->selectColumns(array('id', 'first_name', 'last_name', 'username', 'password'), 'backupleader', 'username = ?', array($username));

        return $backupleaders[0];
    }

    public function createBackupLeader(string $first_name, string $last_name, string $username, string $password, int $location) {
        $checkusername = $this->checkAccountBackupLeaderExists($username);

        if($checkusername) {
            return array('status'=> false, 'msg'=> 'username sudah terpakai.');
        } else {
            $fields = array('first_name', 'last_name', 'username', 'password', 'location');
            $values = array($first_name, $last_name, $username, password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]), $location);
            
            $backupleader_insert = $this->db->insert('backupleader', $fields, $values);
    
            return array('status'=> true, 'id'=> $backupleader_insert);
        }
    }

    public function editBackupLeader(int $id_backupleader, string $first_name, string $last_name, string $username, string $password, int $location) {
        $fields = array('first_name', 'last_name', 'username', 'password', 'location');
        $values = array($first_name, $last_name, $username, $password, $location);

        $backupleader_update = $this->db->update('backupleader', $fields, $values, 'id = '.$id_backupleader);

        return $backupleader_update;
    }

    public function deleteBackupLeader(int $id_backupleader) {
        $backupleader_delete = $this->db->delete('backupleader', 'id = ?', array($id_backupleader));

        return $backupleader_delete;
    }

    public function listBackupLeader(string $order, int $limit, int $index_start) {
        $query_backupleaders = 'SELECT
        backupleader.id,
        backupleader.first_name,
        backupleader.last_name,
        backupleader.username,
        `location`.`name` as locationname
        FROM backupleader
        INNER JOIN `location` ON backupleader.location = `location`.id
        ORDER BY '.$order.' LIMIT '.$index_start.', '.$limit;

        $list_backupleaders = $this->db->rawQueryType('select', $query_backupleaders, array());

        return $list_backupleaders;
    }

    public function getBackupLeader(int $id_backupleader) {
        $query_backupleaders = 'SELECT
        backupleader.id,
        backupleader.first_name,
        backupleader.last_name,
        backupleader.username,
        backupleader.location,
        `location`.`name` as locationname
        FROM backupleader
        INNER JOIN `location` ON backupleader.location = `location`.id
        ORDER BY '.$order.' LIMIT '.$index_start.', '.$limit;

        $list_backupleaders = $this->db->rawQueryType('select', $query_backupleaders, array());

        return $list_backupleaders[0];
    }
}