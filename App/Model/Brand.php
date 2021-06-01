<?php
namespace App\Model;
use System\Model as Model;

class Brand extends Model {
    public function addRecord(string $name) {
        $fields = array('name');
        $values = array($name);

        $id_brand = $this->db->insert('device_brand', $fields, $values);

        if($id_brand) {
            return array('status'=> true, 'id'=> $id_brand);
        } else {
            return array('status'=> false, 'msg'=> 'gagal membuat data.');
        }
    }

    public function deleteRecord(int $id_brand) {
        $delete_brand = $this->db->delete('device_brand', 'id = ?', array($id_brand));

        if($delete_brand) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus data.', 'id'=> $id_brand);
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus data.');
        }
    }

    public function editRecord(int $id_brand, string $name) {
        $fields = array('name');
        $values = array($name);

        $update_brand = $this->db->update('device_brand', $fields, $values, 'id = '.$id_brand);

        if($update_brand) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui data.', 'data'=> array('id'=>$id_brand, 'name'=> $name));
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui data.');
        }
    }

    public function listRecord(string $order, int $limit, int $index_start) {
        $list_brands = $this->db->selectColumns(array('id', 'name'), 'device_brand', 'ORDER BY '.$order.' LIMIT '.$index_start.','.$limit, array());

        if($list_brands) {
            return array('status'=> true, 'data'=> $list_brands);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find list data.');
        }
    }

    public function getRecord(int $id_brand) {
        $list_brands = $this->db->selectColumns(array('id', 'name'), 'device_brand', 'id = ?', array($id_brand));

        if($list_brands) {
            $brand = $list_brands[0];
    
            return array('status'=> true, 'data'=> $brand);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find any data.');
        }
    }
}