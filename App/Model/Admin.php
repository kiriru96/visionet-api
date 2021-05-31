<?php
namespace App\Model;
use System\Model as Model;

class Admin extends Model {
    public function login(string $username, string $password) {
        $admin = $this->checkUsernameExists($username);

        if($admin) {
            $hash_password = $admin['password'];

            if(password_verify($password, $hash_password)) {
                return array('status'=> true, 'data'=> array('id'=> $admin['id'], 'type'=> 0, 'username'=> $admin['username'], 'name'=> $admin['fullname']));
            }
        }

        return array('status'=> false, 'msg'=> 'username atau password salah.');
    }

    private function checkUsernameExists($username) {
        $admins = $this->db->selectColumns(array('id', 'fullname', 'username', 'password'), 'account', 'username = ?', array($username));

        return $admins[0];
    }

    public function addAdmin(string $fullname,string $username, string $password) {
        $checkAdmin = $this->checkUsernameExists($username);

        if(!$checkAdmin) {
            $fields = array('fullname', 'username', 'password');
            $values = array($fullname, $username, password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]));
    
            $admin_new_id = $this->db->insert('account', $fields, $values);
    
            return array('status' => true, 'id' => $admin_new_id);
        }

        return array('status' => false, 'msg'=> 'username is exists.');
    }

    public function updateAdmin(int $admin_id, string $fullname, string $username, string $password) {
        $fields = array('fullname', 'username', 'password');
        $values = array($fullname, $username, $password);

        $update_admin_status = $this->db->update('account', $fields, $values, 'id = '+$admin_id);

        if($update_admin_status > 0) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui.');
        }
    }

    public function deleteAdmin(int $delete_id, int $admin_id) {
        $delete_admin = $this->db->delete('account', 'id = '+$admin_id);

        if($delete_admin > 0) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus.');
        }
    }
}