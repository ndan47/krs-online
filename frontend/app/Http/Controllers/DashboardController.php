<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        // // Retrieve token from session
        // $token = session('jwt_token');

        // if (!$token) {
        //     return response()->json(['message' => 'Token not found'], 401);
        // }

        // // Send GET request to CodeIgniter /api/profile
        // $response = Http::withToken($token)->get('http://localhost:8080/api/profile');

        // if ($response->successful()) {
        //     return $response->json();
        // } else {
        //     return response()->json([
        //         'message' => 'Failed to access profile',
        //         'errors' => $response->json()
        //     ], $response->status());
        // }

        $token = session('jwt_token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['login_failed' => 'Unauthorized. Please login again.']);
        }

        // Optional: Validate token via profile
        $profile = Http::withToken($token)->get('http://localhost:8080/api/profile');

        if (!$profile->successful()) {
            return redirect()->route('login')->withErrors(['login_failed' => 'Invalid token. Please login again.']);
        }

        $profileJson = $profile->json();
        $user = $profileJson['user'] ?? null;

        if (!$user){
            return redirect()->route('login')->withErrors(['login_failed' => 'user data not found.']);
        }

        $mahasiswa = Http::get('http://localhost:8080/api/mahasiswa');
        $prodi = Http::get('http://localhost:8080/api/prodi');
        // dd($prodi->json()['data_prodi']);
        $mahasiswa = count($mahasiswa->json()['data_mahasiswa']);
        $prodi = count($prodi->json()['data_prodi']);

        return view('index', compact('mahasiswa', 'prodi', 'user'));
    }

    // public function show()
    // {

    // }
}
