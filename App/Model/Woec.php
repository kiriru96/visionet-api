<?php
// Woec = Work Order Engginer Confirm

namespace App\Model;
use System\Model as Model;

class Woec extends Model {
    private function checkWOECExists(int $wo) {
        $woec = $this->db->selectColumns(array('work_order'), 'work_order_engginer_confirm', 'work_order = ?', array($wo));

        if($woec[0]) {
            return true;
        } else {
            return false;
        }
    }

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

    public function updateWorkOrderConfirm(int $id, string $pics) {
        $fields = array('pic_list');
        $values = array($pics);

        $woec_update = $this->db->update('work_order_engginer_confirm', $fields, $values, 'id = '.$id);

        return $woec_update;
    }

    public function listWOEC(string $date, int $limit, int $index_start) {
        
    }
}