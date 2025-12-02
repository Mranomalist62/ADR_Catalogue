<?php
// app/Http/Middleware/AdminAuth.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class adminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            // For web requests, redirect to admin login page
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthorized. Admin access required.',
                    'error' => 'admin_authentication_required'
                ], 401);
            }
            
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
