<?php namespace App\Models;

use CodeIgniter\Model;
 
class Pembayaran_model extends Model {
 
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
 
    public function getPembayaran($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere([$this->primaryKey => $id])->getRowObject();
        }  
    }
     
    public function insertPembayaran($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
 
    public function updatePembayaran($data, $id)
    {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }
 
    public function deletePembayaran($id)
    {
        return $this->db->table($this->table)->delete([$this->primaryKey => $id]);
    }
} 