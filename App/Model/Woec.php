<?php
// Woec = Work Order Engginer Confirm

namespace App\Model;
use System\Model as Model;

class Woec extends Model {
    // check if work order is exists in the table, to prevent double work order id
    private function checkWOECExists(int $wo) {
        $woec = $this->db->selectColumns(array('work_order'), 'work_order_engginer_confirm', 'work_order = ?', array($wo));

        if($woec) {
            return $woec[0];
        } else {
            return false;
        }
    }
    // insert woec to table
    public function addWorkOrderConfirm(int $wo, string $pics, string $descs, int $idsubmit) {
        $check_woec = $this->checkWOECExists($wo);

        if(!$check_woec) {
            $fields = array('work_order', 'pic_list', 'desc_list', 'id_submit');
            $values = array($wo, $pics, $descs, $idsubmit);
    
            $woec_id = $this->db->insert('work_order_engginer_confirm', $fields, $values);
            
            return array('status'=> true, 'id'=> $woec_id);
        } else {
            return array('status'=> false, 'msg'=> 'terhadi kesalahan.');
        }
    }
    // update woec table
    public function updateWorkOrderConfirm(int $id, string $pics) {
        $fields = array('pic_list');
        $values = array($pics);

        $woec_update = $this->db->update('work_order_engginer_confirm', $fields, $values, 'id = '.$id);

        return $woec_update;
    }

    public function listWOEC(string $date, int $page, int $location) {
        $index = ($page - 1) * 20;

        $query = 'SELECT
            wo.id,
            dn.name AS devicename,
            db.name AS brandname,
            cus.name AS customername
            FROM work_order_engginer_confirm AS woec
            INNER JOIN work_order AS wo ON woec.work_order = wo.id
            INNER JOIN assets AS ass ON wo.asset = ass.id
            INNER JOIN device_brand AS db ON ass.device_brand = db.id
            INNER JOIN device_name AS dn ON ass.device_name = dn.id
            INNER JOIN location AS loc ON wo.location = loc.id
            INNER JOIN engginer AS engg ON woec.id_submit = engg.id
            INNER JOIN customer AS cus ON wo.customer = cus.id
            WHERE DATE(woec.datecreated) = ? AND wo.location = ?
            ORDER BY woec.datecreated DESC LIMIT '.$index.', 20';

        $list_woec = $this->db->rawQueryType('select', $query, array($date, $location));

        if($list_woec) {
            return array('status'=> true, 'data'=> $list_woec);
        } else {
            return array('status'=> false, 'msg'=> 'tidak ada assets');
        }
    }

    public function confirmWoec(int $id) {
        $fields = array('status');
        $values = array(1);

        $result = $this->db->update('work_order_engginer_confirm', $fields, $values, 'id = '.$id);

        if($result) {
            return array('status'=> true, 'msg'=> 'berhasil.');
        } else {
            return array('status'=> false, 'msg'=> 'Gagal.');
        }
    }

    public function listClose(string $date, int $page, int $engginer) {
        $index = ($page - 1) * 20;

        $query = 'SELECT
            wo.id,
            dn.name AS devicename,
            db.name AS brandname,
            cus.name AS customername
            FROM work_order_engginer_confirm AS woec
            INNER JOIN work_order AS wo ON wo.id = woec.work_order
            INNER JOIN assets AS ass ON ass.id = wo.asset
            INNER JOIN device_name AS dn ON dn.id = ass.device_name
            INNER JOIN device_brand AS db ON db.id = ass.device_brand
            INNER JOIN customer AS cus ON cus.id = wo.customer
            INNER JOIN location AS loc ON loc.id = wo.location
            WHERE DATE(wo.datecreated) = ? AND wo.engginer = ? AND woec.status = ?
            ORDER BY wo.datecreated DESC LIMIT '.$index.', 20';

        $list_progress = $this->db->rawQueryType('select', $query, array($date, $engginer, 1));

        if($list_progress) {
            return array('status'=> true, 'data'=> $list_progress);
        } else {
            return array('status'=> false, 'msg'=> 'tidak ada assets');
        }
    }

    public function listProgress(string $date, int $page, int $engginer) {
        $index = ($page - 1) * 20;

        $query = 'SELECT
            wo.id,
            dn.name AS devicename,
            db.name AS brandname,
            cus.name AS customername
            FROM work_order_engginer_confirm AS woec
            INNER JOIN work_order AS wo ON wo.id = woec.work_order
            INNER JOIN assets AS ass ON ass.id = wo.asset
            INNER JOIN device_name AS dn ON dn.id = ass.device_name
            INNER JOIN device_brand AS db ON db.id = ass.device_brand
            INNER JOIN customer AS cus ON cus.id = wo.customer
            INNER JOIN location AS loc ON loc.id = wo.location
            WHERE DATE(wo.datecreated) = ? AND wo.engginer = ? AND woec.status = ?
            ORDER BY wo.datecreated DESC LIMIT '.$index.', 20';

        $list_progress = $this->db->rawQueryType('select', $query, array($date, $engginer, 0));

        if($list_progress) {
            return array('status'=> true, 'data'=> $list_progress);
        } else {
            return array('status'=> false, 'msg'=> 'tidak ada assets');
        }
    }

    public function detailWOEC(int $id) {
        $query_detail_woec = 'SELECT 
        woec.id, 
        woec.pic_list,
        dn.name AS devicename,
        db.name AS brandname
        ast.serial_number
        FROM 
        work_order_engginer_confirm AS woec 
        INNER JOIN work_order AS wo ON woec.work_order = wo.id 
        INNER JOIN customer AS cust ON wo.customer = cust.id 
        INNER JOIN assets AS ast ON wo.asset = ast.id 
        INNER JOIN `location` AS loc ON wo.location = loc.id 
        INNER JOIN device_name AS dn ON wo.device_name = dn.id
        INNER JOIN device_brand AS db ON wo.device_brand = db.id
        WHERE woec.id = ?';

        $woec_list = $this->db->rawQueryType('select', $query_detail_woec, array($id));

        $woec = $woec_list[0];

    }
}