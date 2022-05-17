<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penjualan extends Migration
{
	public function up()
	{
		/**
		 * tabel penjualan
		 */
		$this->forge->addField([
			'id' => ['type' => 'int', 'constraint'	=> 11, 'unsigned' => true, 'auto_increment' => true],
			'invoice' => ['type' => 'varchar', 'constraint'	=> 50],
			'id_pelanggan' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'total_harga' => ['type' => 'int', 'constraint'	=> 11, 'unsigned' => true],
			'diskon' => ['type' => 'int', 'constraint'	=> 11, 'unsigned' => true],
			'total_akhir' => ['type' => 'int', 'constraint'	=> 11, 'unsigned' => true],
			'tunai' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'kembalian' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'catatan' => ['type' => 'text', null => true],
			'tanggal' => ['type' => 'date', null => true],
			'id_user' => ['type' => 'int', 'constraint'	=> 11, 'unsigned' => true],
			'ip_address' => ['type' => 'varchar', 'constraint' => 100],
			'created_at'	=> ['type' => 'datetime', null => true],
			'updated_at'	=> ['type' => 'datetime', null => true],
			'deleted_at'	=> ['type' => 'datetime', null => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey(['id_pelanggan', 'id_user']);
		$this->forge->addForeignKey('id_pelanggan', 'tb_pelanggan', 'id', 'cascade', 'restrict');
		$this->forge->addForeignKey('id_user', 'tb_users', 'id', 'cascade', 'restrict');
		$this->forge->createTable('tb_penjualan', true);

		/**
		 * tabel transaksi
		 */
		$this->forge->addField([
			'id_transaksi' => ['type' => 'int','constraint'	=> 11, 'unsigned' => true,'auto_increment' => true],
			'id_penjualan' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'id_item' => ['type' => 'int', 'constraint'	=> 11, 'unsigned' => true],
			'harga_item' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'jumlah_item' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'diskon_item' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'subtotal' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'ip_address' => ['type' => 'varchar', 'constraint' => 100],
			'created_at' => ['type' => 'datetime', null => true],
			'updated_at' => ['type' => 'datetime', null => true],
			'deleted_at' => ['type' => 'datetime', null => true],
		]);

		$this->forge->addKey('id_transaksi', true);
		$this->forge->addKey(['id_penjualan', 'id_item']);
		$this->forge->addForeignKey('id_penjualan', 'tb_penjualan', 'id', 'cascade', 'restrict');
		$this->forge->addForeignKey('id_item', 'tb_item', 'id', 'cascade', 'restrict');
		$this->forge->createTable('tb_transaksi', true);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		// $this->forge->dropTable('tb_keranjang', true);
		$this->forge->dropTable('tb_penjualan', true);
		$this->forge->dropTable('tb_transaksi', true);
	}
}
