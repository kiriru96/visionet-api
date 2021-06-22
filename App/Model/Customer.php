<?php
namespace App\Model;
use System\Model as Model;

class Customer extends Model {
    private function checkRecordExists(string $name) {
        $list_brands = $this->db->selectColumns(array('name'), 'customer', 'name = ?', array(trim($name)));

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

            $id_customer = $this->db->insert('customer', $fields, $values);

            if($id_customer) {
                return array('status'=> true, 'id'=> $id_customer);
            } else {
                return array('status'=> false, 'msg'=> 'gagal membuat data.');
            }
        } else {
            return array('status'=> false, 'msg'=> 'nama sudah digunakan');
        }
    }

    public function deleteRecord(int $id_customer) {
        $fields = array('deleted');
        $values = array(1);

        // $delete_customer = $this->db->delete('customer', 'id = ?', array($id_customer));
        $delete_customer = $this->db->update('customer', $fields, $values, 'deleted = 0 AND id = '.$id_customer);

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

    public function listRecord(string $search, int $page, string $orderby, string $order, int $limit) {
        $index = ($page - 1) * $limit;

        $src = '%'.trim($search).'%';

        $list_customers = $this->db->selectColumns(array('id', 'name'), 'customer', ' name LIKE ? AND deleted = ? ORDER BY '.$orderby.' DESC LIMIT '.$index.','.$limit, array($src, 0));

        if($list_customers) {
            return array('status'=> true, 'data'=> $list_customers);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find list data.');
        }
    }

    public function lightListRecord(string $search) {
        $list_brands = null;

        if(trim($search) !== '' && strlen(trim($search)) >= 3) {
            $src = '%'.trim($search).'%';
            $list_brands = $this->db->selectColumns(array('id', 'name'), 'customer', ' name LIKE ? AND deleted = ? ORDER BY id ASC LIMIT 0, 20', array($src, 0));
        }

        if($list_brands) {
            return array('status'=> true, 'data'=> $list_brands);
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
    
    public function allRows(string $search) {
        $src = '%'.trim($search).'%';

        $query = 'SELECT count(*) AS len FROM customer WHERE name LIKE ? AND deleted = ?';

        $res = $this->db->rawQueryType('select', $query, array($src, 0));

        return $res[0]['len'];
    }
}