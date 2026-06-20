@extends('layouts.admin')

@section('title', 'Master Data: Skills')

@section('content')
<div style="margin-bottom: 32px; display: flex; align-items: center; justify-content: space-between;">
    <div>
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Master Data: Skills</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Kelola daftar skill yang dapat dipilih mahasiswa & perusahaan.</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 300px; gap: 24px; align-items: flex-start;">
    
    <div class="card" style="padding: 0; overflow: hidden;">
        <table style="width: 100%; text-align: left; border-collapse: collapse;">
            <thead>
                <tr style="background: var(--color-fog); border-bottom: 1px solid rgba(163,166,175,0.2);">
                    <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Nama Skill</th>
                    <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink); text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($skills as $skill)
                    <tr style="border-bottom: 1px solid rgba(163,166,175,0.15);">
                        <td style="padding: 16px; font-size: 14px; color: var(--color-ink);">{{ $skill->name }}</td>
                        <td style="padding: 16px; text-align: right;">
                            <form method="POST" action="/admin/master/skills/{{ $skill->id }}" onsubmit="return confirm('Hapus skill ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-ghost" style="font-size: 12px; color: #b91c1c; padding: 4px 8px;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" style="padding: 32px; text-align: center; color: var(--color-graphite); font-size: 14px;">Belum ada data skill.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($skills->hasPages())
            <div style="padding: 16px; border-top: 1px solid rgba(163,166,175,0.2);">
                {{ $skills->links() }}
            </div>
        @endif
    </div>

    <div class="card" style="position: sticky; top: 24px;">
        <h3 style="font-size: 15px; font-weight: 600; color: var(--color-ink); margin-bottom: 16px;">Tambah Skill Baru</h3>
        <form method="POST" action="/admin/master/skills">
            @csrf
            <div style="margin-bottom: 16px;">
                <label class="form-label">Nama Skill</label>
                <input type="text" name="name" class="form-input" placeholder="Contoh: Laravel, Figma, dll." required>
                @error('name')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Tambah</button>
        </form>
    </div>

</div>
@endsection
