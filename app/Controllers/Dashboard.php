<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\PelangganModel;
use App\Models\PemasokModel;
use App\Models\PenjualanModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    protected $produk;
    protected $pemasok;
    protected $pelanggan;
    protected $pengguna;
    protected $penjualan;

    public function __construct()
    {
        $this->produk = new ItemModel();
        $this->pemasok = new PemasokModel();
        $this->pelanggan = new PelangganModel();
        $this->pengguna = new UserModel();
        $this->penjualan = new PenjualanModel();
    }
    public function index()
    {
        $data = [
            'title'     => 'Dashboard',
            'produk'    => $this->produk->countAllResults(),
            'pemasok'  => $this->pemasok->countAllResults(),
            'pelanggan' => $this->pelanggan->countAllResults(),
            'pengguna'  => $this->pengguna->countAllResults()
        ];
        echo view('dashboard', $data);
    }

    public function laporan()
    {
        $data = $this->penjualan->laporanPenjualan(date('Y'));
        return $this->response->setJSON($data);
    }
}
