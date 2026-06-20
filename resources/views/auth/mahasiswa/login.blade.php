@extends('layouts.auth')

@section('title', 'Masuk Mahasiswa')
@section('auth-subtitle', 'Masuk ke akun mahasiswamu')

@section('content')
    <h2 style="font-family: var(--font-serif); font-size: 22px; font-weight: 500; color: var(--color-ink); margin-bottom: 24px; text-align: center;">Selamat Datang Kembali</h2>

    <form method="POST" action="/mahasiswa/login">
        @csrf
        <div style="margin-bottom: 16px;">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
            @error('email')<p class="form-error">{{ $message }}</p>@enderror
        </div>
        <div style="margin-bottom: 24px;">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-input" placeholder="••••••••" required>
            @error('password')<p class="form-error">{{ $message }}</p>@enderror
        </div>
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--color-ash); cursor: pointer;">
                <input type="checkbox" name="remember" style="accent-color: var(--color-ink);"> Ingat saya
            </label>
        </div>
        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Masuk</button>
    </form>
@endsection

@section('auth-links')
    <p style="font-size: 13px; color: var(--color-graphite);">Belum punya akun? <a href="/mahasiswa/register" style="color: var(--color-ink); font-weight: 600;">Daftar sekarang</a></p>
    <p style="font-size: 12px; color: var(--color-dove); margin-top: 12px;">Daftar sebagai <a href="/perusahaan/login" style="color: var(--color-ash);">Perusahaan</a></p>
@endsection
