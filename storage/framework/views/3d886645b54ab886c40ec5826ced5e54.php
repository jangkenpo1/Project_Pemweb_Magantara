<?php $__env->startSection('title', 'Manajemen Lowongan'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 32px; display: flex; align-items: center; justify-content: space-between;">
    <div>
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Manajemen Lowongan</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Kelola seluruh lowongan magang yang ada di platform.</p>
    </div>
</div>

<form action="/admin/lowongan" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 24px;">
    <div class="search-bar" style="width: 300px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-dove)" stroke-width="2" style="margin-left: 16px;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari posisi lowongan...">
        <button type="submit">Cari</button>
    </div>
    <select name="status" onchange="this.form.submit()" class="form-select" style="width: auto; min-width: 150px; border-radius: 9999px; padding: 9px 40px 9px 16px;">
        <option value="">Semua Status</option>
        <option value="published" <?php echo e(request('status') === 'published' ? 'selected' : ''); ?>>Published</option>
        <option value="closed" <?php echo e(request('status') === 'closed' ? 'selected' : ''); ?>>Closed</option>
    </select>
</form>

<div class="card" style="padding: 0; overflow: hidden;">
    <table style="width: 100%; text-align: left; border-collapse: collapse;">
        <thead>
            <tr style="background: var(--color-fog); border-bottom: 1px solid rgba(163,166,175,0.2);">
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Lowongan</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Sistem Kerja</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Tipe</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Status</th>
                <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink); text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $lowongans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lowongan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr style="border-bottom: 1px solid rgba(163,166,175,0.15);">
                    <td style="padding: 16px;">
                        <a href="/lowongan/<?php echo e($lowongan->id); ?>" style="font-size: 14px; font-weight: 500; color: var(--color-ink); text-decoration: none;"><?php echo e($lowongan->title); ?></a>
                        <p style="font-size: 12px; color: var(--color-graphite); margin-top: 2px;"><?php echo e($lowongan->perusahaan->name ?? '-'); ?></p>
                    </td>
                    <td style="padding: 16px; font-size: 13px; color: var(--color-graphite);"><?php echo e(ucfirst($lowongan->work_system)); ?></td>
                    <td style="padding: 16px; font-size: 13px; color: var(--color-graphite);"><?php echo e(ucfirst($lowongan->payment_type)); ?></td>
                    <td style="padding: 16px;">
                        <span class="badge <?php echo e($lowongan->status === 'published' ? 'badge-apricot' : 'badge-fog'); ?>" style="font-size: 11px;">
                            <?php echo e(ucfirst($lowongan->status)); ?>

                        </span>
                    </td>
                    <td style="padding: 16px; text-align: right;">
                        <form method="POST" action="/admin/lowongan/<?php echo e($lowongan->id); ?>" onsubmit="return confirm('Hapus lowongan ini permanen?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn-ghost" style="font-size: 12px; color: #b91c1c; padding: 6px 12px;">Hapus Permanen</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" style="padding: 32px; text-align: center; color: var(--color-graphite); font-size: 14px;">Tidak ada data lowongan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div style="margin-top: 24px;"><?php echo e($lowongans->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/admin/lowongan/index.blade.php ENDPATH**/ ?>