<?php

namespace App\Controllers;

use App\Models\PelangganModel;
use Irsyadulibad\DataTables\DataTables;

class Pelanggan extends BaseController
{
    protected $pelangganModel;
    protected $rules = ['pelanggan' => ['rules' => 'required']];

    public function __construct()
    {
        $this->pelangganModel = new PelangganModel();
		helper('form');
    }

    public function index()
    {
        echo view('pelanggan/index', ['title' => 'Daftar Pelanggan']);
    }

    public function ajax()
    {
        if ($this->request->isAJAX()) {
            return DataTables::use('tb_pelanggan')
			->select('id, nama_pelanggan AS pelanggan, jenkel, telp_pelanggan AS telp, alamat_pelanggan AS alamat')
			->make();
        }
    }

    public function tambah()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate($this->rules)) {
                $respon = [
                    'validasi' => false,
                    'error'   => $this->validator->getErrors(),
                ];
            } else {
                // validation form sukses 
                $data = [
                    'nama_pelanggan'   => ucwords($this->request->getPost('pelanggan', FILTER_SANITIZE_STRING)),
                    'jenkel'   => $this->request->getPost('jenkel', FILTER_SANITIZE_STRING),
                    'telp_pelanggan'   => $this->request->getPost('telp', FILTER_SANITIZE_STRING),
                    'alamat_pelanggan' => ucfirst($this->request->getPost('alamat', FILTER_SANITIZE_STRING))
                ];
                $this->pelangganModel->save($data);
                $respon = [
                    'validasi' => true,
                    'sukses' => true,
                    'pesan' => 'Data berhasil ditambahkan :)'
                ];
            }
            return $this->response->setJSON($respon);
        }
    }

    public function ubah()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate($this->rules)) {
                $respon = [
                    'validasi' => false,
                    'error'   => $this->validator->getErrors(),
                ];
            } else {
                // validation form sukses 
                $data = [
                    'id'   => $this->request->getPost('id', FILTER_SANITIZE_NUMBER_INT),
                    'nama_pelanggan'   => ucwords($this->request->getPost('pelanggan', FILTER_SANITIZE_STRING)),
                    'jenkel'   => $this->request->getPost('jenkel', FILTER_SANITIZE_STRING),
                    'telp_pelanggan'   => $this->request->getPost('telp', FILTER_SANITIZE_STRING),
                    'alamat_pelanggan' => ucfirst($this->request->getPost('alamat', FILTER_SANITIZE_STRING))
                ];
                $this->pelangganModel->save($data);
                $respon = [
                    'validasi' => true,
                    'sukses' => true,
                    'pesan' => 'Data berhasil diubah :)'
                ];
            }
            return $this->response->setJSON($respon);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getGet('id', FILTER_SANITIZE_NUMBER_INT);
            if(!(empty($this->pelangganModel->find($id)))){
                $this->pelangganModel->delete($id);
                $respon = [
                    'status' => true,
                    'pesan' => 'Data berhasil dihapus :)'
                ];
            } else {
                $respon = [
                    'status' => false,
                    'pesan' => 'Maaf data tidak ditemukan :('
                ];
            }
            return $this->response->setJSON($respon);
        }
    }
}