<?php
namespace App\Model;
use System\Model as Model;

class StockOut extends Model {
    private function checkStockIn($asset_id, $id_account, $type_account) {
        $history = $this->db->selectColumns(array('asset_id', 'status'), 'stock_out_history', 'status = ? AND asset_id = ?', array(0, $asset_id));

        if($history) {
            return $history[0];
        } else {
            return null;
        }
    }

    private function updateStockAsset(int $asset_id, int $count_input) {
        $query = 'UPDATE assets SET stock_out = stock_out + ? , stock_available = stock_available - ? WHERE id = ?';

        $result = $this->db->rawQueryType('update', $query, array($count_input, $count_input, $asset_id));

        return $result;
    }

    public function newStock($asset_id, $count, $id_account, $type_account) {
        $check_history = $this->checkStockIn($asset_id, $id_account, $type_account);

        if(!$check_history) {
            $fields = array('asset_id', 'count_input', 'id_account', 'type_account', 'status');
            $values = array($asset_id, $count, $id_account, $type_account, 0);

            $stock_in_history = $this->db->insert($fields, $values, 'stock_in_history');

            if($stock_in_history) {
                $result = $this->updateStockAsset($asset_id, $count);
            } else {

            }

        } else {
            $fields = array('count_input');
            $values = array($count);

            $stock_in_history = $this->db->update(
                $fields, 
                $values, 
                'stock_in_history', 
                'asset_id = '.$asset_id.' AND id_account = '.$id_account.' AND type_account = '.$type_account.' AND status = 0');

            if($stock_in_history) {
                $result = $this->updateStockAsset($asset_id, $count);
            } else {

            }
        }
    }

    public function editStock($asset_id, $count, $id_account, $type_account) {
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

    public function deleteStock($asset_id, $id_account, $type_account) {
        $stock_in_history = $this->db->delete('stock_in_history', 'asset_id = ? AND id_account = ? AND type_account = ? AND status = ?', array($asset_id, $id_account, $type_account, 0));
        
        if($stock_in_history) {
            $result = $this->updateStockAsset($asset_id, $count);
            return array('status'=> true, 'msg'=> 'berhasil menghapus data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus data.');
        }
    }

    public function listStock() {
        $query = 'SELECT
                dn.name AS devicename,
                db.name AS brandname,
                ass.model,
                sih.count_input,
                CASE 
                    WHEN sih.type_account = 0 THEN adm.fullname
                    WHEN sih.type_account = 1 THEN CONCAT(lead.first_name, " ", lead.last_name)
                    WHEN sih.type_account = 2 THEN CONCAT(bl.first_name, " ", bl.last_name)
                    WHEN sih.engginer = 3 THEN CONCAT(eng.first_name, " ", eng.last_name)
                    ELSE adm.fullname
                END AS fullname
                FROM stock_in_history AS sih
                INNER JOIN assets AS ass ON sih.asset = ass.id
                LEFT JOIN admin AS adm ON sih.id_account = adm.id AND sih.type_account = 0
                LEFT JOIN leader AS lead ON sih.id_account = lead.id AND sih.type_account = 1
                LEFT JOIN backupleader AS bl ON sih.id_account = bl.id AND sih.type_account = 2
                LEFT JOIN engginer AS eng ON sih.id_account = eng.id AND sih.type_account = 3
                INNER JOIN device_name AS dn ON ass.device_name = dn.id
                INNER JOIN device_brand AS db ON ass.device_brand = db.id
                ORDER BY sih.datecreated ASC';

        $list_stock_in_history = $this->db->rawQueryType('select', $query, array());

        if($list_stock_in_history) {
            return array('result'=> true, 'data'=> $list_stock_in_history);
        } else {
            return array('result'=> false, 'msg'=> 'belum ada data.');
        }
    }

    public function submitstock($id_account, $type_account) {
        $history_list = $this->db->selectColumns(array('asset_id', 'stock_input'), 'stock_in_history', 'id_account = ? AND type_account = ?', array($id_account, $type_account));

        if($history_list) {
            $list_asset = array();
            foreach ($history_llist as $key => $value) {
                
            }
        } else {

        }
    }
}