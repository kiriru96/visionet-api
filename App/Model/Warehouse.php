<?php
namespace App\Model;
use System\Model as Model;

class Warehouse extends Model {
    public function addWareHouse(string $name) {
        $fields = array('name');
        $values = array($name);

        $id_warehouse = $this->db->insert('warehouse', $fields, $values);

        return $id_warehouse;
    }

    public function deleteWareHouse(int $id_warehouse) {
        $delete_warehouse = $this->db->delete('warehoue', 'id = ?', array($id_warehouse));

        return $delete_warehouse;
    }

    public function editWareHouse(int $id_warehouse, string $name) {
        $fields = array('name');
        $values = array($name);

        $update_warehouse = $this->db->update('warehouse', $fields, $values, 'id = '.$id_warehouse);

        return $update_warehouse;
    }

    public function listWareHouse(string $order, int $limit, int $index_start) {
        $list_warehouses = $this->db->selectColumns(array('id', 'name'), 'warehouse', 'ORDER BY '.$order.' LIMIT '.$index_start.','.$limit, array());

        return $list_warehouses;
    }

    public function getWareHouse(int $id_warehouse) {
        $list_warehouses = $this->db->selectColumns(array('id', 'name'), 'warehouse', 'id = ?', array($id_warehouse));

        $warehouse = $list_warehouses[0];

        return $warehouse;
    }
}