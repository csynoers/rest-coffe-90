<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Laporan_model;

class Laporan extends ResourceController
{
	protected $format    = 'json';

	public function __construct(){
        $this->laporan = new Laporan_model();
    }

	public function stok()
	{
		$rows_all = $this->laporan->getStok();
		
		return $this->setResponseAPI($rows_all,200);
	}

	public function penjualan()
	{
		$rows_all = $this->laporan->getPenjualan();
		
		return $this->setResponseAPI($rows_all,200);
	}
	public function penjualan_filter()
	{
		$start = $this->request->getGet('start');
		$end = $this->request->getGet('end');

		$rows_all = $this->laporan->getPenjualanFilter($start,$end);
		
		return $this->setResponseAPI($rows_all,200);
	}
	public function menu_favorit()
	{
		$rows_all = $this->laporan->getMenuFavorit();
		
		return $this->setResponseAPI($rows_all,200);
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

	//--------------------------------------------------------------------

}
