<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PesananDetail extends Migration
{
	public function up()
	{
		// Membuat kolom/field untuk tabel pesanan_detail
		$this->forge->addField([
			'id_pesanan_detail'=> [
				'type'=> 'INT',
				'unsigned'=> true,
				'auto_increment'=> true
			],
			'id_pesanan'=> [
				'type'=> 'INT',
			],
			'id_menu'=> [
				'type'=> 'INT',
			],
			'harga'=> [
				'type'=> 'INT',
			],
			'jumlah'=> [
                'type'=> 'INT',
            ],
			'keterangan'=> [
                'type'=> 'VARCHAR',
				'constraint'=> '255',
				'default'=> '-'
            ],
			'status_pesanan_detail'=> [
                'type'=> 'ENUM',
				'constraint'=> ['Belum Siap', 'Siap', 'Selesai'],
            ],
		]);

		// Membuat primary key
		$this->forge->addKey('id_pesanan_detail', TRUE);

		// Membuat tabel pesanan_detail
		$this->forge->createTable('pesanan_detail', TRUE);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// menghapus tabel pesanan_detail
		$this->forge->dropTable('pesanan_detail');
	}
}
