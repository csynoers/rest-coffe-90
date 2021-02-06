<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		// Membuat kolom/field untuk tabel users
		$this->forge->addField([
			'id_user'=> [
				'type'=> 'INT',
				'unsigned'=> true,
				'auto_increment'=> true
			],
			'username'=> [
				'type'=> 'CHAR',
				'constraint'=> '20'
			],
			'password'=> [
				'type'=> 'CHAR',
				'constraint'=> '32'
			],
			'nama'=> [
				'type'=> 'VARCHAR',
				'constraint'=> '100'
			],
			'level'=> [
                'type'=> 'ENUM',
				'constraint'=> ['Owner', 'Admin', 'Dapur'],
            ],
			'status'=> [
                'type'=> 'ENUM',
				'constraint'=> ['Aktif', 'Tidak Aktif'],
            ],
		]);

		// Membuat primary key
		$this->forge->addKey('id_user', TRUE);

		// Membuat tabel useres
		$this->forge->createTable('users', TRUE);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// menghapus tabel users
		$this->forge->dropTable('users');
	}
}
