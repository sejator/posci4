<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaturanModel extends Model
{
    protected $table            = 'tb_pengaturan';
    protected $allowedFields    = ['nama_toko', 'no_telp', 'alamat'];
}
