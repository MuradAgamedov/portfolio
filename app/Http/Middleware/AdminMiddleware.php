<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        // Əlavə admin yoxlaması üçün (əgər admin rol sistemi varsa)
        // if (Auth::user()->role !== 'admin') {
        //     return redirect()->route('admin.login');
        // }

        return $next($request);
    }
} 