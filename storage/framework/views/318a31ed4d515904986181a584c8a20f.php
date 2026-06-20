<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 32px;">
    <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Admin Dashboard</h1>
    <p style="font-size: 14px; color: var(--color-graphite);">Ringkasan statistik dan aktivitas platform MaganTara.</p>
</div>

<!-- Stats -->
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 32px;">
    <div class="stat-card">
        <div style="width: 40px; height: 40px; border-radius: 12px; background: white; border: 1.5px solid var(--color-ink); color: var(--color-ink); display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
        </div>
        <p class="stat-number" style="font-size: 32px;"><?php echo e($stats['total_mahasiswa']); ?></p>
        <p class="stat-label">Total Mahasiswa</p>
    </div>
    <div class="stat-card">
        <div style="width: 40px; height: 40px; border-radius: 12px; background: white; border: 1.5px solid var(--color-ink); color: var(--color-ink); display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/></svg>
        </div>
        <p class="stat-number" style="font-size: 32px;"><?php echo e($stats['total_perusahaan']); ?></p>
        <p class="stat-label">Total Perusahaan</p>
    </div>
    <div class="stat-card">
        <div style="width: 40px; height: 40px; border-radius: 12px; background: white; border: 1.5px solid var(--color-ink); color: var(--color-ink); display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
        </div>
        <p class="stat-number" style="font-size: 32px;"><?php echo e($stats['total_lowongan']); ?></p>
        <p class="stat-label">Total Lowongan</p>
    </div>
    <div class="stat-card">
        <div style="width: 40px; height: 40px; border-radius: 12px; background: white; border: 1.5px solid var(--color-ink); color: var(--color-ink); display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        </div>
        <p class="stat-number" style="font-size: 32px;"><?php echo e($stats['total_lamaran']); ?></p>
        <p class="stat-label">Total Lamaran</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
    
    <!-- Perusahaan Menunggu Verifikasi -->
    <div class="card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink);">Menunggu Verifikasi</h2>
            <a href="/admin/perusahaan?status=pending" class="btn-ghost" style="font-size: 12px;">Lihat Semua →</a>
        </div>
        <?php if($stats['pending_verify'] > 0): ?>
            <div style="background: #fef9c3; border-radius: 12px; padding: 12px 16px; margin-bottom: 16px; font-size: 13px; color: #854d0e;">
                Terdapat <strong><?php echo e($stats['pending_verify']); ?></strong> perusahaan menunggu verifikasi.
            </div>
        <?php endif; ?>
        
        <?php $__empty_1 = true; $__currentLoopData = $perusahaanPending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="display: flex; align-items: center; gap: 12px; padding: 12px 0; border-bottom: 1px solid rgba(163,166,175,0.2);">
                <div class="company-logo" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; color: var(--color-ink); overflow: hidden;">
                    <?php if($p->logo): ?>
                        <img src="<?php echo e(Storage::url($p->logo)); ?>" alt="<?php echo e($p->name); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    <?php else: ?>
                        <?php echo e(strtoupper(substr($p->name, 0, 1))); ?>

                    <?php endif; ?>
                </div>
                <div style="flex: 1; min-width: 0;">
                    <a href="/admin/perusahaan/<?php echo e($p->id); ?>" style="font-size: 14px; font-weight: 500; color: var(--color-ink); text-decoration: none;"><?php echo e($p->name); ?></a>
                    <p style="font-size: 12px; color: var(--color-graphite);"><?php echo e($p->industry->name ?? 'Belum ada industri'); ?></p>
                </div>
                <form method="POST" action="/admin/perusahaan/<?php echo e($p->id); ?>/verify" style="display: inline-block;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-primary" style="font-size: 11px; padding: 6px 12px;">Verifikasi</button>
                </form>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="font-size: 14px; color: var(--color-graphite); text-align: center; padding: 24px;">Tidak ada perusahaan yang menunggu verifikasi.</p>
        <?php endif; ?>
    </div>

    <!-- Lowongan Terbaru -->
    <div class="card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink);">Lowongan Terbaru</h2>
            <a href="/admin/lowongan" class="btn-ghost" style="font-size: 12px;">Lihat Semua →</a>
        </div>
        <?php $__empty_1 = true; $__currentLoopData = $lowonganTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lowongan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="display: flex; align-items: center; gap: 12px; padding: 12px 0; border-bottom: 1px solid rgba(163,166,175,0.2);">
                <div style="flex: 1; min-width: 0;">
                    <p style="font-size: 14px; font-weight: 500; color: var(--color-ink);"><?php echo e($lowongan->title); ?></p>
                    <p style="font-size: 12px; color: var(--color-graphite);"><?php echo e($lowongan->perusahaan->name); ?></p>
                </div>
                <span class="badge <?php echo e($lowongan->status === 'published' ? 'badge-apricot' : 'badge-fog'); ?>" style="font-size: 11px;">
                    <?php echo e(ucfirst($lowongan->status)); ?>

                </span>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="font-size: 14px; color: var(--color-graphite); text-align: center; padding: 24px;">Belum ada lowongan.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>