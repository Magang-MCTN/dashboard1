<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminTimRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->level === 'Admin Tim') {
            // Admin tim sudah login, lanjutkan ke tujuan yang diinginkan
            return $next($request);
        }

        // Admin tim belum login, arahkan ke halaman login
        return redirect()->route('login');
    }
}
