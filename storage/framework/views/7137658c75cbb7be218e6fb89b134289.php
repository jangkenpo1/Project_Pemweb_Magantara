<?php $__env->startSection('title', $lowongan->title . ' — ' . $lowongan->perusahaan->name); ?>

<?php $__env->startSection('content'); ?>
<div style="padding: 40px 0 60px;">
    <div class="page-container">
        <div style="display: grid; grid-template-columns: 1fr 360px; gap: 32px; align-items: flex-start;">

            <!-- Main Content -->
            <div>
                <!-- Back link -->
                <?php
                    $backUrl = '/lowongan';
                    if (auth('admin')->check()) {
                        $backUrl = '/admin/lowongan';
                    } elseif (auth('perusahaan')->check()) {
                        $backUrl = '/perusahaan/lowongan';
                    }
                ?>
                <a href="<?php echo e($backUrl); ?>" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; color: var(--color-graphite); text-decoration: none; margin-bottom: 24px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Kembali ke daftar lowongan
                </a>

                <!-- Company & Title -->
                <div class="card" style="margin-bottom: 20px;">
                    <div style="display: flex; align-items: flex-start; gap: 16px; margin-bottom: 20px;">
                        <div class="company-logo-lg" style="display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 24px; color: var(--color-ink); overflow: hidden;">
                            <?php if($lowongan->perusahaan->logo): ?>
                                <img src="<?php echo e(Storage::url($lowongan->perusahaan->logo)); ?>" alt="<?php echo e($lowongan->perusahaan->name); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <?php echo e(strtoupper(substr($lowongan->perusahaan->name, 0, 1))); ?>

                            <?php endif; ?>
                        </div>
                        <div style="flex: 1;">
                            <h1 class="text-job-title" style="font-size: 26px; margin-bottom: 4px;"><?php echo e($lowongan->title); ?></h1>
                            <p style="font-size: 15px; color: var(--color-ash); font-weight: 500;"><?php echo e($lowongan->perusahaan->name); ?></p>
                            <?php if($lowongan->perusahaan->industry): ?>
                                <p style="font-size: 13px; color: var(--color-graphite);"><?php echo e($lowongan->perusahaan->industry->name); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 20px;">
                        <span class="badge <?php echo e($lowongan->work_system === 'remote' ? 'badge-sky' : 'badge-fog'); ?>"><?php echo e($lowongan->work_system_label); ?></span>
                        <span class="badge <?php echo e($lowongan->payment_type === 'paid' ? 'badge-apricot' : 'badge-fog'); ?>"><?php echo e($lowongan->payment_type_label); ?></span>
                        <span class="badge badge-fog"><?php echo e($lowongan->duration_months); ?> Bulan</span>
                        <span class="badge badge-fog"><?php echo e($lowongan->quota); ?> Posisi</span>
                        <?php if($mahasiswa && $skillMatch > 0): ?>
                            <span class="badge <?php echo e($skillMatch >= 80 ? 'badge-skill-match-high' : ($skillMatch >= 50 ? 'badge-skill-match-mid' : 'badge-skill-match-low')); ?>">
                                ✦ <?php echo e($skillMatch); ?>% Match
                            </span>
                        <?php endif; ?>
                    </div>

                    <div style="display: flex; gap: 20px; padding: 16px 0; border-top: 1px solid rgba(163,166,175,0.2); font-size: 13px; color: var(--color-graphite);">
                        <?php if($lowongan->province): ?>
                            <span style="display: flex; align-items: center; gap: 4px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <?php echo e($lowongan->city->name ?? ''); ?><?php echo e($lowongan->city ? ', ' : ''); ?><?php echo e($lowongan->province->name); ?>

                            </span>
                        <?php endif; ?>
                        <?php if($lowongan->gmaps_url): ?>
                            <a href="<?php echo e($lowongan->gmaps_url); ?>" target="_blank" style="display: flex; align-items: center; gap: 4px; color: var(--color-sky); text-decoration: none; font-weight: 500;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                Lihat Maps
                            </a>
                        <?php endif; ?>
                        <span style="display: flex; align-items: center; gap: 4px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            Deadline: <?php echo e($lowongan->deadline->format('d M Y')); ?>

                        </span>
                    </div>
                </div>

                <!-- Description -->
                <div class="card" style="margin-bottom: 20px;">
                    <h2 style="font-size: 18px; font-weight: 600; color: var(--color-ink); margin-bottom: 16px;">Deskripsi Pekerjaan</h2>
                    <div style="font-size: 14px; color: var(--color-ash); line-height: 1.8; white-space: pre-line;"><?php echo e($lowongan->description); ?></div>
                </div>

                <?php if($lowongan->responsibilities): ?>
                    <div class="card" style="margin-bottom: 20px;">
                        <h2 style="font-size: 18px; font-weight: 600; color: var(--color-ink); margin-bottom: 16px;">Tanggung Jawab</h2>
                        <div style="font-size: 14px; color: var(--color-ash); line-height: 1.8; white-space: pre-line;"><?php echo e($lowongan->responsibilities); ?></div>
                    </div>
                <?php endif; ?>

                <?php if($lowongan->qualifications): ?>
                    <div class="card" style="margin-bottom: 20px;">
                        <h2 style="font-size: 18px; font-weight: 600; color: var(--color-ink); margin-bottom: 16px;">Kualifikasi</h2>
                        <div style="font-size: 14px; color: var(--color-ash); line-height: 1.8; white-space: pre-line;"><?php echo e($lowongan->qualifications); ?></div>
                    </div>
                <?php endif; ?>

                <!-- Skills Required -->
                <?php if($lowongan->skills->isNotEmpty()): ?>
                    <div class="card" style="margin-bottom: 20px;">
                        <h2 style="font-size: 18px; font-weight: 600; color: var(--color-ink); margin-bottom: 16px;">Skill yang Dibutuhkan</h2>
                        <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                            <?php $__currentLoopData = $lowongan->skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge badge-fog" style="font-size: 13px;"><?php echo e($skill->name); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($lowongan->benefits): ?>
                    <div class="card" style="margin-bottom: 20px;">
                        <h2 style="font-size: 18px; font-weight: 600; color: var(--color-ink); margin-bottom: 16px;">Benefit</h2>
                        <div style="font-size: 14px; color: var(--color-ash); line-height: 1.8; white-space: pre-line;"><?php echo e($lowongan->benefits); ?></div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div style="position: sticky; top: 80px;">
                <?php if(!auth('admin')->check() && !auth('perusahaan')->check()): ?>
                    <div class="card" style="margin-bottom: 16px;">
                        <?php if($mahasiswa): ?>
                            <?php if($sudahLamar): ?>
                                <div style="background: #dcfce7; border-radius: 12px; padding: 12px 16px; text-align: center; margin-bottom: 16px;">
                                    <p style="font-size: 13px; font-weight: 600; color: #15803d;">✓ Sudah Dilamar</p>
                                </div>
                            <?php else: ?>
                                <!-- Apply Form -->
                                <form method="POST" action="/mahasiswa/lamaran/<?php echo e($lowongan->id); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div style="margin-bottom: 16px;">
                                        <label class="form-label">Cover Letter (opsional)</label>
                                        <textarea name="cover_letter" class="form-textarea" placeholder="Ceritakan mengapa kamu tertarik dengan posisi ini..." style="min-height: 80px;"></textarea>
                                    </div>
                                    <button type="submit" class="btn-primary" style="width: 100%; justify-content: center; padding: 13px;">
                                        Lamar Sekarang
                                    </button>
                                </form>
                            <?php endif; ?>

                            <!-- Bookmark button -->
                            <form method="POST" action="/mahasiswa/bookmark/<?php echo e($lowongan->id); ?>" style="margin-top: 10px;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="<?php echo e($sudahSimpan ? 'btn-primary' : 'btn-outline'); ?>" style="width: 100%; justify-content: center;">
                                    <?php echo e($sudahSimpan ? '♥ Tersimpan' : '♡ Simpan ke Wishlist'); ?>

                                </button>
                            </form>
                        <?php else: ?>
                            <div style="text-align: center; padding: 8px 0;">
                                <p style="font-size: 14px; color: var(--color-ash); margin-bottom: 16px;">Masuk untuk melamar lowongan ini</p>
                                <a href="/mahasiswa/login" class="btn-primary" style="width: 100%; justify-content: center; display: flex;">Masuk & Lamar</a>
                                <a href="/mahasiswa/register" class="btn-ghost" style="width: 100%; justify-content: center; margin-top: 8px;">Belum punya akun? Daftar</a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Company Info -->
                <div class="card">
                    <h3 style="font-size: 14px; font-weight: 600; color: var(--color-ink); margin-bottom: 14px;">Tentang Perusahaan</h3>
                    <?php if($lowongan->perusahaan->description): ?>
                        <p style="font-size: 13px; color: var(--color-ash); line-height: 1.6; margin-bottom: 12px;"><?php echo e(Str::limit($lowongan->perusahaan->description, 160)); ?></p>
                    <?php endif; ?>
                    <?php if($lowongan->perusahaan->employee_scale): ?>
                        <p style="font-size: 12px; color: var(--color-graphite);">👥 <?php echo e($lowongan->perusahaan->employee_scale); ?> karyawan</p>
                    <?php endif; ?>
                    <?php if($lowongan->perusahaan->website_url): ?>
                        <a href="<?php echo e($lowongan->perusahaan->website_url); ?>" target="_blank" class="btn-ghost" style="margin-top: 10px; font-size: 12px; padding: 6px 0;">Kunjungi Website →</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(auth('mahasiswa')->check() ? 'layouts.app' : (auth('perusahaan')->check() ? 'layouts.perusahaan' : (auth('admin')->check() ? 'layouts.admin' : 'layouts.guest')), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/lowongan/show.blade.php ENDPATH**/ ?>