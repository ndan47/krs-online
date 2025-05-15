<?php 

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AdminFilter extends AuthFilter
{
    public function before(RequestInterface $request, $arguments = null)
    {
        parent::before($request);
        if ($request->user->role !== 'admin') {
            return Services::response()->setStatusCode(403)->setJSON(['error' => 'Admins only']);
        }
    }
}


?>