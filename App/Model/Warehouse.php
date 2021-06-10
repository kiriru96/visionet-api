<?php
namespace App\Model;
use System\Model as Model;

class Warehouse extends Model {
    private function checkRecordExists(string $name) {
        $list_brands = $this->db->selectColumns(array('name'), 'warehouse', 'name = ?', array(trim($name)));

        if($list_brands) {
            return $list_brands[0]['name'];
        } else {
            return null;
        }
    }

    public function addWareHouse(string $name) {
        $checkRecord = $this->checkRecordExists($name);
        
        if(!$checkRecord) {
            $fields = array('name');
            $values = array($name);

            $id_warehouse = $this->db->insert('warehouse', $fields, $values);

            if($id_warehouse) {
                return array('status'=> true, 'id'=> $id_warehouse);
            } else {
                return array('status'=> false, 'msg'=> 'gagal membuat data.');
            }
        } else {
            return array('status'=> false, 'msg'=> 'nama sudah digunakan');
        }
    }

    public function deleteWareHouse(int $id_warehouse) {
        $delete_warehouse = $this->db->delete('warehoue', 'id = ?', array($id_warehouse));

        if($delete_warehouse) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus data.');
        }
    }

    public function editWareHouse(int $id_warehouse, string $name) {
        $fields = array('name');
        $values = array($name);

        $update_warehouse = $this->db->update('warehouse', $fields, $values, 'id = '.$id_warehouse);

        if($update_warehouse) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui data.');
        }
    }

    public function listWareHouse(string $search, int $page, string $orderby, string $order, int $limit) {
        $index = ($page - 1) * $limit;

        $src = '%'.trim($search).'%';

        $list_warehouses = $this->db->selectColumns(array('id', 'name'), 'warehouse', ' name LIKE ? ORDER BY '.$orderby.' DESC LIMIT '.$index.','.$limit, array($src));

        if($list_warehouses) {
            return array('status'=> true, 'data'=> $list_warehouses);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find list data.');
        }
    }

    public function getWareHouse(int $id_warehouse) {
        $list_warehouses = $this->db->selectColumns(array('id', 'name'), 'warehouse', 'id = ?', array($id_warehouse));

        $warehouse = $list_warehouses[0];

        if($warehouse) {
            return array('status'=> true, 'data'=> $warehouse);
        } else {
            return array('status'=> false, 'msg'=> 'data tidak ditemukan.');
        }
    }
    
    public function allRows() {
        $query = 'SELECT count(*) AS len FROM warehouse';

        $res = $this->db->rawQueryType('select', $query, array());

        return $res[0]['len'];
    }
}