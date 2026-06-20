@extends('layouts.admin')

@section('title', 'Review Perusahaan: ' . $perusahaan->name)

@section('content')
<div style="margin-bottom: 24px;">
    <a href="/admin/perusahaan" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; color: var(--color-graphite); text-decoration: none; margin-bottom: 16px;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        Kembali ke Daftar Perusahaan
    </a>
    <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Review Profil Perusahaan</h1>
</div>

<div style="display: grid; grid-template-columns: 1fr 300px; gap: 24px; align-items: flex-start;">
    
    <div>
        <div class="card" style="margin-bottom: 24px;">
            <div style="display: flex; align-items: flex-start; gap: 20px; margin-bottom: 24px;">
                @if($perusahaan->logo)
                    <img src="{{ Storage::url($perusahaan->logo) }}" style="width: 80px; height: 80px; border-radius: 16px; object-fit: cover;">
                @else
                    <div style="width: 80px; height: 80px; border-radius: 16px; background: var(--color-fog); border: 1px solid var(--color-dove); display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: 700; color: var(--color-ink);">
                        {{ strtoupper(substr($perusahaan->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <h2 style="font-size: 20px; font-weight: 600; color: var(--color-ink); margin-bottom: 4px;">{{ $perusahaan->name }}</h2>
                    <p style="font-size: 14px; color: var(--color-graphite); margin-bottom: 8px;">{{ $perusahaan->email }}</p>
                    <span class="badge {{ $perusahaan->status_verification === 'verified' ? 'badge-apricot' : ($perusahaan->status_verification === 'pending' ? 'badge-sky' : 'badge-fog') }}">
                        Status: {{ ucfirst($perusahaan->status_verification) }}
                    </span>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px; padding: 16px; background: var(--color-fog); border-radius: 12px;">
                <div>
                    <p style="font-size: 11px; font-weight: 600; color: var(--color-graphite); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Industri</p>
                    <p style="font-size: 14px; color: var(--color-ink); font-weight: 500;">{{ $perusahaan->industry->name ?? '-' }}</p>
                </div>
                <div>
                    <p style="font-size: 11px; font-weight: 600; color: var(--color-graphite); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Skala Karyawan</p>
                    <p style="font-size: 14px; color: var(--color-ink); font-weight: 500;">{{ $perusahaan->employee_scale ?? '-' }}</p>
                </div>
                <div>
                    <p style="font-size: 11px; font-weight: 600; color: var(--color-graphite); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Website</p>
                    @if($perusahaan->website_url)
                        <a href="{{ $perusahaan->website_url }}" target="_blank" style="font-size: 14px; color: var(--color-ink); font-weight: 500;">{{ $perusahaan->website_url }}</a>
                    @else
                        <p style="font-size: 14px; color: var(--color-ink); font-weight: 500;">-</p>
                    @endif
                </div>
                <div>
                    <p style="font-size: 11px; font-weight: 600; color: var(--color-graphite); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Bergabung Sejak</p>
                    <p style="font-size: 14px; color: var(--color-ink); font-weight: 500;">{{ $perusahaan->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <h3 style="font-size: 15px; font-weight: 600; color: var(--color-ink); margin-bottom: 8px;">Deskripsi</h3>
            <p style="font-size: 14px; color: var(--color-ash); line-height: 1.6; margin-bottom: 20px; white-space: pre-line;">{{ $perusahaan->description ?: 'Belum ada deskripsi.' }}</p>

            <h3 style="font-size: 15px; font-weight: 600; color: var(--color-ink); margin-bottom: 8px;">Alamat</h3>
            @if($perusahaan->office_address)
                <a href="{{ $perusahaan->office_address }}" target="_blank" style="font-size: 14px; color: var(--color-sky); font-weight: 500; text-decoration: none; display: block; margin-bottom: 4px; word-break: break-all;">
                    🔗 {{ $perusahaan->office_address }}
                </a>
            @else
                <p style="font-size: 14px; color: var(--color-ash); line-height: 1.6; margin-bottom: 4px;">Alamat belum diisi.</p>
            @endif
            <p style="font-size: 13px; color: var(--color-graphite);">{{ $perusahaan->city->name ?? '-' }}, {{ $perusahaan->province->name ?? '-' }}</p>
        </div>
    </div>

    <!-- Sidebar Actions -->
    <div style="position: sticky; top: 24px;">
        <div class="card" style="margin-bottom: 16px;">
            <h3 style="font-size: 14px; font-weight: 600; color: var(--color-ink); margin-bottom: 16px;">Aksi Verifikasi</h3>
            <div style="margin-bottom: 20px; padding: 12px; background: var(--color-fog); border-radius: 8px;">
                <p style="font-size: 13px; font-weight: 600; color: var(--color-ink); margin-bottom: 8px;">Dokumen Legal</p>
                @if($perusahaan->legal_document_path)
                    <a href="{{ Storage::url($perusahaan->legal_document_path) }}" target="_blank" style="font-size: 13px; font-weight: 500; color: var(--color-sky); text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                        📄 Lihat Dokumen
                    </a>
                @else
                    <p style="font-size: 12px; color: #b91c1c;">Belum ada dokumen.</p>
                @endif
            </div>

            @if($perusahaan->status_verification === 'pending' || $perusahaan->status_verification === 'rejected' || $perusahaan->status_verification === 'unverified')
                <form method="POST" action="/admin/perusahaan/{{ $perusahaan->id }}/verify" style="margin-bottom: 12px;">
                    @csrf
                    <button type="submit" class="btn-primary" style="width: 100%; justify-content: center; background: #15803d; color: white;">Verifikasi Perusahaan</button>
                </form>
            @endif

            @if($perusahaan->status_verification === 'pending' || $perusahaan->status_verification === 'verified')
                <form method="POST" action="/admin/perusahaan/{{ $perusahaan->id }}/reject" style="margin-bottom: 24px;">
                    @csrf
                    <div style="margin-bottom: 12px;">
                        <textarea name="verification_notes" class="form-textarea" placeholder="Alasan penolakan (opsional)" style="min-height: 60px; font-size: 12px; padding: 8px;"></textarea>
                    </div>
                    <button type="submit" class="btn-outline" style="width: 100%; justify-content: center; color: #b91c1c; border-color: #b91c1c;">Tolak / Batalkan</button>
                </form>
            @endif

            <div style="border-top: 1px solid rgba(163,166,175,0.2); padding-top: 16px;">
                <form method="POST" action="/admin/perusahaan/{{ $perusahaan->id }}" onsubmit="return confirm('Hapus akun perusahaan ini beserta seluruh lowongannya?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-ghost" style="width: 100%; justify-content: center; color: #b91c1c;">Hapus Akun Permanen</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
