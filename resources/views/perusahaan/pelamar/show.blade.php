@extends('layouts.perusahaan')

@section('title', 'Detail Pelamar')

@section('content')
<div style="margin-bottom: 32px;">
    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
        <a href="/perusahaan/pelamar" class="btn-ghost" style="padding: 8px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        </a>
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink);">Detail Pelamar</h1>
    </div>
    <p style="font-size: 14px; color: var(--color-graphite); margin-left: 52px;">Evaluasi kandidat untuk lowongan <strong>{{ $lamaran->lowongan->title }}</strong></p>
</div>

@if(session('success'))
    <div style="background: #dcfce7; border: 1px solid #22c55e; border-radius: 8px; padding: 16px; margin-bottom: 24px; color: #15803d; font-size: 14px;">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div style="background: #fee2e2; border: 1px solid #f87171; border-radius: 8px; padding: 16px; margin-bottom: 24px; color: #b91c1c; font-size: 14px;">
        {{ session('error') }}
    </div>
@endif

<div style="display: grid; grid-template-columns: 1fr 340px; gap: 32px;">
    <!-- Kiri: Detail Profil -->
    <div>
        <div class="card" style="margin-bottom: 24px;">
            <div style="display: flex; gap: 20px; align-items: flex-start; margin-bottom: 24px;">
                @if($lamaran->mahasiswa->avatar_path)
                    <img src="{{ Storage::url($lamaran->mahasiswa->avatar_path) }}" alt="{{ $lamaran->mahasiswa->name }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 1px solid var(--color-dove);">
                @else
                    <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--color-ink); color: white; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 600;">
                        {{ strtoupper(substr($lamaran->mahasiswa->name, 0, 1)) }}
                    </div>
                @endif
                <div style="flex: 1;">
                    <h2 style="font-size: 22px; font-weight: 600; color: var(--color-ink); margin-bottom: 4px;">{{ $lamaran->mahasiswa->name }}</h2>
                    <p style="font-size: 14px; color: var(--color-ash); margin-bottom: 12px;">{{ $lamaran->mahasiswa->university->name ?? 'Universitas tidak diketahui' }} — {{ $lamaran->mahasiswa->major->name ?? 'Jurusan tidak diketahui' }} (Semester {{ $lamaran->mahasiswa->semester }})</p>
                    
                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                        <span class="badge {{ $skillMatch >= 80 ? 'badge-skill-match-high' : ($skillMatch >= 50 ? 'badge-skill-match-mid' : 'badge-skill-match-low') }}">
                            ✦ {{ $skillMatch }}% Skill Match
                        </span>
                    </div>
                </div>
            </div>

            @if($lamaran->mahasiswa->about_me)
                <div style="margin-bottom: 20px;">
                    <h3 style="font-size: 14px; font-weight: 600; color: var(--color-ink); margin-bottom: 8px;">Tentang</h3>
                    <p style="font-size: 14px; color: var(--color-ash); line-height: 1.6; white-space: pre-line;">{{ $lamaran->mahasiswa->about_me }}</p>
                </div>
            @endif

            @if($lamaran->mahasiswa->experience)
                <div style="margin-bottom: 20px;">
                    <h3 style="font-size: 14px; font-weight: 600; color: var(--color-ink); margin-bottom: 8px;">Pengalaman</h3>
                    <p style="font-size: 14px; color: var(--color-ash); line-height: 1.6; white-space: pre-line;">{{ $lamaran->mahasiswa->experience }}</p>
                </div>
            @endif

            <div>
                <h3 style="font-size: 14px; font-weight: 600; color: var(--color-ink); margin-bottom: 12px;">Skill</h3>
                <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                    @foreach($lamaran->mahasiswa->skills as $skill)
                        @php
                            $isMatch = $lamaran->lowongan->skills->contains('id', $skill->id);
                        @endphp
                        <span class="badge {{ $isMatch ? 'badge-apricot' : 'badge-fog' }}">{{ $skill->name }}</span>
                    @endforeach
                </div>
                <p style="font-size: 12px; color: var(--color-graphite); margin-top: 12px;">* Skill yang di-highlight adalah skill yang sesuai dengan kebutuhan lowongan.</p>
            </div>
        </div>

        @if($lamaran->cover_letter)
            <div class="card" style="margin-bottom: 24px;">
                <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 16px;">Cover Letter</h2>
                <div style="font-size: 14px; color: var(--color-ash); line-height: 1.6; white-space: pre-line; background: #fafafa; padding: 16px; border-radius: 8px; border: 1px solid var(--color-dove);">{{ $lamaran->cover_letter }}</div>
            </div>
        @endif
    </div>

    <!-- Kanan: Status & Berkas -->
    <div>
        <div class="card" style="margin-bottom: 24px;">
            <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 16px;">Update Status</h2>
            <form method="POST" action="/perusahaan/pelamar/{{ $lamaran->id }}/status" x-data="{ status: '{{ old('status', $lamaran->status) }}' }">
                @csrf
                @method('PUT')
                
                <div style="margin-bottom: 16px;">
                    <label class="form-label">Status Lamaran</label>
                    <select name="status" class="form-select" x-model="status" {{ $lamaran->status === 'dibatalkan' ? 'disabled' : '' }}>
                        <option value="dilihat">Sedang Ditinjau</option>
                        <option value="interview">Panggilan Interview</option>
                        <option value="diterima">Diterima</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>

                <template x-if="status === 'interview'">
                    <div style="background: var(--color-fog); padding: 16px; border-radius: 8px; margin-bottom: 16px; border: 1px solid var(--color-dove);">
                        <div style="margin-bottom: 12px;">
                            <label class="form-label" style="font-size: 13px;">Tanggal & Waktu Interview *</label>
                            <input type="datetime-local" name="interview_date" class="form-input" value="{{ old('interview_date', $lamaran->interview_date ? $lamaran->interview_date->format('Y-m-d\TH:i') : '') }}" required>
                        </div>
                        <div>
                            <label class="form-label" style="font-size: 13px;">URL Meeting (Zoom/GMeet) *</label>
                            <input type="url" name="interview_url" class="form-input" placeholder="https://zoom.us/j/..." value="{{ old('interview_url', $lamaran->interview_url) }}" required>
                        </div>
                    </div>
                </template>

                <div style="margin-bottom: 20px;">
                    <label class="form-label">Catatan Rekruter (Opsional)</label>
                    <textarea name="recruiter_notes" class="form-textarea" placeholder="Catatan internal untuk pelamar ini..." style="min-height: 80px;" {{ $lamaran->status === 'dibatalkan' ? 'disabled' : '' }}>{{ $lamaran->recruiter_notes }}</textarea>
                </div>

                @if($lamaran->status !== 'dibatalkan')
                    <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Simpan Status</button>
                @else
                    <div style="background: #fee2e2; color: #b91c1c; padding: 12px; border-radius: 8px; font-size: 13px; text-align: center;">
                        Pelamar ini telah membatalkan lamarannya.
                    </div>
                @endif
            </form>
        </div>

        <div class="card">
            <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 16px;">Berkas & Tautan</h2>
            
            <div style="display: flex; flex-direction: column; gap: 12px;">
                @if($lamaran->mahasiswa->cv_path)
                    <a href="{{ Storage::url($lamaran->mahasiswa->cv_path) }}" target="_blank" class="btn-outline" style="justify-content: center; width: 100%;">📄 Lihat CV (PDF)</a>
                @else
                    <div style="padding: 12px; text-align: center; border: 1px dashed var(--color-dove); border-radius: 8px; font-size: 13px; color: var(--color-graphite);">
                        Belum mengunggah CV
                    </div>
                @endif

                @if($lamaran->mahasiswa->portfolio_url)
                    <a href="{{ $lamaran->mahasiswa->portfolio_url }}" target="_blank" style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--color-sky); text-decoration: none; padding: 8px 0; border-bottom: 1px solid var(--color-dove);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        Portfolio Website
                    </a>
                @endif

                @if($lamaran->mahasiswa->linkedin_url)
                    <a href="{{ $lamaran->mahasiswa->linkedin_url }}" target="_blank" style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--color-sky); text-decoration: none; padding: 8px 0; border-bottom: 1px solid var(--color-dove);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                        LinkedIn
                    </a>
                @endif

                @if($lamaran->mahasiswa->github_url)
                    <a href="{{ $lamaran->mahasiswa->github_url }}" target="_blank" style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--color-sky); text-decoration: none; padding: 8px 0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
                        GitHub
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
