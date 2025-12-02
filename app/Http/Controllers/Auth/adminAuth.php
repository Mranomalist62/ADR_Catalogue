<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class adminAuth extends Controller
{
    public function login(Request $request){
        $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $admin = Admin::where('email', $request->email)->first();

            if (!$admin || !Hash::check($request->password, $admin->password)){
                throw ValidationException::withMessages([
                    'email' => ['the provided credentials are incorrect']
                ]);
            }

            Auth::guard('admin')->login($admin);
            
            // Check if request wants JSON response (for AJAX)
            if ($request->expectsJson()) {
                return response()->json([
                    'message'=> 'Admin login successful',
                    'admin' => [
                        'id'=> $admin->id,
                        'nama'=> $admin->nama,
                        'email' => $admin->email,
                    ]
                ]);
            }
            
            // For form submission, redirect to admin dashboard
            return redirect()->route('admin')->with('success', 'Login berhasil! Selamat datang admin.');
    }

    public function Logout(Request $request){
        Auth::guard('admin')->Logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Admin logout successful');
    }

    public function profile(Request $request){
        return response()->json([
            'admin' => Auth::guard('admin')->user()
        ]);
    }


}
