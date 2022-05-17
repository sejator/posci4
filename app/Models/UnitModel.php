<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table      = 'tb_unit';
    protected $primaryKey = 'id';
    // protected $useSoftDeletes = true;
    protected $allowedFields = ['nama_unit'];
    protected $useTimestamps = true;

    public function getUnit($id = null)
    {
        if (!(empty($id))) {
            return $this->builder($this->table)->select('id, nama_unit AS unit')->where('id', $id)
            ->get(1)->getRow();
        }
        return $this->builder($this->table)->select('id, nama_unit AS unit')->get()->getResult();
    }
}
