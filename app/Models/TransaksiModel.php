<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'tb_transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $allowedFields = [
        'id_penjualan',
        'id_item',
        'harga_item',
        'jumlah_item',
        'diskon_item',
        'subtotal',
        'ip_address'
    ];

    protected $useTimestamps = true;

    public function detailTransaksi($id = null)
    {
        if ($id) {
            return $this->builder($this->table)
            ->select('harga_item AS harga, jumlah_item AS jumlah, diskon_item, subtotal, p.invoice, p.total_harga, p.diskon, p.total_akhir, p.tunai, p.kembalian, p.catatan, p.created_at AS tanggal, i.nama_item AS item, pb.nama_pelanggan AS pelanggan, u.nama AS kasir')
            ->join('tb_penjualan p', 'p.id = id_penjualan')
            ->join('tb_item i', 'i.id = id_item')
            ->join('tb_pelanggan pb', 'pb.id = id_pelanggan')
            ->join('tb_users u', 'u.id = id_user')
            ->where('id_penjualan', $id, true)
            ->get()->getResultArray();
        }
    }
}
