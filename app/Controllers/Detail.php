<?php namespace App\Controllers;

use App\Models\Pesanan_detail_model;

use CodeIgniter\RESTful\ResourceController;

class Detail extends ResourceController
{
    protected $modelName = 'App\Models\Pesanan_detail_model';
    protected $format    = 'json';

    public function __construct(){
        $this->pesanan_detail = new Pesanan_detail_model();
    }

    public function index()
    {
        $rows = $this->model->findAll();
        
        return $this->setResponseAPI($rows,200);
    }

    /* membuat data baru */
    public function create()
    {

        $data = json_decode($_POST['data']);
        $pesanan = $data->pesanan;
        $data_pesanan = [
            'id_user' => $pesanan->id_user,
            'nomor_meja' => $pesanan->nomor_meja,
            'tanggal_pesanan' => $pesanan->tanggal_pesanan,
        ];

        // insert pesanan
        $id_pesanan = $this->pesanan->insertPesanan($data_pesanan);

        $pembayaran = $data->pembayaran;
        $data_pembayaran = [
            'id_pesanan' => $id_pesanan,
            'tanggal_bayar' => $pembayaran->tanggal_bayar,
            'jumlah_bayar' => $pembayaran->jumlah_bayar,
        ];
        // insert pembayaran
        $this->pembayaran->insertPembayaran($data_pembayaran);

        $pesanan_detail = $data->detail_pesanan;
        foreach ($pesanan_detail as $key => $value) {
            $data_pesanan_detail = [
                'id_pesanan' => $id_pesanan,
                'id_menu' => $value->id_menu,
                'harga' => $value->harga,
                'jumlah' => $value->jumlah,
                'keterangan' => $value->keterangan,
                'status_pesanan_detail' => $value->status_pesanan_detail,
            ];

            if ( $value->jenis_menu == 'Stok' ) {
                // update stok menu
                $this->menu->updateMenuStok($value->jumlah,$value->id_menu);
            }

            // insert pesanan detail
            $this->pesanan_detail->insertPesananDetail($data_pesanan_detail);
        }

        return $this->setResponseAPI($data, 200);
        
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
        $data = json_decode($_POST['data']);
        $status_pesanan_detail = $data->status_pesanan_detail;
        
        $data = [
            'status_pesanan_detail' => $status_pesanan_detail,
        ];

        $simpan = $this->model->updatePesananDetail($data,$id);
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