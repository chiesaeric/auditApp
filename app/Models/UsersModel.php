<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'tbl_users';
    protected $primaryKey = 'id_users';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'slug', 'username', 'password', 'tipe', 'status'];
}
