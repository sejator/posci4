<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'tb_users';
    protected $primaryKey = 'id';
    // protected $returnType = 'object';
    // protected $useSoftDeletes = true;
    protected $allowedFields = ['username', 'email', 'password', 'nama', 'alamat', 'id_role', 'avatar', 'status', 'token', 'ip_address'];
    protected $useTimestamps = true;

    public function getUser($kolom = null)
    {
        if (empty($kolom)) {
            return $this->findAll();
        }
        return $this->builder($this->table)->where('id', $kolom)->orWhere('username', $kolom)->orWhere('email', $kolom)->get(1)->getRow();
    }

    public function getToken(string $token)
    {
        return $this->builder($this->table)->select('id, email, token')->where('token', $token)->get(1)->getRow();
    }

    public function getRole()
    {
        return $this->builder('tb_roles')->select('id, keterangan')->orderBy('id', 'DESC')->get()->getResult();
    }
}
