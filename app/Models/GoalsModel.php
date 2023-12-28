<?php

namespace App\Models;

use CodeIgniter\Model;

class GoalsModel extends Model
{
    protected $table = 'goals';
    protected $primaryKey = 'id_goals';
    protected $returnType = GoalsModel::class;
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'nama_goals',
        'tujuan_goals',
        'tanggal_goals',
        'jumlah_goals',
        'status_goals', 
    ];
}