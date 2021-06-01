<?php
namespace App\Model;
use System\Model as Model;

class Location extends Model {
    public function addRecord(string $name) {
        $fields = array('name');
        $values = array($name);

        $id_location = $this->db->insert('location', $fields, $values);

        if($id_location) {
            return array('status'=> true, 'id'=> $id_location);
        } else {
            return array('status'=> false, 'msg'=> 'gagal memasukan data.');
        }
    }

    public function deleteRecord(int $id_location) {
        $delete_location = $this->db->delete('location', 'id = ?', array($id_location));

        if($delete_location) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus data.');
        }
    }

    public function editRecord(int $id_location, string $name) {
        $fields = array('name');
        $values = array($name);

        $update_location = $this->db->update('location', $fields, $values, 'id = '.$id_location);

        if($update_location) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui data.', 'data'=> array('id'=> $id_location, 'name'=> $name));
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui data.');
        }
    }

    public function listRecord(string $order, int $limit, int $index_start) {
        $list_locations = $this->db->selectColumns(array('id', 'name'), 'location', 'ORDER BY '.$order.' LIMIT '.$index_start.','.$limit, array());

        if($list_locations) {
            return array('status'=> true, 'data'=> $list_locations);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find list data.');
        }
    }

    public function getRecord(int $id_location) {
        $list_locations = $this->db->selectColumns(array('id', 'name'), 'location', 'id = ?', array($id_location));

        if($list_locations) {
            $location = $list_locations[0];
    
            return array('status'=> true, 'data'=> $location);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find any data.');
        }
    }
}