@extends('layouts.perusahaan')

@section('title', 'Daftar Pelamar')

@section('content')
    <div style="margin-bottom: 28px;">
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Daftar Pelamar</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Kelola dan seleksi kandidat magang terbaik.</p>
    </div>

    <!-- Filter -->
    <form action="/perusahaan/pelamar" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 24px;">
        <select name="lowongan_id" onchange="this.form.submit()" class="form-select" style="width: auto; min-width: 200px; border-radius: 9999px; padding: 9px 40px 9px 16px;">
            <option value="">Semua Lowongan</option>
            @foreach($lowongans as $low)
                <option value="{{ $low->id }}" {{ request('lowongan_id') == $low->id ? 'selected' : '' }}>{{ $low->title }}</option>
            @endforeach
        </select>
        <select name="status" onchange="this.form.submit()" class="form-select" style="width: auto; min-width: 150px; border-radius: 9999px; padding: 9px 40px 9px 16px;">
            <option value="">Semua Status</option>
            @foreach(['dikirim', 'dilihat', 'seleksi', 'interview', 'diterima', 'ditolak', 'dibatalkan'] as $s)
                <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </form>

    @forelse($lamarans as $lamaran)
        <div class="applicant-row" style="margin-bottom: 12px;">
            <div class="avatar-initials">{{ strtoupper(substr($lamaran->mahasiswa->name, 0, 1)) }}</div>
            <div style="flex: 1; min-width: 0;">
                <p style="font-size: 14px; font-weight: 600; color: var(--color-ink);">{{ $lamaran->mahasiswa->name }}</p>
                <p style="font-size: 12px; color: var(--color-graphite);">{{ $lamaran->lowongan->title }} · {{ $lamaran->created_at->diffForHumans() }}</p>
                @php
                    $matchPct = $lamaran->mahasiswa->skillMatchPercentage($lamaran->lowongan);
                @endphp
                @if($matchPct > 0)
                    <span class="badge {{ $matchPct >= 80 ? 'badge-skill-match-high' : ($matchPct >= 50 ? 'badge-skill-match-mid' : 'badge-skill-match-low') }}" style="font-size: 11px; margin-top: 4px;">⚡ {{ $matchPct }}% Match</span>
                @endif
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <span class="badge status-{{ $lamaran->status }}" style="font-size: 12px;">{{ $lamaran->status_label }}</span>
                <a href="/perusahaan/pelamar/{{ $lamaran->id }}" class="btn-outline" style="font-size: 13px; padding: 7px 16px;">Lihat Detail</a>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-state-card">
                <h3>Belum ada pelamar</h3>
                <p>Belum ada mahasiswa yang melamar lowonganmu.</p>
            </div>
        </div>
    @endforelse

    <div style="margin-top: 24px;">{{ $lamarans->links() }}</div>
@endsection
