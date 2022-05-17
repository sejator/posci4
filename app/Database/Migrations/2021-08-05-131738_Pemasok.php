<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pemasok extends Migration
{
	public function up()
	{
		/**
		 * tabel pemasok
		 */
		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'nama_pemasok' => ['type' => 'varchar', 'constraint' => 100],
			'telp_pemasok' => ['type' => 'varchar', 'constraint' => 20],
			'alamat_pemasok' => ['type' => 'varchar', 'constraint' => 100],
			'keterangan' => ['type' => 'varchar', 'constraint' => 50, null => true],
			'created_at' => ['type' => 'datetime', null	=> true],
			'updated_at' => ['type' => 'datetime', null	=> true],
			'deleted_at' => ['type' => 'datetime', null	=> true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('tb_pemasok', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tb_pemasok', true);
	}
}
