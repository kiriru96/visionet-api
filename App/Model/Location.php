<?php
namespace App\Model;
use System\Model as Model;

class Location extends Model {
    public function addLocation(string $name) {
        $fields = array('name');
        $values = array($name);

        $id_location = $this->db->insert('location', $fields, $values);

        if($id_location) {
            return array('status'=> true, 'id'=> $id_location);
        } else {
            return array('status'=> false, 'msg'=> 'gagal memasukan data.');
        }
    }

    public function deleteLocation(int $id_location) {
        $delete_location = $this->db->delete('location', 'id = ?', array($id_location));

        if($delete_location) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus data.');
        }
    }

    public function editLocation(int $id_location, string $name) {
        $fields = array('name');
        $values = array($name);

        $update_location = $this->db->update('location', $fields, $values, 'id = '.$id_location);

        if($update_location) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui data.');
        }
    }

    public function listLocation(string $order, int $limit, int $index_start) {
        $list_locations = $this->db->selectColumns(array('id', 'name'), 'location', 'ORDER BY '.$order.' LIMIT '.$index_start.','.$limit, array());

        return $list_locations;
    }

    public function getLocation(int $id_location) {
        $list_locations = $this->db->selectColumns(array('id', 'name'), 'location', 'id = ?', array($id_location));

        $location = $list_locations[0];

        return $location;
    }
}