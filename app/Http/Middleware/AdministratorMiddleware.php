<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministratorMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->level === 'Administrator') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
