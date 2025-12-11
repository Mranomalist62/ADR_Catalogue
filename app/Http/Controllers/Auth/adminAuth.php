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
                return redirect()->back()->withErrors('Login failed! Please check your credentials.');
            }

            Auth::guard('admin')->login($admin);

            return redirect()->intended(route('admin'))
            ->with('success', 'Login berhasil! Selamat datang.');
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
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
