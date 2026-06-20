@extends('layouts.auth')

@section('title', 'Masuk Perusahaan')
@section('auth-subtitle', 'Portal rekrutmen perusahaan')

@section('content')
    <h2 style="font-family: var(--font-serif); font-size: 22px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px; text-align: center;">Masuk sebagai Perusahaan</h2>
    <p style="font-size: 13px; color: var(--color-graphite); text-align: center; margin-bottom: 24px;">Kelola lowongan dan seleksi pelamar terbaik</p>

    <form method="POST" action="/perusahaan/login">
        @csrf
        <div style="margin-bottom: 16px;">
            <label class="form-label">Email Perusahaan</label>
            <input type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="email@perusahaan.com" required autofocus>
            @error('email')<p class="form-error">{{ $message }}</p>@enderror
        </div>
        <div style="margin-bottom: 24px;">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-input" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Masuk</button>
    </form>
@endsection

@section('auth-links')
    <p style="font-size: 13px; color: var(--color-graphite);">Belum terdaftar? <a href="/perusahaan/register" style="color: var(--color-ink); font-weight: 600;">Daftar perusahaan</a></p>
    <p style="font-size: 12px; color: var(--color-dove); margin-top: 12px;">Masuk sebagai <a href="/mahasiswa/login" style="color: var(--color-ash);">Mahasiswa</a></p>
@endsection
