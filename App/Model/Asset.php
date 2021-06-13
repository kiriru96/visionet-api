<?php
namespace App\Model;
use System\Model as Model;

class Asset extends Model {
    private function checkSerialNumberExists(string $serial_number) {
        $assets = $this->db->selectColumns(array('serial_number'), 'assets', 'serial_number = ?', array($serial_number));

        return $assets[0];
    }

    public function addAsset(int $id_device_name, int $id_device_brand, string $model, string $serial_number, int $condition, string $description, string $datein, int $id_warehouse) {
        $checkAsset = $this->checkSerialNumberExists($serial_number);

        if(!$checkAsset) {
            $fields = array('device_name', 'device_brand', 'model', 'serial_number', 'condition_status', 'description', 'date_in', 'warehouse');
            $values = array($id_device_name, $id_device_brand, $model, $serial_number, $condition, $description, date($datein), $id_warehouse);
    
            $asset = $this->db->insert('assets', $fields, $values);
    
            return array('status'=> true, 'id'=> $asset);
        } else {
            return array('status'=> false, 'msg'=> 'serial number sudah terpakai');
        }
    }

    public function deleteAsset(int $id_asset) {
        $asset_delete = $this->db->delete('assets', 'id = ?', array($id_asset));

        if($asset_delete > 0) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus.');
        }
    }

    public function editAsset(int $asset_id, int $id_device_name, int $id_device_brand, string $model, string $serial_number, int $condition, string $description, int $id_warehouse) {
        $fields = array('device_name', 'device_brand', 'model', 'serial_number', 'condition_Status', 'description', 'warehouse');
        $values = array($id_device_name, $id_device_brand, $model, $serial_number, $condition, $description, $id_warehouse);

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
                        ass.condition_status AS condition_id,
                        cond.name AS conditionstatus,
                        ass.description,
                        ass.warehouse AS warehouse_id,
                        wh.name AS warehousename,
                        ass.date_in,
                        ass.date_out,
                        ass.datecreated
                    FROM assets AS ass 
                        INNER JOIN device_brand AS db ON ass.device_brand = db.id
                        INNER JOIN device_name AS dn ON ass.device_name = dn.id
                        INNER JOIN warehouse AS wh ON ass.warehouse = wh.id
                        INNER JOIN conditions AS cond ON ass.condition_status = cond.id
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
    
    public function allRows(string $search) {
        $src = '%'.trim($search).'%';

        $query = 'SELECT count(*) AS len FROM assets WHERE serial_number LIKE ?';

        $res = $this->db->rawQueryType('select', $query, array($src));

        return $res[0]['len'];
    }
}