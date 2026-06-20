@extends('layouts.perusahaan')

@section('title', 'Buat Lowongan Baru')

@section('content')
<div style="margin-bottom: 32px; max-width: 800px;">
    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
        <a href="/perusahaan/lowongan" class="btn-ghost" style="padding: 8px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        </a>
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink);">Buat Lowongan</h1>
    </div>
    <p style="font-size: 14px; color: var(--color-graphite); margin-left: 52px;">Publikasikan peluang magang baru untuk mahasiswa.</p>
</div>

<form method="POST" action="/perusahaan/lowongan" style="max-width: 800px; margin-left: 52px;">
    @csrf

    @if ($errors->any())
        <div style="background: #fee2e2; border: 1px solid #f87171; border-radius: 8px; padding: 16px; margin-bottom: 24px;">
            <div style="font-weight: 600; color: #b91c1c; margin-bottom: 8px;">Terdapat beberapa kesalahan:</div>
            <ul style="margin: 0; padding-left: 20px; color: #b91c1c; font-size: 14px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card" style="margin-bottom: 24px;">
        <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 20px;">Informasi Utama</h2>
        <div style="margin-bottom: 16px;">
            <label class="form-label">Judul Lowongan *</label>
            <input type="text" name="title" class="form-input" value="{{ old('title') }}" placeholder="Contoh: Frontend Developer Intern" required>
            @error('title')<p class="form-error">{{ $message }}</p>@enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
            <div>
                <label class="form-label">Sistem Kerja *</label>
                <select name="work_system" class="form-select" required>
                    <option value="">Pilih sistem kerja...</option>
                    <option value="remote" {{ old('work_system') == 'remote' ? 'selected' : '' }}>Remote</option>
                    <option value="hybrid" {{ old('work_system') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                    <option value="onsite" {{ old('work_system') == 'onsite' ? 'selected' : '' }}>On-Site</option>
                </select>
                @error('work_system')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="form-label">Tipe Pembayaran *</label>
                <select name="payment_type" class="form-select" required>
                    <option value="">Pilih tipe pembayaran...</option>
                    <option value="paid" {{ old('payment_type') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="unpaid" {{ old('payment_type') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                </select>
                @error('payment_type')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="form-label">Durasi (Bulan) *</label>
                <input type="number" name="duration_months" class="form-input" value="{{ old('duration_months') }}" min="1" max="12" placeholder="Contoh: 3" required>
                @error('duration_months')<p class="form-error">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="form-label">Kuota Penerimaan *</label>
                <input type="number" name="quota" class="form-input" value="{{ old('quota') }}" min="1" placeholder="Contoh: 5" required>
                @error('quota')<p class="form-error">{{ $message }}</p>@enderror
            </div>
        </div>

        <div>
            <label class="form-label">Batas Akhir Lamaran (Deadline) *</label>
            <input type="date" name="deadline" class="form-input" value="{{ old('deadline') }}" required>
            @error('deadline')<p class="form-error">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="card" style="margin-bottom: 24px;">
        <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 20px;">Detail Pekerjaan</h2>
        
        <div style="margin-bottom: 16px;">
            <label class="form-label">Deskripsi *</label>
            <textarea name="description" class="form-textarea" placeholder="Jelaskan gambaran umum tentang posisi ini..." style="min-height: 100px;" required>{{ old('description') }}</textarea>
            @error('description')<p class="form-error">{{ $message }}</p>@enderror
        </div>
        
        <div style="margin-bottom: 16px;">
            <label class="form-label">Tanggung Jawab *</label>
            <textarea name="responsibilities" class="form-textarea" placeholder="Apa saja yang akan dikerjakan..." style="min-height: 100px;" required>{{ old('responsibilities') }}</textarea>
            @error('responsibilities')<p class="form-error">{{ $message }}</p>@enderror
        </div>

        <div style="margin-bottom: 16px;">
            <label class="form-label">Kualifikasi *</label>
            <textarea name="qualifications" class="form-textarea" placeholder="Syarat-syarat pelamar..." style="min-height: 100px;" required>{{ old('qualifications') }}</textarea>
            @error('qualifications')<p class="form-error">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="form-label">Benefit</label>
            <textarea name="benefits" class="form-textarea" placeholder="Apa yang akan didapatkan peserta magang..." style="min-height: 80px;">{{ old('benefits') }}</textarea>
            @error('benefits')<p class="form-error">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="card" style="margin-bottom: 24px;">
        <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 6px;">Skill & Jurusan yang Relevan</h2>
        <p style="font-size: 13px; color: var(--color-graphite); margin-bottom: 20px;">Pilih skill dan jurusan untuk membantu sistem mencocokkan kandidat terbaik.</p>
        
        <div style="margin-bottom: 24px;" x-data="{ search: '' }">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <label class="form-label" style="margin-bottom: 0;">Skill (Pilih yang sesuai)</label>
                <input type="text" x-model="search" placeholder="Cari skill..." class="form-input" style="padding: 6px 12px; font-size: 13px; max-width: 250px; min-height: 0;">
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                @foreach($skills as $skill)
                    <label x-show="search === '' ? ({{ $loop->index }} < 20 || {{ in_array($skill->id, old('skills', [])) ? 'true' : 'false' }}) : '{{ strtolower($skill->name) }}'.includes(search.toLowerCase())" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 9999px; border: 1.5px solid var(--color-dove); font-size: 13px; font-weight: 500; cursor: pointer; transition: all 0.15s; color: var(--color-ash);">
                        <input type="checkbox" name="skills[]" value="{{ $skill->id }}" {{ in_array($skill->id, old('skills', [])) ? 'checked' : '' }} style="display: none;" onchange="this.parentElement.style.background = this.checked ? 'var(--color-ink)' : 'transparent'; this.parentElement.style.borderColor = this.checked ? 'var(--color-ink)' : 'var(--color-dove)'; this.parentElement.style.color = this.checked ? 'white' : 'var(--color-ash)';">
                        {{ $skill->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <div x-data="{ search: '' }">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <label class="form-label" style="margin-bottom: 0;">Jurusan (Pilih yang sesuai)</label>
                <input type="text" x-model="search" placeholder="Cari jurusan..." class="form-input" style="padding: 6px 12px; font-size: 13px; max-width: 250px; min-height: 0;">
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                @foreach($majors as $major)
                    <label x-show="search === '' ? ({{ $loop->index }} < 20 || {{ in_array($major->id, old('majors', [])) ? 'true' : 'false' }}) : '{{ strtolower($major->name) }}'.includes(search.toLowerCase())" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 9999px; border: 1.5px solid var(--color-dove); font-size: 13px; font-weight: 500; cursor: pointer; transition: all 0.15s; color: var(--color-ash);">
                        <input type="checkbox" name="majors[]" value="{{ $major->id }}" {{ in_array($major->id, old('majors', [])) ? 'checked' : '' }} style="display: none;" onchange="this.parentElement.style.background = this.checked ? 'var(--color-ink)' : 'transparent'; this.parentElement.style.borderColor = this.checked ? 'var(--color-ink)' : 'var(--color-dove)'; this.parentElement.style.color = this.checked ? 'white' : 'var(--color-ash)';">
                        {{ $major->name }}
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom: 24px;" x-data="locationDropdown('{{ old('province_id') }}', '{{ old('city_id') }}')">
        <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 20px;">Lokasi Penempatan</h2>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
            <div>
                <label class="form-label">Provinsi (Opsional)</label>
                <select name="province_id" class="form-select" x-model="province" @change="fetchCities()">
                    <option value="">Pilih provinsi...</option>
                    @foreach($provinces as $prov)
                        <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="form-label">Kota (Opsional)</label>
                <select name="city_id" class="form-select" x-model="city" :disabled="!province || isLoading">
                    <option value="">Pilih kota...</option>
                    <template x-for="c in cities" :key="c.id">
                        <option :value="c.id" x-text="c.name"></option>
                    </template>
                </select>
            </div>
        </div>
        <div>
            <label class="form-label">URL Google Maps (Opsional)</label>
            <input type="url" name="gmaps_url" class="form-input" placeholder="https://maps.app.goo.gl/..." value="{{ old('gmaps_url') }}">
        </div>
    </div>

    <div style="display: flex; gap: 12px; align-items: center;">
        <button type="submit" name="status" value="published" class="btn-primary" style="padding: 13px 32px;">Publikasikan Lowongan</button>
        <button type="submit" name="status" value="draft" class="btn-outline" style="padding: 13px 24px;">Simpan Draft</button>
        <a href="/perusahaan/lowongan" class="btn-ghost" style="padding: 13px 24px;">Batal</a>
    </div>
</form>

<script>
    // Initialize checkboxes UI state on load
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
            if (checkbox.checked) {
                checkbox.parentElement.style.background = 'var(--color-ink)';
                checkbox.parentElement.style.borderColor = 'var(--color-ink)';
                checkbox.parentElement.style.color = 'white';
            }
        });
    });

    function locationDropdown(initialProvince, initialCity) {
        return {
            province: initialProvince,
            city: initialCity,
            cities: [],
            isLoading: false,
            init() {
                if (this.province) {
                    this.fetchCities(true);
                }
            },
            fetchCities(isInit = false) {
                if (!this.province) {
                    this.cities = [];
                    this.city = '';
                    return;
                }
                this.isLoading = true;
                let oldCity = this.city;
                fetch('/api/provinces/' + this.province + '/cities')
                    .then(res => res.json())
                    .then(data => {
                        this.cities = data;
                        if (!isInit) {
                            this.city = '';
                        } else {
                            this.$nextTick(() => {
                                this.city = oldCity;
                            });
                        }
                        this.isLoading = false;
                    });
            }
        }
    }
</script>
@endsection
