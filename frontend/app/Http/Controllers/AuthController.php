<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function register(Request $request){
        $response = Http::post('http://localhost:8080/api/register', [
            'npm' => $request->npm,
            'password' => $request->password,
        ]);

        if ($response->successful()){
            return redirect()->route('login')->with('success', 'Registrasi Berhasil. Silahkan Login');
        }else{
            return back()->withErrors(['error' => 'Registrasi Gagal']);
        }
    }

    public function login(Request $request)
{
    // Send POST request to CodeIgniter /api/login
    $response = Http::post('http://localhost:8080/api/login', [
        'npm' => $request->npm,
        'password' => $request->password
    ]);

    // Handle response
    if ($response->successful()) {
        $data = $response->json();
        
        // Save token for future use (like in session or as a cookie)
        session([
            'jwt_token' => $data['token'],
            'user' => $data['user']
        ]);

        // Redirect to dashboard after successful login
        return redirect()->route('dashboard.index');
    } else {
        // In case of failure, show an error message and redirect back to login page
        return redirect()->route('login')->withErrors(['login_failed' => 'Login failed. Please check your credentials and try again.']);
    }
}

public function logout(Request $request)
{
    // Clear the token
    session()->forget('jwt_token');

    // Optional: clear semua session
    session()->flush();

    return redirect()->route('login')->with('message', 'Logout successful');
}


}