<?php
namespace App\Model;
use System\Model as Model;

class Backupleader extends Model {
    public function login(string $username, string $password) {
        $backupleader = $this->checkAccountBackupLeaderExists($username);

        if($backupleader) {
            $hash_password = $backupleader['password'];

            if(password_verify($password, $hash_password)) {
                return array('status'=> true, 'data'=> array('id'=> $backupleader['id'], 'type'=> 2, 'username'=> $backupleader['username'], 'location'=> $backupleader['location'], 'name'=> $backupleader['first_name'].' '.$backupleader['last_name']));
            }
        }

        return array('status'=> false, 'msg'=> 'Username atau password salah.');
    }

    public function profile($id) {
        $result = $this->db->selectColumns(array('id', 'fullname', 'username'), 'backupleader', 'id = ?', array($id));

        if($result) {
            return array('status'=> true, 'data'=> array('id'=> $result['id'], 'name'=> $result['first_name'].' '.$result['last_name'], 'username'=> $result['username']));
        } else {
            return array('status'=> false, 'msg'=> 'cannot find profile');
        }
    }

    public function changeUsername(int $id, string $username) {
        $check_username = $this->checkUsernameExists($username);

        if($check_username) {
            return array('status'=> false, 'msg'=> 'username sudah terpakai.');
        } else {
            $fields = array('username');
            $values = array($username);

            $result = $this->db->update('backupleader', $fields, $values, 'id = '.$id_admin);

            if($result > 0) {
                return array('status'=> true, 'msg'=> 'berhasil memperbaharui data.', 'data'=> array('id'=> $id_admin, 'username'=> $username));
            } else {
                return array('status'=> false, 'msg'=> 'gagal memperbaharui.');
            }
        }
    }

    public function changePassword(int $id, string $password) {
        $fields = array('password');
        $values = array(password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]));

        $result = $this->db->update('backupleader', $fields, $values, 'id = '.$id);

        if($result) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui password.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui password.');
        }
    }

    private function checkAccountBackupLeaderExists($username) {
        $backupleaders = $this->db->selectColumns(array('id', 'first_name', 'last_name', 'username', 'password', 'location'), 'backupleader', 'username = ?', array($username));

        if($backupleaders) {
            return $backupleaders[0];
        } else {
            return null;
        }
    }

    public function addRecord(string $first_name, string $last_name, string $username, string $password, int $location) {
        $checkusername = $this->checkAccountBackupLeaderExists($username);

        if($checkusername) {
            return array('status'=> false, 'msg'=> 'username sudah terpakai.');
        } else {
            $fields = array('first_name', 'last_name', 'username', 'password', 'location');
            $values = array($first_name, $last_name, $username, password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]), $location);
            
            $backupleader_insert = $this->db->insert('backupleader', $fields, $values);
    
            if($backupleader_insert) {
                return array('status'=> true, 'id'=> $backupleader_insert);
            } else {
                return array('status'=> false, 'msg'=> 'failed to insert data.');
            }
        }
    }

    public function editRecord(int $id_backupleader, string $first_name, string $last_name, int $location) {
        $fields = array('first_name', 'last_name', 'location');
        $values = array($first_name, $last_name, $location);

        $backupleader_update = $this->db->update('backupleader', $fields, $values, 'id = '.$id_backupleader);

        if($backupleader_update > 0) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui.', 'data'=> array('id'=> $id_backupleader, 'firstname'=> $first_name, 'lastname'=> $last_name));
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui.');
        }
    }

    public function deleteRecord(int $id_backupleader) {
        $backupleader_delete = $this->db->delete('backupleader', 'id = ?', array($id_backupleader));

        if($backupleader_delete) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus data.');
        }
    }

    public function listRecord(string $search, int $page, string $orderby, string $order, int $limit) {
        $index = ($page - 1) * $limit;

        $src = '%'.trim($search).'%';

        $query_backupleaders = 'SELECT
        backupleader.id,
        backupleader.first_name,
        backupleader.last_name,
        backupleader.username,
        `location`.`name` as locationname,
        backupleader.location
        FROM backupleader
        INNER JOIN `location` ON backupleader.location = `location`.id
        WHERE backupleader.first_name LIKE ? OR backupleader.last_name LIKE ? OR backupleader.username LIKE ?
        ORDER BY '.$orderby.' DESC LIMIT '.$index.', '.$limit;

        $list_backupleaders = $this->db->rawQueryType('select', $query_backupleaders, array($src, $src, $src));

        if($list_backupleaders) {
            return array('status'=> true, 'data'=> $list_backupleaders);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find any list data.');
        }
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

        if($list_backupleaders) {
            return array('status'=> true, 'data'=> $list_backupleaders[0]);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find data.');
        }
    }
    
    public function allRows(string $search) {
        $src = '%'.trim($search).'%';

        $query = 'SELECT count(*) AS len 
        FROM backupleader
        INNER JOIN `location` ON backupleader.location = `location`.id
        WHERE backupleader.first_name LIKE ? OR backupleader.last_name LIKE ? OR backupleader.username LIKE ?';

        $res = $this->db->rawQueryType('select', $query, array($src, $src, $src));

        return $res[0]['len'];
    }
}