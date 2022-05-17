<?php

namespace App\Controllers;

use App\Models\PemasokModel;
use Irsyadulibad\DataTables\DataTables;

class Pemasok extends BaseController
{
    protected $pemasokModel;

    private $rules = [
        'pemasok' => ['rules' => 'required'],
        'telp'    => ['rules' => 'required'],
        'alamat'  => ['rules' => 'required']
    ];

    public function __construct()
    {
        $this->pemasokModel = new PemasokModel();
        helper('form');
    }
    public function index()
    {
        echo view('pemasok/index', ['title' => 'Daftar Pemasok']);
    }

    public function ajax()
    {
        if ($this->request->isAJAX()) {
            return DataTables::use('tb_pemasok')
                ->select('id, nama_pemasok as pemasok, telp_pemasok as telp, alamat_pemasok as alamat, keterangan')
                ->make(true);
        }
    }

    public function tambah()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate($this->rules)) {
                // validasi form gagal
                $respon = [
                    'validasi' => false,
                    'error'   => $this->validator->getErrors()
                ];
            } else {
                // sukses
                $data = [
                    'nama_pemasok'     => ucwords($this->request->getPost('pemasok', FILTER_SANITIZE_STRING)),
                    'telp_pemasok'     => $this->request->getPost('telp', FILTER_SANITIZE_STRING),
                    'alamat_pemasok'   => ucwords($this->request->getPost('alamat', FILTER_SANITIZE_STRING)),
                    'keterangan'        => ucfirst($this->request->getPost('keterangan', FILTER_SANITIZE_STRING))
                ];
                $this->pemasokModel->save($data);
                if ($this->pemasokModel->getInsertID() > 0) {
                    $respon = [
                        'validasi' => true,
                        'sukses' => true,
                        'pesan'   => 'Data berhasil ditambahkan :)',
                    ];
                }else{
                    $respon = [
                        'validasi' => true,
                        'sukses' => false,
                        'pesan'   => 'Gagal menambahkan data!',
                    ];
                }
            }
            return $this->response->setJSON($respon);
        }
    }

    public function ubah()
    {
        // cek apakah method yang dikirim dari ajax 
        if ($this->request->isAJAX()) {
            if (!$this->validate($this->rules)) {
                // validasi form gagal
                $respon = [
                    'validasi' => false,
                    'error'   => $this->validator->getErrors()
                ];
            } else {
                // validasi form sukses
                $data = [
                    'id'       => $this->request->getPost('id', FILTER_SANITIZE_NUMBER_INT),
                    'nama_pemasok'     => ucwords($this->request->getPost('pemasok', FILTER_SANITIZE_STRING)),
                    'telp_pemasok'     => $this->request->getPost('telp', FILTER_SANITIZE_STRING),
                    'alamat_pemasok'   => ucwords($this->request->getPost('alamat', FILTER_SANITIZE_STRING)),
                    'keterangan'        => ucfirst($this->request->getPost('keterangan', FILTER_SANITIZE_STRING))
                ];
                $this->pemasokModel->save($data); // update data
                $respon = [
                    'validasi' => true,
                    'sukses' => true,
                    'pesan'   => 'Data berhasil diubah!',
                ];
            }
            return $this->response->setJSON($respon);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getGet('id', FILTER_SANITIZE_NUMBER_INT);
            $role = 1; // role admin / superadmin
            if($this->pemasokModel->find($id) && $role == 1){
                $this->pemasokModel->delete($id);
                $respon = [
                    'status' => true,
                    'pesan' => 'Data berhasil dihapus :)'
                ];
            } else {
                $respon = [
                    'status' => false,
                    'pesan' => 'Gagal menghapus data'
                ];
            }
            return $this->response->setJSON($respon);
        }
    }

}
