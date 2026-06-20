<?php $__env->startSection('title', 'Cari Lowongan Magang'); ?>

<?php $__env->startSection('content'); ?>
<div style="padding: 40px 0 60px;">
    <div class="page-container">

        <!-- Header -->
        <div style="margin-bottom: 36px;">
            <h1 style="font-family: var(--font-serif); font-size: 36px; font-weight: 500; color: var(--color-ink); margin-bottom: 8px;">Cari Lowongan Magang</h1>
            <p style="font-size: 15px; color: var(--color-ash);"><?php echo e($lowongans->total()); ?> lowongan tersedia untuk kamu</p>
        </div>

        <!-- Search bar -->
        <div style="margin-bottom: 28px;">
            <form action="/lowongan" method="GET">
                <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                    <div class="search-bar" style="flex: 1; min-width: 280px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-dove)" stroke-width="2" style="margin-left: 16px; flex-shrink: 0;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Posisi, perusahaan, atau keyword...">
                        <button type="submit">Cari</button>
                    </div>
                    <!-- Quick filters -->
                    <select name="work_system" onchange="this.form.submit()" class="form-select" style="width: auto; min-width: 140px; border-radius: 9999px; padding: 10px 40px 10px 16px;">
                        <option value="">Sistem Kerja</option>
                        <option value="remote" <?php echo e(request('work_system') === 'remote' ? 'selected' : ''); ?>>Remote</option>
                        <option value="hybrid" <?php echo e(request('work_system') === 'hybrid' ? 'selected' : ''); ?>>Hybrid</option>
                        <option value="onsite" <?php echo e(request('work_system') === 'onsite' ? 'selected' : ''); ?>>On-Site</option>
                    </select>
                    <select name="payment_type" onchange="this.form.submit()" class="form-select" style="width: auto; min-width: 130px; border-radius: 9999px; padding: 10px 40px 10px 16px;">
                        <option value="">Jenis Magang</option>
                        <option value="paid" <?php echo e(request('payment_type') === 'paid' ? 'selected' : ''); ?>>Paid</option>
                        <option value="unpaid" <?php echo e(request('payment_type') === 'unpaid' ? 'selected' : ''); ?>>Unpaid</option>
                    </select>
                    <select name="industri" onchange="this.form.submit()" class="form-select" style="width: auto; min-width: 150px; border-radius: 9999px; padding: 10px 40px 10px 16px;">
                        <option value="">Industri</option>
                        <?php $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($ind->id); ?>" <?php echo e(request('industri') == $ind->id ? 'selected' : ''); ?>><?php echo e($ind->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if(request()->hasAny(['q', 'work_system', 'payment_type', 'industri', 'skill', 'provinsi'])): ?>
                        <a href="/lowongan" class="btn-ghost" style="font-size: 13px; color: var(--color-graphite);">Hapus Filter ×</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Grid -->
        <?php $__empty_1 = true; $__currentLoopData = $lowongans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lowongan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="/lowongan/<?php echo e($lowongan->id); ?>" class="job-card card-hover" style="display: flex; align-items: flex-start; gap: 16px; margin-bottom: 12px;">
                <div class="company-logo" style="display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px; color: var(--color-ink); width: 52px; height: 52px; flex-shrink: 0; overflow: hidden; border-radius: 8px;">
                    <?php if($lowongan->perusahaan->logo): ?>
                        <img src="<?php echo e(Storage::url($lowongan->perusahaan->logo)); ?>" alt="<?php echo e($lowongan->perusahaan->name); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    <?php else: ?>
                        <?php echo e(strtoupper(substr($lowongan->perusahaan->name, 0, 1))); ?>

                    <?php endif; ?>
                </div>
                <div style="flex: 1; min-width: 0;">
                    <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; flex-wrap: wrap; margin-bottom: 6px;">
                        <div>
                            <h2 style="font-family: var(--font-serif); font-size: 18px; font-weight: 500; color: var(--color-ink); margin-bottom: 2px;"><?php echo e($lowongan->title); ?></h2>
                            <p style="font-size: 13px; color: var(--color-graphite);"><?php echo e($lowongan->perusahaan->name); ?></p>
                        </div>
                        <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                            <span class="badge <?php echo e($lowongan->work_system === 'remote' ? 'badge-sky' : 'badge-fog'); ?>"><?php echo e($lowongan->work_system_label); ?></span>
                            <span class="badge <?php echo e($lowongan->payment_type === 'paid' ? 'badge-apricot' : 'badge-fog'); ?>"><?php echo e($lowongan->payment_type_label); ?></span>
                            <span class="badge badge-fog"><?php echo e($lowongan->duration_months); ?> Bulan</span>
                        </div>
                    </div>
                    <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-top: 8px;">
                        <?php $__currentLoopData = $lowongan->skills->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span style="font-size: 11px; color: var(--color-graphite); background: var(--color-fog); padding: 3px 8px; border-radius: 6px;"><?php echo e($skill->name); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div style="display: flex; align-items: center; gap: 16px; margin-top: 12px; padding-top: 12px; border-top: 1px solid rgba(163,166,175,0.2);">
                        <?php if($lowongan->province): ?>
                            <span style="font-size: 12px; color: var(--color-graphite); display: flex; align-items: center; gap: 4px;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <?php echo e($lowongan->city->name ?? $lowongan->province->name); ?>

                            </span>
                        <?php endif; ?>
                        <span style="font-size: 12px; color: var(--color-dove);">Deadline: <?php echo e($lowongan->deadline->format('d M Y')); ?></span>
                    </div>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-state">
                <div class="empty-state-card">
                    <h3>Tidak ada lowongan ditemukan</h3>
                    <p>Coba ubah filter pencarianmu atau gunakan kata kunci yang berbeda.</p>
                    <a href="/lowongan" class="btn-outline" style="margin-top: 20px;">Reset Filter</a>
                </div>
            </div>
        <?php endif; ?>

        <div style="margin-top: 32px;"><?php echo e($lowongans->links()); ?></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(auth('mahasiswa')->check() ? 'layouts.app' : (auth('perusahaan')->check() ? 'layouts.perusahaan' : (auth('admin')->check() ? 'layouts.admin' : 'layouts.guest')), array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/lowongan/index.blade.php ENDPATH**/ ?>