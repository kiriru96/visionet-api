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

        if($engginers) {
            return $engginers[0];
        } else {
            return null;
        }
    }

    public function addRecord(string $first_name, string $last_name, string $username, string $password, int $location) {
        $checkusername = $this->checkAccountEngginerExists($username);

        if($checkusername) {
            return array('status'=> false, 'msg'=> 'username sudah terpakai.');
        } else {
            $fields = array('first_name', 'last_name', 'username', 'password', 'location');
            $values = array($first_name, $last_name, $username, password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]), $location);
            
            $engginer_insert = $this->db->insert('engginer', $fields, $values);
    
            if($engginer_insert) {
                return array('status'=> true, 'id'=> $engginer_insert);
            } else {
                return array('status'=> false, 'msg'=> 'failed to insert data.');
            }
        }
    }

    public function editRecord(int $id_engginer, string $first_name, string $last_name, string $username, int $location) {
        $checkusername = $this->checkAccountEngginerExists($username);

        if($checkusername) {
            return array('status'=> false, 'msg'=> 'username sudah terpakai.');
        } else {
            $fields = array('first_name', 'last_name', 'username', 'location');
            $values = array($first_name, $last_name, $username, $location);

            $engginer_update = $this->db->update('engginer', $fields, $values, 'id = '.$id_engginer);

            if($engginer_update > 0) {
                return array('status'=> true, 'msg'=> 'berhasil memperbaharui.', 'data'=> array('id'=> $id_engginer, 'firstname'=> $first_name, 'lastname'=> $last_name, 'username'=> $username));
            } else {
                return array('status'=> false, 'msg'=> 'gagal memperbaharui.');
            }
        }
    }

    public function deleteRecord(int $id_engginer) {
        $engginer_delete = $this->db->delete('engginer', 'id = ?', array($id_engginer));

        if($engginer_delete) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus data.');
        }
    }

    public function lightListRecord(string $search) {
        $src = '%'.trim($search).'%';

        $query = 'SELECT
        id,
        username AS name
        FROM engginer
        WHERE username LIKE ?
        ORDER BY username ASC LIMIT 0, 20';

        $list_engginers = $this->db->rawQueryType('select', $query, array($src));

        if($list_engginers) {
            return array('status'=> true, 'data'=> $list_engginers);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find list data.');
        }
    }

    public function listRecord(string $search, int $page, string $orderby, string $order, int $limit) {
        $index = ($page - 1) * $limit;

        $src = '%'.trim($search).'%';

        $query_engginers = 'SELECT
            engginer.id,
            engginer.first_name,
            engginer.last_name,
            engginer.username,
            `location`.`name` as locationname
            FROM engginer
            INNER JOIN `location` ON engginer.location = `location`.id
            WHERE engginer.first_name LIKE ? OR engginer.last_name LIKE ? OR engginer.username LIKE ?
            ORDER BY '.$orderby.' DESC LIMIT '.$index.', '.$limit;

        $list_engginers = $this->db->rawQueryType('select', $query_engginers, array($src, $src, $src));

        if($list_engginers) {
            return array('status'=> true, 'data'=> $list_engginers);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find list data.');
        }
    }

    public function getRecord(int $id_engginer) {
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

        if($list_engginers) {
            return array('status'=> true, 'data'=> $list_engginers[0]);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find any data.');
        }
    }
    
    public function allRows(string $search) {
        $src = '%'.trim($search).'%';

        $query = 'SELECT count(*) AS len 
        FROM engginer
        INNER JOIN `location` ON engginer.location = `location`.id
        WHERE engginer.first_name LIKE ? OR engginer.last_name LIKE ? OR engginer.username LIKE ?';

        $res = $this->db->rawQueryType('select', $query, array($src, $src, $src));

        return $res[0]['len'];
    }
}