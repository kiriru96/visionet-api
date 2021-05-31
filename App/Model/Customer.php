<?php
namespace App\Model;
use System\Model as Model;

class Customer extends Model {
    public function addCustomer(string $name) {
        $fields = array('name');
        $values = array($name);

        $id_customer = $this->db->insert('customer', $fields, $values);

        if($id_customer) {
            return array('status'=> true, 'id'=> $id_customer);
        } else {
            return array('status'=> false, 'msg'=> 'gagal membuat data.');
        }
    }

    public function deleteCustomer(int $id_customer) {
        $delete_customer = $this->db->delete('customer', 'id = ?', array($id_customer));

        if($delete_customer) {
            return array('status'=> true, 'msg'=> 'berhasil menghapus data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal menghapus data.');
        }
    }

    public function editCustomer(int $id_customer, string $name) {
        $fields = array('name');
        $values = array($name);

        $update_customer = $this->db->update('customer', $fields, $values, 'id = '.$id_customer);

        if($update_customer) {
            return array('status'=> true, 'msg'=> 'berhasil memperbaharui data.');
        } else {
            return array('status'=> false, 'msg'=> 'gagal memperbaharui data.');
        }
    }

    public function listCustomer(string $order, int $limit, int $index_start) {
        $list_customers = $this->db->selectColumns(array('id', 'name'), 'customer', 'ORDER BY '.$order.' LIMIT '.$index_start.','.$limit, array());

        return $list_customers;
    }

    public function getCustomer(int $id_customer) {
        $list_customers = $this->db->selectColumns(array('id', 'name'), 'customer', 'id = ?', array($id_customer));

        $customer = $list_customers[0];

        return $customer;
    }
}