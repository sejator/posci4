<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
	public function up()
	{
		// Tabel pelanggan
		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'nama_pelanggan' => ['type'	=> 'varchar', 'constraint' => 100],
			'jenkel' => ['type'	=> 'varchar', 'constraint'	=> 1],
			'telp_pelanggan' => ['type'	=> 'varchar', 'constraint' => 20],
			'alamat_pelanggan' => ['type' => 'varchar', 'constraint'	=> 100],
			'created_at' => ['type' => 'datetime', null	=> true],
			'updated_at' => ['type' => 'datetime', null	=> true],
			'deleted_at' => ['type' => 'datetime', null	=> true],
		]);

		$this->forge->addKey('id', true);
		$this->forge->createTable('tb_pelanggan', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tb_pelanggan', true);
	}
}
