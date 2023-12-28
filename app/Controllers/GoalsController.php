<?php

// namespace App\Controllers;

// use CodeIgniter\RESTful\ResourceController;

// class GoalsController extends ResourceController
// {
//     protected $format = 'json';
    
//     public function index()
//     {
//         $goalsModel = new \App\Models\GoalsModel();
//         $data = $goalsModel->findAll();

//         if (!empty($data)) {
//             $response = [
//                 'status' => 'success',
//                 'message' => 'Data retrieved successfully',
//                 'data' => $data
//             ];
//         } else {
//             $response = [
//                 'status' => 'error',
//                 'message' => 'No data found',
//                 'data' => []
//             ];
//         }

//         return $this->respond($response);
//     }

//     public function create()
//     {

//         $data = [
//             'nama_goals' => $this->request->getVar('nama_goals'),
//             'tujuan_goals' => $this->request->getVar('tujuan_goals'),
//             'tanggal_goals' => $this->request->getVar('tanggal_goals'),
//             'jumlah_goals' => $this->request->getVar('jumlah_goals'),
//             'status_goals' => $this->request->getVar('status_goals'),      
//         ];
//         $goalsModel = new \App\Models\goalsModel();
//         $goalsModel->save($data);

//         $response = [
//             'status' => 200,
//             'messages' => 'Data berhasil ditambahkan',
//             'data' => $data,
//         ];

//         return $this->respond($response);
//     }

//     // function untuk mengedit data
//     public function update($id = null)
//     {
//         $goalsModel = new \App\Models\goalsModel();
//         $user = $goalsModel->find($id);
//         if ($user) {
//             $data = [
//                 'nama_goals' => $this->request->getVar('nama_goals'),
//                 'tujuan_goals' => $this->request->getVar('tujuan_goals'),
//                 'tanggal_goals' => $this->request->getVar('tanggal_goals'),
//                 'jumlah_goals' => $this->request->getVar('jumlah_goals'),
//                 'status_goals' => $this->request->getVar('status_goals'),
//             ];
//             $proses = $goalsModel->update($id, $data);
//             if ($proses) {
//                 $response = [
//                     'status' => 200,
//                     'messages' => 'Data berhasil diubah',
//                     'data' => $data,
//                 ];
//             } else {
//                 $response = [
//                     'status' => 500,
//                     'messages' => 'Gagal diubah',
//                 ];
//             }
//             return $this->respond($response);
//         }
//         return $this->failNotFound('Data tidak ditemukan');
//     }    

//     // function untuk menghapus data
//     public function delete($id = null)
//     {
//         $goalsModel = new \App\Models\billsModel();
//         $user = $goalsModel->find($id);
//         if ($user) {
//             $proses = $goalsModel->delete($id);
//             if ($proses) {
//                 $response = [
//                     'status' => 200,
//                     'messages' => 'Data berhasil dihapus',
//                 ];
//             } else {
//                 $response = [
//                     'status' => 200,
//                     'messages' => 'Gagal menghapus data',
//                 ];
//             }
//             return $this->respond($response);
//         } else {
//             return $this->failNotFound('Data tidak ditemukan');
//         }
//     }
// }
// app/Controllers/GoalsController.php
namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\GoalsModel;

class GoalsController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $goalsModel = new GoalsModel();
        $data = $goalsModel->findAll();

        if (!empty($data)) {
            return $this->respond(['status' => 'success', 'message' => 'Data retrieved successfully', 'data' => $data]);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'No data found', 'data' => []]);
        }
    }

    public function create()
    {
        $data = [
            'nama_goals' => $this->request->getVar('nama_goals'),
            'tujuan_goals' => $this->request->getVar('tujuan_goals'),
            'tanggal_goals' => $this->request->getVar('tanggal_goals'),
            'jumlah_goals' => $this->request->getVar('jumlah_goals'),
            'status_goals' => $this->request->getVar('status_goals'),
        ];

        $goalsModel = new GoalsModel();
        $goalsModel->insert($data);

        return $this->respondCreated([
            'status' => 201,
            'messages' => 'Data berhasil ditambahkan',
            'data' => $data,
        ]);
    }

    public function update($id = null)
    {
        $goalsModel = new GoalsModel();
        $user = $goalsModel->find($id);

        if ($user) {
            $data = [
                'nama_goals' => $this->request->getVar('nama_goals'),
                'tujuan_goals' => $this->request->getVar('tujuan_goals'),
                'tanggal_goals' => $this->request->getVar('tanggal_goals'),
                'jumlah_goals' => $this->request->getVar('jumlah_goals'),
                'status_goals' => $this->request->getVar('status_goals'),
            ];

            $proses = $goalsModel->update($id, $data);

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
        $goalsModel = new GoalsModel();
        $user = $goalsModel->find($id);

        if ($user) {
            $proses = $goalsModel->delete($id);

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
