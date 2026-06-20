@extends(auth('mahasiswa')->check() ? 'layouts.app' : (auth('perusahaan')->check() ? 'layouts.perusahaan' : (auth('admin')->check() ? 'layouts.admin' : 'layouts.guest')))

@section('title', 'Cari Lowongan Magang')

@section('content')
<div style="padding: 40px 0 60px;">
    <div class="page-container">

        <!-- Header -->
        <div style="margin-bottom: 36px;">
            <h1 style="font-family: var(--font-serif); font-size: 36px; font-weight: 500; color: var(--color-ink); margin-bottom: 8px;">Cari Lowongan Magang</h1>
            <p style="font-size: 15px; color: var(--color-ash);">{{ $lowongans->total() }} lowongan tersedia untuk kamu</p>
        </div>

        <!-- Search bar -->
        <div style="margin-bottom: 28px;">
            <form action="/lowongan" method="GET">
                <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                    <div class="search-bar" style="flex: 1; min-width: 280px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-dove)" stroke-width="2" style="margin-left: 16px; flex-shrink: 0;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Posisi, perusahaan, atau keyword...">
                        <button type="submit">Cari</button>
                    </div>
                    <!-- Quick filters -->
                    <select name="work_system" onchange="this.form.submit()" class="form-select" style="width: auto; min-width: 140px; border-radius: 9999px; padding: 10px 40px 10px 16px;">
                        <option value="">Sistem Kerja</option>
                        <option value="remote" {{ request('work_system') === 'remote' ? 'selected' : '' }}>Remote</option>
                        <option value="hybrid" {{ request('work_system') === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        <option value="onsite" {{ request('work_system') === 'onsite' ? 'selected' : '' }}>On-Site</option>
                    </select>
                    <select name="payment_type" onchange="this.form.submit()" class="form-select" style="width: auto; min-width: 130px; border-radius: 9999px; padding: 10px 40px 10px 16px;">
                        <option value="">Jenis Magang</option>
                        <option value="paid" {{ request('payment_type') === 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="unpaid" {{ request('payment_type') === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    </select>
                    <select name="industri" onchange="this.form.submit()" class="form-select" style="width: auto; min-width: 150px; border-radius: 9999px; padding: 10px 40px 10px 16px;">
                        <option value="">Industri</option>
                        @foreach($industries as $ind)
                            <option value="{{ $ind->id }}" {{ request('industri') == $ind->id ? 'selected' : '' }}>{{ $ind->name }}</option>
                        @endforeach
                    </select>
                    @if(request()->hasAny(['q', 'work_system', 'payment_type', 'industri', 'skill', 'provinsi']))
                        <a href="/lowongan" class="btn-ghost" style="font-size: 13px; color: var(--color-graphite);">Hapus Filter ×</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Grid -->
        @forelse($lowongans as $lowongan)
            <a href="/lowongan/{{ $lowongan->id }}" class="job-card card-hover" style="display: flex; align-items: flex-start; gap: 16px; margin-bottom: 12px;">
                <div class="company-logo" style="display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px; color: var(--color-ink); width: 52px; height: 52px; flex-shrink: 0; overflow: hidden; border-radius: 8px;">
                    @if($lowongan->perusahaan->logo)
                        <img src="{{ Storage::url($lowongan->perusahaan->logo) }}" alt="{{ $lowongan->perusahaan->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        {{ strtoupper(substr($lowongan->perusahaan->name, 0, 1)) }}
                    @endif
                </div>
                <div style="flex: 1; min-width: 0;">
                    <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; flex-wrap: wrap; margin-bottom: 6px;">
                        <div>
                            <h2 style="font-family: var(--font-serif); font-size: 18px; font-weight: 500; color: var(--color-ink); margin-bottom: 2px;">{{ $lowongan->title }}</h2>
                            <p style="font-size: 13px; color: var(--color-graphite);">{{ $lowongan->perusahaan->name }}</p>
                        </div>
                        <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                            <span class="badge {{ $lowongan->work_system === 'remote' ? 'badge-sky' : 'badge-fog' }}">{{ $lowongan->work_system_label }}</span>
                            <span class="badge {{ $lowongan->payment_type === 'paid' ? 'badge-apricot' : 'badge-fog' }}">{{ $lowongan->payment_type_label }}</span>
                            <span class="badge badge-fog">{{ $lowongan->duration_months }} Bulan</span>
                        </div>
                    </div>
                    <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-top: 8px;">
                        @foreach($lowongan->skills->take(5) as $skill)
                            <span style="font-size: 11px; color: var(--color-graphite); background: var(--color-fog); padding: 3px 8px; border-radius: 6px;">{{ $skill->name }}</span>
                        @endforeach
                    </div>
                    <div style="display: flex; align-items: center; gap: 16px; margin-top: 12px; padding-top: 12px; border-top: 1px solid rgba(163,166,175,0.2);">
                        @if($lowongan->province)
                            <span style="font-size: 12px; color: var(--color-graphite); display: flex; align-items: center; gap: 4px;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                {{ $lowongan->city->name ?? $lowongan->province->name }}
                            </span>
                        @endif
                        <span style="font-size: 12px; color: var(--color-dove);">Deadline: {{ $lowongan->deadline->format('d M Y') }}</span>
                    </div>
                </div>
            </a>
        @empty
            <div class="empty-state">
                <div class="empty-state-card">
                    <h3>Tidak ada lowongan ditemukan</h3>
                    <p>Coba ubah filter pencarianmu atau gunakan kata kunci yang berbeda.</p>
                    <a href="/lowongan" class="btn-outline" style="margin-top: 20px;">Reset Filter</a>
                </div>
            </div>
        @endforelse

        <div style="margin-top: 32px;">{{ $lowongans->links() }}</div>
    </div>
</div>
@endsection
