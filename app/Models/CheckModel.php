<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckModel extends Model
{
    protected $table = 'tbl_cp';
    protected $primaryKey = 'id_cp';
    protected $useTimestamps = true;
    protected $allowedFields = ['title_cp', 'clausal', 'evidence', 'id_area', 'tipe', 'description'];
}
