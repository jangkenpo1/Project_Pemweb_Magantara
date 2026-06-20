@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
<div style="padding: 40px 0 60px;">
    <div class="page-container" style="max-width: 800px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
            <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink);">Notifikasi</h1>
        </div>

        <div class="card" style="padding: 0; overflow: hidden;">
            @forelse($notifikasis as $notif)
                <a href="{{ $notif->url ?? '#' }}" class="notif-item" style="display: block; padding: 20px; border-bottom: 1px solid rgba(163,166,175,0.2); text-decoration: none; transition: background 0.15s; background: {{ $notif->status === 'belum_dibaca' ? '#f0f5ff' : 'transparent' }};">
                    <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 16px;">
                        <div>
                            <h3 style="font-size: 15px; font-weight: 600; color: var(--color-ink); margin-bottom: 4px;">
                                @if($notif->status === 'belum_dibaca')
                                    <span class="notif-dot" style="margin-right: 6px; transform: translateY(-1px);"></span>
                                @endif
                                {{ $notif->judul }}
                            </h3>
                            <p style="font-size: 14px; color: var(--color-ash); line-height: 1.5;">{{ $notif->isi }}</p>
                        </div>
                        <span style="font-size: 12px; color: var(--color-graphite); white-space: nowrap;">{{ $notif->created_at->diffForHumans() }}</span>
                    </div>
                </a>
            @empty
                <div style="padding: 48px; text-align: center;">
                    <p style="font-size: 14px; color: var(--color-graphite);">Belum ada notifikasi.</p>
                </div>
            @endforelse
        </div>

        <div style="margin-top: 24px;">{{ $notifikasis->links() }}</div>
    </div>
</div>

<style>
    .notif-item:hover {
        background: var(--color-fog) !important;
    }
</style>
@endsection
