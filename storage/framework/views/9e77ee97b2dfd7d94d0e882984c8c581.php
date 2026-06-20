<?php $__env->startSection('title', 'Daftar Pelamar'); ?>

<?php $__env->startSection('content'); ?>
    <div style="margin-bottom: 28px;">
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Daftar Pelamar</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Kelola dan seleksi kandidat magang terbaik.</p>
    </div>

    <!-- Filter -->
    <form action="/perusahaan/pelamar" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 24px;">
        <select name="lowongan_id" onchange="this.form.submit()" class="form-select" style="width: auto; min-width: 200px; border-radius: 9999px; padding: 9px 40px 9px 16px;">
            <option value="">Semua Lowongan</option>
            <?php $__currentLoopData = $lowongans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $low): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($low->id); ?>" <?php echo e(request('lowongan_id') == $low->id ? 'selected' : ''); ?>><?php echo e($low->title); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <select name="status" onchange="this.form.submit()" class="form-select" style="width: auto; min-width: 150px; border-radius: 9999px; padding: 9px 40px 9px 16px;">
            <option value="">Semua Status</option>
            <?php $__currentLoopData = ['dikirim', 'dilihat', 'seleksi', 'interview', 'diterima', 'ditolak', 'dibatalkan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($s); ?>" <?php echo e(request('status') === $s ? 'selected' : ''); ?>><?php echo e(ucfirst($s)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </form>

    <?php $__empty_1 = true; $__currentLoopData = $lamarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lamaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="applicant-row" style="margin-bottom: 12px;">
            <div class="avatar-initials"><?php echo e(strtoupper(substr($lamaran->mahasiswa->name, 0, 1))); ?></div>
            <div style="flex: 1; min-width: 0;">
                <p style="font-size: 14px; font-weight: 600; color: var(--color-ink);"><?php echo e($lamaran->mahasiswa->name); ?></p>
                <p style="font-size: 12px; color: var(--color-graphite);"><?php echo e($lamaran->lowongan->title); ?> · <?php echo e($lamaran->created_at->diffForHumans()); ?></p>
                <?php
                    $matchPct = $lamaran->mahasiswa->skillMatchPercentage($lamaran->lowongan);
                ?>
                <?php if($matchPct > 0): ?>
                    <span class="badge <?php echo e($matchPct >= 80 ? 'badge-skill-match-high' : ($matchPct >= 50 ? 'badge-skill-match-mid' : 'badge-skill-match-low')); ?>" style="font-size: 11px; margin-top: 4px;">⚡ <?php echo e($matchPct); ?>% Match</span>
                <?php endif; ?>
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <span class="badge status-<?php echo e($lamaran->status); ?>" style="font-size: 12px;"><?php echo e($lamaran->status_label); ?></span>
                <a href="/perusahaan/pelamar/<?php echo e($lamaran->id); ?>" class="btn-outline" style="font-size: 13px; padding: 7px 16px;">Lihat Detail</a>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="empty-state">
            <div class="empty-state-card">
                <h3>Belum ada pelamar</h3>
                <p>Belum ada mahasiswa yang melamar lowonganmu.</p>
            </div>
        </div>
    <?php endif; ?>

    <div style="margin-top: 24px;"><?php echo e($lamarans->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.perusahaan', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/perusahaan/pelamar/index.blade.php ENDPATH**/ ?>