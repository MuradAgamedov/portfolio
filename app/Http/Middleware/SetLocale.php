<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Set locale from session if exists
        if (session()->has('locale')) {
            app()->setLocale(session('locale'));
        } else {
            // Set default locale from config
            app()->setLocale(config('app.locale'));
        }

        return $next($request);
    }
} 