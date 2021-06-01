<?php
namespace App\Model;
use System\Model as Model;

class Customer extends Model {
    public function addRecord(string $name) {
        $fields = array('name');
        $values = array($name);

        $id_customer = $this->db->insert('customer', $fields, $values);

        if($id_customer) {
            return array('status'=> true, 'id'=> $id_customer);
        } else {
            return array('status'=> false, 'msg'=> 'gagal membuat data.');
        }
    }

    public function deleteRecord(int $id_customer) {
        $delete_customer = $this->db->delete('customer', 'id = ?', array($id_customer));

        if($delete_customer) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus data.');
        }
    }

    public function editRecord(int $id_customer, string $name) {
        $fields = array('name');
        $values = array($name);

        $update_customer = $this->db->update('customer', $fields, $values, 'id = '.$id_customer);

        if($update_customer) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui data.', 'data'=> array('id'=> $id_customer, 'name'=> $name));
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui data.');
        }
    }

    public function listRecord(string $order, int $limit, int $index_start) {
        $list_customers = $this->db->selectColumns(array('id', 'name'), 'customer', 'ORDER BY '.$order.' LIMIT '.$index_start.','.$limit, array());

        if($list_customers) {
            return array('status'=> true, 'data'=> $list_customers);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find list data.');
        }
    }

    public function getRecord(int $id_customer) {
        $list_customers = $this->db->selectColumns(array('id', 'name'), 'customer', 'id = ?', array($id_customer));

        if($list_customers) {
            $customer = $list_customers[0];
    
            return array('status'=> true, 'data'=> $customer);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find any data.');
        }
    }
}