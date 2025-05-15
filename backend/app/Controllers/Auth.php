<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use Config\Database;

class Auth extends ResourceController
{
    use ResponseTrait;

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->db = Database::connect();
    }

    public function register() {
        $rules = $this->validate([
            'npm' => 'required',
            'password' => 'required',
        ]);
    
        if (!$rules) {
            return $this->failValidationErrors($this->validator->getErrors());
        }
    
        $npm = $this->request->getVar('npm');
        $password = $this->request->getVar('password');
    
        // Cek apakah user sudah terdaftar
        $cekUser = $this->db->query("SELECT * FROM users WHERE npm = ?", [$npm])->getRow();
        if ($cekUser) {
            return $this->fail("NPM sudah digunakan untuk akun user.");
        }
    
        // Ambil data mahasiswa berdasarkan NPM
        $mahasiswa = $this->db->query("SELECT nama_mahasiswa FROM mahasiswa WHERE NPM = ?", [$npm])->getRow();
    
        if (!$mahasiswa) {
            return $this->failNotFound("Data mahasiswa dengan NPM tersebut tidak ditemukan.");
        }
    
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Insert ke tabel users, ambil nama dari mahasiswa
        $this->db->query("
            INSERT INTO users (npm, password, name, created_at)
            VALUES (?, ?, ?, NOW())
        ", [$npm, $hashedPassword, $mahasiswa->nama_mahasiswa]);
    
        return $this->respondCreated([
            'message' => 'User berhasil didaftarkan',
            'user' => [
                'npm' => $npm,
                'name' => $mahasiswa->nama_mahasiswa
            ]
        ]);
    }
    
    

    public function login()
    {
        $npm = $this->request->getVar('npm');
        $password = $this->request->getVar('password');

        if (!$npm || !$password) {
            return $this->fail('NPM dan password wajib diisi.', 400);
        }

        $user = $this->userModel->where('npm', $npm)->first();

        if (!$user) {
            return $this->failNotFound('NPM tidak ditemukan.');
        }

        if (!password_verify($password, $user['password'])) {
            return $this->fail('Password salah.', 401);
        }

        // JWT setup
        $key = getenv('JWT_SECRET');
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600; // 1 jam
        $payload = [
            'iat'  => $issuedAt,
            'exp'  => $expirationTime,
            'uid'  => $user['id'],
            'npm'  => $user['npm'],
            'name' => $user['name'],
            'role' => $user['role']
        ];

        $jwt = createJWT($payload);

        session()->set('userData', $payload);

        return $this->respond([
            'status' => true,
            'message' => 'Login berhasil.',
            'user' => [
                'name' => $user['name'],
                'role' => $user['role']
            ],
            'token' => $jwt
        ]);
    }
}