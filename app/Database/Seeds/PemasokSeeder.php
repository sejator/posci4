<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PemasokSeeder extends Seeder
{
    public function run()
	{
        // generate data dummy pemasok
		$faker = \Faker\Factory::create('id_ID');
		for ($i = 0; $i < 5; $i++) {
			$data = [
				'nama_pemasok'   => ucwords($faker->company()),
				'telp_pemasok'   => $faker->phoneNumber(),
				'alamat_pemasok' => ucwords($faker->address()),
				'keterangan'     => ucfirst($faker->text(10)),
				'created_at'	 => date('Y-m-d H:i:s'),
				'updated_at'	 => date('Y-m-d H:i:s')
			];
			$this->db->table('tb_pemasok')->insert($data);
		}
	}
}
