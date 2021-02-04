<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kategori extends Seeder
{
	public function run()
	{
		// membuat data
		$data = [
			[
				'nama_kategori' => 'Food',
			],
			[
				'nama_kategori' => 'Flavour tea',
			],
			[
				'nama_kategori' => 'Tea',
			],
			[
				'nama_kategori' => 'Coffee',
			],
			[
				'nama_kategori' => 'Manual Brewing',
			],
			[
				'nama_kategori' => 'Non Coffee',
			],
		];

		foreach($data as $value){
			// insert semua data ke tabel
			$this->db->table('kategori')->insert($value);
		}
	}
}
