<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin'; // Sesuaikan dengan nama tabel di database Anda
    protected $primaryKey = 'id'; // Sesuaikan dengan primary key di tabel Anda

    protected $allowedFields = ['email', 'password']; // Sesuaikan dengan kolom yang dapat diisi

    protected $useTimestamps = true; // Aktifkan timestamp (created_at dan updated_at)

    protected $returnType = 'array'; // Tipe data yang dihasilkan oleh model

    // Metode atau fungsi lain sesuai kebutuhan

    /**
     * Cek apakah email sudah terdaftar
     *
     * @param string $email
     * @return bool
     */
    public function isEmailRegistered($email)
    {
        return $this->where('email', $email)->countAllResults() > 0;
    }

    /**
     * Ambil data admin berdasarkan email
     *
     * @param string $email
     * @return array|null
     */
    public function getAdminByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
