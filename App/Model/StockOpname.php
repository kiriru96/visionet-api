<?php
namespace App\Model;
use System\Model as Model;

class StockOpname extends Model {

  public function getIdHistoryByDate(string $date) {
        $stock_opname_history = $this->db->selectColumns(array('id'), 'stock_opname_history', 'DATE(date) = ? AND status = ?', array($date, 1));

        if($stock_opname_history) {
            return $stock_opname_history[0];
        } else {
            return null;
        }
    }

    public function checkStockOpnameHistory() {
        $stock_opname_history = $this->db->selectColumns(array('id', 'date'), 'stock_opname_history', 'status = ?', array(0));

        if($stock_opname_history) {
            return $stock_opname_history[0];
        } else {
            return null;
        }
    }

    private function checkStockOpnameAvailabel($id_history, $id_asset) {
        $stock_opname = $this->db->selectColumns(array('id_history', 'id_asset'), 'stock_opname', 'status = ? AND id_history = ? AND id_asset = ?', array(0, $id_history, $id_asset));

        if($stock_opname) {
            return $stock_opname[0];
        } else {
            return null;
        }
    }

    public function createStockOpname() {
        $date_now = date('Y-m-d');
        $fields = array('date');
        $values = array($date_now);

        $stock_opname_history = $this->db->selectColumns(array('id'), 'stock_opname_history', 'status = ?', array(0));

        if(count($stock_opname_history) <= 0) {
            $stock_opname = $this->db->insert('stock_opname_history', $fields, $values);

            if($stock_opname) {
                return array('status'=> true, 'id'=> $stock_opname, 'date'=> $date_now);
            } else {
                return array('status'=> false, 'msg'=> 'gagal membuat stock opname');
            }
        } else {
            return array('status'=> false, 'msg'=> 'Terdapat stock opname yang sedang diproses');
        }
    }

    public function insertStockOpnameList(int $id_asset, int $stock_available, int $stock_actual, int $stock_diff, string $description) {
        $checkHistorySO = $this->checkStockOpnameHistory();

        if($checkHistorySO) {
            $id_history = (int) $checkHistorySO['id'];

            $checkStockOpname = $this->checkStockOpnameAvailabel($id_history, $id_asset);

            if(!$checkStockOpname) {
                $fields = array('id_history', 'id_asset', 'current_stock_available', 'actual_stock_available', 'stock_difference', 'description');
                $values = array($id_history, $id_asset, $stock_available, $stock_actual, $stock_diff, $description);
        
                $stock_opname_input = $this->db->insert('stock_opname', $fields, $values, 2);
        
                if($stock_opname_input) {
                    return array('status'=> true, 'msg'=> 'Berhasil memasukan stock opname.');
                } else {
                    return array('status'=> false, 'msg'=> 'Gagal memasukan.');
                }
            } else {
                return array('status'=> false, 'msg'=> 'Asset sudah diinput.');
            }
        } else {
            return array('status'=> false, 'msg'=> 'Gagal memasukan, tidak ada proses Stock Opname yang berlangsung.');
        }
    }

    public function deleteStockOpnameList(int $id_history, int $id_asset) {
        $stock_opname = $this->db->delete('stock_opname', 'id_history = ? AND id_asset = ? AND status = ?', array($id_history, $id_asset, 0));

        if($stock_opname) {
            return array('status'=> true, 'msg'=> 'Berhasil menghapus.');
        } else {
            return array('status'=> false, 'msg'=> 'Gagal menghapus.');
        }
    }

    public function submitStockOpnameHistory(int $id_history) {
        $query = 'UPDATE assets AS ass, stock_opname AS so, stock_opname_history AS soh
            SET
                ass.stock_available = so.actual_stock_available,
                so.status = 1,
                soh.status = 1
            WHERE
                ass.id = so.id_asset AND so.status = 0';
        
        $update_stock_opname = $this->db->rawQueryType('update', $query, array());

        if($update_stock_opname) {
            // $fields = array('status');
            // $values = array(1);
    
            // $stock_opname_history = $this->db->update('stock_opname_history', $fields, $values, 'status = 0 AND id = '.$id_history);
    
            // if($stock_opname_history) {
            return array('status'=> true, 'msg'=> 'berhasil membuat stock opname');
            // } else {
            //     return array('status'=> false, 'msg'=> 'Gagal membuat stock opname');
            // }
        } else {
            return array('status'=> false, 'msg'=> 'Gagal membuat stock opname');
        }
    }

    public function listHistory(string $search, int $page, string $orderby, string $order, int $limit) {
        $index = ($page - 1) * $limit;

        $query = 'SELECT id, `date` FROM stock_opname_history WHERE status = ? ORDER BY `date` DESC LIMIT '.$index.', '.$limit;

        $list_stock_opname_history = $this->db->rawQueryType('select', $query, array(1));

        if($list_stock_opname_history) {
            return array('status'=> true, 'data'=> $list_stock_opname_history);
        } else {
            return array('status'=> false, 'msg'=> 'tidak ada data yang ditemukan.');
        }
    }

    public function reportTable(int $id_history) {
        $query = 'SELECT
            so.id_history,
            so.id_asset,
            dn.name AS devicename,
            db.name AS brandname,
            ass.model,
            ass.serial_number,
            so.description,
            so.current_stock_available,
            so.actual_stock_available,
            so.stock_difference
            FROM stock_opname AS so
            INNER JOIN assets AS ass ON ass.id = so.id_asset
            INNER JOIN device_name AS dn ON dn.id = ass.device_name
            INNER JOIN device_brand AS db ON db.id = ass.device_brand
            INNER JOIN stock_opname_history AS soh ON soh.id = so.id_history
            WHERE so.id_history = ? AND so.status = ?
            ORDER BY so.datecreated DESC';

        $table_stock_opname = $this->db->rawQueryType('select', $query, array($id_history, 1));

        if($table_stock_opname) {
            return array('status'=> true, 'data'=> $table_stock_opname);
        } else {
            return array('status'=> false, 'msg'=> 'tidak ada data.');
        }
    }

    public function listRecord(int $id_history, string $search, int $page, string $orderby, string $order, int $limit) {
        $index = ($page - 1) * $limit;

        $query = 'SELECT
            so.id_history,
            so.id_asset,
            dn.name AS devicename,
            db.name AS brandname,
            ass.model,
            ass.serial_number,
            so.description,
            so.current_stock_available,
            so.actual_stock_available,
            so.stock_difference
            FROM stock_opname AS so
            INNER JOIN assets AS ass ON so.id_asset = ass.id
            INNER JOIN device_name AS dn ON ass.device_name = dn.id
            INNER JOIN device_brand AS db ON ass.device_brand = db.id
            WHERE so.status = ? AND so.id_history = ?
            ORDER BY so.datecreated DESC LIMIT '.$index.', '.$limit;

        $list_stock_opname = $this->db->rawQueryType('select', $query, array(0, $id_history));
        
        if($list_stock_opname) {
            return array('status'=> true, 'data'=> $list_stock_opname);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find list data.');
        }
    }

    public function allRowsHistory(int $status) {
        $query = 'SELECT COUNT(*) AS len FROM stock_opname_history WHERE status = ?';

        $stock_opname_history = $this->db->rawQueryType('select', $query, array($status));

        return $stock_opname_history[0]['len'];
    }

    public function allRows(int $id_history, int $status) {
        $query = 'SELECT COUNT(*) AS len FROM stock_opname WHERE status = ? AND id_history = ?';

        $stock_opname = $this->db->rawQueryType('select', $query, array($status, $id_history));

        return $stock_opname[0]['len'];
    }
}