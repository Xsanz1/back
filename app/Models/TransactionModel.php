<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $returnType = TransactionModel::class;
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id_transaksi',
        'nama_transaksi',
        'tanggal_transaksi',
        'jumlah_transaksi',
        'struk'
    ];
}