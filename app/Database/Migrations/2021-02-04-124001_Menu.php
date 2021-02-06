<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
{
	public function up()
	{
		// Membuat kolom/field untuk tabel menu
		$this->forge->addField([
			'id_menu'=> [
				'type'=> 'INT',
				'unsigned'=> true,
				'auto_increment'=> true
			],
			'id_kategori'=> [
				'type'=> 'INT',
			],
			'nama_menu'=> [
				'type'=> 'VARCHAR',
				'constraint'=> '50'
			],
			'jenis_menu'=> [
				'type'=> 'ENUM',
				'constraint'=> ['Stok', 'Non Stok'],
			],
			'stok'       => [
				'type'           => 'INT',
				'default'     => 0
			],
			'status_nonstok'=> [
				'type'=> 'ENUM',
				'constraint'=> ['Tersedia', 'Tidak Tersedia'],
				'null'=> true
			],
			'status_menu'=> [
				'type'=> 'ENUM',
				'constraint'=> ['Aktif', 'Tidak Aktif'],
			],
			'harga'=> [
				'type'=> 'INT',
				'default'=> 0
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id_menu', TRUE);

		// Membuat tabel menu
		$this->forge->createTable('menu', TRUE);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// menghapus tabel menu
		$this->forge->dropTable('menu');
	}
}
