<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table      = 'tb_kategori';
    protected $primaryKey = 'id';
    // protected $useSoftDeletes = true;
    protected $allowedFields = ['nama_kategori'];
    protected $useTimestamps = true;


    public function getKategori($id = null)
    {
        if (!(empty($id))) {
            return $this->builder($this->table)
            ->select('id, nama_kategori AS kategori')
            ->where('id', $id)->get(1)->getRow();
        }
        return $this->builder($this->table)
        ->select('id, nama_kategori AS kategori')
        ->get()->getResult();
    }
}
