<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> — MaganTara</title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Dashboard Mahasiswa MaganTara'); ?>">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body style="background: var(--color-fog); min-height: 100vh;">

    <!-- Topbar -->
    <nav class="navbar">
        <div class="navbar-inner">
            <div style="display: flex; align-items: center; gap: 32px;">
                <a href="/mahasiswa/dashboard" class="logo-text">MaganTara</a>
                <div style="display: flex; gap: 4px;">
                    <a href="/lowongan" class="nav-link <?php echo e(request()->is('lowongan*') ? 'active' : ''); ?>">Cari Magang</a>
                    <a href="/mahasiswa/wishlist" class="nav-link <?php echo e(request()->is('mahasiswa/wishlist*') ? 'active' : ''); ?>">Wishlist</a>
                    <a href="/mahasiswa/lamaran" class="nav-link <?php echo e(request()->is('mahasiswa/lamaran*') ? 'active' : ''); ?>">Lamaran Saya</a>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <!-- Notif -->
                <a href="/mahasiswa/notifikasi" style="position: relative; display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 9999px; color: var(--color-ash); transition: background 0.15s ease;" onmouseover="this.style.background='var(--color-fog)'" onmouseout="this.style.background='transparent'">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                </a>
                <!-- Avatar dropdown -->
                <div style="position: relative;" x-data="{ open: false }">
                    <button @click="open = !open" style="display: flex; align-items: center; gap: 8px; background: none; border: none; cursor: pointer; padding: 4px;">
                        <?php if(auth('mahasiswa')->user()->avatar): ?>
                            <img src="<?php echo e(Storage::url(auth('mahasiswa')->user()->avatar)); ?>" alt="Avatar" class="avatar">
                        <?php else: ?>
                            <div class="avatar-initials"><?php echo e(strtoupper(substr(auth('mahasiswa')->user()->name, 0, 1))); ?></div>
                        <?php endif; ?>
                        <span style="font-size: 14px; font-weight: 500; color: var(--color-ash);"><?php echo e(auth('mahasiswa')->user()->name); ?></span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div x-show="open" @click.outside="open = false" style="position: absolute; right: 0; top: calc(100% + 8px); background: white; border-radius: 16px; box-shadow: var(--shadow-card); min-width: 180px; overflow: hidden; z-index: 100;">
                        <a href="/mahasiswa/profil" style="display: flex; align-items: center; gap: 10px; padding: 12px 16px; font-size: 14px; color: var(--color-ash); text-decoration: none; transition: background 0.15s;" onmouseover="this.style.background='var(--color-fog)'" onmouseout="this.style.background='white'">Profil Saya</a>
                        <div class="divider" style="margin: 0;"></div>
                        <form method="POST" action="/mahasiswa/logout">
                            <?php echo csrf_field(); ?>
                            <button type="submit" style="display: flex; align-items: center; gap: 10px; padding: 12px 16px; font-size: 14px; color: #dc2626; background: none; border: none; width: 100%; text-align: left; cursor: pointer; transition: background 0.15s;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='none'">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page -->
    <main>
        <?php if(session('success')): ?>
            <div style="background: #dcfce7; border-bottom: 1px solid #bbf7d0; padding: 12px 24px; text-align: center; font-size: 14px; color: #15803d;"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div style="background: #fee2e2; border-bottom: 1px solid #fecaca; padding: 12px 24px; text-align: center; font-size: 14px; color: #991b1b;"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

</body>
</html>
<?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/layouts/app.blade.php ENDPATH**/ ?>