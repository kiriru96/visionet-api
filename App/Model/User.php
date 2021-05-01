<?php

namespace App\Model;
use System\Model as Model;

class User extends Model {
    public function get_user($username, $type) {
        if(trim($username) !== '' && $type >= 0 && $type <= 5) {
            $users = $this->db->selectColumns(array('password'), 'user', 'username = ? AND type = ?', array($username, $type));

            if($users) {
                $user = $users[0];
                
            }
        }
    }
}