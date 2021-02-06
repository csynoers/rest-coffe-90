<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pesanan extends Migration
{
	public function up()
	{
		// Membuat kolom/field untuk tabel pesanan
		$this->forge->addField([
			'id_pesanan'          => [
				'type'           => 'INT',
				'unsigned'       => true,
				'auto_increment' => true
			],
			'id_user'          => [
				'type'           => 'INT',
			],
			'nomor_meja'          => [
				'type'           => 'INT',
			],
			'tanggal_pesanan' => [
                'type'           => 'DATETIME',
            ],
		]);

		// Membuat primary key
		$this->forge->addKey('id_pesanan', TRUE);

		// Membuat tabel pesanan
		$this->forge->createTable('pesanan', TRUE);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// menghapus tabel pesanan
		$this->forge->dropTable('pesanan');
	}
}
