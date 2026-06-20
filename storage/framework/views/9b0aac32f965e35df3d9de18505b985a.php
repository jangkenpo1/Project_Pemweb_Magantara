<?php $__env->startSection('title', 'Manajemen Perusahaan'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 32px; display: flex; align-items: center; justify-content: space-between;">
    <div>
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Manajemen Perusahaan</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Verifikasi dan kelola akun perusahaan.</p>
    </div>
</div>

<form action="/admin/perusahaan" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 24px;">
    <div class="search-bar" style="width: 300px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-dove)" stroke-width="2" style="margin-left: 16px;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari perusahaan...">
        <button type="submit">Cari</button>
    </div>
    <select name="status" onchange="this.form.submit()" class="form-select" style="width: auto; min-width: 150px; border-radius: 9999px; padding: 9px 40px 9px 16px;">
        <option value="">Semua Status</option>
        <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>Pending</option>
        <option value="verified" <?php echo e(request('status') === 'verified' ? 'selected' : ''); ?>>Terverifikasi</option>
        <option value="rejected" <?php echo e(request('status') === 'rejected' ? 'selected' : ''); ?>>Ditolak</option>
    </select>
</form>

<div class="card" style="padding: 0; overflow: hidden;">
    <table style="width: 100%; text-align: left; border-collapse: collapse;">
        <thead>
            <tr style="background: var(--color-fog); border-bottom: 1px solid rgba(163,166,175,0.2);">
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Perusahaan</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Industri</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Skala</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Status</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink); text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $perusahaans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr style="border-bottom: 1px solid rgba(163,166,175,0.15);">
                    <td style="padding: 16px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div class="company-logo" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 13px; color: var(--color-ink); overflow: hidden;">
                                <?php if($p->logo): ?>
                                    <img src="<?php echo e(Storage::url($p->logo)); ?>" alt="<?php echo e($p->name); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <?php echo e(strtoupper(substr($p->name, 0, 1))); ?>

                                <?php endif; ?>
                            </div>
                            <div>
                                <p style="font-size: 14px; font-weight: 500; color: var(--color-ink);"><?php echo e($p->name); ?></p>
                                <p style="font-size: 12px; color: var(--color-graphite);"><?php echo e($p->email); ?></p>
                            </div>
                        </div>
                    </td>
                    <td style="padding: 16px; font-size: 13px; color: var(--color-graphite);"><?php echo e($p->industry->name ?? '-'); ?></td>
                    <td style="padding: 16px; font-size: 13px; color: var(--color-graphite);"><?php echo e($p->employee_scale ?? '-'); ?></td>
                    <td style="padding: 16px;">
                        <span class="badge <?php echo e($p->status_verification === 'verified' ? 'badge-apricot' : ($p->status_verification === 'pending' ? 'badge-sky' : 'badge-fog')); ?>" style="font-size: 11px;">
                            <?php echo e(ucfirst($p->status_verification)); ?>

                        </span>
                    </td>
                    <td style="padding: 16px; text-align: right;">
                        <a href="/admin/perusahaan/<?php echo e($p->id); ?>" class="btn-outline" style="font-size: 12px; padding: 6px 14px;">Review</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" style="padding: 32px; text-align: center; color: var(--color-graphite); font-size: 14px;">Tidak ada data perusahaan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div style="margin-top: 24px;"><?php echo e($perusahaans->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/admin/perusahaan/index.blade.php ENDPATH**/ ?>