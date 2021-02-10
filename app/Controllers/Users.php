<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Users extends ResourceController
{
    protected $modelName = 'App\Models\Users_model';
    protected $format    = 'json';

    public function index()
    {
        $rows = $this->model->findAll();
        return $this->respond($rows,200);
    }

    /* membuat kategori baru */
    public function create()
    {
        $nama_kategori= $this->request->getPost('nama_kategori');
        
        $data = [
            'nama_kategori' => $nama_kategori,
        ];
        
        $cek = $this->model->where('nama_kategori', $nama_kategori)->findAll();
        if ( count($cek) > 0 ) {
            $msg = ['message' => 'Maaf sudah digunakan silahkan coba lagi dengan data yang berbeda'];
            $response = [
                'status' => 204,
                'error' => false,
                'data' => $msg,
            ];
            return $this->setResponseAPI($response, 200);
        } else {
            $simpan = $this->model->insertKategori($data);
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
        
    }

    /* show data by id */
    public function show($id = NULL)
    {
        $get = $this->model->getKategori($id);
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
        $nama_kategori= $this->request->getPost('nama_kategori');
        $data = [
            'nama_kategori' => $nama_kategori,
        ];

        $cek = $this->model->where('nama_kategori', $nama_kategori)->findAll();
        if ( count($cek) >= 1 ) {
            $msg = ['message' => 'Maaf sudah digunakan silahkan coba lagi dengan data yang berbeda'];
            $response = [
                'status' => 204,
                'error' => false,
                'data' => $msg,
            ];
            return $this->setResponseAPI($response, 200);

        } else {
            $simpan = $this->model->updateKategori($data,$id);
            if($simpan){
                $msg = ['message' => 'Updated category successfully'];
                $response = [
                    'status' => 201,
                    'error' => false,
                    'data' => $msg,
                ];
                return $this->setResponseAPI($response, 200);
            }
            
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