<?php namespace App\Controllers;

use App\Models\Kategori_model;
use App\Models\Menu_model;
use App\Models\Pesanan_model;
use App\Models\Pesanan_detail_model;
use App\Models\Pembayaran_detail_model;
use CodeIgniter\RESTful\ResourceController;

class Pesanan extends ResourceController
{
    protected $modelName = 'App\Models\Pesanan_model';
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

    /* membuat data baru */
    public function create()
    {
        $nama_menu= $this->request->getPost('nama_menu');
        $id_kategori= $this->request->getPost('id_kategori');
        $jenis_menu= $this->request->getPost('jenis_menu');
        $status_nonstok= $this->request->getPost('status_nonstok');
        $stok= $this->request->getPost('stok');
        $harga= $this->request->getPost('harga');
        $status_menu= $this->request->getPost('status_menu');
        
        $data = [
            'nama_menu' => $nama_menu,
            'id_kategori' => $id_kategori,
            'jenis_menu' => $jenis_menu,
            // 'status_nonstok' => $status_nonstok,
            // 'stok' => $stok,
            'harga' => $harga,
            'status_menu' => $status_menu,
        ];

        if ( $jenis_menu == 'Stok' ) {
            $data['stok'] = $stok;
        }

        if ( $jenis_menu == 'Non Stok' ) {
            $data['status_nonstok'] = $status_nonstok;
        }

        $simpan = $this->model->insertMenu($data);
        if($simpan){
            $msg = ['message' => 'Data berhasil dibuat'];
            $response = [
                'status' => 201,
                'error' => false,
                'data' => $msg,
            ];
            return $this->setResponseAPI($response, 200);
        }
        
    }

    /* show data by id */
    public function show($id = NULL)
    {
        $get = $this->model->getMenu($id);
        if($get){
            $code = 200;
            $response = [
                'status' => $code,
                'error' => false,
                'data' => $get,
            ];
        } else {
            $code = 401;
            $msg = ['message' => 'Not Found'];
            $response = [
                'status' => $code,
                'error' => true,
                'data' => $msg,
            ];
        }
        return $this->setResponseAPI($response, $code);
    }

    // update data
    public function update($id = NULL)
    {
        $nama_menu= $this->request->getPost('nama_menu');
        $id_kategori= $this->request->getPost('id_kategori');
        $jenis_menu= $this->request->getPost('jenis_menu');
        $status_nonstok= $this->request->getPost('status_nonstok');
        $stok= $this->request->getPost('stok');
        $harga= $this->request->getPost('harga');
        $status_menu= $this->request->getPost('status_menu');
        
        $data = [
            'nama_menu' => $nama_menu,
            'id_kategori' => $id_kategori,
            'jenis_menu' => $jenis_menu,
            // 'status_nonstok' => $status_nonstok,
            // 'stok' => $stok,
            'harga' => $harga,
            'status_menu' => $status_menu,
        ];

        if ( $jenis_menu == 'Stok' ) {
            $data['stok'] = $stok;
        }

        if ( $jenis_menu == 'Non Stok' ) {
            $data['status_nonstok'] = $status_nonstok;
        }

        $simpan = $this->model->updateMenu($data,$id);
        if($simpan){
            $msg = ['message' => 'Updated data successfully'];
            $response = [
                'status' => 201,
                'error' => false,
                'data' => $msg,
            ];
            return $this->setResponseAPI($response, 200);
        }
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