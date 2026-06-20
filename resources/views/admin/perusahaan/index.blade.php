@extends('layouts.admin')

@section('title', 'Manajemen Perusahaan')

@section('content')
<div style="margin-bottom: 32px; display: flex; align-items: center; justify-content: space-between;">
    <div>
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Manajemen Perusahaan</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Verifikasi dan kelola akun perusahaan.</p>
    </div>
</div>

<form action="/admin/perusahaan" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 24px;">
    <div class="search-bar" style="width: 300px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-dove)" stroke-width="2" style="margin-left: 16px;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari perusahaan...">
        <button type="submit">Cari</button>
    </div>
    <select name="status" onchange="this.form.submit()" class="form-select" style="width: auto; min-width: 150px; border-radius: 9999px; padding: 9px 40px 9px 16px;">
        <option value="">Semua Status</option>
        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="verified" {{ request('status') === 'verified' ? 'selected' : '' }}>Terverifikasi</option>
        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
    </select>
</form>

<div class="card" style="padding: 0; overflow: hidden;">
    <table style="width: 100%; text-align: left; border-collapse: collapse;">
        <thead>
            <tr style="background: var(--color-fog); border-bottom: 1px solid rgba(163,166,175,0.2);">
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Perusahaan</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Industri</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Skala</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Status</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink); text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($perusahaans as $p)
                <tr style="border-bottom: 1px solid rgba(163,166,175,0.15);">
                    <td style="padding: 16px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div class="company-logo" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px; color: var(--color-ink); overflow: hidden;">
                                @if($p->logo)
                                    <img src="{{ Storage::url($p->logo) }}" alt="{{ $p->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    {{ strtoupper(substr($p->name, 0, 1)) }}
                                @endif
                            </div>
                            <div>
                                <p style="font-size: 14px; font-weight: 500; color: var(--color-ink);">{{ $p->name }}</p>
                                <p style="font-size: 12px; color: var(--color-graphite);">{{ $p->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 16px; font-size: 13px; color: var(--color-graphite);">{{ $p->industry->name ?? '-' }}</td>
                    <td style="padding: 16px; font-size: 13px; color: var(--color-graphite);">{{ $p->employee_scale ?? '-' }}</td>
                    <td style="padding: 16px;">
                        <span class="badge {{ $p->status_verification === 'verified' ? 'badge-apricot' : ($p->status_verification === 'pending' ? 'badge-sky' : 'badge-fog') }}" style="font-size: 11px;">
                            {{ ucfirst($p->status_verification) }}
                        </span>
                    </td>
                    <td style="padding: 16px; text-align: right;">
                        <a href="/admin/perusahaan/{{ $p->id }}" class="btn-outline" style="font-size: 12px; padding: 6px 14px;">Review</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding: 32px; text-align: center; color: var(--color-graphite); font-size: 14px;">Tidak ada data perusahaan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 24px;">{{ $perusahaans->links() }}</div>
@endsection
