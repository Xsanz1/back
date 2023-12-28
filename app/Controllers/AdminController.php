<?php

namespace App\Controllers\Api;

use App\Models\AdminModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    use ResponseTrait;

    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function adminLogin()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Langsung login tanpa validasi
        // Catatan: Ini bukan praktik keamanan yang baik
        // Harap periksa dan pertimbangkan implikasi keamanan lebih lanjut

        return $this->respond(['status' => 'success', 'message' => 'Login successful']);
    }
}
