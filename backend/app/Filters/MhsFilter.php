<?php 

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// app/Filters/StudentFilter.php
class MhsFilter extends AuthFilter
{
    public function before(RequestInterface $request, $arguments = null)
    {
        parent::before($request);
        if ($request->user->role !== 'student') {
            return Services::response()->setStatusCode(403)->setJSON(['error' => 'Students only']);
        }
    }
}



?>