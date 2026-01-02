<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    // common dashboard funvtion to redirect based on role
    public function index()
    {
        $role = session()->get('role');
        return match ($role) {
            'admin'     => redirect()->to('/admin/dashboard'),
            'manager',
            'director'  => redirect()->to('/approver/dashboard'),
            default     => redirect()->to('/user/events'),
        };
    }
}
