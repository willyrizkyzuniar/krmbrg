<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBarang;
use App\Models\ModelTempBarangMasuk;
use App\Models\ModelBarangMasuk;
use App\Models\ModelDetailBarangMasuk;

class Barangmasuk extends BaseController
{
    public function index()
    {
        return view('barangmasuk/forminput');
    }

    function dataTemp()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');

            $modelTemp = new ModelTempBarangMasuk();
            $data = [
                'datatemp' => $modelTemp->tampilDataTemp($faktur)
            ];

            $json = [
                'data' => view('barangmasuk/datatemp', $data)
            ];
            echo json_encode($json);
        } else {
            exit('Maaf Tidak Bisa dipanggil');
        }
    }

    function ambilDataBarang()
    {
        if ($this->request->isAJAX()) {
            $kodebarang = $this->request->getPost('kodebarang');

            $modelBarang = new ModelBarang();
            $ambilData = $modelBarang->find($kodebarang);

            if ($ambilData == NULL) {
                $json = [
                    'error' => 'Data Barang Tidak Ditemukan'
                ];
            } else {
                $data = [
                    'namabarang' => $ambilData['brgnama'],
                    'hargajual' => $ambilData['brgharga']
                ];

                $json = [
                    'sukses' => $data
                ];
            }

            echo json_encode($json);
        } else {
            exit('Maaf Tidak Bisa dipanggil');
        }
    }

    function simpanTemp()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');
            $kodebarang = $this->request->getPost('kodebarang');
            $hargabeli = $this->request->getPost('hargabeli');
            $hargajual = $this->request->getPost('hargajual');
            $jumlah = $this->request->getPost('jumlah');

            $modelTempBarang = new ModelTempBarangMasuk();
            $modelTempBarang->insert([
                'detfaktur' => $faktur,
                'detbrgkode' => $kodebarang,
                'dethargamasuk' => $hargabeli,
                'dethargajual' => $hargajual,
                'detjml' => $jumlah,
                'detsubtotal' => intval($jumlah) * intval($hargabeli)
            ]);

            $json = [
                'sukses' => 'Item Berhasil ditambahkan'
            ];
            echo json_encode($json);
        } else {
            exit('Maaf Tidak Bisa dipanggil');
        }
    }

    function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');

            $modelTempBarang = new ModelTempBarangMasuk();
            $modelTempBarang->delete($id);

            $json = [
                'sukses' => 'Item Berhasil Dihapus'
            ];
            echo json_encode($json);
        } else {
            exit('Maaf Tidak Bisa dipanggil');
        }
    }

    function cariDataBarang()
    {
        if ($this->request->isAJAX()) {
            $json = [
                'data' => view('barangmasuk/modalcaribarang')
            ];

            echo json_encode($json);
        } else {
            exit('Maaf Tidak Bisa dipanggil');
        }
    }

    function detailCariBarang()
    {
        if ($this->request->isAJAX()) {
            $cari = $this->request->getPost('cari');

            $modalBarang = new ModelBarang();

            $data =  $modalBarang->tampildata_cari($cari)->get();

            if ($data != null) {
                $json = [
                    'data' => view('barangmasuk/detaildatabarang', [
                        'tampildata' => $data
                    ])
                ];
            }
            echo json_encode($json);
        } else {
            exit('Maaf Tidak Bisa dipanggil');
        }
    }

    function selesaiTransaksi()
    {
        if ($this->request->isAJAX()) {
            $faktur = $this->request->getPost('faktur');
            $tglfaktur = $this->request->getPost('tglfaktur');

            $modelTemp = new ModelTempBarangMasuk();
            $dataTemp = $modelTemp->getWhere(['detfaktur' => $faktur]);

            if ($dataTemp->getNumRows() == 0) {
                $json = [
                    'error' => 'Maaf, data item faktur belum ada'
                ];
            } else {
                //simpan data kedalam tabel barang masuk
                $modelBarangMasuk = new ModelBarangMasuk();
                $totalSubTotal = 0;
                foreach ($dataTemp->getResultArray() as $total) :
                    $totalSubTotal += intval($total['detsubtotal']);
                endforeach;

                $modelBarangMasuk->insert([
                    'faktur' => $faktur,
                    'tglfaktur' => $tglfaktur,
                    'totalharga' => $totalSubTotal
                ]);

                // simpan data ke tabel detail barang masuk
                // $modelDetailBarangMasuk = new ModelDetailBarangMasuk();

                // foreach ($dataTemp->getResultArray() as $row) :
                //     $modelDetailBarangMasuk->insert([
                //         'detfaktur' => $row['detfaktur'],
                //         'detbrgkode' => $row['detbrgkode'],
                //         'dethargamasuk' => $row['dethargamasuk'],
                //         'dethargajual' => $row['dethargajual'],
                //         'detjml' => $row['detjml'],
                //         'detsubtotal' => $row['detsubtotal']
                //     ]);
                // endforeach;

                // hapus data tabel temp berdasarkan kode faktur
                // $modelTemp->emptyTable();

                $json = [
                    'sukses' => 'Transaksi Berhasil disimpan'
                ];
            }
            echo json_encode($json);
        } else {
            exit('Maaf Tidak Bisa dipanggil');
        }
    }
}
