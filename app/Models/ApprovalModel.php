<?php

namespace App\Models;

use CodeIgniter\Model;

class ApprovalModel extends Model
{
    protected $table = 'approvals';

    protected $allowedFields = [
        'registration_id',
        'approved_by',
        'band_id',
        'decision',
        'remarks',
        'approved_at'
    ];
}
