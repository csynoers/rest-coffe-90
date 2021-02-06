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
    public function getPesananDetailBelumSiap()
    {
        $this->join('pesanan', 'pesanan.id_pesanan = pesanan_detail.id_pesanan', 'left');
        $this->join('menu', 'menu.id_menu = pesanan_detail.id_menu', 'left');
        $this->where('pesanan_detail.status_pesanan_detail','Belum Siap');
        return $this->findAll();
    }
    public function getPesananDetailAntrian()
    {
        $this->join('pesanan', 'pesanan.id_pesanan = pesanan_detail.id_pesanan', 'left');
        $this->join('menu', 'menu.id_menu = pesanan_detail.id_menu', 'left');
        $this->where('pesanan_detail.status_pesanan_detail!=','Selesai');
        return $this->findAll();
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