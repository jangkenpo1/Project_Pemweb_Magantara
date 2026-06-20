<?php $__env->startSection('title', 'Wishlist'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-container" style="padding-top: 40px; padding-bottom: 60px;">
    <div style="margin-bottom: 32px;">
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Wishlist</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Lowongan yang kamu simpan untuk dilamar nanti.</p>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $bookmarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lowongan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="job-card" style="margin-bottom: 16px; display: flex; align-items: center; gap: 16px;">
            <div class="company-logo" style="display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px; color: var(--color-ink); width: 48px; height: 48px;">
                <?php echo e(strtoupper(substr($lowongan->perusahaan->name, 0, 1))); ?>

            </div>
            <div style="flex: 1; min-width: 0;">
                <a href="/lowongan/<?php echo e($lowongan->id); ?>" style="font-size: 16px; font-weight: 600; color: var(--color-ink); text-decoration: none;"><?php echo e($lowongan->title); ?></a>
                <p style="font-size: 13px; color: var(--color-graphite);"><?php echo e($lowongan->perusahaan->name); ?></p>
                <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-top: 8px;">
                    <span class="badge <?php echo e($lowongan->work_system === 'remote' ? 'badge-sky' : 'badge-fog'); ?>"><?php echo e($lowongan->work_system_label); ?></span>
                    <span class="badge <?php echo e($lowongan->payment_type === 'paid' ? 'badge-apricot' : 'badge-fog'); ?>"><?php echo e($lowongan->payment_type_label); ?></span>
                    <?php $__currentLoopData = $lowongan->skills->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="badge badge-fog" style="font-size: 11px;"><?php echo e($skill->name); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div style="display: flex; gap: 8px;">
                <a href="/lowongan/<?php echo e($lowongan->id); ?>" class="btn-outline" style="padding: 8px 18px; font-size: 13px;">Lihat Detail</a>
                <form method="POST" action="/mahasiswa/bookmark/<?php echo e($lowongan->id); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-ghost" style="font-size: 13px; color: #dc2626;" title="Hapus dari wishlist">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="#dc2626" stroke="none"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="empty-state">
            <div class="empty-state-card">
                <h3>Wishlist kosong</h3>
                <p>Simpan lowongan yang menarik dengan menekan tombol bookmark pada halaman detail lowongan.</p>
                <a href="/lowongan" class="btn-primary" style="margin-top: 20px;">Jelajahi Lowongan</a>
            </div>
        </div>
    <?php endif; ?>

    <div style="margin-top: 24px;"><?php echo e($bookmarks->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/mahasiswa/wishlist/index.blade.php ENDPATH**/ ?>