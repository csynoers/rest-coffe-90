<?php namespace App\Models;

use CodeIgniter\Model;
 
class Users_model extends Model {
 
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = [
        'username',
        'password',
        'nama',
        'level',
        'status',
    ];
 
    public function getuser($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere([$this->primaryKey => $id])->getRowObject();
        }  
    }
     
    public function insertuser($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
 
    public function updateuser($data, $id)
    {
        return $this->db->table($this->table)->update($data, [$this->primaryKey => $id]);
    }
 
    public function deleteuser($id)
    {
        return $this->db->table($this->table)->delete([$this->primaryKey => $id]);
    }
} 