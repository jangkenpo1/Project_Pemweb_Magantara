<?php $__env->startSection('title', 'Lamaran Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-container" style="padding-top: 40px; padding-bottom: 60px;">
    <div style="margin-bottom: 32px;">
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Lamaran Saya</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Pantau status seluruh lamaranmu di sini.</p>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $lamarans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lamaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="applicant-row card-hover" style="margin-bottom: 12px; border: 1px solid rgba(163,166,175,0.15); display: flex; flex-direction: column; align-items: stretch; padding: 16px;">
            <div style="display: flex; align-items: center; width: 100%;">
                <div class="company-logo" style="display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 15px; color: var(--color-ink); width: 48px; height: 48px; margin-right: 16px; overflow: hidden; border-radius: 8px;">
                    <?php if($lamaran->lowongan->perusahaan->logo): ?>
                        <img src="<?php echo e(Storage::url($lamaran->lowongan->perusahaan->logo)); ?>" alt="<?php echo e($lamaran->lowongan->perusahaan->name); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    <?php else: ?>
                        <?php echo e(strtoupper(substr($lamaran->lowongan->perusahaan->name, 0, 1))); ?>

                    <?php endif; ?>
                </div>
                <div style="flex: 1; min-width: 0;">
                    <a href="/lowongan/<?php echo e($lamaran->lowongan_id); ?>" style="font-size: 15px; font-weight: 600; color: var(--color-ink); text-decoration: none;"><?php echo e($lamaran->lowongan->title); ?></a>
                    <p style="font-size: 13px; color: var(--color-graphite);"><?php echo e($lamaran->lowongan->perusahaan->name); ?></p>
                    <p style="font-size: 12px; color: var(--color-dove); margin-top: 2px;">Dikirim <?php echo e($lamaran->created_at->diffForHumans()); ?></p>
                </div>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <span class="badge <?php echo e('status-' . $lamaran->status); ?>" style="font-size: 12px;"><?php echo e($lamaran->status_label); ?></span>
                    <?php if($lamaran->status === 'dikirim'): ?>
                        <form method="POST" action="/mahasiswa/lamaran/<?php echo e($lamaran->id); ?>/cancel" onsubmit="return confirm('Batalkan lamaran ini?')">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn-ghost" style="font-size: 12px; color: #dc2626;">Batalkan</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($lamaran->status === 'interview'): ?>
                <div style="margin-top: 16px; padding: 16px; background: var(--color-fog); border-radius: 8px; border: 1px solid var(--color-dove);">
                    <h4 style="font-size: 13px; font-weight: 600; color: var(--color-ink); margin-bottom: 8px;">Detail Jadwal Interview</h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div>
                            <p style="font-size: 12px; color: var(--color-graphite); margin-bottom: 4px;">Waktu</p>
                            <p style="font-size: 14px; font-weight: 500; color: var(--color-ink);"><?php echo e($lamaran->interview_date ? $lamaran->interview_date->format('d M Y, H:i') : '-'); ?> WIB</p>
                        </div>
                        <div>
                            <p style="font-size: 12px; color: var(--color-graphite); margin-bottom: 4px;">Tautan / Lokasi</p>
                            <?php if($lamaran->interview_url): ?>
                                <a href="<?php echo e($lamaran->interview_url); ?>" target="_blank" style="font-size: 14px; font-weight: 500; color: var(--color-sky); text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                    Buka Ruang Meeting
                                </a>
                            <?php else: ?>
                                <p style="font-size: 14px; color: var(--color-ink);">-</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if($lamaran->recruiter_notes): ?>
                        <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid var(--color-dove);">
                            <p style="font-size: 12px; color: var(--color-graphite); margin-bottom: 4px;">Catatan Rekruter:</p>
                            <p style="font-size: 13px; color: var(--color-ink);"><?php echo e($lamaran->recruiter_notes); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="empty-state">
            <div class="empty-state-card">
                <h3>Belum ada lamaran</h3>
                <p>Mulai lamar lowongan magang yang sesuai dengan minat dan skillmu.</p>
                <a href="/lowongan" class="btn-primary" style="margin-top: 20px;">Cari Lowongan</a>
            </div>
        </div>
    <?php endif; ?>

    <div style="margin-top: 24px;"><?php echo e($lamarans->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/mahasiswa/lamaran/index.blade.php ENDPATH**/ ?>