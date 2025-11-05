<?php

namespace App\Http\Controller\Auth;

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
            return response()->json([
                'message'=> 'Admin login successful',
                'admin' => [
                    'id'=> $admin->id,
                    'nama'=> $admin->nama,
                    'email' => $admin->email,
                ]
            ]);
    }

    public function Logout(Request $request){
        Auth::guard('admin')->Logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message' => 'Admin logout successful']);
    }

    public function profile(Request $request){
        return response()->json([
            'admin' => Auth::guard('admin')->user()
        ]);
    }


}
