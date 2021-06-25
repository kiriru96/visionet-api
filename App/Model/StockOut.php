<?php
namespace App\Model;
use System\Model as Model;

class StockOut extends Model {
    private function checkStock(int $asset_id, int $id_account) {
        $history = $this->db->selectColumns(array('asset_id', 'status', 'count_input'), 'stock_out_history', 'status = ? AND asset_id = ? AND id_account = ?', array(0, $asset_id, $id_account));

        if($history) {
            return $history[0];
        } else {
            return null;
        }
    }

    private function checkStockAvailable(int $asset_id, int $count) {
        $stock = $this->db->selectColumns(array('id', 'stock_available'), 'assets', 'id = ? AND stock_available >= ?', array($asset_id, $count));

        if($stock) {
            return $stock[0];
        } else {
            return null;
        }
    }

    public function newStock(int $asset_id, int $count, int $id_account) {
        $check_history = $this->checkStock($asset_id, $id_account);

        if(!$check_history) {
            $checkAssetStockAvailable = $this->checkStockAvailable($asset_id, $count);
            if($checkAssetStockAvailable) {
                $fields = array('asset_id', 'count_input', 'id_account', 'status');
                $values = array($asset_id, $count, $id_account, 0);

                $result = $this->db->insert('stock_out_history', $fields, $values, 2);

                if($result) {
                    return array('status'=> true, 'msg'=> 'Berhasil memasukan data.');
                } else {
                    return array('status'=> false, 'msg'=> 'Gagal memasukan data');
                }
            } else {
                return array('status'=> false, 'msg'=> 'Jumlah dimasukan melebihi stok yang ada.');
            }
        } else {
            $new_count_input = (int) $check_history['count_input'] + $count;
            
            $checkAssetStockAvailable = $this->checkStockAvailable($asset_id, $new_count_input);
            
            if($checkAssetStockAvailable) {
                $query = 'UPDATE stock_out_history SET count_input = (count_input + ?) WHERE id_account = ? AND status = ? AND asset_id = ?';
                
                $result = $this->db->rawQueryType('update', $query, array($count, $id_account, 0, $asset_id));
    
                if($result) {
                    return array('status'=> true, 'msg'=> 'Berhasil memasukan data.');
                } else {
                    return array('status'=> false, 'msg'=> 'Gagal memasukan data');
                }
            } else {
                return array('status'=> false, 'msg'=> 'Jumlah dimasukan melebihi stok yang ada.');
            }
        }
    }

    public function deleteStock($asset_id, $id_account) {
        $check_history = $this->checkStock($asset_id, $id_account);
        if($check_history) {
            $stock_in_history = $this->db->delete('stock_out_history', 'asset_id = ? AND id_account = ? AND status = ?', array($asset_id, $id_account, 0));

            if($stock_in_history) {
                return array('status'=> true, 'msg'=> 'berhasil menghapus data.');
            } else {
                return array('status'=> false, 'msg'=> 'gagal menghapus data.');
            }
        } else {
            return array('status'=> false, 'msg'=> 'tidak ada data yang dihapus.');
        }
    }

    public function listStock(int $id) {
        $query = 'SELECT
                soh.asset_id AS assetid,
                dn.name AS devicename,
                db.name AS brandname,
                ass.model,
                soh.count_input AS quantity,
                adm.fullname AS fullname
                FROM stock_out_history AS soh
                INNER JOIN assets AS ass ON soh.asset_id = ass.id
                LEFT JOIN admin AS adm ON soh.id_account = adm.id AND soh.type_account = 0
                INNER JOIN device_name AS dn ON ass.device_name = dn.id
                INNER JOIN device_brand AS db ON ass.device_brand = db.id
                WHERE soh.id_account = ? AND soh.status = ?
                ORDER BY soh.datecreated ASC';

        $list_stock_in_history = $this->db->rawQueryType('select', $query, array($id, 0));

        if($list_stock_in_history) {
            return array('status'=> true, 'data'=> $list_stock_in_history);
        } else {
            return array('status'=> false, 'msg'=> 'belum ada data.');
        }
    }

    public function submitstock($id_account) {
        $query = 'UPDATE 
            assets AS ass, 
            stock_out_history AS soh
            SET
                ass.stock_out = ass.stock_out + soh.count_input,
                ass.stock_available = ass.stock_available - soh.count_input,
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