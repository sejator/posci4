<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BulanTahun extends Migration
{
	public function up()
	{
		$field = [
			'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'bulan' => ['type' => 'varchar', 'constraint' => 10],
			'tahun' => ['type' => 'year', 'constraint' => 4],
			'bln_thn' => ['type' => 'varchar', 'constraint' => 10]
		];
		$this->forge->addField($field);
		$this->forge->addKey('id', true);
		$this->forge->createTable('tb_bulan_tahun', true);
	}

	public function down()
	{
		$this->forge->dropTable('tb_bulan_tahun', true);
	}
}
