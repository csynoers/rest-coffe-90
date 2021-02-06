<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pembayaran extends Migration
{
	public function up()
	{
		// Membuat kolom/field untuk tabel pembayaran
		$this->forge->addField([
			'id_pembayaran'=> [
				'type'=> 'INT',
				'unsigned'=> true,
				'auto_increment'=> true
			],
			'id_pesanan'=> [
				'type'=> 'INT',
			],
			'tanggal_bayar'=> [
				'type'=> 'DATETIME',
			],
			'jumlah_bayar'=> [
				'type'=> 'INT',
			],
			'nota'=> [
				'type'=> 'VARCHAR',
				'constraint'=> '10'
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id_pembayaran', TRUE);

		// Membuat tabel pembayaran
		$this->forge->createTable('pembayaran', TRUE);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// menghapus tabel pembayaran
		$this->forge->dropTable('pembayaran');
	}
}
