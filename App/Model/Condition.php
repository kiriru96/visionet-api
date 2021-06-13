<?php
namespace App\Model;
use System\Model as Model;

class Condition extends Model {

    public function lightListRecord(string $search) {
        $list_brands = null;

        $list_brands = $this->db->selectColumns(array('id', 'name'), 'conditions', 'ORDER BY id ASC', array());

        if($list_brands) {
            return array('status'=> true, 'data'=> $list_brands);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find list data.');
        }
    }
}