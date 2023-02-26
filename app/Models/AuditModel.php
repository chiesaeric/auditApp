<?php

namespace App\Models;

use CodeIgniter\Model;

class AuditModel extends Model
{
    protected $table = 'tbl_audit';
    protected $primaryKey = 'id_audit';
    protected $useTimestamps = true;
    protected $allowedFields = ['task_name', 'id_reporter', 'id_assigne', 'id_category', 'status', 'deadline'];
}
