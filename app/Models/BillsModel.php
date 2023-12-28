<?php

namespace App\Models;

use CodeIgniter\Model;

class BillsModel extends Model
{
    protected $table = 'bills';
    protected $primaryKey = 'id';
    protected $returnType = BillsModel::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'nama',
        'nominal',
    ];
}