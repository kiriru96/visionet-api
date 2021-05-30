<?php
namespace App\Model;
use System\Model as Model;

class Device extends Model {
    public function addDevice(string $name) {
        $fields = array('name');
        $values = array($name);

        $id_device = $this->db->insert('device_name', $fields, $values);

        return $id_device;
    }

    public function deleteDevice(int $id_device) {
        $delete_device = $this->db->delete('device_name', 'id = ?', array($id_device));

        return $delete_device;
    }

    public function editDevice(int $id_device, string $name) {
        $fields = array('name');
        $values = array($name);

        $update_device = $this->db->update('device_name', $fields, $values, 'id = '.$id_device);

        return $update_device;
    }

    public function listDevice(string $order, int $limit, int $index_start) {
        $list_devices = $this->db->selectColumns(array('id', 'name'), 'device_name', 'ORDER BY '.$order.' LIMIT '.$index_start.','.$limit, array());

        return $list_devices;
    }

    public function getDevice(int $id_device) {
        $list_devices = $this->db->selectColumns(array('id', 'name'), 'device_name', 'id = ?', array($id_device));

        $device = $list_devices[0];

        return $device;
    }
}