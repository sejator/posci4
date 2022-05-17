<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Item extends Migration
{
	public function up()
	{
		/**
		 * tabel kategori
		 */
		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint'	 => 11, 'unsigned' => true, 'auto_increment' => true],
			'nama_kategori'	=> ['type' => 'varchar', 'constraint' => 50],
			'created_at'	=> ['type' => 'datetime', null => true],
			'updated_at'	=> ['type' => 'datetime', null => true],
			'deleted_at'	=> ['type' => 'datetime', null => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('tb_kategori', true);

		/**
		 * tabel unit
		 */
		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint'	 => 11, 'unsigned' => true, 'auto_increment' => true],
			'nama_unit'	=> ['type' => 'varchar', 'constraint' => 50],
			'created_at'	=> ['type' => 'datetime', null => true],
			'updated_at'	=> ['type' => 'datetime', null => true],
			'deleted_at'	=> ['type' => 'datetime', null => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('tb_unit', true);

		/**
		 * tabel item
		 */
		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'barcode'	=> ['type' => 'varchar', 'constraint'	=> 50],
			'nama_item'	=> ['type' => 'varchar', 'constraint'	=> 100],
			'id_kategori'	=> ['type' => 'int', 'constraint'	=> 11, 'unsigned' => true],
			'id_unit'	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'id_pemasok' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'harga'	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'stok'	=> ['type' => 'int', 'constraint'	=> 11, 'unsigned' => true],
			'gambar' => ['type' => 'varchar', 'constraint'	=> 100, 'default' => 'gambar.jpg'],
			'created_at' => ['type' => 'datetime', null => true],
			'updated_at' => ['type' => 'datetime', null => true],
			'deleted_at' => ['type' => 'datetime', null => true],
		]);
		$this->forge->addKey('id', true)->addKey(['id_kategori', 'id_unit', 'id_pemasok'])
		->addUniqueKey('barcode');
		$this->forge->addForeignKey('id_kategori', 'tb_kategori', 'id', 'cascade', 'restrict');
		$this->forge->addForeignKey('id_unit', 'tb_unit', 'id', 'cascade', 'restrict');
		$this->forge->addForeignKey('id_pemasok', 'tb_pemasok', 'id', 'cascade', 'restrict');
		$this->forge->createTable('tb_item', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tb_kategori', true);
		$this->forge->dropTable('tb_unit', true);
		$this->forge->dropTable('tb_item', true);
	}
}
