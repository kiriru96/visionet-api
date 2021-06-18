<?php
namespace App\Model;
use System\Model as Model;

class StockIn extends Model {
    private function checkStockIn($asset_id, $id_account, $type_account) {
        $history = $this->db->selectColumns(array('asset_id', 'status'), 'stock_in_history', 'status = ? AND asset_id = ?', array(0, $asset_id));

        if($history) {
            return $history[0];
        } else {
            return null;
        }
    }

    public function newStockIn($asset_id, $count, $id_account, $type_account) {
        $check_history = $this->checkStockIn($asset_id, $id_account, $type_account);

        if(!$check_history) {
            $fields = array('asset_id', 'count_input', 'id_account', 'type_account', 'status');
            $values = array($asset_id, $count, $id_account, $type_account, 0);
        } else {
            $fields = array('count_input');
            $values = array($count);

            $stock_in_history = $this->db->update(
                $fields, 
                $values, 
                'stock_in_history', 
                'asset_id = '.$asset_id.' AND id_account = '.$id_account.' AND type_account = '.$type_account.' AND status = 0');
        }
    }

    public function editStockIn($asset_id, $count, $id_account, $type_account) {
        $fields = array('count_input');
        $values = array($count);

        $stock_in_history = $this->db->update(
            $fields, 
            $values, 
            'stock_in_history', 
            'asset_id = '.$asset_id.' AND id_account = '.$id_account.' AND type_account = '.$type_account.' AND status = 0');

        if($stock_in_history) {
            return array('status'=> true, 'data'=> array('asset_id'=> $asset_id, 'count'=> $count));
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui stock.');
        }
    }

    public function deleteStockIn($asset_id, $id_account, $type_account) {
        $stock_in_history = $this->db->delete('stock_in_history', 'asset_id = ? AND id_account = ? AND type_account = ? AND status = ?', array($asset_id, $id_account, $type_account, 0));
        
    }
}