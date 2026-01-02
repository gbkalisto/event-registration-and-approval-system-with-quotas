<?php

namespace App\Models;

use CodeIgniter\Model;

class QuotaModel extends Model
{
    protected $table = 'quotas';
    protected $allowedFields = ['event_id', 'role', 'max_participants'];
}
