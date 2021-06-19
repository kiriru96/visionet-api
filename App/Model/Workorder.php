<?php
namespace App\Model;
use System\Model as Model;

class Workorder extends Model {
    private function checkWOExists($asset) {
        $wo = $this->db->selectColumns(array('asset'), 'work_order', 'asset = ?', array($asset));

        if($wo) {
            return $wo[0];
        } else {
            return null;
        }
    }
    public function createWork(int $asset, int $location, int $customer) {
        $fields = array('asset', 'customer', 'location');
        $values = array($asset, $customer, $location);

        $wo = $this->db->insert('work_order', $fields, $values);

        if($wo) {
            return array('status'=> true, 'id'=> $wo);
        } else {
            return array('status'=> false, 'msg'=> 'gagal membuat data');
        }
    }

    public function updateWork(int $idwork, int $location, int $customer) {
        $fields = array('customer', 'location');
        $values = array($customer, $location);

        $work = $this->db->update('work_order', $fields, $values, 'id = '.$idwork);

        if($work > 0) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui.');
        }
    }

    public function deleteWork(int $id_work) {
        $work_delete = $this->db->delete('work_order', 'id = ?', array($id_work));

        if($work_delete > 0) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus.');
        }
    }

    public function signEngginer(int $id_work_order, int $id_engginer) {
        $fields = array('engginer');
        $values = array($id_engginer);

        $update_engginer_wo = $this->db->update('work_order', $fields, $values, 'id = '.$id_work_order);

        if($update_engginer_wo) {
            return array('status'=> true, 'msg'=> 'berhasil mengirim ke engginer.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal, ulangi pengiriman data.');
        }
    }

    public function updateStatusWork(int $id_work_order, int $status) {
        $fields = array('status');
        $values = array($status);

        $update_status_wo = $this->db->pdate('work_order', $fields, $values, 'id = '.$id_work_order);
        
        if($update_status_wo) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui status WO.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbahrui status WO.');
        }
    }
    
    public function listRecord(string $search, int $page, string $orderby, string $order, int $limit) {
        $index = ($page - 1) * $limit;

        $src = '%'.trim($search).'%';

        $query = 'SELECT
                wo.id,
                ass.id AS asset_id,
                ass.serial_number,
                ass.model,
                ass.device_name AS device_id,
                ass.device_brand AS brand_id,
                dn.name AS devicename,
                db.name AS brandname,
                wo.location,
                wo.customer,
                loc.name AS worklocation,
                cus.name AS customername
                FROM work_order AS wo
                INNER JOIN assets AS ass ON wo.asset = ass.id
                INNER JOIN device_brand AS db ON ass.device_brand = db.id
                INNER JOIN device_name AS dn ON ass.device_name = dn.id
                INNER JOIN location AS loc ON wo.location = loc.id
                INNER JOIN customer AS cus ON wo.customer = cus.id
                WHERE cus.name LIKE ? OR loc.name LIKE ?
                ORDER BY wo.id DESC LIMIT '.$index.', '.$limit;

        $list_works = $this->db->rawQueryType('select', $query, array($src, $src));

        if($list_works) {
            return array('status'=> true, 'data'=> $list_works);
        } else {
            return array('status'=> false, 'msg'=> 'tidak ada assets');
        }
    }

    public function listWorkOrderReq(string $date, int $page, int $location) {
        $index = ($page - 1) * 20;

        $query = 'SELECT
                wo.id,
                dn.name AS devicename,
                db.name AS brandname,
                loc.name AS locationname,
                cus.name AS customername
                FROM work_order AS wo
                INNER JOIN customer as cus ON wo.customer = cus.id
                INNER JOIN location as loc ON wo.location = loc.id
                INNER JOIN assets as ass ON wo.asset = ass.id
                INNER JOIN device_name as dn ON ass.device_name = dn.id
                INNER JOIN device_brand as db ON ass.device_brand = db.id
                WHERE DATE(wo.datecreated) = ? AND wo.location = ?
                ORDER BY wo.datecreated DESC LIMIT '.$index.',20';

        $list_works = $this->db->rawQueryType('select', $query, array($date, $location));

        if($list_works) {
            return array('status'=> true, 'data'=> $list_works);
        } else {
            return array('status'=> false, 'msg'=> 'tidak ada list');
        }
    }

    public function detailWO(int $id) {
        $query = 'SELECT
                wo.id,
                ass.id AS asset_id,
                dn.name AS devicename,
                db.name AS brandname,
                loc.name AS locationname,
                cus.name AS customername
                FROM work_order AS wo
                INNER JOIN customer as cus ON wo.customer = cus.id
                INNER JOIN location as loc ON wo.location = loc.id
                INNER JOIN assets as ass ON wo.asset = ass.id
                INNER JOIN device_name as dn ON ass.device_name = dn.id
                INNER JOIN device_brand as db ON ass.device_brand = db.id
                WHERE wo.id = ?';

        $wo = $this->db->rawQueryType('select', $query, array($id));
        
        if($wo[0]) {
            return array('status'=> true, 'data'=> $wo[0]);
        } else {
            return array('status'=> false, 'msg'=> 'tidak menemukan data.');
        }
    }

    public function allRows(string $search) {
        $src = '%'.trim($search).'%';

        $query = 'SELECT count(*) AS len 
            FROM work_order AS wo 
            INNER JOIN location AS loc ON wo.location = loc.id 
            INNER JOIN customer AS cus ON wo.customer = cus.id 
            WHERE cus.name LIKE ? OR loc.name LIKE ?';

        $res = $this->db->rawQueryType('select', $query, array($src, $src));

        return $res[0]['len'];
    }
}