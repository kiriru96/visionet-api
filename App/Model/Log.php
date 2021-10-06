<?php
namespace App\Model;
use System\Model as Model;

class Log extends Model {
    private function insertLog(int $type, int $id, string $desc) {
        $fields = array('account_type', 'id_user', 'description');
        $values = array($type, $id, $desc);

        $result = $this->db->insert('log', $fields, $values);
    }
    // create log when create admin account
    public function signLogCreateAdmin(int $type, int $id, string $username, string $name) {
        $description = 'Created admin account '.$username;

        $this->insertLog($type, $id, $description);
    }
    // create log when admin login
    public function signLogLoginAdmin(int $type, int $id, string $username) {
        $description = 'Admin Login: '.$username;

        $this->insertLog($type, $id, $description);
    }
    // create log when leader login
    public function signLogLoginLeader(int $type, int $id, string $username) {
        $description = 'Admin Login: '.$username;

        $this->insertLog($type, $id, $description);
    }
    // create log when backupleader login
    public function signLogLoginBackupLeader(int $type, int $id, string $username) {
        $description = 'Admin Login: '.$username;

        $this->insertLog($type, $id, $description);
    }
    // create log when engineer login
    public function signLogLoginEngineer(int $type, int $id, string $username) {
        $description = 'Admin Login: '.$username;

        $this->insertLog($type, $id, $description);
    }
    // create log when engineer post work order
    public function signEngineerWOPost(int $id, int $id_wo) {

    }
    // create log when leader send wo to engineer
    public function signLogLeaderSendWO(int $id, int $id_wo) {

    }
    // create log when backup leader send wo to engineer
    public function signLogBackupLeaderSendWO(int $id, int $id_wo) {

    }
    // create log when admin insert asset
    public function signLogAdminCreateAsset(int $type, int $id, string $asset_name) {
        $description = 'Insert Asset named '.$asset_name;

        $this->insertLog($type, $id, $description);
    }
    // create log when admin delete asset
    public function signLogAdmindeleteAsset(int $id, int $id_asset) {

    }
    // create log when leader confirm wo
    public function signLogLeaderConfirmWO(int $id, int $id_wo) {

    }
    // create log when backup leader confirm wo
    public function signLogBackupLeaderConfirmWO(int $id, int $id_wo) {
        
    }
}