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

    public function addRecord(string $name) {
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

    public function deleteRecord(int $id_warehouse) {
        $fields = array('deleted');
        $values = array(1);

        // $delete_warehouse = $this->db->delete('warehoue', 'id = ?', array($id_warehouse));
        // $delete_warehouse = $this->db->update('warehouse', $fields, )

        if($delete_warehouse) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus data.');
        }
    }

    public function editRecord(int $id_warehouse, string $name) {
        $fields = array('name');
        $values = array($name);

        $update_warehouse = $this->db->update('warehouse', $fields, $values, 'id = '.$id_warehouse);

        if($update_warehouse) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui data.');
        }
    }

    public function listRecord(string $search, int $page, string $orderby, string $order, int $limit) {
        $index = ($page - 1) * $limit;

        $src = '%'.trim($search).'%';

        $list_warehouses = $this->db->selectColumns(array('id', 'name'), 'warehouse', ' name LIKE ? ORDER BY '.$orderby.' DESC LIMIT '.$index.','.$limit, array($src));

        if($list_warehouses) {
            return array('status'=> true, 'data'=> $list_warehouses);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find list data.');
        }
    }

    public function lightListRecord(string $search) {
        $list_brands = null;

        if(trim($search) !== '' && strlen(trim($search)) >= 2) {
            $src = '%'.trim($search).'%';
            $list_brands = $this->db->selectColumns(array('id', 'name'), 'warehouse', ' name LIKE ? ORDER BY id ASC LIMIT 0, 20', array($src));
        }

        if($list_brands) {
            return array('status'=> true, 'data'=> $list_brands);
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
    
    public function allRows(string $search) {
        $src = '%'.trim($search).'%';

        $query = 'SELECT count(*) AS len FROM warehouse  WHERE name LIKE ?';

        $res = $this->db->rawQueryType('select', $query, array($src));

        return $res[0]['len'];
    }
}