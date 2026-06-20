@extends('layouts.admin')

@section('title', 'Master Data: Industri')

@section('content')
<div style="margin-bottom: 32px; display: flex; align-items: center; justify-content: space-between;">
    <div>
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Master Data: Bidang Industri</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Kelola daftar bidang industri untuk profil perusahaan.</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 300px; gap: 24px; align-items: flex-start;">
    
    <div class="card" style="padding: 0; overflow: hidden;">
        <table style="width: 100%; text-align: left; border-collapse: collapse;">
            <thead>
                <tr style="background: var(--color-fog); border-bottom: 1px solid rgba(163,166,175,0.2);">
                    <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Nama Industri</th>
                    <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink); text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($industries as $industry)
                    <tr style="border-bottom: 1px solid rgba(163,166,175,0.15);">
                        <td style="padding: 16px; font-size: 14px; color: var(--color-ink);">{{ $industry->name }}</td>
                        <td style="padding: 16px; text-align: right;">
                            <form method="POST" action="/admin/master/industri/{{ $industry->id }}" onsubmit="return confirm('Hapus bidang industri ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-ghost" style="font-size: 12px; color: #b91c1c; padding: 4px 8px;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" style="padding: 32px; text-align: center; color: var(--color-graphite); font-size: 14px;">Belum ada data industri.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($industries->hasPages())
            <div style="padding: 16px; border-top: 1px solid rgba(163,166,175,0.2);">
                {{ $industries->links() }}
            </div>
        @endif
    </div>

    <div class="card" style="position: sticky; top: 24px;">
        <h3 style="font-size: 15px; font-weight: 600; color: var(--color-ink); margin-bottom: 16px;">Tambah Industri Baru</h3>
        <form method="POST" action="/admin/master/industri">
            @csrf
            <div style="margin-bottom: 16px;">
                <label class="form-label">Nama Industri</label>
                <input type="text" name="name" class="form-input" placeholder="Contoh: Technology, Finance, dll." required>
                @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Tambah</button>
        </form>
    </div>

</div>
@endsection
