<?php

namespace App\Database\Seeds;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        // generate data dummy roles
        $roles = [
            ['id' => 1, 'keterangan' => 'Super Admin'],
            ['id' => 2, 'keterangan' => 'Administrator'],
            ['id' => 3, 'keterangan' => 'Kasir']
        ];
        // insert role ke tabel
        $this->db->table('tb_roles')->insertBatch($roles);

        $reques = \Config\Services::request();
        helper('fungsi');
        // generate data dummy pengguna
        $data = [
            [
                'username'  => 'superadmin',
                'email'     => 'sejatordev@gmail.com',
                'password'  => buat_password('superadmin'),
                'nama'      => 'Super Admin',
                'alamat'    => 'Bandung',
                'id_role'   => 1,
                'status'    => 1,
                'ip_address' => $reques->getIPAddress(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'  => 'admin',
                'email'     => 'admin@gmail.com',
                'password'  => buat_password('admin1234'),
                'nama'      => 'Administrator',
                'alamat'    => 'Bandung',
                'id_role'   => 2,
                'status'    => 1,
                'ip_address' => $reques->getIPAddress(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'  => 'kasir',
                'email'     => 'kasir@gmail.com',
                'password'  => buat_password('kasir1234'),
                'nama'      => 'Kasir',
                'alamat'    => 'Bandung',
                'id_role'   => 3,
                'status'    => 1,
                'ip_address' => $reques->getIPAddress(),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];
        // insert data user ke tabel
        $this->db->table('tb_users')->insertBatch($data);
    }
}
