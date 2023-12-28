<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class BillsController extends ResourceController
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
        $billsModel = new \App\Models\BillsModel();
        $data = $billsModel->findAll();

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
            'nama' => $this->request->getVar('nama'),
            'nominal' => $this->request->getVar('nominal'),
        ];

        $billsModel = new \App\Models\billsModel();
        $billsModel->save($data);

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
        $billsModel = new \App\Models\billsModel();
        $user = $billsModel->find($id);
        if ($user) {
            $data = [
                'nama' => $this->request->getVar('nama'),
                'nominal' => $this->request->getVar('nominal'),
            ];
            $proses = $billsModel->update($id, $data);
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
        $billsModel = new \App\Models\billsModel();
        $user = $billsModel->find($id);
        if ($user) {
            $proses = $billsModel->delete($id);
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