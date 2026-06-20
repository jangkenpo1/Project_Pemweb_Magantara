<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — MaganTara Perusahaan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body style="background: var(--color-fog); min-height: 100vh; display: flex; flex-direction: column;">

    <!-- Topbar -->
    <nav class="navbar">
        <div class="navbar-inner">
            <div style="display: flex; align-items: center; gap: 32px;">
                <a href="/perusahaan/dashboard" class="logo-text">MaganTara</a>
                <span style="font-size: 12px; font-weight: 500; color: var(--color-graphite); background: var(--color-fog); padding: 3px 10px; border-radius: 9999px; border: 1px solid var(--color-dove);">Perusahaan</span>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <a href="/perusahaan/notifikasi" style="display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 9999px; color: var(--color-ash); transition: background 0.15s ease;" onmouseover="this.style.background='var(--color-fog)'" onmouseout="this.style.background='transparent'">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                </a>
                <div style="display: flex; align-items: center; gap: 8px;">
                    @if(auth('perusahaan')->user()->logo)
                        <img src="{{ Storage::url(auth('perusahaan')->user()->logo) }}" alt="Logo" class="company-logo">
                    @else
                        <div style="width:40px;height:40px;border-radius:12px;background:var(--color-fog);border:1px solid var(--color-dove);display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--color-ink);font-size:16px;">{{ strtoupper(substr(auth('perusahaan')->user()->name, 0, 1)) }}</div>
                    @endif
                    <span style="font-size: 14px; font-weight: 500; color: var(--color-ash);">{{ auth('perusahaan')->user()->name }}</span>
                </div>
                <form method="POST" action="/perusahaan/logout" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-ghost" style="font-size: 13px;">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <div style="display: flex; flex: 1;">
        <!-- Sidebar -->
        <aside class="sidebar">
            @php $perusahaan = auth('perusahaan')->user(); @endphp

            @if($perusahaan->status_verification !== 'verified')
                <div class="verification-banner" style="margin-bottom: 20px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-rust)" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    <div>
                        <p style="font-size: 12px; font-weight: 600; color: var(--color-rust); margin: 0;">{{ $perusahaan->status_verification === 'pending' ? 'Menunggu Verifikasi' : 'Verifikasi Ditolak' }}</p>
                        <p style="font-size: 11px; color: var(--color-rust); margin: 2px 0 0; opacity: 0.8;">Lengkapi profil untuk memposting lowongan</p>
                    </div>
                </div>
            @endif

            <nav>
                <a href="/perusahaan/dashboard" class="sidebar-link {{ request()->is('perusahaan/dashboard') ? 'active' : '' }}">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    Dashboard
                </a>
                <a href="/perusahaan/lowongan" class="sidebar-link {{ request()->is('perusahaan/lowongan*') ? 'active' : '' }}">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
                    Lowongan Saya
                </a>
                <a href="/perusahaan/pelamar" class="sidebar-link {{ request()->is('perusahaan/pelamar*') ? 'active' : '' }}">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Pelamar
                </a>
                <a href="/perusahaan/profil" class="sidebar-link {{ request()->is('perusahaan/profil*') ? 'active' : '' }}">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Profil Perusahaan
                </a>
            </nav>
        </aside>

        <!-- Main -->
        <main style="flex: 1; padding: 32px; overflow: auto;">
            @if(session('success'))
                <div style="background: #dcfce7; border: 1px solid #bbf7d0; border-radius: 12px; padding: 12px 16px; font-size: 14px; color: #15803d; margin-bottom: 24px;">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div style="background: #fee2e2; border: 1px solid #fecaca; border-radius: 12px; padding: 12px 16px; font-size: 14px; color: #991b1b; margin-bottom: 24px;">{{ session('error') }}</div>
            @endif
            @yield('content')
        </main>
    </div>

</body>
</html>
