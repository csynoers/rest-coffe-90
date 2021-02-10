<?php namespace App\Models;

use CodeIgniter\Model;
 
class Laporan_model extends Model {

    protected $db;

    function __construct(){
        parent::__construct();
        $this->db = db_connect();
    }
 
    public function getStok()
    {
        $builder = $this->db
            ->table('menu')
            ->join('kategori','kategori.id_kategori=menu.id_kategori','left')
            ->get();

        return $builder->getResult();
    }
    public function getPenjualan()
    {
        $builder = $this->db
            ->table('pesanan_detail')
            ->join('pesanan','pesanan.id_pesanan=pesanan_detail.id_pesanan','left')
            ->join('menu','menu.id_menu=pesanan_detail.id_pesanan','left')
            ->where('pesanan_detail.status_pesanan_detail=','Selesai')
            ->orderBy('pesanan.tanggal_pesanan','desc')
            ->get();

        return $builder->getResult();
    }
    public function getPenjualanFilter($start,$end)
    {
        $builder = $this->db
            ->table('pesanan_detail')
            ->join('pesanan','pesanan.id_pesanan=pesanan_detail.id_pesanan','left')
            ->join('menu','menu.id_menu=pesanan_detail.id_pesanan','left')
            ->where('pesanan_detail.status_pesanan_detail=','Selesai');
            
            
        if ( $start === $end ) {
            $builder->where('pesanan.tanggal_pesanan >=', $end);

        } else {
            if ( $start > $end ) {
                $builder->where('pesanan.tanggal_pesanan >=', $end);
                $builder->where('pesanan.tanggal_pesanan <=', $start);
                
            } else {
                $builder->where('pesanan.tanggal_pesanan >=', $start);
                $builder->where('pesanan.tanggal_pesanan <=', $end);
            }
        }
        $builder->orderBy('pesanan.tanggal_pesanan','desc');
        // $builder->get();

        return $builder->get()->getResult();
    }
    public function getMenuFavorit()
    {
        $builder = $this->db
            ->table('menu')
            ->select('*,(SELECT SUM(pesanan_detail.jumlah) FROM pesanan_detail WHERE pesanan_detail.id_menu=menu.id_menu) AS jumlah_terjual')
            ->orderBy('jumlah_terjual','desc');

        // return $builder->getCompiledSelect();
        return $builder->get()->getResult();
    }

} 