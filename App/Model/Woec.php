<?php
// Woec = Work Order Engginer Confirm

namespace App\Model;
use System\Model as Model;

class Woec extends Model {
    // check if work order is exists in the table, to prevent double work order id
    private function checkWOECExists(int $wo) {
        $woec = $this->db->selectColumns(array('work_order'), 'work_order_engginer_confirm', 'work_order = ?', array($wo));

        if($woec[0]) {
            return true;
        } else {
            return false;
        }
    }
    // insert woec to table
    public function addWorkOrderConfirm(int $wo, string $pics) {
        $check_woec = $this->checkWOECExists($wo);

        if($check_woec) {
            $fields = array('work_order', 'pic_list');
            $values = array($wo, $pics);
    
            $woec_id = $this->db->insert('work_order_engginer_confirm', $fields, $values);

            return array('status'=> true, 'id'=> $woec_insert);
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

        $query = 'SELECT'
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