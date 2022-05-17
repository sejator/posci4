<?php

namespace App\Models;

use CodeIgniter\Model;

class PemasokModel extends Model
{
    protected $table = "tb_pemasok";
    protected $primaryKey   = 'id';
    protected $allowedFields = ['nama_pemasok', 'telp_pemasok', 'alamat_pemasok', 'keterangan'];
    protected $useTimestamps = true;

    public function detailPemasok($id = null)
    {
        $builder = $this->builder($this->table)->select('id, nama_pemasok AS pemasok, telp_pemasok AS telp, alamat_pemasok AS alamat, keterangan');
        if (empty($id)) {
            return $builder->get()->getResult();
        }
        return $builder->where('id', $id)->get(1)->getRow();
    }
}
