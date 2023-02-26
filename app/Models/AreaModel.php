<?php

namespace App\Models;

use CodeIgniter\Model;

class AreaModel extends Model
{
    protected $table = 'tbl_area';
    protected $primaryKey = 'id_area';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_area', 'id_category'];
}
