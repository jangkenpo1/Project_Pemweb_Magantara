<?php $__env->startSection('title', 'Lowongan Saya'); ?>

<?php $__env->startSection('content'); ?>
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 32px;">
        <div>
            <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 4px;">Lowongan Saya</h1>
            <p style="font-size: 14px; color: var(--color-graphite);">Kelola semua lowongan magang yang kamu pasang.</p>
        </div>
        <?php if(auth('perusahaan')->user()->isVerified()): ?>
            <a href="/perusahaan/lowongan/create" class="btn-primary">+ Buat Lowongan</a>
        <?php endif; ?>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $lowongans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lowongan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="applicant-row" style="margin-bottom: 12px; flex-wrap: wrap; gap: 12px;">
            <div style="flex: 1; min-width: 0;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 4px;">
                    <a href="/lowongan/<?php echo e($lowongan->id); ?>" style="font-size: 15px; font-weight: 600; color: var(--color-ink); text-decoration: none;"><?php echo e($lowongan->title); ?></a>
                    <span class="badge status-<?php echo e($lowongan->status); ?>" style="font-size: 11px;"><?php echo e(ucfirst($lowongan->status)); ?></span>
                </div>
                <p style="font-size: 12px; color: var(--color-graphite);"><?php echo e($lowongan->lamarans_count); ?> pelamar · Deadline <?php echo e($lowongan->deadline->format('d M Y')); ?> · <?php echo e($lowongan->work_system_label); ?> · <?php echo e($lowongan->payment_type_label); ?></p>
            </div>
            <div style="display: flex; gap: 8px;">
                <a href="/perusahaan/pelamar?lowongan_id=<?php echo e($lowongan->id); ?>" class="btn-ghost" style="font-size: 13px;">👥 <?php echo e($lowongan->lamarans_count); ?></a>
                <a href="/perusahaan/lowongan/<?php echo e($lowongan->id); ?>/edit" class="btn-outline" style="font-size: 13px; padding: 7px 16px;">Edit</a>
                <form method="POST" action="/perusahaan/lowongan/<?php echo e($lowongan->id); ?>" onsubmit="return confirm('Hapus lowongan ini?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn-danger" style="font-size: 13px; padding: 8px 14px;">Hapus</button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="empty-state">
            <div class="empty-state-card">
                <h3>Belum ada lowongan</h3>
                <p>Mulai rekrut peserta magang terbaik dengan membuat lowongan pertamamu.</p>
                <?php if(auth('perusahaan')->user()->isVerified()): ?>
                    <a href="/perusahaan/lowongan/create" class="btn-primary" style="margin-top: 20px;">Buat Lowongan Pertama</a>
                <?php else: ?>
                    <p style="font-size: 12px; color: #854d0e; background: #fef9c3; padding: 10px 14px; border-radius: 10px; margin-top: 16px;">Akun belum diverifikasi. Lengkapi profil dan tunggu verifikasi admin.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div style="margin-top: 24px;"><?php echo e($lowongans->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.perusahaan', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/perusahaan/lowongan/index.blade.php ENDPATH**/ ?>