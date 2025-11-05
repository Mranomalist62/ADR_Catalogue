<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;


class userAuth extends Controller
{

    public function register(Request $request){
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        //todo, after image system completed, add default image.
        $profile = UserProfile::create([
            'nomor_handphone' => $request->nomor_handphone ?? null,
            'path_thumbnail' => null
        ]);

        //create user
        $user = User::create(([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_profile' => $profile->id,
        ]));

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        Auth::guard('user')->login($user);

        return response()->json([
            'message' => 'User login successful',
            'user' => ['id'=> $user->id,
            'nama'=> $user->nama,
            'email' => $user->email,
            ]
        ]);
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
