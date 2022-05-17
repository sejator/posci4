<?php

namespace App\Models;

use CodeIgniter\Model;

class StokModel extends Model
{
    protected $table      = 'tb_stok';
    protected $primaryKey = 'id_stok';
    // protected $useSoftDeletes = true;
    protected $allowedFields = ['tipe', 'id_item', 'id_pemasok', 'jumlah', 'keterangan', 'id_user', 'ip_address'];
    protected $useTimestamps = true;

    public function simpanTransaksi(array $data)
    {
        $db = \Config\Database::connect();
        $db->transBegin();
        $this->save($data); // simpan transaksi
        // proses update stok item
        if ($data['tipe'] == 'masuk') {
            // stok bertambah
            $db->table('tb_item')->set('stok', 'stok+'.$data['jumlah'], false)->where('id', $data['id_item'])->update();
        } else {
            // stok berkurang
            $db->table('tb_item')->set('stok', 'stok-'.$data['jumlah'], false)->where('id', $data['id_item'])->update();
        }
        
        if ($db->transStatus() === FALSE) {
            return $db->transRollback();
        } else {
            return $db->transCommit();
        }
    }
}
