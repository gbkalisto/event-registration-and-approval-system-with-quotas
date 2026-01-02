<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }


    public function authenticate()
    {
        $email = $this->request->getPost('email');

        if (!$email) {
            return redirect()->back()->with('error', 'Email is required');
        }
        $user = new UserModel();

        $checkLogin = $user->where('email', $email)->first();

        if (!$checkLogin) {
            return redirect()->back()->with('error', 'User not found');
        }

        session()->set([
            'user_id'   => $checkLogin['id'],
            'name'      => $checkLogin['name'],
            'email'     => $checkLogin['email'],
            'role'      => $checkLogin['role'],
            'logged_in' => true
        ]);

        return redirect()->to('/dashboard');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
