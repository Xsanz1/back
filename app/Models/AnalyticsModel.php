<?php

namespace App\Models;

use CodeIgniter\Model;

class AnalyticsModel extends Model
{
    protected $table = 'analytics'; // Ganti 'nama_tabel' dengan nama tabel sesuai dengan struktur database Anda
    protected $primaryKey = 'id_analytics'; // Ganti 'id' dengan primary key tabel
    protected $allowedFields = ['saldo_awal', 'pemasukan', 'pengeluaran'];
}