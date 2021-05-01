<?php
namespace App\Controller;
use System\Controller as Controller;

class App extends Controller {
    public function __construct() {
        // $hash_password = password_hash('admin123456789', PASSWORD_BCRYPT, ['cost'=>12]);
        // $this->res?->json(array('app'=>'visionet', 'password'=>$hash_password, 'len'=> strlen($hash_password)));
        $this->res->render('app', array());
    }
}