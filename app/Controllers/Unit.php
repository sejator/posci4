<?php

namespace App\Controllers;

use App\Models\UnitModel;
use Irsyadulibad\DataTables\DataTables;

class Unit extends BaseController
{
    protected $unitModel;
    protected $rules = [
        'unit' => [
            'rules' => 'required|alpha_numeric_punct|is_unique[tb_unit.nama_unit,id,{id}]'
        ]
    ];

    public function __construct()
    {
        $this->unitModel = new UnitModel();
        helper('form');
    }

    public function index()
    {
        echo view('unit/index', ['title'    => 'Daftar Unit']);
    }

    public function ajax()
    {
        if ($this->request->isAJAX()) {
            return DataTables::use('tb_unit')
            ->select('id, nama_unit AS unit')->make();
        }
    }

    public function tambah()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate($this->rules)) {
                $respon = [
                    'validasi' => false,
                    'error' => $this->validator->getErrors()
                ];
            } else {
                $data = [
                    'nama_unit' => ucwords($this->request->getPost('unit', FILTER_SANITIZE_STRING))
                ];
                $this->unitModel->save($data); // simpan data
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
                    'error' => $this->validator->getErrors()
                ];
            } else {
                $data = [
                    'id' => $this->request->getPost('id', FILTER_SANITIZE_NUMBER_INT),
                    'nama_unit' => ucwords($this->request->getPost('unit', FILTER_SANITIZE_STRING))
                ];
                $this->unitModel->save($data); // update data
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
            $id = $this->request->getGet("id", FILTER_SANITIZE_NUMBER_INT);
            if ($this->unitModel->find($id)) {
                $this->unitModel->delete($id); // hapus data
                $respon = [
                    'status' => true,
                    'pesan' => 'Data berhasil dihapus :)'
                ];
            } else {
                $respon = [
                    'status' => false,
                    'pesan' => 'Gagal menghapus data :('
                ];
            }
            return $this->response->setJSON($respon);
        }
    }
}
