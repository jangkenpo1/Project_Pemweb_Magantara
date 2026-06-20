<?php $__env->startSection('title', 'Notifikasi'); ?>

<?php $__env->startSection('content'); ?>
<div style="padding: 40px 0 60px;">
    <div class="page-container" style="max-width: 800px;">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
            <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink);">Notifikasi</h1>
        </div>

        <div class="card" style="padding: 0; overflow: hidden;">
            <?php $__empty_1 = true; $__currentLoopData = $notifikasis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e($notif->url ?? '#'); ?>" class="notif-item" style="display: block; padding: 20px; border-bottom: 1px solid rgba(163,166,175,0.2); text-decoration: none; transition: background 0.15s; background: <?php echo e($notif->status === 'belum_dibaca' ? '#f0f5ff' : 'transparent'); ?>;">
                    <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 16px;">
                        <div>
                            <h3 style="font-size: 15px; font-weight: 600; color: var(--color-ink); margin-bottom: 4px;">
                                <?php if($notif->status === 'belum_dibaca'): ?>
                                    <span class="notif-dot" style="margin-right: 6px; transform: translateY(-1px);"></span>
                                <?php endif; ?>
                                <?php echo e($notif->judul); ?>

                            </h3>
                            <p style="font-size: 14px; color: var(--color-ash); line-height: 1.5;"><?php echo e($notif->isi); ?></p>
                        </div>
                        <span style="font-size: 12px; color: var(--color-graphite); white-space: nowrap;"><?php echo e($notif->created_at->diffForHumans()); ?></span>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="padding: 48px; text-align: center;">
                    <p style="font-size: 14px; color: var(--color-graphite);">Belum ada notifikasi.</p>
                </div>
            <?php endif; ?>
        </div>

        <div style="margin-top: 24px;"><?php echo e($notifikasis->links()); ?></div>
    </div>
</div>

<style>
    .notif-item:hover {
        background: var(--color-fog) !important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/mahasiswa/notifikasi/index.blade.php ENDPATH**/ ?>