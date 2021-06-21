<?php
namespace App\Model;
use System\Model as Model;

class StockIn extends Model {
    private function checkStock(int $asset_id, int $id_account) {
        $history = $this->db->selectColumns(array('asset_id', 'status', 'count_input'), 'stock_in_history', 'status = ? AND asset_id = ?', array(0, $asset_id));

        if($history) {
            return $history[0];
        } else {
            return null;
        }
    }

    public function newStock(int $asset_id, int $count, int $id_account) {
        $check_history = $this->checkStock($asset_id, $id_account);

        if(!$check_history) {
            $fields = array('asset_id', 'count_input', 'id_account', 'status');
            $values = array($asset_id, $count, $id_account, 0);

            $result = $this->db->insert('stock_in_history',$fields, $values, 2);

            if($result) {
                return array('status'=> true, 'msg'=> 'Berhasil memasukan data.');
            } else {
                return array('status'=> false, 'msg'=> 'Gagal memasukan data');
            }
        } else {
            $query = 'UPDATE stock_in_history SET count_input = (count_input + ?) WHERE id_account = ? AND status = ? AND asset_id = ?';
            
            $result = $this->db->rawQueryType('update', $query, array($count, $id_account, 0, $asset_id));

            if($result) {
                return array('status'=> true, 'msg'=> 'Berhasil memasukan data.');
            } else {
                return array('status'=> false, 'msg'=> 'Gagal memasukan data');
            }
        }
    }

    public function deleteStock(int $asset_id, int $id_account) {
        $check_history = $this->checkStock($asset_id, $id_account);
        if($check_history) {
            $stock_in_history = $this->db->delete('stock_in_history', 'asset_id = ? AND id_account = ? AND status = ?', array($asset_id, $id_account, 0));

            if($stock_in_history) {
                return array('status'=> true, 'msg'=> 'berhasil menghapus data.');
            } else {
                return array('status'=> false, 'msg'=> 'gagal menghapus data.');
            }
        } else {
            return array('status'=> false, 'msg'=> 'tidak ada data yang dihapus.');
        }
    }

    public function listStock(int $id, int $status) {
        $query = 'SELECT
                sih.asset_id AS assetid,
                dn.name AS devicename,
                db.name AS brandname,
                ass.model,
                sih.count_input AS quantity,
                adm.fullname AS fullname
                FROM stock_in_history AS sih
                INNER JOIN assets AS ass ON sih.asset_id = ass.id
                LEFT JOIN admin AS adm ON sih.id_account = adm.id AND sih.type_account = 0
                INNER JOIN device_name AS dn ON ass.device_name = dn.id
                INNER JOIN device_brand AS db ON ass.device_brand = db.id
                WHERE sih.id_account = ? AND sih.status = ?
                ORDER BY sih.datecreated ASC';

        $list_stock_in_history = $this->db->rawQueryType('select', $query, array($id, $status));

        if($list_stock_in_history) {
            return array('status'=> true, 'data'=> $list_stock_in_history);
        } else {
            return array('status'=> false, 'msg'=> 'belum ada data.');
        }
    }

    public function submitstock($id_account) {
        $query = 'UPDATE 
            assets AS ass, 
            stock_in_history AS soh
            SET
                ass.stock_in = ass.stock_in + soh.count_input,
                ass.stock_available = ass.stock_available + soh.count_input,
                soh.status = 1
            WHERE
                ass.id = soh.asset_id AND soh.status = 0 AND soh.id_account = ?';
        
        $result = $this->db->rawQueryType('update', $query, array($id_account));

        if($result) {
            return array('status'=> true, 'msg'=> 'Berhasil.');
        } else {
            return array('status'=> false, 'msg'=> 'Gagal.');
        }
    }
}