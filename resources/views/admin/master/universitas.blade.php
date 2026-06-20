@extends('layouts.admin')

@section('title', 'Master Data: Universitas')

@section('content')
<div style="margin-bottom: 32px; display: flex; align-items: center; justify-content: space-between;">
    <div>
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Master Data: Universitas</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Kelola daftar universitas untuk profil mahasiswa.</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 300px; gap: 24px; align-items: flex-start;">
    
    <div class="card" style="padding: 0; overflow: hidden;">
        <table style="width: 100%; text-align: left; border-collapse: collapse;">
            <thead>
                <tr style="background: var(--color-fog); border-bottom: 1px solid rgba(163,166,175,0.2);">
                    <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Nama Universitas</th>
                    <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink); text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($universities as $univ)
                    <tr style="border-bottom: 1px solid rgba(163,166,175,0.15);">
                        <td style="padding: 16px; font-size: 14px; color: var(--color-ink);">{{ $univ->name }}</td>
                        <td style="padding: 16px; text-align: right;">
                            <form method="POST" action="/admin/master/universitas/{{ $univ->id }}" onsubmit="return confirm('Hapus universitas ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-ghost" style="font-size: 12px; color: #b91c1c; padding: 4px 8px;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" style="padding: 32px; text-align: center; color: var(--color-graphite); font-size: 14px;">Belum ada data universitas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($universities->hasPages())
            <div style="padding: 16px; border-top: 1px solid rgba(163,166,175,0.2);">
                {{ $universities->links() }}
            </div>
        @endif
    </div>

    <div class="card" style="position: sticky; top: 24px;">
        <h3 style="font-size: 15px; font-weight: 600; color: var(--color-ink); margin-bottom: 16px;">Tambah Universitas Baru</h3>
        <form method="POST" action="/admin/master/universitas">
            @csrf
            <div style="margin-bottom: 16px;">
                <label class="form-label">Nama Universitas</label>
                <input type="text" name="name" class="form-input" placeholder="Contoh: Universitas Indonesia" required>
                @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Tambah</button>
        </form>
    </div>

</div>
@endsection
