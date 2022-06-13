<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\PemasokModel;
use App\Models\StokModel;
use App\Models\TransaksiModel;
use Irsyadulibad\DataTables\DataTables;

class Transaksi extends BaseController {
    protected $stok;
    protected $pemasok;

    public function __construct() {
        $this->stok    = new StokModel();
        $this->pemasok = new PemasokModel();
        helper('form');
    }

    public function index() {
        $data = [
            'pemasok' => $this->pemasok->detailPemasok(),
        ];
        $uri = $this->request->uri;

        if ($uri->getSegment(2) == 'masuk') {
            $data['title'] = 'Daftar Stok Masuk';
            echo view('stok/masuk/index', $data);
        } else {
            $data['title'] = 'Daftar Stok Keluar';
            echo view('stok/keluar/index', $data);
        }
    }

    public function stok() {
        if ($this->request->isAJAX()) {
            $tipe = $this->request->getGet('tipe', FILTER_SANITIZE_SPECIAL_CHARS);

            return DataTables::use ('tb_stok')
                ->select('tb_stok.id_stok AS id, tb_stok.jumlah, tb_stok.keterangan, tb_stok.created_at AS tanggal, tb_item.barcode AS barcode, nama_item AS item, tb_pemasok.nama_pemasok AS pemasok')
                ->join('tb_item', 'tb_item.id = id_item')
                ->join('tb_pemasok', 'tb_pemasok.id = tb_stok.id_pemasok')
                ->where(['tipe' => $tipe])
                ->make(true);
        }
    }

    public function tambah() {
        $uri  = $this->request->uri;
        $data = [
            'pemasok' => $this->pemasok->detailPemasok(),
        ];
        if ($uri->getSegment(2) == 'masuk') {
            $data['title'] = 'Stok Masuk';
            echo view('stok/masuk/tambah', $data);
        } else {
            $data['title'] = 'Stok Keluar';
            echo view('stok/keluar/tambah', $data);
        }
    }

    public function proses() {
        $rules = [
            'tanggal'    => ['rules' => 'required'],
            'barcode'    => ['rules' => 'required|alpha_numeric'],
            'pemasok'    => ['rules' => 'required|numeric'],
            'jumlah'     => ['rules' => 'required|numeric'],
            'keterangan' => ['rules' => 'required|alpha_numeric_punct'],
        ];
        if ($this->request->getMethod() == 'post') {
            if (!$this->validate($rules)) {
                $respon = [
                    'validasi' => false,
                    'error'    => $this->validator->getErrors(),
                ];
            } else {
                // jika sukses
                $data = [
                    'tipe'       => $this->request->getPost('tipe', FILTER_SANITIZE_SPECIAL_CHARS),
                    'id_item'    => $this->request->getPost('iditem', FILTER_SANITIZE_NUMBER_INT),
                    'id_pemasok' => $this->request->getPost('pemasok', FILTER_SANITIZE_NUMBER_INT),
                    'jumlah'     => $this->request->getPost('jumlah', FILTER_SANITIZE_NUMBER_INT),
                    'keterangan' => $this->request->getPost('keterangan', FILTER_SANITIZE_SPECIAL_CHARS),
                    'id_user'    => session('id'),
                    'ip_address' => $this->request->getIPAddress(),
                ];

                $hasil = $this->stok->simpanTransaksi($data);
                if ($hasil) {
                    $respon = [
                        'validasi' => true,
                        'sukses'   => true,
                        'pesan'    => 'Data berhasil di simpan :)',
                    ];
                }
            }

            return $this->response->setJSON($respon);
        }
    }

    public function hapus() {
        if ($this->request->isAJAX()) {
            $id   = $this->request->getGet('id', FILTER_SANITIZE_NUMBER_INT);
            $tipe = $this->request->getGet('tipe', FILTER_SANITIZE_SPECIAL_CHARS);
            if (empty($this->stok->find($id))) {
                $respon = [
                    'status' => false,
                    'pesan'  => 'Data tidak ditemukan',
                ];
            } else {
                $respon = [
                    'status' => true,
                    'pesan'  => 'Data berhasil dihapus :)',
                ];
                $this->stok->where('id_stok', $id)->where('tipe', $tipe)->delete();
            }

            return $this->response->setJSON($respon);
        }
    }
}
