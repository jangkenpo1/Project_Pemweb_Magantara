<?php

namespace App\Http\Controllers\Auth\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegister()
    {
        if (Auth::guard('mahasiswa')->check()) {
            return redirect()->route('mahasiswa.dashboard');
        }
        return view('auth.mahasiswa.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:100'],
            'email'                 => ['required', 'email', 'unique:mahasiswas,email'],
            'password'              => ['required', 'min:8', 'confirmed'],
        ]);

        $mahasiswa = Mahasiswa::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::guard('mahasiswa')->login($mahasiswa);
        return redirect()->route('mahasiswa.dashboard')->with('success', 'Selamat datang di MaganTara!');
    }
}
