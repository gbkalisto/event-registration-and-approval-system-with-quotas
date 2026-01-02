<?php

namespace App\Models;

use CodeIgniter\Model;

class ApprovalBandModel extends Model
{
    protected $table = 'approval_bands';
    protected $allowedFields = ['event_id', 'band_order', 'role'];
}
