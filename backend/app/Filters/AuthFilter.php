<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
{
    $authHeader = $request->getHeaderLine('Authorization');

    if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        return Services::response()
            ->setJSON(['message' => 'Token tidak ditemukan.'])
            ->setStatusCode(401);
    }

    $token = $matches[1];

    try {
        $key = getenv('JWT_SECRET');
        $decoded = JWT::decode($token, new Key($key, 'HS256'));

        // Inject user data into request (so controller can access it)
        $request->userData = (array) $decoded;

        return;
    } catch (\Exception $e) {
        return Services::response()
            ->setJSON(['message' => 'Token tidak valid: ' . $e->getMessage()])
            ->setStatusCode(401);
    }
}


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after
    }
}