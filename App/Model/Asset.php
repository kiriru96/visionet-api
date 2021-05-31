<?php
namespace App\Model;
use System\Model as Model;

class Asset extends Model {
    private function checkSerialNumberExists(string $serial_number) {
        $assets = $this->db->selectColumns(array('serial_number'), 'assets', 'serial_number = ?', array($serial_number));

        return $assets[0];
    }

    public function addAsset(int $id_device_name, int $id_device_brand, string $serial_number, int $condition, string $description, string $datein, int $id_warehouse) {
        $checkAsset = $this->checkSerialNumberExists($serial_number);

        if($checkAsset) {
            $fields = array('device_name', 'device_brand', 'serial_number', 'condition', 'description', 'date_in', 'warehouse');
            $values = array($id_device_name, $id_device_brand, $serial_number, $condition, $description, date($datein), $id_warehouse);
    
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

    public function editAsset(int $asset_id, int $id_device_name, int $id_device_brand, string $serial_number, int $condition, string $description, string $datein, int $id_warehouse) {
        $fields = array('device_name', 'device_brand', 'serial_number', 'condition', 'description', 'date_in', 'warehouse');
        $values = array($id_device_name, $id_device_brand, $serial_number, $condition, $description, date($datein), $id_warehouse);

        $asset = $this->db->update('assets', $fields, $values, 'id = '.$asset_id);

        if($asset > 0) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui.');
        }
    }

    public function listAssets(string $src, string $order, int $limit, int $index_start) {
        $where = '';
        $values = array();

        if(trim($src) != '') {
            $src_value = '%'.trim($src).'%';

            $where = ' WHERE assets.serial_number LIKE ?';

            array_push($values, $src_value);
        }

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
        '.$where.'
        ORDER BY '.$order.' LIMIT '.$index_start.', '.$limit;
        
        $list_assets = $this->db->rawQueryType('select', $query_list_assets, $values);

        if($list_assets) {
            return array('status'=> true, 'list'=> $list_assets);
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
}