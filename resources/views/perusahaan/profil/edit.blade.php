@extends('layouts.perusahaan')

@section('title', 'Edit Profil Perusahaan')

@section('content')
    <div style="margin-bottom: 32px; max-width: 720px;">
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Profil Perusahaan</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Lengkapi profil untuk mendapatkan verifikasi dari tim MaganTara.</p>
    </div>

    <form method="POST" action="/perusahaan/profil" enctype="multipart/form-data" style="max-width: 720px;">
        @csrf

        <!-- Logo & Identity -->
        <div class="card" style="margin-bottom: 20px;">
            <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 20px;">Identitas Perusahaan</h2>
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 24px;">
                @if($perusahaan->logo)
                    <img src="{{ Storage::url($perusahaan->logo) }}" style="width: 64px; height: 64px; border-radius: 12px; object-fit: cover;">
                @else
                    <div style="width: 64px; height: 64px; border-radius: 12px; background: var(--color-fog); border: 1px solid var(--color-dove); display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 700; color: var(--color-ink);">{{ strtoupper(substr($perusahaan->name, 0, 1)) }}</div>
                @endif
                <div>
                    <label class="form-label">Logo Perusahaan</label>
                    <input type="file" name="logo" accept="image/*" style="font-size: 13px; color: var(--color-ash);">
                    <p style="font-size: 11px; color: var(--color-dove); margin-top: 4px;">JPG, PNG. Maks 2MB.</p>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div>
                    <label class="form-label">Nama Perusahaan *</label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', $perusahaan->name) }}" required>
                    @error('name')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="form-label">Email Perusahaan *</label>
                    <input type="email" name="email" class="form-input" value="{{ old('email', $perusahaan->email) }}" required>
                    @error('email')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="form-label">Bidang Industri</label>
                    <select name="industry_id" class="form-select">
                        <option value="">Pilih industri...</option>
                        @foreach($industries as $ind)
                            <option value="{{ $ind->id }}" {{ old('industry_id', $perusahaan->industry_id) == $ind->id ? 'selected' : '' }}>{{ $ind->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Website</label>
                    <input type="url" name="website_url" class="form-input" value="{{ old('website_url', $perusahaan->website_url) }}" placeholder="https://perusahaan.com">
                </div>
                <div>
                    <label class="form-label">Skala Karyawan</label>
                    <select name="employee_scale" class="form-select">
                        <option value="">Pilih skala...</option>
                        @foreach(['1-50', '51-200', '201-500', '501-1000', '1000+'] as $scale)
                            <option value="{{ $scale }}" {{ old('employee_scale', $perusahaan->employee_scale) === $scale ? 'selected' : '' }}>{{ $scale }} karyawan</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="card" style="margin-bottom: 20px;">
            <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 16px;">Deskripsi</h2>
            <textarea name="description" class="form-textarea" placeholder="Ceritakan tentang perusahaan Anda, visi misi, budaya kerja..." style="min-height: 120px;">{{ old('description', $perusahaan->description) }}</textarea>
        </div>

        <div class="card" style="margin-bottom: 20px;" x-data="locationDropdown('{{ old('province_id', $perusahaan->province_id) }}', '{{ old('city_id', $perusahaan->city_id) }}')">
            <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 16px;">Lokasi</h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div>
                    <label class="form-label">Provinsi</label>
                    <select name="province_id" class="form-select" x-model="province" @change="fetchCities()">
                        <option value="">Pilih provinsi...</option>
                        @foreach($provinces as $prov)
                            <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Kota/Kabupaten</label>
                    <select name="city_id" class="form-select" x-model="city" :disabled="!province || isLoading">
                        <option value="">Pilih kota...</option>
                        <template x-for="c in cities" :key="c.id">
                            <option :value="c.id" x-text="c.name"></option>
                        </template>
                    </select>
                </div>
                <div style="grid-column: span 2;">
                    <label class="form-label">Tautan Google Maps</label>
                    <input type="url" name="office_address" class="form-input" value="{{ old('office_address', $perusahaan->office_address) }}" placeholder="https://maps.app.goo.gl/..." required>
                    <p style="font-size: 11px; color: var(--color-dove); margin-top: 4px;">Buka lokasi kantor Anda di Google Maps, klik Bagikan (Share), lalu Salin Link (Copy Link).</p>
                </div>
            </div>
        </div>

        <!-- Dokumen Legal -->
        <div class="card" style="margin-bottom: 20px;">
            <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 16px;">Dokumen Legal (Wajib untuk Verifikasi)</h2>
            <div style="display: flex; align-items: flex-start; gap: 20px;">
                @if($perusahaan->legal_document_path)
                    <div style="width: 64px; height: 64px; border-radius: 12px; background: var(--color-fog); border: 1px solid var(--color-dove); display: flex; align-items: center; justify-content: center; font-size: 24px; color: var(--color-ink);">
                        📄
                    </div>
                @endif
                <div>
                    <label class="form-label">Unggah NIB / NPWP Perusahaan</label>
                    <input type="file" name="legal_document" accept="application/pdf,image/*" style="font-size: 13px; color: var(--color-ash);">
                    <p style="font-size: 11px; color: var(--color-dove); margin-top: 4px;">PDF, JPG, PNG. Maks 5MB.</p>
                    @if($perusahaan->legal_document_path)
                        <a href="{{ Storage::url($perusahaan->legal_document_path) }}" target="_blank" style="font-size: 12px; font-weight: 500; color: var(--color-sky); text-decoration: none; display: inline-block; margin-top: 8px;">Lihat Dokumen Tersimpan</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Status verification alert -->
        @if($perusahaan->status_verification === 'unverified')
            <div style="background: #f1f5f9; border-radius: 12px; border: 1px solid #cbd5e1; padding: 16px; margin-bottom: 20px;">
                <p style="font-size: 14px; font-weight: 600; color: var(--color-ink); margin-bottom: 4px;">Belum Terverifikasi</p>
                <p style="font-size: 13px; color: var(--color-graphite); margin-bottom: 12px;">Profil Anda belum diajukan untuk verifikasi. Anda belum bisa mempublikasikan lowongan magang. Lengkapi profil dan dokumen legal, lalu centang kotak di bawah untuk mengajukan.</p>
                <label style="display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 500; color: var(--color-ink); cursor: pointer;">
                    <input type="checkbox" name="submit_verification" value="1" style="width: 16px; height: 16px; accent-color: var(--color-ink);"> Ajukan Verifikasi ke Admin
                </label>
            </div>
        @elseif($perusahaan->status_verification === 'rejected')
            <div style="background: #fee2e2; border-radius: 12px; border: 1px solid #fca5a5; padding: 16px; margin-bottom: 20px;">
                <p style="font-size: 14px; color: #991b1b; font-weight: 600; margin-bottom: 4px;">Verifikasi Ditolak</p>
                @if($perusahaan->verification_notes)
                    <div style="background: white; padding: 12px; border-radius: 8px; font-size: 13px; color: #7f1d1d; margin-bottom: 12px; border: 1px solid #fecaca;">
                        <strong>Alasan Penolakan:</strong><br>
                        {{ $perusahaan->verification_notes }}
                    </div>
                @else
                    <p style="font-size: 13px; color: #991b1b; margin-bottom: 12px;">Perbaiki profil dan dokumen Anda sesuai panduan.</p>
                @endif
                <label style="display: flex; align-items: center; gap: 8px; font-size: 14px; font-weight: 500; color: #991b1b; cursor: pointer;">
                    <input type="checkbox" name="submit_verification" value="1" style="width: 16px; height: 16px; accent-color: #991b1b;"> Ajukan Ulang Verifikasi setelah menyimpan
                </label>
            </div>
        @elseif($perusahaan->status_verification === 'pending')
            <div style="background: #fef9c3; border-radius: 12px; border: 1px solid #fde047; padding: 14px 18px; margin-bottom: 20px;">
                <p style="font-size: 13px; color: #854d0e;">⏳ Sedang direview oleh Admin. Anda akan mendapatkan notifikasi setelah proses selesai.</p>
            </div>
        @elseif($perusahaan->status_verification === 'verified')
            <div style="background: #dcfce7; border-radius: 12px; border: 1px solid #86efac; padding: 14px 18px; margin-bottom: 20px;">
                <p style="font-size: 13px; color: #15803d;">✓ Perusahaan Anda telah terverifikasi. Anda dapat membuat lowongan magang.</p>
            </div>
        @endif

        <div style="display: flex; gap: 12px;">
            <button type="submit" class="btn-primary" style="padding: 13px 32px;">Simpan Perubahan</button>
            <a href="/perusahaan/dashboard" class="btn-outline" style="padding: 13px 24px;">Batal</a>
        </div>
    </form>



    <script>
        function locationDropdown(initialProvince, initialCity) {
            return {
                province: initialProvince,
                city: initialCity ? parseInt(initialCity) : '',
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
                    fetch('/api/provinces/' + this.province + '/cities')
                        .then(res => res.json())
                        .then(data => {
                            this.cities = data;
                            if (isInit) {
                                setTimeout(() => {
                                    this.city = initialCity ? parseInt(initialCity) : '';
                                }, 50);
                            } else {
                                this.city = '';
                            }
                        })
                        .finally(() => {
                            this.isLoading = false;
                        });
                }
            }
        }
    </script>
@endsection
