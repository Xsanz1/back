<?php

// namespace App\Controllers;

// use CodeIgniter\API\ResponseTrait;

// class AnalyticsController extends BaseController
// {
//     use ResponseTrait;

//     public function saveData()
//     {
//         $request = $this->request->getJSON();

//         // Ambil data dari permintaan
//         $saldo_awal = $request->saldo_awal;
//         $pemasukan = $request->pemasukan;
//         $pengeluaran = $request->pengeluaran;
//         $selisih = $request->selisih;

//         // Simpan data ke database (gunakan model)
//         $analyticsModel = new \App\Models\AnalyticsModel();
//         $analyticsModel->insert([
//             'saldo_awal' => $saldo_awal,
//             'pemasukan' => $pemasukan,
//             'pengeluaran' => $pengeluaran,
//             'selisih' => $selisih,
//         ]);

//         // Respon berhasil
//         return $this->respond(['status' => 'success']);
//     }
// }

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class AnalyticsController extends ResourceController
{
    protected $format = 'json';

    // public function index($id = null)
    // {
    //     $billsModel = new \App\Models\billsModel();

    //     if ($id === null) {
    //         $data = $billsModel->findAll();
    //     } else {
    //         $data = $billsModel->find($id);
    //     }

    //     if (!empty($data)) {
    //         $response = [
    //             'status' => 'success',
    //             'message' => 'Data retrieved successfully',
    //             'data' => [$data]
    //         ];
    //     } else {
    //         $response = [
    //             'status' => 'error',
    //             'message' => ($id === null) ? 'No data found' : 'Data with the specified ID not found',
    //             'data' => []
    //         ];
    //     }

    //     return $this->respond($response);
    // }

    public function index()
    {
        $analyticsModel = new \App\Models\AnalyticsModel();
        $data = $analyticsModel->findAll();

        if (!empty($data)) {
            $response = [
                'status' => 'success',
                'message' => 'Data retrieved successfully',
                'data' => $data
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'No data found',
                'data' => []
            ];
        }

        return $this->respond($response);
    }

    public function create()
{
    $data = [
        'saldo_awal' => $this->request->getPost('saldo_awal'),
        'pemasukan' => $this->request->getPost('pemasukan'),
        'pengeluaran' => $this->request->getPost('pengeluaran'),
        'selisih' => $this->request->getPost('pemasukan') - $this->request->getPost('pengeluaran'),
    ];

    $analyticsModel = new \App\Models\analyticsModel();
    $analyticsModel->save($data);

    $response = [
        'status' => 200,
        'messages' => 'Data berhasil ditambahkan',
        'data' => $data,
    ];

        return $this->respond($response);
    }

    // function untuk mengedit data
    public function update($id = null)
    {
        $analyticsModel = new \App\Models\analyticsModel();
        $user = $analyticsModel->find($id);
        if ($user) {
            $data = [
            'saldo_awal' => $this->request->getPost('saldo_awal') ?? $user['saldo_awal'],
            'pemasukan' => $this->request->getPost('pemasukan') ?? $user['pemasukan'],
            'pengeluaran' => $this->request->getPost('pengeluaran') ?? $user['pengeluaran'],
            'selisih' => ($this->request->getPost('pemasukan') ?? $user['pemasukan']) - ($this->request->getPost('pengeluaran') ?? $user['pengeluaran']),
            ];
            $proses = $analyticsModel->update($id, $data);
            if ($proses) {
                $response = [
                    'status' => 200,
                    'messages' => 'Data berhasil diubah',
                    'data' => $data,
                ];
            } else {
                $response = [
                    'status' => 500,
                    'messages' => 'Gagal diubah',
                ];
            }
            return $this->respond($response);
        }
        return $this->failNotFound('Data tidak ditemukan');
    }    

    // function untuk menghapus data
    public function delete($id = null)
    {
        $analyticsModel = new \App\Models\analyticsModel();
        $user = $analyticsModel->find($id);
        if ($user) {
            $proses = $analyticsModel->delete($id);
            if ($proses) {
                $response = [
                    'status' => 200,
                    'messages' => 'Data berhasil dihapus',
                ];
            } else {
                $response = [
                    'status' => 200,
                    'messages' => 'Gagal menghapus data',
                ];
            }
            return $this->respond($response);
        } else {
            return $this->failNotFound('Data tidak ditemukan');
        }
    }
}