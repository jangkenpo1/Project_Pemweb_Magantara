<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'MaganTara') — MaganTara</title>
    <meta name="description" content="@yield('meta_description', 'Platform pencarian dan publikasi lowongan magang terpusat untuk mahasiswa Indonesia.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background: var(--color-fog); min-height: 100vh; display: flex; flex-direction: column;">

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="/" class="logo-text">MaganTara</a>
            <div style="display: flex; align-items: center; gap: 8px;">
                <a href="/mahasiswa/login" class="btn-ghost">Masuk</a>
                <a href="/mahasiswa/register" class="btn-primary" style="padding: 9px 20px; font-size: 13px;">Daftar Sekarang</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main style="flex: 1;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer style="background: var(--color-ink); color: var(--color-dove); padding: 40px 0; margin-top: auto;">
        <div class="page-container">
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px;">
                <span class="logo-text" style="color: white; font-size: 18px;">MaganTara</span>
                <p style="font-size: 13px; margin: 0;">© 2026 MaganTara. Platform magang terpercaya Indonesia.</p>
            </div>
        </div>
    </footer>

</body>
</html>
