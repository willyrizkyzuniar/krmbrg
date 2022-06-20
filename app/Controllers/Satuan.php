<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelSatuan;

class Satuan extends BaseController
{
    public function __construct()
    {
        $this->satuan = new ModelSatuan();
    }

    public function index()
    {
        $data = [
            'tampildata' => $this->satuan->findAll()
        ];
        return view('satuan/index', $data);
    }

    public function formtambah()
    {
        return view('satuan/formtambah');
    }

    public function simpandata()
    {
        $namasatuan = $this->request->getVar('namasatuan');

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'namasatuan' => [
                'rules' => 'required',
                'label' => 'Nama Satuan',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);

        if (!$valid) {
            $pesan = [
                'errorNamaSatuan' => $validation->getError()
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/satuan/formtambah');
        } else {
            $this->satuan->insert([
                'satnama' => $namasatuan
            ]);

            $pesan = [
                'sukses' => '<div class="alert alert-success">Data satuan Berhasil ditambahkan...</div>'

            ];
            session()->setFlashdata($pesan);
            return redirect()->to('/satuan/index');
        }
    }
}
