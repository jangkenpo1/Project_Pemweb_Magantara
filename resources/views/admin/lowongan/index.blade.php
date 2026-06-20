@extends('layouts.admin')

@section('title', 'Manajemen Lowongan')

@section('content')
<div style="margin-bottom: 32px; display: flex; align-items: center; justify-content: space-between;">
    <div>
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Manajemen Lowongan</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Kelola seluruh lowongan magang yang ada di platform.</p>
    </div>
</div>

<form action="/admin/lowongan" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 24px;">
    <div class="search-bar" style="width: 300px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-dove)" stroke-width="2" style="margin-left: 16px;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari posisi lowongan...">
        <button type="submit">Cari</button>
    </div>
    <select name="status" onchange="this.form.submit()" class="form-select" style="width: auto; min-width: 150px; border-radius: 9999px; padding: 9px 40px 9px 16px;">
        <option value="">Semua Status</option>
        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
        <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
    </select>
</form>

<div class="card" style="padding: 0; overflow: hidden;">
    <table style="width: 100%; text-align: left; border-collapse: collapse;">
        <thead>
            <tr style="background: var(--color-fog); border-bottom: 1px solid rgba(163,166,175,0.2);">
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Lowongan</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Sistem Kerja</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Tipe</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Status</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink); text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lowongans as $lowongan)
                <tr style="border-bottom: 1px solid rgba(163,166,175,0.15);">
                    <td style="padding: 16px;">
                        <a href="/lowongan/{{ $lowongan->id }}" style="font-size: 14px; font-weight: 500; color: var(--color-ink); text-decoration: none;">{{ $lowongan->title }}</a>
                        <p style="font-size: 12px; color: var(--color-graphite); margin-top: 2px;">{{ $lowongan->perusahaan->name ?? '-' }}</p>
                    </td>
                    <td style="padding: 16px; font-size: 13px; color: var(--color-graphite);">{{ ucfirst($lowongan->work_system) }}</td>
                    <td style="padding: 16px; font-size: 13px; color: var(--color-graphite);">{{ ucfirst($lowongan->payment_type) }}</td>
                    <td style="padding: 16px;">
                        <span class="badge {{ $lowongan->status === 'published' ? 'badge-apricot' : 'badge-fog' }}" style="font-size: 11px;">
                            {{ ucfirst($lowongan->status) }}
                        </span>
                    </td>
                    <td style="padding: 16px; text-align: right;">
                        <form method="POST" action="/admin/lowongan/{{ $lowongan->id }}" onsubmit="return confirm('Hapus lowongan ini permanen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-ghost" style="font-size: 12px; color: #b91c1c; padding: 6px 12px;">Hapus Permanen</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding: 32px; text-align: center; color: var(--color-graphite); font-size: 14px;">Tidak ada data lowongan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 24px;">{{ $lowongans->links() }}</div>
@endsection
