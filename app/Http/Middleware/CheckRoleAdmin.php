<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Cek apakah user sudah login DAN punya role_id == 1
        if (auth()->check() && auth()->user()->role_id == 1) {
            return $next($request);
        }

        // Jika bukan role 1, lempar ke halaman 403 atau redirect
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
