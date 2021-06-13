<?php
namespace App\Model;
use System\Model as Model;

class Location extends Model {
    private function checkRecordExists(string $name) {
        $list_brands = $this->db->selectColumns(array('name'), 'location', 'name = ?', array(trim($name)));

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

            $id_location = $this->db->insert('location', $fields, $values);

            if($id_location) {
                return array('status'=> true, 'id'=> $id_location);
            } else {
                return array('status'=> false, 'msg'=> 'gagal memasukan data.');
            }
        } else {
            return array('status'=> false, 'msg'=> 'nama sudah digunakan');
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

    public function listRecord(string $search, int $page, string $orderby, string $order, int $limit) {
        $index = ($page - 1) * $limit;

        $src = '%'.trim($search).'%';

        $list_locations = $this->db->selectColumns(array('id', 'name'), 'location', ' name LIKE ? ORDER BY '.$orderby.' DESC LIMIT '.$index.','.$limit, array($src));

        if($list_locations) {
            return array('status'=> true, 'data'=> $list_locations);
        } else {
            return array('status'=> false, 'msg'=> 'cannot find list data.');
        }
    }

    public function lightListRecord(string $search) {
        $list_brands = null;

        if(trim($search) !== '' && strlen(trim($search)) >= 3) {
            $src = '%'.trim($search).'%';
            $list_brands = $this->db->selectColumns(array('id', 'name'), 'location', ' name LIKE ? ORDER BY id ASC LIMIT 0, 20', array($src));
        }

        if($list_brands) {
            return array('status'=> true, 'data'=> $list_brands);
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
    
    public function allRows(string $search) {
        $src = '%'.trim($search).'%';

        $query = 'SELECT count(*) AS len FROM location  WHERE name LIKE ?';

        $res = $this->db->rawQueryType('select', $query, array($src));

        return $res[0]['len'];
    }
}