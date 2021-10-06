<?php
namespace App\Model;
use System\Model as Model;

class Engineer extends Model {
    public function login(string $username, string $password) {
        $engineer = $this->checkAccountEngineerExists($username);
        
        if($engineer) {
            $hash_password = $engineer['password'];

            if(password_verify($password, $hash_password)) {
                return array('status'=> true, 'data'=> array('id'=> $engineer['id'], 'type'=> 3, 'username'=> $engineer['username'], 'name'=> $engineer['first_name'].' '.$engineer['last_name'], 'location'=> $engineer['location']));
            }
        }

        return array('status'=> false, 'msg'=> 'Username atau password salah.');
    }

    public function profile($type, $id) {
        $result = $this->db->selectColumns(array('id',  'first_name', 'last_name', 'username'), 'engginer', 'id = ?', array($id));

        if($result) {
            return array('status'=> true, 'data'=> array('type'=> $type, 'id'=> $result[0]['id'], 'firstname'=> $result[0]['first_name'], 'lastname'=> $result[0]['last_name'], 'name'=> $result[0]['first_name'].' '.$result[0]['last_name'], 'username'=> $result[0]['username']));
        } else {
            return array('status'=> false, 'msg'=> 'cannot find profile');
        }
    }

    public function changeUsername(int $id, string $username) {
        $check_username = $this->checkAccountEngineerExists($username);

        if($check_username) {
            return array('status'=> false, 'msg'=> 'username sudah terpakai.');
        } else {
            $fields = array('username');
            $values = array($username);

            $result = $this->db->update('engginer', $fields, $values, 'id = '.$id_admin);

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

        $result = $this->db->update('engginer', $fields, $values, 'id = '.$id);

        if($result) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui password.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui password.');
        }
    }

    public function changeName(int $id, string $firstname, string $lastname) {
        $fields = array('first_name', 'last_name');
        $values = array($firstname, $lastname);

        $result = $this->db->update('engginer', $fields, $values, 'id = '.$id);

        if($result) {
            return array('status'=> true, 'data'=> array('id'=> $id, 'name'=> $firstname.' '.$lastname));
        } else {
            return array('status'=> false, 'msg'=> 'Gagal memperbaharui nama');
        }
    }

    private function checkAccountEngineerExists($username) {
        $engineers = $this->db->selectColumns(array('id', 'first_name', 'last_name', 'username', 'password', 'location'), 'engginer', 'username = ? AND deleted = ?', array($username, 0));

        if($engineers) {
            return $engineers[0];
        } else {
            return null;
        }
    }

    public function addRecord(string $first_name, string $last_name, string $username, string $password, int $location) {
        $checkusername = $this->checkAccountEngineerExists($username);

        if($checkusername) {
            return array('status'=> false, 'msg'=> 'username sudah terpakai.');
        } else {
            $fields = array('first_name', 'last_name', 'username', 'password', 'location');
            $values = array($first_name, $last_name, $username, password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]), $location);
            
            $engineer_insert = $this->db->insert('engginer', $fields, $values);
    
            if($engineer_insert) {
                return array('status'=> true, 'id'=> $engineer_insert);
            } else {
                return array('status'=> false, 'msg'=> 'failed to insert data.');
            }
        }
    }

    public function editRecord(int $id_engineer, string $first_name, string $last_name, int $location) {
        $fields = array('first_name', 'last_name', 'location');
        $values = array($first_name, $last_name, $location);

        $engineer_update = $this->db->update('engginer', $fields, $values, 'id = '.$id_engineer);

        if($engineer_update > 0) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui.', 'data'=> array('id'=> $id_engineer, 'firstname'=> $first_name, 'lastname'=> $last_name));
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui.');
        }
    }

    public function deleteRecord(int $id_engineer) {
        $fields = array('deleted');
        $values = array(1);

        // $engineer_delete = $this->db->delete('engginer', 'id = ?', array($id_engineer));
        $engineer_delete    = $this->db->update('engginer', $fields, $values, 'deleted = 0 AND id = '.$id_engineer);

        if($engineer_delete) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus data.');
        }
    }

    public function lightListRecord(string $search) {
        $src = '%'.trim($search).'%';

        $query = 'SELECT
        id,
        username,
        first_name,
        last_name
        FROM engginer
        WHERE username LIKE ? AND deleted = ?
        ORDER BY username ASC LIMIT 0, 20';

        $list_engineers = $this->db->rawQueryType('select', $query, array($src, 0));

        if($list_engineers) {
            return array('status'=> true, 'data'=> $list_engineers);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find list data.');
        }
    }

    public function listRecord(string $search, int $page, string $orderby, string $order, int $limit) {
        $index = ($page - 1) * $limit;

        $src = '%'.trim($search).'%';

        $query_engineers = 'SELECT
            engginer.id,
            engginer.first_name,
            engginer.last_name,
            engginer.username,
            `location`.`name` as locationname,
            engginer.location
            FROM engginer
            INNER JOIN `location` ON engginer.location = `location`.id
            WHERE (engginer.first_name LIKE ? OR engginer.last_name LIKE ? OR engginer.username LIKE ?) AND engginer.deleted = ?
            ORDER BY '.$orderby.' DESC LIMIT '.$index.', '.$limit;

        $list_engineers = $this->db->rawQueryType('select', $query_engineers, array($src, $src, $src, 0));

        if($list_engineers) {
            return array('status'=> true, 'data'=> $list_engineers);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find list data.');
        }
    }

    public function getRecord(int $id_engineer) {
        $query_engineers = 'SELECT
        engginer.id,
        engginer.first_name,
        engginer.last_name,
        engginer.username,
        engginer.location,
        `location`.`name` as locationname
        FROM engginer
        INNER JOIN `location` ON engginer.location = `location`.id
        ORDER BY '.$order.' LIMIT '.$index_start.', '.$limit;

        $list_engineers = $this->db->rawQueryType('select', $query_engineers, array());

        if($list_engineers) {
            return array('status'=> true, 'data'=> $list_engineers[0]);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find any data.');
        }
    }
    
    public function allRows(string $search) {
        $src = '%'.trim($search).'%';

        $query = 'SELECT count(*) AS len 
        FROM engginer
        INNER JOIN `location` ON engginer.location = `location`.id
        WHERE (engginer.first_name LIKE ? OR engginer.last_name LIKE ? OR engginer.username LIKE ?) AND engginer.deleted = ?';

        $res = $this->db->rawQueryType('select', $query, array($src, $src, $src, 0));

        return $res[0]['len'];
    }
}