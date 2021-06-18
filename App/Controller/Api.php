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
use App\Model\Condition as Condition;

class Api extends Controller {
    private const KEY = 'qwerty123456789';
    private int $id;
    private int $type;
    private string $name;
    private string $username;
    private int $location = -1;
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

        $second_link = ['authentication', 'test'];
        
        if(!in_array($second, $second_link)) {
            $this->loadLib('jwt', 'JWT');

            $result = $this->jwt->authenticated(self::KEY);

            if($result['status']) {
                $token  = $result['token'];

                $this->id       = $token->id;
                $this->type     = $token->type;
                $this->name     = $token->name;
                $this->username = $token->username;

                if(($this->type === 1 || $this->type === 2) && $token->location) {
                    $this->location = $token->location;
                }

                $this->loadModel('log', new Log());
            } else {
                $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request, token not found.'));

                exit();
            }
        }
    }

    public function test() {
        $data = json_decode(file_get_contents('php://input'), true);
        print_r($data);
        var_dump($_FILES);
        var_dump($_POST);
    }

    public function index() {
        $this->res?->json(array('version'=>'0.1.0', 'name'=>'visionet'));
    }

    public function home() {
        if($this->req?->getMethod() === 'GET') {
            $this->loadModel('asset', new Asset());

            $asset_all          = $this->asset->allRows('');
            $asset_new          = $this->asset->allRowsCustom('ass.condition_status', 1);
            $asset_used         = $this->asset->allRowsCustom('ass.condition_status', 2);
            $asset_repaired     = $this->asset->allRowsCustom('ass.condition_status', 3);
            $asset_damaged      = $this->asset->allRowsCustom('ass.condition_status', 4);
            $asset_dump         = $this->asset->allRowsCustom('ass.condition_status', 5);

            // var_dump(array(
            //     'all'=> $asset_all, 
            //     'new'=> $asset_new,
            //     'used'=> $asset_used,
            //     'repaired'=> $asset_repaired,
            //     'damaged'=> $asset_damaged,
            //     'dump'=> $asset_dump));
            // die();

            return $this->res?->json(
                array(
                    'status'=> true, 
                    'data'=>array(
                        'all'=> $asset_all, 
                        'new'=> $asset_new,
                        'used'=> $asset_used,
                        'repaired'=> $asset_repaired,
                        'damaged'=> $asset_damaged,
                        'dump'=> $asset_dump)));
        }
        return $this->res?->json(array('status'=> false, 'msg'=> 'cannot handle request.'));
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

    // light search data
    public function light($model) {
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
            } else if($model === 'assets') {
                $this->loadModel('content', new Asset());
            } else if($model === 'condition') {
                $this->loadModel('content', new Condition());
            } else if($model === 'engginer') {
                $this->loadModel('content', new Engginer());
            } else {
                return $this->res?->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
            }

            $search = $this->req?->Get('search');

            $result = $this->content->lightListRecord($search);

            if($result['status']) {
                return $this->res?->json(array('status'=> true, 'data'=> array('list'=>$result['data'])));
            } else {
                return $this->res?->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request'));
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
            } else if($model === 'assets') {
                $this->loadModel('content', new Asset());
            } else if($model === 'backupleader') {
                $this->loadModel('content', new Backupleader());
            } else if($model === 'leader') {
                $this->loadModel('content', new Leader());
            } else if($model === 'engginer') {
                $this->loadModel('content', new Engginer());
            } else if($model === 'workorder') {
                $this->loadModel('content', new WorkOrder());
            } else {
                return $this->res?->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
            }

            $page   = (int) $this->req?->Get('page');
            $search = $this->req?->Get('search');
            $sortby = $this->req?->Get('sortby');
            $sort   = $this->req?->Get('sort');
            $rows   = (int) $this->req?->Get('rows');

            $result = $this->content->listRecord($search, $page, $sortby == 'null' ? 'id' : $sortby, $sort == 'undefined' ? 'ASC' : $sort, $rows);
            $len = $this->content->allRows($search);

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
            } else if($model === 'asset') {
                $this->loadModel('content', new Asset());
            } else {
                return $this->res?->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
            }

            $id = (int) $this->req?->Post('id');

            $result = $this->content->deleteRecord($id);

            if($result['status']) {
                return $this->res?->json(array('status'=> true, 'data'=> $result['msg']));
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

            $id_device_name     = (int) $this->req?->Post('device_id');
            $id_device_brand    = (int) $this->req?->Post('brand_id');
            $model              = $this->req?->Post('model');
            $serial_number      = $this->req?->Post('serial_number');
            $condition          = (int) $this->req?->Post('condition_id');
            $description        = $this->req?->Post('description');
            $date_in            = date('Y-m-d');
            $id_warehouse       = (int) $this->req?->Post('warehouse_id');

            $result = $this->asset->addAsset($id_device_name, $id_device_brand, $model, $serial_number, $condition, $description, $date_in, $id_warehouse);
            
            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function updateasset() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('asset', new Asset());

            $id                 = (int) $this->req?->Post('id');
            $id_device_name     = (int) $this->req?->Post('device_id');
            $id_device_brand    = (int) $this->req?->Post('brand_id');
            $model              = $this->req?->Post('model');
            $serial_number      = $this->req?->Post('serial_number');
            $condition          = (int) $this->req?->Post('condition_id');
            $description        = $this->req?->Post('description');
            $id_warehouse       = (int) $this->req?->Post('warehouse_id');

            $result = $this->asset->editAsset($id, $id_device_name, $id_device_brand, $model, $serial_number, $condition, $description, $id_warehouse);
            
            if($result['status']) {
                return $this->res->json(array('status'=> true, 'msg'=> $result['msg']));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function addworkorder() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('workorder', new WorkOrder());

            $idasset    = (int) $this->req?->Post('asset');
            $idcustomer = (int) $this->req?->Post('customer');
            $idlocation = (int) $this->req?->Post('location');

            $result = $this->workorder->createWork($idasset, $idlocation, $idcustomer);
            
            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function updateworkorder() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('workorder', new WorkOrder());

            $idwork     = (int) $this->req?->Post('id');
            $idcustomer = (int) $this->req?->Post('customer');
            $idlocation = (int) $this->req?->Post('location');

            $result = $this->workorder->updateWork($idwork, $idlocation, $idcustomer);
            
            if($result['status']) {
                return $this->res->json(array('status'=> true, 'msg'=> $result['msg']));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    // api for leader and backup leader

    public function workorderdetail() {
        if($this->req?->getMethod() === 'GET' && ($this->type === 1 || $this->type == 2)) {
            $this->loadModel('wo', new Workorder());

            $id = (int) $this->req?->Get('id');

            $result = $this->wo->detailWO($id);

            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> $result['data']));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function workorderrequest() {
        if($this->req?->getMethod() === 'GET' && ($this->type === 1 || $this->type == 2)) {
            $this->loadModel('wo', new Workorder());

            $date = $this->req?->Get('date');
            $page = (int) $this->req?->Get('page');

            $result = $this->wo->listWorkOrderReq($date, $page, (int) $this->location);

            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('list'=> $result['data'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function setengginer() {
        if($this->req?->getMethod() === 'POST' && ($this->type === 1 || $this->type == 2)) {
            $wo_id          = (int) $this->req?->Post('idwo');
            $engginer_id    = (int) $this->req?->Post('idengginer');
            
            $this->loadModel('wo', new Workorder());

            $result = $this->wo->signEngginer($wo_id, $engginer_id);

            if($result['status']) {
                return $this->res->json(array('status'=> true, 'msg'=> $result['msg']));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
    }

    public function engginersubmitlist() {
        if($this->req?->getMethod() === 'GET' && ($this->type === 1 || $this->type == 2)) {
            $this->loadModel('woec', new Woec());

            $date = $this->req?->Get('date');
            $page = (int) $this->req?->Get('page');

            $result = $this->woec->listWOEC($date, $page, (int) $this->location);

            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('list'=> $result['data'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function confirmwork() {
        if($this->req?->getMethod() === 'POST' && ($this->type === 1 || $this->type == 2)) {
            $wo_id  = $this->req?->Post('idwo');
            
            $this->loadModel('wo', new Workorder());

            $result = $this->wo->confitmWO($wo_id);

            if($result['status']) {
                return array('status'=> true, 'data'=> $result['data']);
            } else {
                return array('status'=> false, 'msg'=> $result['msg']);
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
    }

    // api for engginer

    public function listengginerworkorder() {
        if($this->req?->getMethod() === 'GET' && $this->type === 3) {
            $dateselect = $this->req?->Get('date');
            $page       = $this->req?->Get('page');

            $this->loadModel('woec', new Woec());

            $result = $this->woec->listRecord($dateselect, $page);

            if($result['status']) {
                return array('status'=> true, 'data'=> $result['data']);
            } else {
                return array('status'=> false, 'msg'=> $result['msg']);
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
    }

    public function listwoec($action) {
        if($this->req?->getMethod() === 'GET' && $this->type === 3) {
            $id_engginer    = $this->id;
            
            $dateselect = $this->req?->Get('date');
            $page       = $this->req?->Get('page');

            $this->loadModel('woec', new Woec());

            $result = $this->woec->listRecord($id_engginer, $dateselect, $page);

            if($result['status']) {
                return array('status'=> true, 'data'=> $result['data']);
            } else {
                return array('status'=> false, 'msg'=> $result['msg']);
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
    }

    public function submitwoec() {
        if($this->req?->getMethod() === 'POST' && $this->type === 3) {
            $id_engginer    = $this->id;
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