<?php
namespace App\Model;
use System\Model as Model;

class Log extends Model {
    // create log when create admin account
    public function signLogCreateAdmin($id) {

    }
    // create log when admin login
    public function signLogLoginAdmin($id) {

    }
    // create log when leader login
    public function signLogLoginLeader($id) {

    }
    // create log when backupleader login
    public function signLogLoginBackupLeader($id) {

    }
    // create log when engginer login
    public function signLogLoginEngginer($id) {

    }
    // create log when engginer post work order
    public function signEngginerWOPost(int $id, int $id_wo) {

    }
    // create log when leader send wo to engginer
    public function signLogLeaderSendWO(int $id, int $id_wo) {

    }
    // create log when backup leader send wo to engginer
    public function signLogBackupLeaderSendWO(int $id, int $id_wo) {

    }
    // create log when admin insert asset
    public function signLogAdminCreateAsset(int $id, int $id_asset) {

    }
    // create log when admin update asset
    public function signLogAdminUpdateAsset(int $id, int $id_asset) {

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