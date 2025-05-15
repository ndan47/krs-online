<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Profile extends ResourceController
{
    public function index()
{
    $userData = session()->get('userData');

    $request = service('request');
    $userData = isset($request->userData) ? $request->userData : [];

    return $this->respond([
        'message' => 'Profil user berhasil diambil',
        'user' => $userData
    ]);
}

}