<?php
namespace App\Model;
use System\Model as Model;

class Asset extends Model {
    public function createAsset(int $id_device_name, int $id_device_brand, string $serial_number, int $condition, string $description, string $datein, int $id_warehouse) {
        $fields = array('device_name', 'device_brand', 'serial_number', 'condition', 'description', 'date_in', 'warehouse');
        $values = array($id_device_name, $id_device_brand, $serial_number, $condition, $description, date($datein), $id_warehouse);

        $asset = $this->db->insert('assets', $fields, $values);

        return $asset;
    }

    public function deleteAsset(int $id_asset) {
        $asset_delete = $this->db->delete('assets', 'id = ?', array($id_asset));

        return $asset_delete;
    }

    public function editAsset(int $asset_id, int $id_device_name, int $id_device_brand, string $serial_number, int $condition, string $description, string $datein, int $id_warehouse) {
        $fields = array('device_name', 'device_brand', 'serial_number', 'condition', 'description', 'date_in', 'warehouse');
        $values = array($id_device_name, $id_device_brand, $serial_number, $condition, $description, date($datein), $id_warehouse);

        $asset = $this->db->update('assets', $fields, $values, 'id = '.$asset_id);

        return $asset;
    }

    public function listAssets(string $order, int $limit, int $index_start) {
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
        ORDER BY '.$order.' LIMIT '.$index_start.', '.$limit;
        
        $list_assets = $this->db->rawQueryType('select', $query_list_assets, array());

        return $list_assets;
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

        return $list_assets;
    }
}