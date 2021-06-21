<?php
namespace App\Model;
use System\Model as Model;

class Asset extends Model {
    private function checkSerialNumberExists(string $serial_number) {
        $assets = $this->db->selectColumns(array('serial_number'), 'assets', 'serial_number = ?', array($serial_number));

        if($assets) {
            return $assets[0];
        } else {
            return null;
        }
    }

    public function addAsset(int $id_device_name, int $id_device_brand, string $model, string $serial_number, string $description) {
        $checkAsset = $this->checkSerialNumberExists($serial_number);

        if(!$checkAsset) {
            $fields = array('device_name', 'device_brand', 'model', 'serial_number', 'description');
            $values = array($id_device_name, $id_device_brand, $model, $serial_number, $description);
    
            $asset = $this->db->insert('assets', $fields, $values);
    
            return array('status'=> true, 'id'=> $asset);
        } else {
            return array('status'=> false, 'msg'=> 'serial number sudah terpakai');
        }
    }

    public function deleteRecord(int $id_asset) {
        $asset_delete = $this->db->delete('assets', 'id = ?', array($id_asset));

        if($asset_delete > 0) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus.');
        }
    }

    public function editAsset(int $asset_id, int $id_device_name, int $id_device_brand, string $model, string $serial_number, string $description) {
        $fields = array('device_name', 'device_brand', 'model', 'serial_number', 'description');
        $values = array($id_device_name, $id_device_brand, $model, $serial_number, $description);

        $asset = $this->db->update('assets', $fields, $values, 'id = '.$asset_id);

        if($asset > 0) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui.');
        }
    }

    public function listRecord(string $search, int $page, string $orderby, string $order, int $limit) {
        $index = ($page - 1) * $limit;

        $src = '%'.trim($search).'%';

        $query = 'SELECT 
                        ass.id,
                        ass.device_name AS device_id,
                        ass.device_brand AS brand_id,
                        dn.name AS devicename,
                        db.name AS brandname,
                        ass.model,
                        ass.serial_number,
                        ass.description,
                        ass.datecreated
                    FROM assets AS ass 
                        INNER JOIN device_brand AS db ON ass.device_brand = db.id
                        INNER JOIN device_name AS dn ON ass.device_name = dn.id
                    WHERE
                        ass.serial_number LIKE ?
                    ORDER BY ass.id DESC LIMIT '.$index.', '.$limit;

        $list_assets = $this->db->rawQueryType('select', $query, array($src));

        if($list_assets) {
            return array('status'=> true, 'data'=> $list_assets);
        } else {
            return array('status'=> false, 'msg'=> 'tidak ada assets');
        }
    }

    public function listAssetsByDate(string $datestart, string $dateend,string $order, int $limit, int $index_start) {
        $query_list_assets = 'SELECT 
        device_name.name as devicename,
        device_brand.name as brandname,
        assets.serial_number,
        assets.condition,
        assets.description,
        assets.date_in,
        assets.date_out,
        warehouse.name as warehousename
        FROM assets 
        INNER JOIN device_name ON  assets.device_name = device_name.id 
        INNER JOIN device_brand ON assets.device_brand = device_brand.id 
        INNER JOIN warehouse ON assets.warehouse = warehouse.id
        WHERE assets.datecreated BETWEEN '.$datestart.' AND '.$dateend.'
        ORDER BY '.$order.' LIMIT '.$index_start.', '.$limit;
        
        $list_assets = $this->db->rawQueryType('select', $query_list_assets, array());

        if($list_assets) {
            return array('status'=> true, 'list'=> $list_assets);
        } else {
            return array('status'=> false, 'msg'=> 'tidak ada assets');
        }
    }

    public function listAssetsByDevice(int $id_device, int $limit, int $index_start) {
        $query_list_assets = 'SELECT 
        device_name.name as devicename,
        device_brand.name as brandname,
        assets.serial_number,
        assets.condition,
        assets.description,
        assets.date_in,
        assets.date_out,
        warehouse.name as warehousename
        FROM assets 
        INNER JOIN device_name ON  assets.device_name = device_name.id 
        INNER JOIN device_brand ON assets.device_brand = device_brand.id 
        INNER JOIN warehouse ON assets.warehouse = warehouse.id
        WHERE assets.device_name = ?
        ORDER BY '.$order.' LIMIT '.$index_start.', '.$limit;
        
        $list_assets = $this->db->rawQueryType('select', $query_list_assets, array($id_device));

        if($list_assets) {
            return array('status'=> true, 'list'=> $list_assets);
        } else {
            return array('status'=> false, 'msg'=> 'tidak ada assets');
        }
    }

    public function listAssetsByBrand(int $id_brand, int $limit, int $index_start) {
        $query_list_assets = 'SELECT 
        device_name.name as devicename,
        device_brand.name as brandname,
        assets.serial_number,
        assets.condition,
        assets.description,
        assets.date_in,
        assets.date_out,
        warehouse.name as warehousename
        FROM assets 
        INNER JOIN device_name ON  assets.device_name = device_name.id 
        INNER JOIN device_brand ON assets.device_brand = device_brand.id 
        INNER JOIN warehouse ON assets.warehouse = warehouse.id
        WHERE assets.device_brand = ?
        ORDER BY '.$order.' LIMIT '.$index_start.', '.$limit;
        
        $list_assets = $this->db->rawQueryType('select', $query_list_assets, array($id_brand));

        if($list_assets) {
            return array('status'=> true, 'list'=> $list_assets);
        } else {
            return array('status'=> false, 'msg'=> 'tidak ada assets');
        }
    }

    public function searchAsset(string $search) {
        $src = '%'.trim($search).'%';

        $query = 'SELECT 
            ass.id AS assetid,
            ass.stock_available,
            dn.name AS devicename,
            db.name AS brandname,
            ass.serial_number
            FROM assets AS ass
            INNER JOIN device_name AS dn ON dn.id = ass.device_name
            INNER JOIN device_brand AS db ON db.id = ass.device_brand
            WHERE ass.serial_number LIKE ? OR dn.name LIKE ?
            ORDER BY ass.id ASC LIMIT 0, 20';

        $result = $this->db->rawQueryType('select', $query, array($src, $src));

        if($result) {
            return array('status'=> true, 'data'=> $result);
        } else {
            return array('status'=> false, 'msg'=> 'tidak ditemukan');
        }
    }

    public function reportTable(string $date) {
        $query = 'SELECT
        FROM assets AS ass
        INNER JOIN device_name AS dn ON ass.device_name = dn.id
        INNER JOIN device_brand AS db ON ass.device_brand = db.id
        INNER JOIN conditions AS cond ON ass.condition_status = cond.id
        INNER JOIN warehouse AS wh ON ass.warehouse = wh.id
        WHERE ass.date_in = ?';

        $report_table = $this->db->rawQueryType('select', $query, array($src));

        if($report_table) {
            return array('status'=> true, 'table'=> $report_table);
        } else {
            return array('status'=> false, 'msg'=> 'Tidak terdapat data yang bisa ditampilkan.');
        }
    }
    
    public function allRows(string $search) {
        $src = '%'.trim($search).'%';

        $query = 'SELECT count(*) AS len FROM assets WHERE serial_number LIKE ?';

        $res = $this->db->rawQueryType('select', $query, array($src));

        return $res[0]['len'];
    }

    public function report_stock_out(string $datestart, string $dateend) {
        $query = 'SELECT
            dn.name AS devicename,
            db.name AS brandname,
            ass.serial_number,
            ass.model,
            adm.fullname AS adminname,
            soh.datecreated,
            soh.count_input
            FROM stock_out_history AS soh
            INNER JOIN assets AS ass ON ass.id = soh.asset_id
            INNER JOIN admin AS adm ON adm.id = soh.id_account
            INNER JOIN device_name AS dn ON dn.id = ass.device_name
            INNER JOIN device_brand AS db ON db.id = ass.device_brand
            WHERE soh.status = ? AND DATE(soh.datecreated) BETWEEN ? AND ?
            ORDER BY soh.datecreated ASC';
        
        $result = $this->db->rawQueryType('select', $query, array(1, $datestart, $dateend));

        if($result) {
            return array('status'=> true, 'data'=> $result);
        } else {
            return array('status'=> false, 'msg'=> 'Tidak menemukan data');
        }
    }

    public function report_stock_in(string $datestart, string $dateend) {
        $query = 'SELECT
            dn.name AS devicename,
            db.name AS brandname,
            ass.serial_number,
            ass.model,
            adm.fullname AS adminname,
            sih.datecreated,
            sih.count_input
            FROM stock_in_history AS sih
            INNER JOIN assets AS ass ON ass.id = sih.asset_id
            INNER JOIN admin AS adm ON adm.id = sih.id_account
            INNER JOIN device_name AS dn ON dn.id = ass.device_name
            INNER JOIN device_brand AS db ON db.id = ass.device_brand
            WHERE sih.status = ? AND DATE(sih.datecreated) BETWEEN ? AND ?
            ORDER BY sih.datecreated ASC';
        
        $result = $this->db->rawQueryType('select', $query, array(1, $datestart, $dateend));

        if($result) {
            return array('status'=> true, 'data'=> $result);
        } else {
            return array('status'=> false, 'msg'=> 'Tidak menemukan data');
        }
    }

    public function allRowsCustom(string $column, int $type) {

        $query = 'SELECT 
                    count(*) AS len 
                FROM assets AS ass 
                INNER JOIN device_name AS dn ON  ass.device_name = dn.id 
                INNER JOIN device_brand AS db ON ass.device_brand = db.id 
                INNER JOIN warehouse AS wh ON ass.warehouse = wh.id
                INNER JOIN conditions AS cond ON ass.condition_status = cond.id
                WHERE '.$column.' = '.$type;
        
        $res = $this->db->rawQueryType('select', $query, array());

        return $res[0]['len'];
    }
}