<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-container" style="padding-top: 40px; padding-bottom: 60px;">

    <!-- Header -->
    <div style="margin-bottom: 32px; animation: fadeInUp 0.4s ease forwards;">
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">
            Hai, <?php echo e($mahasiswa->name); ?>!
        </h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Selamat datang kembali. Berikut ringkasan aktivitas magang Anda.</p>
    </div>

    <!-- Profile completion alert -->
    <?php if(!$mahasiswa->cv_path): ?>
        <div style="background: var(--color-apricot-wash); border-radius: 16px; padding: 16px 20px; display: flex; align-items: center; gap: 14px; margin-bottom: 28px; animation: fadeInUp 0.4s ease 0.1s both;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--color-rust)" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            <div style="flex: 1;">
                <p style="font-size: 14px; font-weight: 600; color: var(--color-rust); margin-bottom: 2px;">Profil belum lengkap</p>
                <p style="font-size: 13px; color: var(--color-ash);">Upload CV untuk mulai melamar lowongan magang.</p>
            </div>
            <a href="/mahasiswa/profil" class="btn-outline" style="padding: 8px 18px; font-size: 13px; border-color: var(--color-rust); color: var(--color-rust);">Lengkapi Profil</a>
        </div>
    <?php endif; ?>

    <!-- Stats -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 40px;" class="stagger-children">
        <!-- Card 1 -->
        <div class="stat-card animate-fade-in-up" style="padding: 20px;">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: white; border: 1.5px solid var(--color-ink); color: var(--color-ink); display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
            </div>
            <p class="stat-number" style="font-size: 28px;"><?php echo e($totalLamaran); ?></p>
            <p class="stat-label">Total Lamaran</p>
        </div>

        <!-- Card 2 -->
        <div class="stat-card animate-fade-in-up" style="padding: 20px;">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: white; border: 1.5px solid var(--color-ink); color: var(--color-ink); display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <p class="stat-number" style="font-size: 28px;"><?php echo e($lamaranProses); ?></p>
            <p class="stat-label">Sedang Diproses</p>
        </div>

        <!-- Card 3 -->
        <div class="stat-card animate-fade-in-up" style="padding: 20px;">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: white; border: 1.5px solid var(--color-ink); color: var(--color-ink); display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
            </div>
            <p class="stat-number" style="font-size: 28px;"><?php echo e($lamaranDiterima); ?></p>
            <p class="stat-label">Diterima</p>
        </div>

        <!-- Card 4 -->
        <div class="stat-card animate-fade-in-up" style="padding: 20px;">
            <div style="width: 40px; height: 40px; border-radius: 12px; background: white; border: 1.5px solid var(--color-ink); color: var(--color-ink); display: flex; align-items: center; justify-content: center; margin-bottom: 12px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"/></svg>
            </div>
            <p class="stat-number" style="font-size: 28px;"><?php echo e($totalBookmark); ?></p>
            <p class="stat-label">Wishlist</p>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">

        <!-- Recent Lamarans -->
        <div class="card">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink);">Lamaran Terbaru</h2>
                <a href="/mahasiswa/lamaran" class="btn-ghost" style="font-size: 12px;">Lihat Semua →</a>
            </div>
            <?php $__empty_1 = true; $__currentLoopData = $lamarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lamaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="applicant-row" style="margin-bottom: 12px;">
                    <div class="company-logo" style="display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; color: var(--color-ink); overflow: hidden;">
                        <?php if($lamaran->lowongan->perusahaan->logo): ?>
                            <img src="<?php echo e(Storage::url($lamaran->lowongan->perusahaan->logo)); ?>" alt="<?php echo e($lamaran->lowongan->perusahaan->name); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php else: ?>
                            <?php echo e(strtoupper(substr($lamaran->lowongan->perusahaan->name, 0, 1))); ?>

                        <?php endif; ?>
                    </div>
                    <div style="flex: 1; min-width: 0;">
                        <p style="font-size: 14px; font-weight: 500; color: var(--color-ink); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo e($lamaran->lowongan->title); ?></p>
                        <p style="font-size: 12px; color: var(--color-graphite);"><?php echo e($lamaran->lowongan->perusahaan->name); ?></p>
                    </div>
                    <span class="badge <?php echo e('status-' . $lamaran->status); ?>" style="font-size: 11px; padding: 3px 10px;"><?php echo e($lamaran->status_label); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty-state" style="min-height: 120px;">
                    <div style="text-align: center;">
                        <p style="font-size: 14px; color: var(--color-graphite);">Belum ada lamaran</p>
                        <a href="/lowongan" class="btn-ghost" style="margin-top: 8px; font-size: 13px;">Cari Lowongan →</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Recommended Lowongan -->
        <div class="card">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink);">Lowongan Terbaru</h2>
                <a href="/lowongan" class="btn-ghost" style="font-size: 12px;">Jelajahi →</a>
            </div>
            <?php $__empty_1 = true; $__currentLoopData = $lowonganTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lowongan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="/lowongan/<?php echo e($lowongan->id); ?>" style="display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid rgba(163,166,175,0.2); text-decoration: none;" onmouseover="this.style.background='var(--color-fog)'" onmouseout="this.style.background='transparent'">
                    <div class="company-logo" style="display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; color: var(--color-ink); overflow: hidden;">
                        <?php if($lowongan->perusahaan->logo): ?>
                            <img src="<?php echo e(Storage::url($lowongan->perusahaan->logo)); ?>" alt="<?php echo e($lowongan->perusahaan->name); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php else: ?>
                            <?php echo e(strtoupper(substr($lowongan->perusahaan->name, 0, 1))); ?>

                        <?php endif; ?>
                    </div>
                    <div style="flex: 1; min-width: 0;">
                        <p style="font-size: 14px; font-weight: 500; color: var(--color-ink); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo e($lowongan->title); ?></p>
                        <p style="font-size: 12px; color: var(--color-graphite);"><?php echo e($lowongan->perusahaan->name); ?></p>
                    </div>
                    <span class="badge <?php echo e($lowongan->payment_type === 'paid' ? 'badge-apricot' : 'badge-fog'); ?>" style="font-size: 11px; padding: 2px 8px;"><?php echo e($lowongan->payment_type_label); ?></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p style="font-size: 14px; color: var(--color-graphite); text-align: center; padding: 24px;">Belum ada lowongan tersedia.</p>
            <?php endif; ?>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/mahasiswa/dashboard.blade.php ENDPATH**/ ?>