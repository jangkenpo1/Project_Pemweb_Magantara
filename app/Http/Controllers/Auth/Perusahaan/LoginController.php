<?php

namespace App\Http\Controllers\Auth\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('perusahaan')->check()) {
            return redirect()->route('perusahaan.dashboard');
        }
        return view('auth.perusahaan.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('perusahaan')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('perusahaan.dashboard'));
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('perusahaan')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('perusahaan.login')->with('success', 'Anda berhasil keluar.');
    }
}
