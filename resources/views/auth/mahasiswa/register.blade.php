@extends('layouts.auth')

@section('title', 'Daftar Mahasiswa')
@section('auth-subtitle', 'Buat akun mahasiswamu secara gratis')

@section('content')
    <h2 style="font-family: var(--font-serif); font-size: 22px; font-weight: 500; color: var(--color-ink); margin-bottom: 24px; text-align: center;">Bergabung dengan MaganTara</h2>

    <form method="POST" action="/mahasiswa/register">
        @csrf
        <div style="margin-bottom: 16px;">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-input" value="{{ old('name') }}" placeholder="Nama lengkapmu" required autofocus>
            @error('name')<p class="form-error">{{ $message }}</p>@enderror
        </div>
        <div style="margin-bottom: 16px;">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="nama@email.com" required>
            @error('email')<p class="form-error">{{ $message }}</p>@enderror
        </div>
        <div style="margin-bottom: 16px;">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-input" placeholder="Minimal 8 karakter" required>
            @error('password')<p class="form-error">{{ $message }}</p>@enderror
        </div>
        <div style="margin-bottom: 24px;">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-input" placeholder="Ulangi password" required>
        </div>
        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Buat Akun</button>
        <p style="font-size: 11px; color: var(--color-graphite); text-align: center; margin-top: 14px; line-height: 1.6;">Dengan mendaftar, kamu setuju dengan <a href="#" style="color: var(--color-ash);">Syarat & Ketentuan</a> dan <a href="#" style="color: var(--color-ash);">Kebijakan Privasi</a> MaganTara.</p>
    </form>
@endsection

@section('auth-links')
    <p style="font-size: 13px; color: var(--color-graphite);">Sudah punya akun? <a href="/mahasiswa/login" style="color: var(--color-ink); font-weight: 600;">Masuk</a></p>
    <p style="font-size: 12px; color: var(--color-dove); margin-top: 12px;">Daftar sebagai <a href="/perusahaan/register" style="color: var(--color-ash);">Perusahaan</a></p>
@endsection
