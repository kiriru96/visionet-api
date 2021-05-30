<?php
namespace App\Model;
use System\Model as Model;

class Admin extends Model {
    public function login(string $username, string $password) {
        $admins = $this->db->selectColumns(array('password'), 'account', 'username = ?', array($username));

        $admin = $admins[0];

        if($admin) {
            $hash_password = $admin['password'];

            if($hash_password == $password) {
                return array('id'=> $admin['id'], 'username'=> $admin['username'], 'name'=> $admin['fullname'])
            }
        } else {
            return null;
        }
    }

    public function create(string $fullname,string $username, string $password) {
        $fields = array('fullname', 'username', 'password');
        $values = array($fullname, $username, $password);

        $admin_new_id = $this->db->insert('account', $fields, $values);

        return $admin_new_id;
    }

    public function update(int $admin_id, string $fullname, string $username, string $password) {
        $fields = array('fullname', 'username', 'password');
        $values = array($fullname, $username, $password);

        $update_admin_status = $this->db->update('account', $fields, $values, 'id = '+$admin_id);

        return $update_admin_status;
    }

    public function delete(int $delete_id, int $admin_id) {
        $delete_admin = $this->db->delete('account', 'id = '+$admin_id);
    }
}