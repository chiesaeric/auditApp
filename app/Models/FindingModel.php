<?php

namespace App\Models;

use CodeIgniter\Model;

class FindingModel extends Model
{
    protected $table = 'tbl_finding';
    protected $primaryKey = 'id_finding';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_detail_audit', 'status_finding', 'category_finding', 'cause', 'short_term', 'long_term', 'revised'];
}
