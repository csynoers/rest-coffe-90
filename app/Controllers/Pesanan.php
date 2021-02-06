<?php namespace App\Controllers;

use App\Models\Kategori_model;
use App\Models\Menu_model;
use App\Models\Pesanan_model;
use App\Models\Pesanan_detail_model;
use App\Models\Pembayaran_model;
use CodeIgniter\RESTful\ResourceController;

class Pesanan extends ResourceController
{
    protected $modelName = 'App\Models\Pesanan_model';
    protected $format    = 'json';

    public function __construct(){
        $this->kategori = new Kategori_model();
        $this->pesanan = new Pesanan_model();
        $this->pesanan_detail = new Pesanan_detail_model();
        $this->pembayaran = new Pembayaran_model();
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
            // insert pesanan detail
            $this->pesanan_detail->insertPesananDetail($data_pesanan_detail);
        }

        // $tes = var_dump($this->request->getPost());

        // return $this->setResponseAPI($data_pesanan, 200);
        // return $this->setResponseAPI(, 200);
        return $this->setResponseAPI($data, 200);
        
        // $data = [
        //     'nama_menu' => $nama_menu,
        //     'id_kategori' => $id_kategori,
        //     'jenis_menu' => $jenis_menu,
        //     // 'status_nonstok' => $status_nonstok,
        //     // 'stok' => $stok,
        //     'harga' => $harga,
        //     'status_menu' => $status_menu,
        // ];

        // if ( $jenis_menu == 'Stok' ) {
        //     $data['stok'] = $stok;
        // }

        // if ( $jenis_menu == 'Non Stok' ) {
        //     $data['status_nonstok'] = $status_nonstok;
        // }

        // $simpan = $this->model->insertMenu($data);
        // if($simpan){
        //     $msg = ['message' => 'Data berhasil dibuat'];
        //     $response = [
        //         'status' => 201,
        //         'error' => false,
        //         'data' => $msg,
        //     ];
        //     return $this->setResponseAPI($response, 200);
        // }
        
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