<?php

namespace App\Http\Controllers\Auth\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegister()
    {
        if (Auth::guard('perusahaan')->check()) {
            return redirect()->route('perusahaan.dashboard');
        }
        return view('auth.perusahaan.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'unique:perusahaans,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $perusahaan = Perusahaan::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'status_verification' => 'unverified',
        ]);

        Auth::guard('perusahaan')->login($perusahaan);
        return redirect()->route('perusahaan.dashboard')->with('success', 'Akun perusahaan berhasil dibuat. Silakan lengkapi profil Anda.');
    }
}
