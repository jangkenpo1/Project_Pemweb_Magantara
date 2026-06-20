@extends('layouts.auth')

@section('title', 'Admin Login')
@section('auth-subtitle', 'Akses terbatas untuk administrator')

@section('content')
    <div style="text-align: center; margin-bottom: 20px;">
        <div style="width: 48px; height: 48px; background: var(--color-ink); border-radius: 14px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h2 style="font-family: var(--font-serif); font-size: 20px; font-weight: 500; color: var(--color-ink); margin-bottom: 4px;">Admin Panel</h2>
        <p style="font-size: 13px; color: var(--color-graphite);">MaganTara Administration</p>
    </div>

    <form method="POST" action="/admin/login">
        @csrf
        <div style="margin-bottom: 16px;">
            <label class="form-label">Email Admin</label>
            <input type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="admin@magantara.id" required autofocus>
            @error('email')<p class="form-error">{{ $message }}</p>@enderror
        </div>
        <div style="margin-bottom: 24px;">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-input" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Masuk ke Panel Admin</button>
    </form>
@endsection

@section('auth-links')
    <a href="/" style="font-size: 13px; color: var(--color-graphite);">← Kembali ke MaganTara</a>
@endsection
