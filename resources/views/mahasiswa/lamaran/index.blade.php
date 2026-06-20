@extends('layouts.app')

@section('title', 'Lamaran Saya')

@section('content')
<div class="page-container" style="padding-top: 40px; padding-bottom: 60px;">
    <div style="margin-bottom: 32px;">
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Lamaran Saya</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Pantau status seluruh lamaranmu di sini.</p>
    </div>

    @forelse($lamarans as $lamaran)
        <div class="applicant-row card-hover" style="margin-bottom: 12px; border: 1px solid rgba(163,166,175,0.15); display: flex; flex-direction: column; align-items: stretch; padding: 16px;">
            <div style="display: flex; align-items: center; width: 100%;">
                <div class="company-logo" style="display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 15px; color: var(--color-ink); width: 48px; height: 48px; margin-right: 16px; overflow: hidden; border-radius: 8px;">
                    @if($lamaran->lowongan->perusahaan->logo)
                        <img src="{{ Storage::url($lamaran->lowongan->perusahaan->logo) }}" alt="{{ $lamaran->lowongan->perusahaan->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        {{ strtoupper(substr($lamaran->lowongan->perusahaan->name, 0, 1)) }}
                    @endif
                </div>
                <div style="flex: 1; min-width: 0;">
                    <a href="/lowongan/{{ $lamaran->lowongan_id }}" style="font-size: 15px; font-weight: 600; color: var(--color-ink); text-decoration: none;">{{ $lamaran->lowongan->title }}</a>
                    <p style="font-size: 13px; color: var(--color-graphite);">{{ $lamaran->lowongan->perusahaan->name }}</p>
                    <p style="font-size: 12px; color: var(--color-dove); margin-top: 2px;">Dikirim {{ $lamaran->created_at->diffForHumans() }}</p>
                </div>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span class="badge {{ 'status-' . $lamaran->status }}" style="font-size: 12px;">{{ $lamaran->status_label }}</span>
                    @if($lamaran->status === 'dikirim')
                        <form method="POST" action="/mahasiswa/lamaran/{{ $lamaran->id }}/cancel" onsubmit="return confirm('Batalkan lamaran ini?')">
                            @csrf
                            <button type="submit" class="btn-ghost" style="font-size: 12px; color: #dc2626;">Batalkan</button>
                        </form>
                    @endif
                </div>
            </div>

            @if($lamaran->status === 'interview')
                <div style="margin-top: 16px; padding: 16px; background: var(--color-fog); border-radius: 8px; border: 1px solid var(--color-dove);">
                    <h4 style="font-size: 13px; font-weight: 600; color: var(--color-ink); margin-bottom: 8px;">Detail Jadwal Interview</h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div>
                            <p style="font-size: 12px; color: var(--color-graphite); margin-bottom: 4px;">Waktu</p>
                            <p style="font-size: 14px; font-weight: 500; color: var(--color-ink);">{{ $lamaran->interview_date ? $lamaran->interview_date->format('d M Y, H:i') : '-' }} WIB</p>
                        </div>
                        <div>
                            <p style="font-size: 12px; color: var(--color-graphite); margin-bottom: 4px;">Tautan / Lokasi</p>
                            @if($lamaran->interview_url)
                                <a href="{{ $lamaran->interview_url }}" target="_blank" style="font-size: 14px; font-weight: 500; color: var(--color-sky); text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                    Buka Ruang Meeting
                                </a>
                            @else
                                <p style="font-size: 14px; color: var(--color-ink);">-</p>
                            @endif
                        </div>
                    </div>
                    @if($lamaran->recruiter_notes)
                        <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid var(--color-dove);">
                            <p style="font-size: 12px; color: var(--color-graphite); margin-bottom: 4px;">Catatan Rekruter:</p>
                            <p style="font-size: 13px; color: var(--color-ink);">{{ $lamaran->recruiter_notes }}</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-state-card">
                <h3>Belum ada lamaran</h3>
                <p>Mulai lamar lowongan magang yang sesuai dengan minat dan skillmu.</p>
                <a href="/lowongan" class="btn-primary" style="margin-top: 20px;">Cari Lowongan</a>
            </div>
        </div>
    @endforelse

    <div style="margin-top: 24px;">{{ $lamarans->links() }}</div>
</div>
@endsection
