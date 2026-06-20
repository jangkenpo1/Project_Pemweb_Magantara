@extends('layouts.app')

@section('title', 'Wishlist')

@section('content')
<div class="page-container" style="padding-top: 40px; padding-bottom: 60px;">
    <div style="margin-bottom: 32px;">
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Wishlist</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Lowongan yang kamu simpan untuk dilamar nanti.</p>
    </div>

    @forelse($bookmarks as $lowongan)
        <div class="job-card" style="margin-bottom: 16px; display: flex; align-items: center; gap: 16px;">
            <div class="company-logo" style="display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px; color: var(--color-ink); width: 48px; height: 48px;">
                {{ strtoupper(substr($lowongan->perusahaan->name, 0, 1)) }}
            </div>
            <div style="flex: 1; min-width: 0;">
                <a href="/lowongan/{{ $lowongan->id }}" style="font-size: 16px; font-weight: 600; color: var(--color-ink); text-decoration: none;">{{ $lowongan->title }}</a>
                <p style="font-size: 13px; color: var(--color-graphite);">{{ $lowongan->perusahaan->name }}</p>
                <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-top: 8px;">
                    <span class="badge {{ $lowongan->work_system === 'remote' ? 'badge-sky' : 'badge-fog' }}">{{ $lowongan->work_system_label }}</span>
                    <span class="badge {{ $lowongan->payment_type === 'paid' ? 'badge-apricot' : 'badge-fog' }}">{{ $lowongan->payment_type_label }}</span>
                    @foreach($lowongan->skills->take(3) as $skill)
                        <span class="badge badge-fog" style="font-size: 11px;">{{ $skill->name }}</span>
                    @endforeach
                </div>
            </div>
            <div style="display: flex; gap: 8px;">
                <a href="/lowongan/{{ $lowongan->id }}" class="btn-outline" style="padding: 8px 18px; font-size: 13px;">Lihat Detail</a>
                <form method="POST" action="/mahasiswa/bookmark/{{ $lowongan->id }}">
                    @csrf
                    <button type="submit" class="btn-ghost" style="font-size: 13px; color: #dc2626;" title="Hapus dari wishlist">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="#dc2626" stroke="none"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-state-card">
                <h3>Wishlist kosong</h3>
                <p>Simpan lowongan yang menarik dengan menekan tombol bookmark pada halaman detail lowongan.</p>
                <a href="/lowongan" class="btn-primary" style="margin-top: 20px;">Jelajahi Lowongan</a>
            </div>
        </div>
    @endforelse

    <div style="margin-top: 24px;">{{ $bookmarks->links() }}</div>
</div>
@endsection
