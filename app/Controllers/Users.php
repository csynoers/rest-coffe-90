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

    /* membuat users baru */
    public function create()
    {        
        $data = $this->request->getRawInput();

        $this->model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];
         
        return $this->respondCreated($data, 201);        
    }

    /* show data by id */
    public function show($id = NULL)
    {
        $data = $this->model->getUser($id);
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }

    // update data
    public function update($id = NULL)
    {
        $data= $this->request->getRawInput();

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
}