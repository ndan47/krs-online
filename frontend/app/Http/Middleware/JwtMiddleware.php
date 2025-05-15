<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role = null)
{
    if (!session()->has('jwt_token') || !session()->has('user')) {
        return redirect()->route('login')->withErrors(['Unauthorized' => 'Silakan login dulu']);
    }

    if ($role && session('user.role') !== $role) {
        // abort(403, 'Akses ditolak: tidak memiliki peran yang sesuai');
        return redirect()->route('dashboard.index')->withErrors(['Unauthorized' => '']);
    }

    return $next($request);
}

}