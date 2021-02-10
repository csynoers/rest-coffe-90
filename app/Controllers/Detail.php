<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Pesanan_detail_model;


class Detail extends ResourceController
{
    use ResponseTrait;

    protected $modelName = 'App\Models\Pesanan_detail_model';
    protected $format    = 'json';

    public function __construct(){
        $this->pesanan_detail = new Pesanan_detail_model();
    }

    public function index()
    {
        $rows = $this->model->findAll();
        
        return $this->respond($rows,200);
    }

    /* membuat data baru */
    public function create()
    {        
        $data = $this->request->getRawInput();
        // $data = json_decode(file_get_contents("php://input"));
        // $data = $this->request->getPost();
        $this->model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
         
        return $this->respondCreated($response, 201);
    }

    /* show data by id */
    public function show($id = NULL)
    {
        $data = $this->model->getPesananDetail($id);
        if( $data ){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }

    // update data
    public function update($id = NULL)
    {
        $data = $this->request->getRawInput();
        // Insert to Database
        $this->model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    // update data group
    public function update_group_pesan($id_pesanan = NULL)
    {
        $data = $this->request->getRawInput();
        // Insert to Database
        $this->pesanan_detail->updateGroupPesan($data, $id_pesanan);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
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