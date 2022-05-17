<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		/**
		 * Tabel Roles
		 */
		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint' => 11, 'auto_increment' => true],
			'keterangan' => ['type'	=> 'varchar', 'constraint' => 50]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('tb_roles', true);

		/**
		 * Tabel Users
		 */
		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint'	=> 11, 'unsigned' => true, 'auto_increment' => true],
			'email'			=> ['type' => 'varchar', 'constraint' => 255],
			'username'		=> ['type' => 'varchar', 'constraint' => 30, 'null' => true],
			'password'		=> ['type' => 'varchar', 'constraint' => 255],
			'nama'			=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'alamat'		=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'id_role'			=> ['type' => 'int', 'constraint' => 11],
			'avatar' => ['type' => 'varchar', 'constraint' => 255, 'default' => 'avatar.jpg'],
			'status'		=> ['type' => 'int', 'constraint' => 1, 'null' => 0, 'default' => 0],
			'token'			=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'ip_address'	=> ['type' => 'varchar', 'constraint' => 100, 'null' => true],
			'created_at'	=> ['type' => 'datetime', 'null' => true],
			'updated_at'	=> ['type' => 'datetime', 'null' => true],
			'deleted_at'	=> ['type' => 'datetime', 'null' => true],
		]);

		$this->forge->addKey('id', true)
			->addKey('id_role')
			->addUniqueKey(['email', 'username']);
		$this->forge->addForeignKey('id_role', 'tb_roles', 'id', 'CASCADE', 'RESTRICT');
		$this->forge->createTable('tb_users', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tb_roles', true);
		$this->forge->dropTable('tb_users', true);
	}
}
