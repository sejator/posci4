<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Stok extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_stok' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true, 'unsigned' => true],
			'tipe' => ['type' => 'enum', 'constraint' => ['masuk', 'keluar'], 'default' => null],
			'id_item' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'id_pemasok' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'jumlah' => ['type' => 'int', 'constraint' => 11],
			'keterangan' => ['type' => 'varchar', 'constraint' => 50, null => true],
			'id_user' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'ip_address' => ['type' => 'varchar', 'constraint' => 50],
			'created_at' => ['type' => 'datetime', null => true],
			'updated_at' => ['type' => 'datetime', null => true],
			'deleted_at' => ['type' => 'datetime', null => true]
		]);
		$this->forge->addKey('id_stok', true)->addKey(['id_item', 'id_pemasok', 'id_user']);
		$this->forge->addForeignKey('id_item', 'tb_item', 'id', 'cascade', 'restrict');
		$this->forge->addForeignKey('id_pemasok', 'tb_pemasok', 'id', 'cascade', 'restrict');
		$this->forge->addForeignKey('id_user', 'tb_users', 'id', 'cascade', 'restrict');
		$this->forge->createTable('tb_stok', true);
	}

	public function down()
	{
		$this->forge->dropTable('tb_stok', true);
	}
}
