<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table      = 'tb_item';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    // protected $useSoftDeletes = true;
    protected $allowedFields = ['barcode', 'nama_item', 'id_kategori', 'id_unit', 'id_pemasok', 'harga', 'stok', 'gambar'];
    protected $useTimestamps = true;

    public function detailItem($id = null)
    {
        $builder = $this->builder($this->table)->select('tb_item.id AS iditem, barcode, nama_item AS item, harga, stok, gambar, id_pemasok, nama_unit AS unit, nama_kategori AS kategori, nama_pemasok AS pemasok')
            ->join('tb_unit', 'tb_unit.id = id_unit')
            ->join('tb_kategori', 'tb_kategori.id = id_kategori')
            ->join('tb_pemasok', 'tb_pemasok.id = id_pemasok');
        if (empty($id)) {
            return $builder->get()->getResult(); // tampilkan semua data
        } else {
            // tampilkan data sesuai id/barcode
            return $builder->where('tb_item.id', $id)->orWhere('barcode', $id)->get(1)->getRow();
        }
    }

    public function barcodeModel($keyword)
    {
        $builder = $this->builder($this->table);
        $builder->select('barcode')->Like('barcode', $keyword);
        return $builder->get()->getResultArray();
    }

    public function cariProduk($keyword)
    {
        $builder = $this->builder($this->table);
        $query = $builder->select('barcode, nama_item');
        if (empty($keyword)) {
            $data = $query->get(10)->getResult();
        } else {
            $data = $query->like('barcode', $keyword)->orLike('nama_item', $keyword)->get()->getResult();
        }
        return $data;
    }
}
