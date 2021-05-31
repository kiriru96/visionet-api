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
    public string $key = 'qwerty123456789';
    private int $id;
    private int $type;
    private string $name;
    private string $username;

    public function __construct() {
        $second = strtolower($this->req?->getUri()?->getSecondPath());

        header('Content-type: application/json');

        if($second !== 'authentication') {
            $this->loadLib('jwt', 'JWT');

            $result = $this->jwt->authenticated($this->key);

            if($result['status']) {
                $token  = $result['token'];

                $this->id       = $token['id'];
                $this->type     = $token['type'];
                $this->name     = $token['name'];
                $this->username = $token['username'];

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
            $result = array();

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

                    return $this->res->json(array('status'=> true, 'token'=> $this->jwt->createToken($data, $this->key), 'data'=> $data));
                }
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> 'username or password is empty, please check fields'));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request'));
    }

    // insert data to table

    public function addadmin() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('admin', new Admin());

            $fullname   = $this->req?->Post('fullname');
            $username   = $this->req?->Post('username');
            $password   = $this->req?->Post('password');

            $result = $this->admin->addAdmin($fullname, $username, $password);

            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function addleader() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('leader', new Leader());

            $first_name = $this->req?->Post('firstname');
            $last_name  = $this->req?->Post('lastname');
            $username   = $this->req?->Post('username');
            $password   = $this->req?->Post('password');

            $result = $this->leader->addLeader($first_name, $last_name, $username, $password);

            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function addbackupleader() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('backupleader', new Backupleader());

            $first_name = $this->req?->Post('firstname');
            $last_name  = $this->req?->Post('lastname');
            $username   = $this->req?->Post('username');
            $password   = $this->req?->Post('password');

            $result = $this->backupleader->addBackupLeader($first_name, $last_name, $username, $password);

            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function addengginer() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('engginer', new Engginer());

            $first_name = $this->req?->Post('firstname');
            $last_name  = $this->req?->Post('lastname');
            $username   = $this->req?->Post('username');
            $password   = $this->req?->Post('password');

            $result = $this->engginer->addEngginer($first_name, $last_name, $username, $password);

            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function addasset() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('asset', new Asset());

            $id_device_name     = (int) $this->req?->Post('devicename');
            $id_device_brand    = (int) $this->req?->Post('devicebrand');
            $serial_number      = $this->req?->Post('serialnumber');
            $condition          = (int) $this->req?->Post('condition');
            $description        = $this->req?->Post('description');
            $date_in            = $this->req?->Post('datein');
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

    public function addbrand() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('brand', new Brand());

            $name     = (int) $this->req?->Post('brandname');

            $result = $this->brand->addBrand($name);
            
            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function addcustomer() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('customer', new Customer());

            $name     = (int) $this->req?->Post('customername');

            $result = $this->customer->addCustomer($name);
            
            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }
    
    public function adddevice() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('device', new Device());

            $name     = (int) $this->req?->Post('devicename');

            $result = $this->device->addDevice($name);
            
            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function addlocation() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('location', new Location());

            $name     = (int) $this->req?->Post('brandname');

            $result = $this->location->addLocation($name);
            
            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function addwarehouse() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('warehouse', new Warehouse());

            $name     = (int) $this->req?->Post('brandname');

            $result = $this->warehouse->addWarehouse($name);
            
            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    // public function addwoec() {
    //     if($this->req?->getMethod() === 'POST') {
    //         $this->loadModel('woec', new Woec());

    //         $name     = (int) $this->req?->Post('brandname');

    //         $result = $this->woec->addWorkOrderConfirm($name);
            
    //         if($result['status']) {
    //             return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
    //         } else {
    //             return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
    //         }
    //     }

    //     return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    // }

    public function addworkorder() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('workorder', new Woec());

            $name     = (int) $this->req?->Post('brandname');

            $result = $this->workorder->addWorkOrder($name);
            
            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    // edit table

    public function editadmin() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('admin', new Admin());

            $idadmin    = $this->req?->Post('idselected');

            $fullname   = $this->req?->Post('fullname');
            $username   = $this->req?->Post('username');
            $password   = $this->req?->Post('password');

            $result = $this->admin->updateAdmin($idadmin, $fullname, $username, $password);

            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function editleader() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('leader', new Leader());

            $idleader    = $this->req?->Post('idselected');

            $fullname   = $this->req?->Post('fullname');
            $username   = $this->req?->Post('username');
            $password   = $this->req?->Post('password');

            $result = $this->leader->updateLeader($idleader, $fullname, $username, $password);

            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function editbackupleader() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('backupleader', new Backupleader());

            $idbackuplader    = $this->req?->Post('idselected');

            $fullname   = $this->req?->Post('fullname');
            $username   = $this->req?->Post('username');
            $password   = $this->req?->Post('password');

            $result = $this->backupleader->updateBackupLeader($idbackuplader, $fullname, $username, $password);

            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    public function editengginer() {
        if($this->req?->getMethod() === 'POST' && $this->type === 0) {
            $this->loadModel('engginer', new Backupleader());

            $idengginer = $this->req?->Post('idselected');

            $fullname   = $this->req?->Post('fullname');
            $username   = $this->req?->Post('username');
            $password   = $this->req?->Post('password');

            $result = $this->engginer->updateEngginer($idengginer, $fullname, $username, $password);

            if($result['status']) {
                return $this->res->json(array('status'=> true, 'data'=> array('id'=> $result['id'])));
            } else {
                return $this->res->json(array('status'=> false, 'msg'=> $result['msg']));
            }
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'can not response this request.'));
    }

    // show list data of table

    public function listadmin() {

    }

    public function listleader() {

    }

    public function listbackupleader() {

    }

    public function listengginer() {

    }

    public function listasset() {

    }

    public function listbrand() {

    }

    public function listcustomer() {

    }

    public function listdevice() {

    }

    public function listlocation() {

    }

    public function listwarehouse() {

    }

    public function listwoec() {

    }

    public function listworkorder() {

    }

    // api for leader and backup leader

    public function areapointworkorder() {
        if($this->req?->getMethod() === 'GET' && ($this->type === 1 || $this->type == 2)) {

        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
    }

    public function setengginer() {
        if($this->req?->getMethod() === 'POST' && ($this->type === 1 || $this->type == 2)) {

        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
    }

    public function confirmwork() {
        if($this->req?->getMethod() === 'POST' && ($this->type === 1 || $this->type == 2)) {

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

    public function listwoecconfirm() {
        if($this->req?->getMethod() === 'GET' && $this->type === 3) {
            $id_engginer = $this->req?->Post('id');
            
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
    }

    public function listwoecnotconfirm() {
        if($this->req?->getMethod() === 'GET' && $this->type === 3) {
            $id_engginer = $this->req?->Post('id');
            
        }

        return $this->res->json(array('status'=> false, 'msg'=> 'cannot response this request.'));
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