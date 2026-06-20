<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Login') — MaganTara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background: var(--color-fog); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px;">
    <div style="width: 100%; max-width: 460px;">

        <!-- Logo -->
        <div style="text-align: center; margin-bottom: 32px;">
            <a href="/" class="logo-text" style="font-size: 24px;">MaganTara</a>
            <p style="font-size: 13px; color: var(--color-graphite); margin-top: 6px;">@yield('auth-subtitle', 'Masuk ke akun Anda')</p>
        </div>

        <!-- Card -->
        <div class="card">
            @if (session('error'))
                <div style="background: #fee2e2; color: #991b1b; padding: 12px 16px; border-radius: 12px; font-size: 13px; margin-bottom: 20px;">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div style="background: #dcfce7; color: #15803d; padding: 12px 16px; border-radius: 12px; font-size: 13px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </div>

        <!-- Links -->
        <div style="text-align: center; margin-top: 20px;">
            @yield('auth-links')
        </div>
    </div>
</body>
</html>
