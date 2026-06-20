@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="page-container" style="padding-top: 40px; padding-bottom: 60px; max-width: 800px;">
    <div style="margin-bottom: 32px;">
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Profil Saya</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Lengkapi profil untuk meningkatkan peluang diterima magang.</p>
    </div>

    <form method="POST" action="/mahasiswa/profil" enctype="multipart/form-data">
        @csrf

        <!-- Avatar & Basic -->
        <div class="card" style="margin-bottom: 20px;">
            <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 20px;">Informasi Dasar</h2>
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 24px;">
                @if($mahasiswa->avatar)
                    <img src="{{ Storage::url($mahasiswa->avatar) }}" class="avatar-lg" alt="Avatar">
                @else
                    <div class="avatar-initials" style="width: 64px; height: 64px; font-size: 22px;">{{ strtoupper(substr($mahasiswa->name, 0, 1)) }}</div>
                @endif
                <div>
                    <label class="form-label">Foto Profil</label>
                    <input type="file" name="avatar" accept="image/*" style="font-size: 13px; color: var(--color-ash);">
                    <p style="font-size: 11px; color: var(--color-dove); margin-top: 4px;">JPG, PNG. Maks 2MB.</p>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div>
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', $mahasiswa->name) }}" required>
                    @error('name')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" value="{{ $mahasiswa->email }}" disabled style="opacity: 0.6; cursor: not-allowed;">
                </div>
                <div>
                    <label class="form-label">Universitas</label>
                    <select name="university_id" class="form-select">
                        <option value="">Pilih universitas...</option>
                        @foreach($universities as $univ)
                            <option value="{{ $univ->id }}" {{ old('university_id', $mahasiswa->university_id) == $univ->id ? 'selected' : '' }}>{{ $univ->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Jurusan</label>
                    <select name="major_id" class="form-select">
                        <option value="">Pilih jurusan...</option>
                        @foreach($majors as $major)
                            <option value="{{ $major->id }}" {{ old('major_id', $mahasiswa->major_id) == $major->id ? 'selected' : '' }}>{{ $major->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Semester</label>
                    <select name="semester" class="form-select">
                        <option value="">Pilih semester...</option>
                        @for($i = 1; $i <= 14; $i++)
                            <option value="{{ $i }}" {{ old('semester', $mahasiswa->semester) == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>

        <!-- Bio & Experience -->
        <div class="card" style="margin-bottom: 20px;">
            <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 20px;">Tentang Saya</h2>
            <div style="margin-bottom: 16px;">
                <label class="form-label">Deskripsi Diri</label>
                <textarea name="bio" class="form-textarea" placeholder="Ceritakan tentang dirimu, minat, dan tujuan kariermu...">{{ old('bio', $mahasiswa->bio) }}</textarea>
            </div>
            <div>
                <label class="form-label">Pengalaman</label>
                <textarea name="experience" class="form-textarea" placeholder="Ceritakan pengalaman organisasi, project, atau kerja sebelumnya...">{{ old('experience', $mahasiswa->experience) }}</textarea>
            </div>
        </div>

        <!-- Skills -->
        <div class="card" style="margin-bottom: 20px;">
            <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 6px;">Skill</h2>
            <p style="font-size: 13px; color: var(--color-graphite); margin-bottom: 20px;">Pilih skill yang kamu kuasai. Ini digunakan untuk fitur Skill Match lowongan.</p>
            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                @foreach($skills as $skill)
                    <label style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 9999px; border: 1.5px solid {{ in_array($skill->id, $mySkillIds) ? 'var(--color-ink)' : 'var(--color-dove)' }}; background: {{ in_array($skill->id, $mySkillIds) ? 'var(--color-ink)' : 'transparent' }}; color: {{ in_array($skill->id, $mySkillIds) ? 'white' : 'var(--color-ash)' }}; font-size: 13px; font-weight: 500; cursor: pointer; transition: all 0.15s;">
                        <input type="checkbox" name="skills[]" value="{{ $skill->id }}" {{ in_array($skill->id, $mySkillIds) ? 'checked' : '' }} style="display: none;" onchange="this.parentElement.style.background = this.checked ? 'var(--color-ink)' : 'transparent'; this.parentElement.style.borderColor = this.checked ? 'var(--color-ink)' : 'var(--color-dove)'; this.parentElement.style.color = this.checked ? 'white' : 'var(--color-ash)';">
                        {{ $skill->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <!-- CV & Links -->
        <div class="card" style="margin-bottom: 24px;">
            <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 20px;">CV & Tautan</h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div>
                    <label class="form-label">Upload CV (PDF) *</label>
                    @if($mahasiswa->cv_path)
                        <p style="font-size: 12px; color: #15803d; margin-bottom: 6px;">✓ CV sudah diupload. <a href="{{ Storage::url($mahasiswa->cv_path) }}" target="_blank" style="color: var(--color-ink);">Lihat CV</a></p>
                    @endif
                    <input type="file" name="cv" accept=".pdf" style="font-size: 13px; color: var(--color-ash);">
                    <p style="font-size: 11px; color: var(--color-dove); margin-top: 4px;">PDF. Maks 5MB.</p>
                    @error('cv')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="form-label">URL Portfolio</label>
                    <input type="url" name="portfolio_url" class="form-input" value="{{ old('portfolio_url', $mahasiswa->portfolio_url) }}" placeholder="https://portofolio.com">
                </div>
                <div>
                    <label class="form-label">URL LinkedIn</label>
                    <input type="url" name="linkedin_url" class="form-input" value="{{ old('linkedin_url', $mahasiswa->linkedin_url) }}" placeholder="https://linkedin.com/in/...">
                </div>
                <div>
                    <label class="form-label">URL GitHub</label>
                    <input type="url" name="github_url" class="form-input" value="{{ old('github_url', $mahasiswa->github_url) }}" placeholder="https://github.com/...">
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 12px;">
            <button type="submit" class="btn-primary" style="padding: 13px 32px;">Simpan Perubahan</button>
            <a href="/mahasiswa/dashboard" class="btn-outline" style="padding: 13px 24px;">Batal</a>
        </div>
    </form>
</div>
@endsection
