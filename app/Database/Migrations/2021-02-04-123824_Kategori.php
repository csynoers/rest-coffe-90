<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kategori extends Migration
{
	public function up()
	{
		// Membuat kolom/field untuk tabel kategori
		$this->forge->addField([
			'id_kategori'          => [
				'type'           => 'INT',
				'unsigned'       => true,
				'auto_increment' => true
			],
			'nama_kategori'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '50'
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id_kategori', TRUE);

		// Membuat tabel kategori
		$this->forge->createTable('kategori', TRUE);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// menghapus tabel kategori
		$this->forge->dropTable('kategori');
	}
}
