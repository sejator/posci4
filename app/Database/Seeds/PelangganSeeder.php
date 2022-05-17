<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PelangganSeeder extends Seeder
{
	public function run()
	{
		// generate data dummy pelanggan
		$faker = \Faker\Factory::create('id_ID');
		for ($i = 0; $i < 10; $i++) {
			$jenkel = ($i % 2 == 0) ? 'L' : 'P';
			$data = [
				'nama_pelanggan'   => ucwords($faker->name($jenkel)),
				'jenkel'		   => $jenkel,
				'telp_pelanggan'   => $faker->phoneNumber(),
				'alamat_pelanggan' => ucwords($faker->address()),
				'created_at'	   => date('Y-m-d'),
				'updated_at'	   => date('Y-m-d')
			];
			$this->db->table('tb_pelanggan')->insert($data);
		}
	}
}
