<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            // Store the intended URL only if it's a GET request and not already a redirect
            if ($request->isMethod('get') && !$request->expectsJson()) {
                // Store only the basic route without parameters to avoid missing parameter errors
                session(['url.intended' => route('admin.dashboard')]);
            }
            
            return redirect()->route('admin.login');
        }
        
        // Here you can add additional checks if needed
        // For example, check if the user has an admin role
        
        return $next($request);
    }
} 