<?php namespace App\Controllers;

use App\Models\Kategori_model;
use CodeIgniter\RESTful\ResourceController;

class Menu extends ResourceController
{
    protected $modelName = 'App\Models\Menu_model';
    protected $format    = 'json';

    public function __construct(){
        $this->kategori = new Kategori_model();
    }

    public function index()
    {
        // ------------------------------------------------------------------------
        // modification json output value type: int
        // ------------------------------------------------------------------------
        $rows = $this->model->findAll();
        // ------------------------------------------------------------------------
        // modification json output value type: int
        // ------------------------------------------------------------------------
        foreach ($rows as $key => $value) {
            $value['nama_kategori'] = $this->kategori->getKategori($value['id_kategori'])->nama_kategori;
            $rows_all[] = $value;
        }
        return $this->setResponseAPI($rows_all,200);
    }

    protected function getSubKategori($id)
    {
        $subKategori = new \App\Models\Sub_kat_imprint_model();
        $rows = $subKategori->where('id_unit_usaha',$id)->findAll();

        foreach ($rows as $key => $value) {
            $rows_all[] = [
                'id'                => intval($value['id_sub_kat_imprint']),
                'title'             => $value['title'],
            ];
        }

        return $rows_all;
    }
    
    protected function setResponseAPI($body,$statusCode)
    {
        $options = [
            'max-age'  => 1200,
            's-maxage' => 3600,
            'etag'     => 'abcde'
        ];
        
        $this->response->setHeader('Access-Control-Allow-Origin', '*')
            ->setHeader('Access-Control-Allow-Headers', '*')
            ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
            // ->setCache($options);
        // echo '<pre>';
        // print_r($this);
        // echo '</pre>';
        return $this->respond($body, $statusCode);
    }
}