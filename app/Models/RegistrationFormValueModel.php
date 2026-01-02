<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrationFormValueModel extends Model
{
    protected $table = 'registration_form_values';

    protected $allowedFields = [
        'registration_id',
        'field_name',
        'field_value'
    ];

    public $timestamps = false;
}
