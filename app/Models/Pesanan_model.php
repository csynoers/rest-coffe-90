<?php namespace App\Models;

use CodeIgniter\Model;
 
class Menu_model extends Model {
 
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
 
    public function getMenu($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere([$this->primaryKey => $id])->getRowObject();
        }  
    }
     
    public function insertMenu($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
 
    public function updateMenu($data, $id)
    {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }
 
    public function deleteMenu($id)
    {
        return $this->db->table($this->table)->delete([$this->primaryKey => $id]);
    }
} 