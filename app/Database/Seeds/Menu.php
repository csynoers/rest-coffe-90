<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Menu extends Seeder
{
	public function run()
	{
		// membuat data
		$data = [
			[
				'id_kategori'=> 1,
				'nama_menu'=> 'Sphagetti Bolognese',
				'jenis_menu'=> 'Non Stok',
				'status_nonstok'=> 'Tersedia',
				'status_menu'=> 'Aktif',
				'harga'=> 32000
			],
			[
				'id_kategori'=> 2,
				'nama_menu'=> 'Blackcurrant',
				'jenis_menu'=> 'Stok',
				'stok'=> 10,
				'status_menu'=> 'Aktif',
				'harga'=> 12000
			],
			[
				'id_kategori'=> 3,
				'nama_menu'=> 'Lemon Tea',
				'jenis_menu'=> 'Stok',
				'stok'=> 10,
				'status_menu'=> 'Aktif',
				'harga'=> 20000
			],
			[
				'id_kategori'=> 4,
				'nama_menu'=> 'Espresso',
				'jenis_menu'=> 'Stok',
				'stok'=> 10,
				'status_menu'=> 'Aktif',
				'harga'=> 18000
			],
			[
				'id_kategori'=> 5,
				'nama_menu'=> 'V60',
				'jenis_menu'=> 'Stok',
				'stok'=> 10,
				'status_menu'=> 'Aktif',
				'harga'=> 30000
			],
			[
				'id_kategori'=> 6,
				'nama_menu'=> 'Chocolate',
				'jenis_menu'=> 'Stok',
				'stok'=> 10,
				'status_menu'=> 'Aktif',
				'harga'=> 18000
			],
		];

		foreach($data as $value){
			// insert semua data ke tabel
			$this->db->table('menu')->insert($value);
		}
	}
}
