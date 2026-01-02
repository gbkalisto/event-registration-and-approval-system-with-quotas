<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $role = session()->get('role');

        if (!in_array($role, $arguments)) {
            // return redirect()->back();
            return redirect()->to('/dashboard')
                ->with('error', 'Unauthorized access');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
