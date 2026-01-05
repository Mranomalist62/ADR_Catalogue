<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class userAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('user')->check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'Unauthorized. Please login as user.',
                    'error' => 'user_authentication_required'
                ], 401);
            }
            
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman ini.');
        }
        
        return $next($request);
    }
}
