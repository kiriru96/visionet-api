<?php
namespace App\Model;
use System\Model as Model;

class Workorder extends Model {
    public function createWork($asset, $location, $customer) {
        $fields = array('asset', 'customer', 'location', 'engginer', 'status');
        $values = array($asset, $customer, $location, 0, 0);

        $wo = $this->db->insert('work_order', $fields, $values);

        return $wo;
    }

    public function signEngginer(int $id_work_order, int $id_engginer) {
        $fields = array('engginer');
        $values = array($id_engginer);

        $update_engginer_wo = $this->db->update('work_order', $fields, $values, 'id = '.$id_work_order);

        return $update_engginer_wo;
    }

    public function updateStatusWork(int $id_work_order, int $status) {
        $fields = array('status');
        $values = array($status);

        $update_status_wo = $this->db->pdate('work_order', $fields, $values, 'id = '.$id_work_order);
        
        return $update_status_wo;
    }
}