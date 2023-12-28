<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class TransactionController extends ResourceController
{

    protected $format = 'json';
    public function index()
    {
        $transactionModel = new \App\Models\TransactionModel();
        $data = $transactionModel->findAll();

        if (!empty($data)) {
            return $this->respond(['status' => 'success', 'message' => 'Data retrieved successfully', 'data' => $data]);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'No data found', 'data' => []]);
        }
    }

    public function create()
    {
        $data = [
            'nama_transaksi' => $this->request->getVar('nama_transaksi'),
            'tanggal_transaksi' => $this->request->getVar('tanggal_transaksi'),
            'jumlah_transaksi' => $this->request->getVar('jumlah_transaksi'),
            'struk' => $this->request->getFile('struk')
        ];

        $transactionModel = new \App\Models\TransactionModel();
        $transactionModel->insert($data);

        return $this->respondCreated([
            'status' => 201,
            'messages' => 'Data berhasil ditambahkan',
            'data' => $data,
        ]);
    }

    public function update($id = null)
    {
        $transactionModel = new \App\Models\TransactionModel();
        $user = $transactionModel->find($id);

        if ($user) {
            $data = [
                'nama_transaksi' => $this->request->getVar('nama_transaksi'),
                'tanggal_transaksi' => $this->request->getVar('tanggal_transaksi'),
                'jumlah_transaksi' => $this->request->getVar('jumlah_transaksi'),
                'struk' => $this->request->getFile('struk')
            ];

            $proses = $transactionModel->update($id, $data);

            if ($proses) {
                return $this->respond(['status' => 200, 'messages' => 'Data berhasil diubah', 'data' => $data]);
            } else {
                return $this->respond(['status' => 500, 'messages' => 'Gagal diubah']);
            }
        }

        return $this->failNotFound('Data tidak ditemukan');
    }

    public function delete($id = null)
    {
        $transactionModel = new \App\Models\TransactionModel();
        $user = $transactionModel->find($id);

        if ($user) {
            $proses = $transactionModel->delete($id);

            if ($proses) {
                return $this->respond(['status' => 200, 'messages' => 'Data berhasil dihapus']);
            } else {
                return $this->respond(['status' => 500, 'messages' => 'Gagal menghapus data']);
            }
        } else {
            return $this->failNotFound('Data tidak ditemukan');
        }
    }
}
