<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BulantahunSeeder extends Seeder
{
	public function run()
	{
		// generate data dummy bulan dan tahun
		for ($i = -1; $i < 10; $i++) {
			// generate 1 tahun kebelakang dan 10 tahun mendatang
			$tahun = ($i < 0) ? date('Y', strtotime("$i year")) : date('Y', strtotime("+$i year"));
			$data = [
				['bulan' => 'Jan', 'tahun' => $tahun, 'bln_thn' => "01-$tahun"],
				['bulan' => 'Feb', 'tahun' => $tahun, 'bln_thn' => "02-$tahun"],
				['bulan' => 'Mar', 'tahun' => $tahun, 'bln_thn' => "03-$tahun"],
				['bulan' => 'Apr', 'tahun' => $tahun, 'bln_thn' => "04-$tahun"],
				['bulan' => 'Mei', 'tahun' => $tahun, 'bln_thn' => "05-$tahun"],
				['bulan' => 'Jun', 'tahun' => $tahun, 'bln_thn' => "06-$tahun"],
				['bulan' => 'Jul', 'tahun' => $tahun, 'bln_thn' => "07-$tahun"],
				['bulan' => 'Agu', 'tahun' => $tahun, 'bln_thn' => "08-$tahun"],
				['bulan' => 'Sep', 'tahun' => $tahun, 'bln_thn' => "09-$tahun"],
				['bulan' => 'Okt', 'tahun' => $tahun, 'bln_thn' => "10-$tahun"],
				['bulan' => 'Nov', 'tahun' => $tahun, 'bln_thn' => "11-$tahun"],
				['bulan' => 'Des', 'tahun' => $tahun, 'bln_thn' => "12-$tahun"],
			];
			$this->db->table('tb_bulan_tahun')->insertBatch($data);
		}
	}
}
