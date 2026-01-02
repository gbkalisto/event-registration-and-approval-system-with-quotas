<?php

namespace App\Models;

use CodeIgniter\Model;

class FormNodeModel extends Model
{
    protected $table = 'form_nodes';
    protected $allowedFields = [
        'event_id',
        'label',
        'field_name',
        'field_type',
        'field_options',
        'required'
    ];
}
