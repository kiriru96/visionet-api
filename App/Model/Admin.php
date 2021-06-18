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

    private function checkUsernameExists($username) {
        $admins = $this->db->selectColumns(array('id', 'fullname', 'username', 'level', 'password'), 'admin', 'username = ?', array($username));

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

    public function deleteRecord(int $delete_id, int $admin_id) {
        $delete_admin = $this->db->delete('admin', 'id = ?', array($admin_id));

        if($delete_admin > 0) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus.');
        }
    }

    public function listRecord(string $search, int $page, string $sortby, $sort, int $rows) {
        $index = ($page - 1) * $limit;

        $src = '%'.trim($search).'%';

        $list_admins = $this->db->selectColumns(array('id', 'name'), 'admin', ' fullname LIKE ? OR username LIKE ? ORDER BY '.$orderby.' DESC LIMIT '.$index.','.$limit, array($src, $src));

        if($list_admins) {
            return array('status'=> true, 'data'=> $list_admins);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find list data.');
        }
    }

    public function editRecord(int $id_admin, string $fullname, string $username) {
        $check_username = $this->checkUsernameExists($username);

        if($check_username) {
            return array('status'=> false, 'msg'=> 'username sudah terpakai.');
        } else {
            $fields = array('fullname', 'username');
            $values = array($fullname, $username);

            $result = $this->db->update($fields, $values, 'admin', 'id = '.$id_admin);

            if($result > 0) {
                return array('status'=> true, 'msg'=> 'berhasil memperbaharui data.', 'data'=> array('id'=> $id_admin, 'fullname'=> $fullname, 'username'=> $username));
            } else {
                return array('status'=> false, 'msg'=> 'gagal memperbaharui.');
            }
        }
    }
}