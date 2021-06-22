<?php
namespace App\Model;
use System\Model as Model;

class Admin extends Model {
    public function login(string $username, string $password) {
        $admin = $this->checkUsernameExists($username);

        if($admin) {
            $hash_password = $admin['password'];

            if(password_verify($password, $hash_password)) {
                return array('status'=> true, 'data'=> array('id'=> $admin['id'], 'type'=> 0, 'username'=> $admin['username'], 'level'=> $admin['level'], 'name'=> $admin['fullname']));
            }
        }

        return array('status'=> false, 'msg'=> 'username atau password salah.');
    }

    public function profile($id) {
        $result = $this->db->selectColumns(array('id', 'fullname', 'username'), 'admin', 'id = ?', array($id));

        if($result) {
            return array('status'=> true, 'data'=> array('id'=> $result['id'], 'name'=> $result['fullname'], 'username'=> $result['username']));
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

            $result = $this->db->update('admin', $fields, $values, 'id = '.$id_admin);

            if($result > 0) {
                return array('status'=> true, 'msg'=> 'berhasil memperbaharui data.', 'data'=> array('id'=> $id_admin, 'fullname'=> $fullname, 'username'=> $username));
            } else {
                return array('status'=> false, 'msg'=> 'gagal memperbaharui.');
            }
        }
    }

    public function changePassword(int $id, string $password) {
        $fields = array('password');
        $values = array(password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]));

        $result = $this->db->update('admin', $fields, $values, 'id = '.$id);
        
        if($result) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui password.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui password.');
        }
    }

    private function checkUsernameExists($username) {
        $admins = $this->db->selectColumns(array('id', 'fullname', 'username', 'level', 'password'), 'admin', 'username = ? AND deleted = ?', array($username, 0));

        if($admins) {
            return $admins[0];
        } else {
            return null;
        }
    }

    public function addAdmin(string $fullname,string $username, string $password) {
        $checkAdmin = $this->checkUsernameExists($username);

        if(!$checkAdmin) {
            $fields = array('fullname', 'username', 'password');
            $values = array($fullname, $username, password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]));
    
            $admin_new_id = $this->db->insert('admin', $fields, $values);
    
            return array('status' => true, 'id' => $admin_new_id);
        }

        return array('status' => false, 'msg'=> 'username is exists.');
    }

    public function deleteRecord(int $delete_id) {
        $fields = array('deleted');
        $values = array(1);

        // $delete_admin = $this->db->delete('admin', 'id = ?', array($delete_id));
        $delete_admin = $this->db->update('admin', $fields, $values, 'deleted = 0 AND id = '.$delete_id);

        if($delete_admin > 0) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus.');
        }
    }

    public function listRecord(string $search, int $page, string $orderby, string $order, int $limit) {
        $index = ($page - 1) * $limit;

        $src = '%'.trim($search).'%';

        $list_admins = $this->db->selectColumns(array('id', 'fullname', 'username'), 'admin', ' (fullname LIKE ? OR username LIKE ?) AND deleted = ? ORDER BY '.$orderby.' DESC LIMIT '.$index.','.$limit, array($src, $src, 0));

        if($list_admins) {
            return array('status'=> true, 'data'=> $list_admins);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find list data.');
        }
    }

    public function editRecord(int $id_admin, string $fullname) {
        $fields = array('fullname');
        $values = array($fullname);

        $result = $this->db->update('admin', $fields, $values, 'id = '.$id_admin);

        if($result > 0) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui data.', 'data'=> array('id'=> $id_admin, 'fullname'=> $fullname));
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui.');
        }
    }
    
    public function allRows(string $search) {
        $src = '%'.trim($search).'%';

        $query = 'SELECT count(*) AS len 
        FROM admin
        WHERE (fullname LIKE ? OR username LIKE ?) AND deleted = ?';

        $res = $this->db->rawQueryType('select', $query, array($src, $src, 0));

        return $res[0]['len'];
    }

    public function customerCount() {
        $query = 'SELECT count(*) AS len FROM customer WHERE deleted = ?';

        $result = $this->db->rawQueryType('select', $query, array(0));

        return $result[0]['len'];
    }

    public function assetCount() {
        $query = 'SELECT count(*) AS len FROM assets WHERE deleted = ?';

        $result = $this->db->rawQueryType('select', $query, array(0));

        return $result[0]['len'];
    }

    public function workorderCount() {
        $query = 'SELECT count(*) AS len FROM work_order WHERE deleted = ?';

        $result = $this->db->rawQueryType('select', $query, array(0));

        return $result[0]['len'];
    }

    public function allstockCount() {
        $query = 'SELECT SUM(stock_available) AS quantity FROM assets WHERE deleted = ?';

        $result = $this->db->rawQueryType('select', $query, array(0));

        return $result[0]['quantity'];
    }
}