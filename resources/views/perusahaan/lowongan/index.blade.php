@extends('layouts.perusahaan')

@section('title', 'Lowongan Saya')

@section('content')
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px;">
        <div>
            <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 4px;">Lowongan Saya</h1>
            <p style="font-size: 14px; color: var(--color-graphite);">Kelola semua lowongan magang yang kamu pasang.</p>
        </div>
        @if(auth('perusahaan')->user()->isVerified())
            <a href="/perusahaan/lowongan/create" class="btn-primary">+ Buat Lowongan</a>
        @endif
    </div>

    @forelse($lowongans as $lowongan)
        <div class="applicant-row" style="margin-bottom: 12px; flex-wrap: wrap; gap: 12px;">
            <div style="flex: 1; min-width: 0;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
                    <a href="/lowongan/{{ $lowongan->id }}" style="font-size: 15px; font-weight: 600; color: var(--color-ink); text-decoration: none;">{{ $lowongan->title }}</a>
                    <span class="badge status-{{ $lowongan->status }}" style="font-size: 11px;">{{ ucfirst($lowongan->status) }}</span>
                </div>
                <p style="font-size: 12px; color: var(--color-graphite);">{{ $lowongan->lamarans_count }} pelamar · Deadline {{ $lowongan->deadline->format('d M Y') }} · {{ $lowongan->work_system_label }} · {{ $lowongan->payment_type_label }}</p>
            </div>
            <div style="display: flex; gap: 8px;">
                <a href="/perusahaan/pelamar?lowongan_id={{ $lowongan->id }}" class="btn-ghost" style="font-size: 13px;">👥 {{ $lowongan->lamarans_count }}</a>
                <a href="/perusahaan/lowongan/{{ $lowongan->id }}/edit" class="btn-outline" style="font-size: 13px; padding: 7px 16px;">Edit</a>
                <form method="POST" action="/perusahaan/lowongan/{{ $lowongan->id }}" onsubmit="return confirm('Hapus lowongan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger" style="font-size: 13px; padding: 8px 14px;">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-state-card">
                <h3>Belum ada lowongan</h3>
                <p>Mulai rekrut peserta magang terbaik dengan membuat lowongan pertamamu.</p>
                @if(auth('perusahaan')->user()->isVerified())
                    <a href="/perusahaan/lowongan/create" class="btn-primary" style="margin-top: 20px;">Buat Lowongan Pertama</a>
                @else
                    <p style="font-size: 12px; color: #854d0e; background: #fef9c3; padding: 10px 14px; border-radius: 10px; margin-top: 16px;">Akun belum diverifikasi. Lengkapi profil dan tunggu verifikasi admin.</p>
                @endif
            </div>
        </div>
    @endforelse

    <div style="margin-top: 24px;">{{ $lowongans->links() }}</div>
@endsection
