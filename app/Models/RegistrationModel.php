<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrationModel extends Model
{
    protected $table = 'registrations';
    protected $allowedFields = [
        'event_id',
        'user_id',
        'status'
    ];
}
