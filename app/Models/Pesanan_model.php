<?php namespace App\Models;

use CodeIgniter\Model;
 
class Pesanan_model extends Model {
 
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
 
    public function getPesanan($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere([$this->primaryKey => $id])->getRowObject();
        }  
    }
     
    public function insertPesanan($data)
    {
        $builder = $this->db->table($this->table);
        $builder->insert($data);
        return $this->db->insertID();
        // return $this->db->table($this->table)->insert($data)->insertID();
    }
 
    public function updatePesanan($data, $id)
    {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }
 
    public function deletePesanan($id)
    {
        return $this->db->table($this->table)->delete([$this->primaryKey => $id]);
    }
} 