<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;


class userAuth extends Controller
{

    public function login(Request $request)
{
    $request->validate([
        'nomor_handphone' => 'required|string',  // Changed from email
        'password' => 'required|string',
    ]);

    // Find user by phone number through their profile
    $user = User::whereHas('profile', function($query) use ($request) {
        $query->where('nomor_handphone', $request->nomor_handphone);
    })->first();

    // Alternative: If phone number is stored in user table directly
    // $user = User::where('nomor_handphone', $request->nomor_handphone)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return redirect()->route('login')
            ->withErrors(['nomor_handphone' => 'Nomor handphone atau password salah.'])
            ->withInput($request->only('nomor_handphone'));
    }

    Auth::guard('user')->login($user);

    return redirect()->intended(route('home'))
        ->with('success', 'Login berhasil! Selamat datang.');
}

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user',
            'password' => 'required|confirmed|min:8',
            'nomor_handphone' => 'nullable|string|max:20',
        ]);

        // Create user profile first if you want to store phone number
        $profile = UserProfile::create([
            'nomor_handphone' => $request->nomor_handphone,
            'path_thumbnail' => null, // placeholder
        ]);

        // Create user
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_profile' => $profile->id,
        ]);

        // Auto-login after registration
        Auth::guard('user')->login($user);

        // Redirect to home page
        return redirect()->route('home')
            ->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    public function logout(Request $request){
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'User logged out successfully',
        ]);
    }

    public function profile(Request $request){
        return response()->json([
           'user' => Auth::guard('user')->user()
        ]);
    }
}
