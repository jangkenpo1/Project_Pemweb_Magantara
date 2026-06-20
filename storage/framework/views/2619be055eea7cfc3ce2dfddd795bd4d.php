<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Admin Panel'); ?> — MaganTara</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body style="background: var(--color-fog); min-height: 100vh; display: flex; flex-direction: column;">

    <nav class="navbar">
        <div class="navbar-inner">
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="/admin/dashboard" class="logo-text">MaganTara</a>
                <span style="font-size: 12px; font-weight: 600; color: white; background: var(--color-ink); padding: 3px 10px; border-radius: 9999px;">Admin</span>
            </div>
            <div style="display: flex; align-items: center; gap: 12px;">
                <span style="font-size: 14px; color: var(--color-ash);"><?php echo e(auth('admin')->user()->name); ?></span>
                <form method="POST" action="/admin/logout">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-ghost" style="font-size: 13px;">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <div style="display: flex; flex: 1;">
        <aside class="sidebar">
            <p style="font-size: 10px; font-weight: 600; color: var(--color-dove); text-transform: uppercase; letter-spacing: 0.1em; padding: 0 14px; margin-bottom: 8px;">Overview</p>
            <nav>
                <a href="/admin/dashboard" class="sidebar-link <?php echo e(request()->is('admin/dashboard') ? 'active' : ''); ?>">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    Dashboard
                </a>
            </nav>
            <p style="font-size: 10px; font-weight: 600; color: var(--color-dove); text-transform: uppercase; letter-spacing: 0.1em; padding: 16px 14px 8px; margin: 0;">Manajemen</p>
            <nav>
                <a href="/admin/perusahaan" class="sidebar-link <?php echo e(request()->is('admin/perusahaan*') ? 'active' : ''); ?>">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    Perusahaan
                </a>
                <a href="/admin/mahasiswa" class="sidebar-link <?php echo e(request()->is('admin/mahasiswa*') ? 'active' : ''); ?>">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Mahasiswa
                </a>
                <a href="/admin/lowongan" class="sidebar-link <?php echo e(request()->is('admin/lowongan*') ? 'active' : ''); ?>">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
                    Lowongan
                </a>
            </nav>
            <p style="font-size: 10px; font-weight: 600; color: var(--color-dove); text-transform: uppercase; letter-spacing: 0.1em; padding: 16px 14px 8px; margin: 0;">Master Data</p>
            <nav>
                <a href="/admin/master/skill" class="sidebar-link <?php echo e(request()->is('admin/master/skill*') ? 'active' : ''); ?>">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    Skill
                </a>
                <a href="/admin/master/industri" class="sidebar-link <?php echo e(request()->is('admin/master/industri*') ? 'active' : ''); ?>">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                    Bidang Industri
                </a>
                <a href="/admin/master/universitas" class="sidebar-link <?php echo e(request()->is('admin/master/universitas*') ? 'active' : ''); ?>">
                    <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    Universitas
                </a>
            </nav>
        </aside>

        <main style="flex: 1; padding: 32px; overflow: auto;">
            <?php if(session('success')): ?>
                <div style="background: #dcfce7; border: 1px solid #bbf7d0; border-radius: 12px; padding: 12px 16px; font-size: 14px; color: #15803d; margin-bottom: 24px;"><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div style="background: #fee2e2; border: 1px solid #fecaca; border-radius: 12px; padding: 12px 16px; font-size: 14px; color: #991b1b; margin-bottom: 24px;"><?php echo e(session('error')); ?></div>
            <?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

</body>
</html>
<?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/layouts/admin.blade.php ENDPATH**/ ?>