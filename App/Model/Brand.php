<?php
namespace App\Model;
use System\Model as Model;

class Brand extends Model {
    public function addBrand(string $name) {
        $fields = array('name');
        $values = array($name);

        $id_brand = $this->db->insert('device_brand', $fields, $values);

        if($id_brand) {
            return array('status'=> true, 'id'=> $id_brand);
        } else {
            return array('status'=> false, 'msg'=> 'gagal membuat data.');
        }
    }

    public function deleteBrand(int $id_brand) {
        $delete_brand = $this->db->delete('device_brand', 'id = ?', array($id_brand));

        if($delete_brand) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus data.');
        }
    }

    public function editBrand(int $id_Brand, string $name) {
        $fields = array('name');
        $values = array($name);

        $update_brand = $this->db->update('device_brand', $fields, $values, 'id = '.$id_brand);

        if($update_brand) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui data.');
        }
    }

    public function listBrand(string $order, int $limit, int $index_start) {
        $list_brands = $this->db->selectColumns(array('id', 'name'), 'device_brand', 'ORDER BY '.$order.' LIMIT '.$index_start.','.$limit, array());

        return $list_brands;
    }

    public function getBrand(int $id_brand) {
        $list_brands = $this->db->selectColumns(array('id', 'name'), 'device_brand', 'id = ?', array($id_brand));

        $brand = $list_brands[0];

        return $brand;
    }
}