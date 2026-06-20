@extends('layouts.perusahaan')

@section('title', 'Dashboard Perusahaan')

@section('content')
    <div style="margin-bottom: 32px;">
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Dashboard</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Selamat datang, <strong>{{ $perusahaan->name }}</strong></p>
    </div>

    <!-- Stats -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 32px;">
        <!-- Card 1 -->
        <div class="stat-card">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: white; border: 1.5px solid var(--color-ink); color: var(--color-ink); display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
            </div>
            <p class="stat-number" style="font-size: 32px;">{{ $totalLowongan }}</p>
            <p class="stat-label">Total Lowongan</p>
        </div>

        <!-- Card 2 -->
        <div class="stat-card">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: white; border: 1.5px solid var(--color-ink); color: var(--color-ink); display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </div>
            <p class="stat-number" style="font-size: 32px;">{{ $lowonganAktif }}</p>
            <p class="stat-label">Lowongan Aktif</p>
        </div>

        <!-- Card 3 -->
        <div class="stat-card">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: white; border: 1.5px solid var(--color-ink); color: var(--color-ink); display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <p class="stat-number" style="font-size: 32px;">{{ $totalPelamar }}</p>
            <p class="stat-label">Total Pelamar</p>
        </div>

        <!-- Card 4 -->
        <div class="stat-card">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: white; border: 1.5px solid var(--color-ink); color: var(--color-ink); display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
            </div>
            <p class="stat-number" style="font-size: 32px;">{{ $pelamarBaru }}</p>
            <p class="stat-label">Pelamar Baru</p>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
        <!-- Lowongan Terbaru -->
        <div class="card">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink);">Lowongan Saya</h2>
                <a href="/perusahaan/lowongan" class="btn-ghost" style="font-size: 12px;">Lihat Semua →</a>
            </div>
            @forelse($lowongans as $lowongan)
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px 0; border-bottom: 1px solid rgba(163,166,175,0.2);">
                    <div style="flex: 1; min-width: 0;">
                        <a href="/perusahaan/lowongan/{{ $lowongan->id }}/edit" style="font-size: 14px; font-weight: 500; color: var(--color-ink); text-decoration: none;">{{ $lowongan->title }}</a>
                        <p style="font-size: 12px; color: var(--color-graphite);">{{ $lowongan->lamarans_count }} pelamar · Deadline {{ $lowongan->deadline->format('d M') }}</p>
                    </div>
                    <span class="badge status-{{ $lowongan->status }}" style="font-size: 11px;">{{ ucfirst($lowongan->status) }}</span>
                </div>
            @empty
                <div style="text-align: center; padding: 24px;">
                    <p style="font-size: 14px; color: var(--color-graphite); margin-bottom: 12px;">Belum ada lowongan</p>
                    <a href="/perusahaan/lowongan/create" class="btn-primary" style="font-size: 13px; padding: 9px 20px;">Buat Lowongan</a>
                </div>
            @endforelse
        </div>

        <!-- Pelamar Terbaru -->
        <div class="card">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink);">Pelamar Terbaru</h2>
                <a href="/perusahaan/pelamar" class="btn-ghost" style="font-size: 12px;">Lihat Semua →</a>
            </div>
            @forelse($pelamarTerbaru as $lamaran)
                <div style="display: flex; align-items: center; gap: 12px; padding: 12px 0; border-bottom: 1px solid rgba(163,166,175,0.2);">
                    <div class="avatar-initials" style="width: 36px; height: 36px; font-size: 12px;">{{ strtoupper(substr($lamaran->mahasiswa->name, 0, 1)) }}</div>
                    <div style="flex: 1; min-width: 0;">
                        <p style="font-size: 14px; font-weight: 500; color: var(--color-ink);">{{ $lamaran->mahasiswa->name }}</p>
                        <p style="font-size: 12px; color: var(--color-graphite);">{{ $lamaran->lowongan->title }}</p>
                    </div>
                    <span class="badge status-{{ $lamaran->status }}" style="font-size: 11px;">{{ $lamaran->status_label }}</span>
                </div>
            @empty
                <p style="font-size: 14px; color: var(--color-graphite); text-align: center; padding: 24px;">Belum ada pelamar.</p>
            @endforelse
        </div>
    </div>
@endsection
