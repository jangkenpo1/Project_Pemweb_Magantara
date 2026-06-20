@extends('layouts.auth')

@section('title', 'Daftar Perusahaan')
@section('auth-subtitle', 'Mulai rekrut peserta magang terbaik')

@section('content')
    <h2 style="font-family: var(--font-serif); font-size: 22px; font-weight: 500; color: var(--color-ink); margin-bottom: 24px; text-align: center;">Daftarkan Perusahaan Anda</h2>

    <form method="POST" action="/perusahaan/register">
        @csrf
        <div style="margin-bottom: 16px;">
            <label class="form-label">Nama Perusahaan</label>
            <input type="text" name="name" class="form-input" value="{{ old('name') }}" placeholder="PT Contoh Indonesia" required autofocus>
            @error('name')<p class="form-error">{{ $message }}</p>@enderror
        </div>
        <div style="margin-bottom: 16px;">
            <label class="form-label">Email Perusahaan</label>
            <input type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="hr@perusahaan.com" required>
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
        <div style="background: var(--color-sky-wash); border-radius: 12px; padding: 12px 16px; font-size: 13px; color: #1d4ed8; margin-bottom: 20px;">
            ℹ️ Setelah mendaftar, akun akan diverifikasi oleh tim MaganTara sebelum dapat memposting lowongan.
        </div>
        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Daftar Sekarang</button>
    </form>
@endsection

@section('auth-links')
    <p style="font-size: 13px; color: var(--color-graphite);">Sudah terdaftar? <a href="/perusahaan/login" style="color: var(--color-ink); font-weight: 600;">Masuk</a></p>
@endsection
