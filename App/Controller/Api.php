<?php
namespace App\Controller;

use System\Controller as Controller;
use App\Model\Admin as Admin;
use App\Model\Leader as Leader;
use App\Model\Backupleader as Backupleader;
use App\Model\Engginer as Engginer;
use App\Model\Log as Log;
use App\Model\Asset as Asset;
use App\Model\Brand as Brand;
use App\Model\Customer as Customer;
use App\Model\Device as Device;
use App\Model\Location as Location;
use App\Model\Warehouse as Warehouse;
use App\Model\Woec as Woec;
use App\Model\Workorder as Workorder;

class Api extends Controller {
    private const KEY = 'qwerty123456789';
    private int $id;
    private int $type;
    private string $name;
    private string $username;
    private $thrid_path;

    public function __construct() {
        $other_path = $this->req?->getUri()?->getParamsPaths();

        if(count($other_path) > 0) {
            $this->thrid_path = $other_path[0];
        }

        $second = strtolower($this->req?->getUri()?->getSecondPath());

        if(isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }
        
        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                // may also be using PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
            
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        
            exit(0);
        }
        
        header('Content-type: application/json');

        $second_link = ['authentication', 'insert', 'edit'];

        if(!in_array($second, $second_link)) {
            $this->loadLib('jwt', 'JWT');

            $result = $this->jwt->authenticated(self::KEY);

            if($result['status']) {
                $token  = $result['token'];

                $this->id       = $token->id;
                $this->type     = $token->type;
                $this->name     = $token->name;
                $this->username = $token->username;

                $this->loadModel('log', new Log());
            } else {
                $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request, token not found.'));

                exit();
            }
        }
    }

    public function index() {
        $this->res?->json(array('version'=>'0.1.0', 'name'=>'visionet'));
    }

    public function authentication() {
        if($this->req?->getMethod() === 'POST') {
            $username = $this->req->Post('username');
            $password = $this->req->Post('password');
            $type     = $this->req->Post('type');

            if($username !== '' && $password !== '' && $type >= 0 && $type < 4) {
                // check username and type
                // if username is found in table get row of data and get password coloum
                // check if password in database is verified with password from request

                if($type == 0) {
                    $this->loadModel('authentication', new Admin());
                } else if($type == 1) {
                    $this->loadModel('authentication', new Leader());
                } else if($type == 2) {
                    $this->loadModel('authentication', new Backupleader());
                } else if($type == 3) {
                    $this->loadModel('authentication', new Engginer());
                } else {
                    return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
                }

                $result = $this->authentication->login($username, $password);

                if($result['status']) {
                    $data = $result['data'];

                    return $this->res->json(array('status'=> true, 'token'=> $this->jwt->createToken($data, self::KEY), 'data'=> $data));
                } else {
                    return $this->res->json(array('status'=> false, 'msg'=> 'username or password is wrong, please check again.'));
                }
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> 'username or password is empty, please check fields.'));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
    }

    // list data
    public function list($model) {
        if($this->req?->getMethod() === 'GET') {
            if($model === 'device') {
                $this->loadModel('content', new Device());
            } else if($model === 'brand') {
                $this->loadModel('content', new Brand());
            } else if($model === 'location') {
                $this->loadModel('content', new Location());
            } else if($model === 'customer') {
                $this->loadModel('content', new Customer());
            } else if($model === 'warehouse') {
                $this->loadModel('content', new Warehouse());
            } else {
                return $this->res?->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
            }

            $page   = (int) $this->req?->Get('page');
            $search = $this->req?->Get('search');
            $sortby = $this->req?->Get('sortby');
            $sort   = $this->req?->Get('sort');
            $rows   = (int) $this->req?->Get('rows');

            $result = $this->content->listRecord($search, $page, $sortby == 'null' ? 'id' : $sortby, $sort == 'undefined' ? 'ASC' : $sort, $rows);
            $len = $this->content->allRows();

            if($result['status']) {
                return $this->res?->json(array('status'=> true, 'data'=> array('list'=>$result['data'], 'len'=>(int)$len)));
            } else {
                return $this->res?->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request'));
    }

    // add data
    public function add($model) {
        if($this->req?->getMethod() === 'POST') {
            if($model === 'device') {
                $this->loadModel('content', new Device());
            } else if($model === 'brand') {
                $this->loadModel('content', new Brand());
            } else if($model === 'location') {
                $this->loadModel('content', new Location());
            } else if($model === 'customer') {
                $this->loadModel('content', new Customer());
            } else if($model === 'warehouse') {
                $this->loadModel('content', new Warehouse());
            } else {
                return $this->res?->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
            }

            $name = $this->req?->Post('name');

            $result = $this->content->addRecord($name);

            if($result['status']) {
                return $this->res?->json(array('status'=> true, 'data'=> $result['id']));
            } else {
                return $this->res?->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request'));
    }

    // update data
    public function update($model) {
        if($this->req?->getMethod() === 'POST') {
            if($model === 'device') {
                $this->loadModel('content', new Device());
            } else if($model === 'brand') {
                $this->loadModel('content', new Brand());
            } else if($model === 'location') {
                $this->loadModel('content', new Location());
            } else if($model === 'customer') {
                $this->loadModel('content', new Customer());
            } else if($model === 'warehouse') {
                $this->loadModel('content', new Warehouse());
            } else {
                return $this->res?->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
            }
            
            $id   = (int) $this->req?->Post('id');
            $name = $this->req?->Post('name');

            $result = $this->content->editRecord($id, $name);

            if($result['status']) {
                return $this->res?->json(array('status'=> true, 'msg'=> $result['msg'], 'data'=> $result['data']));
            } else {
                return $this->res?->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request'));
    }

    // delete data
    
    public function delete($model) {
        if($this->req?->getMethod() === 'POST') {
            if($model === 'device') {
                $this->loadModel('content', new Device());
            } else if($model === 'brand') {
                $this->loadModel('content', new Brand());
            } else if($model === 'location') {
                $this->loadModel('content', new Location());
            } else if($model === 'customer') {
                $this->loadModel('content', new Customer());
            } else if($model === 'warehouse') {
                $this->loadModel('content', new Warehouse());
            } else {
                return $this->res?->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
            }

            $id = (int) $this->req?->Post('id');

            $result = $this->content->deleteRecord($id);

            if($result['status']) {
                return $this->res?->json(array('status'=> true, 'data'=> $result['id']));
            } else {
                return $this->res?->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request'));
    }

    //example insert data

    public function insert($model) {
        if($this->req?->getMethod() === 'POST') {
            if($model === 'admin') {
                $this->loadModel('account', new Admin());
            } else if($model === 'leader') {
                $this->loadModel('account', new Leader());
            } else if($model === 'backupleader') {
                $this->loadModel('account', new Backupleader());
            } else if($model === 'engginer') {
                $this->loadModel('account', new Engginer());
            } else {
                return $this->res?->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
            }

            if($model === 'admin') {
                $fullname   = $this->req?->Post('fullname');
                $username   = $this->req?->Post('username');
                $password   = $this->req?->Post('password');

                $result = $this->account->addAdmin($fullname, $username, $password);
            } else {
                $firstname  = $this->req?->Post('firstname');
                $lastname   = $this->req?->Post('lastname');
                $location   = (int) $this->req?->Post('location');
                $username   = $this->req?->Post('username');
                $password   = $this->req?->Post('password');

                $result = $this->account->addRecord($firstname, $lastname, $username, $password, $location);
            }

            if($result['status']) {
                return $this->res?->json(array('status'=> true, 'data'=> $result['id']));
            } else {
                return $this->res?->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request'));
    }

    //example insert data

    public function edit($model) {
        if($this->req?->getMethod() === 'POST') {
            if($model === 'admin') {
                $this->loadModel('account', new Admin());
            } else if($model === 'leader') {
                $this->loadModel('account', new Leader());
            } else if($model === 'backupleader') {
                $this->loadModel('account', new Backupleader());
            } else if($model === 'engginer') {
                $this->loadModel('account', new Engginer());
            } else {
                return $this->res?->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
            }

            $id_selected = $this->req?->Post('idselected');

            if($model === 'admin') {
                $fullname   = $this->req?->Post('fullname');
                $username   = $this->req?->Post('username');

                $result = $this->account->updateAdmin($id_selected, $fullname, $username);
            } else {
                $firstname  = $this->req?->Post('firstname');
                $lastname   = $this->req?->Post('lastname');
                $location   = (int) $this->req?->Post('location');
                $username   = $this->req?->Post('username');

                $result = $this->account->editRecord($id_selected, $firstname, $lastname, $username, $location);
            }

            if($result['status']) {
                return $this->res?->json(array('status'=> true, 'message'=> $result['msg'], 'data'=> $result['data']));
            } else {
                return $this->res?->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request'));
    }

    public function addasset() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('asset', new Asset());

            $id_device_name     = (int) $this->req?->Post('devicename');
            $id_device_brand    = (int) $this->req?->Post('devicebrand');
            $model              = $this->req?->Post('model');
            $serial_number      = $this->req?->Post('serialnumber');
            $condition          = (int) $this->req?->Post('condition');
            $description        = $this->req?->Post('description');
            $date_in            = date('Y-m-d');
            $id_warehouse       = (int) $this->req?->Post('warehouse');

            $result = $this->asset->addAsset($id_device_name, $id_device_brand, $serial_number, $condition, $description, $date_in, $id_warehouse);
            
            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function addworkorder() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('workorder', new Woec());

            $idasset    = $this->req?->Post('asset');
            $customer   = $this->req?->Post('customer');
            $location   = $this->req?->Post('location');

            $result = $this->workorder->addWorkOrder($name);
            
            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    // api for leader and backup leader

    public function areapointworkorder() {
        if($this->req?->getMethod() === 'GET' && ($this->type === 1 || $this->type == 2)) {

        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
    }

    public function setengginer() {
        if($this->req?->getMethod() === 'POST' && ($this->type === 1 || $this->type == 2)) {
            $wo_id          = $this->req?->Post('idwo');
            $engginer_id    = $this->req?->Post('idengginer');
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
    }

    public function confirmwork() {
        if($this->req?->getMethod() === 'POST' && ($this->type === 1 || $this->type == 2)) {
            $wo_id  = $this->req?->Post('idwo');
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
    }

    // api for engginer

    public function listengginerworkorder() {
        if($this->req?->getMethod() === 'GET' && $this->type === 3) {
            $id_engginer = $this->req?->Post('id');

        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
    }

    public function listwoec($action) {
        if($this->req?->getMethod() === 'GET' && $this->type === 3) {
            $id_engginer    = $this->id;
            
            if($action === 'done') {

            } else {
                
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
    }

    public function woec($action) {
        if($this->req?->getMethod() === 'POST' && $this->type === 3) {
            if($action === 'submit') {

            } else {

            }
        }
    }

    public function submitwoec() {
        if($this->req?->getMethod() === 'POST' && $this->type === 3) {
            $id_engginer    = $this->req?->Post('id');
            $id_work_order  = $this->req?->Post('idwo');

            $images_uploads = array();
            $length_images  = count($_FILES['woimages']['name']);

            $folder_wo_images = __DIR__.'/public/'.$id_work_order.date('Ymd');

            if(!is_dir($folder_wo_images)) {
                mkdir($folder_wo_images);
            }
            
            if($length_images <= 6 && $length_images > 0) {
                for($index = 0; $index < $length_images; $index++) {
                    $uploadfiles = $_FILES['woimages']['tmp_name'][$index];

                    $check_image = getimagesize($uploadfiles);

                    if($check_image) {
                        $image_file_type = strtolower(pathinfo($_FILES['woimages']['name'][$index], PATHINFO_EXTENSION));
                        
                        if(image_file_type === 'jpg' || $image_file_type === 'jpeg') {
                            $dest = $folder_wo_images.'/'.$index.'.'.$image_file_type;
                            if(move_uploaded_file($uploadfiles, $dest)) {
                                array_push($images_uploads, $dest);
                            }
                        }
                    }
                }
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> 'images is more than 6 or empty'));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
    }

    public function updatewoec() {
        if($this->req?->getMethod() === 'POST' && $this->type === 3) {
            $id_engginer = $this->req?->Post('id');
            
            $id_woec    = $this->req?->Post('woecid');
            
            $id_work_order  = $this->req?->Post('idwo');

            $images_uploads = array();
            $length_images  = count($_FILES['woimages']['name']);

            $folder_wo_images = __DIR__.'/public/'.$id_work_order.date('Ymd');

            if(!is_dir($folder_wo_images)) {
                mkdir($folder_wo_images);
            }
            
            if($length_images <= 6 && $length_images > 0) {
                for($index = 0; $index < $length_images; $index++) {
                    $uploadfiles = $_FILES['woimages']['tmp_name'][$index];

                    $check_image = getimagesize($uploadfiles);

                    if($check_image) {
                        $image_file_type = strtolower(pathinfo($_FILES['woimages']['name'][$index], PATHINFO_EXTENSION));
                        
                        if(image_file_type === 'jpg' || $image_file_type === 'jpeg') {
                            $dest = $folder_wo_images.'/'.$index.'.'.$image_file_type;
                            if(move_uploaded_file($uploadfiles, $dest)) {
                                array_push($images_uploads, $dest);
                            }
                        }
                    }
                }
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> 'images is more than 6 or empty'));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
    }
}