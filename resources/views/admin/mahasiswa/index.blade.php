@extends('layouts.admin')

@section('title', 'Manajemen Mahasiswa')

@section('content')
<div style="margin-bottom: 32px; display: flex; align-items: center; justify-content: space-between;">
    <div>
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Manajemen Mahasiswa</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Kelola akun mahasiswa terdaftar.</p>
    </div>
</div>

<form action="/admin/mahasiswa" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 24px;">
    <div class="search-bar" style="width: 300px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-dove)" stroke-width="2" style="margin-left: 16px;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau email...">
        <button type="submit">Cari</button>
    </div>
</form>

<div class="card" style="padding: 0; overflow: hidden;">
    <table style="width: 100%; text-align: left; border-collapse: collapse;">
        <thead>
            <tr style="background: var(--color-fog); border-bottom: 1px solid rgba(163,166,175,0.2);">
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Mahasiswa</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Universitas</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Jurusan</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Bergabung</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink); text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($mahasiswas as $mhs)
                <tr style="border-bottom: 1px solid rgba(163,166,175,0.15);">
                    <td style="padding: 16px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            @if($mhs->avatar)
                                <img src="{{ Storage::url($mhs->avatar) }}" style="width: 36px; height: 36px; border-radius: 50%; object-fit: cover;">
                            @else
                                <div class="avatar-initials" style="width: 36px; height: 36px; font-size: 13px;">{{ strtoupper(substr($mhs->name, 0, 1)) }}</div>
                            @endif
                            <div>
                                <p style="font-size: 14px; font-weight: 500; color: var(--color-ink);">{{ $mhs->name }}</p>
                                <p style="font-size: 12px; color: var(--color-graphite);">{{ $mhs->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 16px; font-size: 13px; color: var(--color-graphite);">{{ $mhs->university->name ?? '-' }}</td>
                    <td style="padding: 16px; font-size: 13px; color: var(--color-graphite);">{{ $mhs->major->name ?? '-' }}</td>
                    <td style="padding: 16px; font-size: 13px; color: var(--color-graphite);">{{ $mhs->created_at->format('d M Y') }}</td>
                    <td style="padding: 16px; text-align: right;">
                        <form method="POST" action="/admin/mahasiswa/{{ $mhs->id }}" onsubmit="return confirm('Hapus akun mahasiswa ini beserta riwayat lamarannya?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-ghost" style="font-size: 12px; color: #b91c1c; padding: 6px 12px;">Hapus Akun</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding: 32px; text-align: center; color: var(--color-graphite); font-size: 14px;">Tidak ada data mahasiswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 24px;">{{ $mahasiswas->links() }}</div>
@endsection
