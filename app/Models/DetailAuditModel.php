<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailAuditModel extends Model
{
    protected $table = 'tbl_detail_audit';
    protected $primaryKey = 'id_detail_audit';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_audit', 'id_cp', 'status', 'file_path', 'desc_audit', 'nama_audity'];
}
