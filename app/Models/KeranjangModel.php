<?php

namespace App\Models;

use App\Models\ItemModel;
use CodeIgniter\Model;

class KeranjangModel extends Model {
    protected $table         = 'tb_keranjang';
    protected $primaryKey    = 'id_keranjang';
    protected $allowedFields = ['id_keranjang', 'id_item', 'harga_produk', 'qty', 'diskon_item', 'total', 'id_user', 'stok_produk', 'ip_address'];

    protected $afterInsert = ['updateStok'];

    protected $db;
    protected $builder;

    public function __construct() {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table($this->table);
    }

    public function getDataKeranjang($id = false) {
        // if ($id) {
        //     $this->builder->select('id_keranjang AS id, harga_produk AS harga, qty, diskon_item AS diskon, total, ip_address');
        //     $this->builder->where('id_item', $id);
        //     $this->builder->where('id_user', session('id'));
        //     return $this->builder->get()->getRowArray();
        // }

        // $this->builder->select('keranjang.id_keranjang AS id, keranjang.harga_produk AS harga, keranjang.qty, keranjang.diskon_item AS diskon, keranjang.total, keranjang.ip_address, item.id_item, item.barcode, item.nama_item AS item, item.stok');
        // $this->builder->join('item', 'item.id_item=keranjang.id_item');
        // $this->builder->where('id_user', session('id'));

        // return $this->builder->get()->getResultArray();
    }

    public function cekStokProduk($barcode) {
        return $this->builder('tb_item')->select('stok')->where('barcode', $barcode)->get()->getRow();
    }

    public function hapusKeranjang($id = false) {
        if ($id) {
            return $this->builder->delete(['id_keranjang' => $id]);
        } else {
            return $this->builder->delete(['id_user' => session()->get('id')]);
        }
    }

    protected function updateStok(array $data) {
        $itemModel = new ItemModel();
        $cek_stok  = $itemModel->getItem($data['data']['id_item']);
        $stok      = [
            'stok' => $cek_stok['stok'] - $data['data']['qty'],
        ];
        $itemModel->update($data['data']['id_item'], $stok);

        return $data;
    }
}
