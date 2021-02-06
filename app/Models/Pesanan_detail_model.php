<?php namespace App\Models;

use CodeIgniter\Model;
 
class Pesanan_detail_model extends Model {
 
    protected $table = 'pesanan_detail';
    protected $primaryKey = 'id_pesanan_detail';
 
    public function getPesananDetail($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere([$this->primaryKey => $id])->getRowObject();
        }  
    }
     
    public function insertPesananDetail($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
 
    public function updatePesananDetail($data, $id)
    {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }
 
    public function deletePesananDetail($id)
    {
        return $this->db->table($this->table)->delete([$this->primaryKey => $id]);
    }
} 