<?php
namespace App\Model;
use System\Model as Model;

class Warehouse extends Model {
    public function addWareHouse(string $name) {
        $fields = array('name');
        $values = array($name);

        $id_warehouse = $this->db->insert('warehouse', $fields, $values);

        if($id_warehouse) {
            return array('status'=> true, 'id'=> $id_warehouse);
        } else {
            return array('status'=> false, 'msg'=> 'gagal membuat data.');
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

    public function listWareHouse(string $order, int $limit, int $index_start) {
        $list_warehouses = $this->db->selectColumns(array('id', 'name'), 'warehouse', 'ORDER BY '.$order.' LIMIT '.$index_start.','.$limit, array());

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
}