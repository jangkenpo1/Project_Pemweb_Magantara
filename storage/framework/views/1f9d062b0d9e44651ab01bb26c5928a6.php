<?php $__env->startSection('title', 'Master Data: Universitas'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 32px; display: flex; align-items: center; justify-content: space-between;">
    <div>
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Master Data: Universitas</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Kelola daftar universitas untuk profil mahasiswa.</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 300px; gap: 24px; align-items: flex-start;">
    
    <div class="card" style="padding: 0; overflow: hidden;">
        <table style="width: 100%; text-align: left; border-collapse: collapse;">
            <thead>
                <tr style="background: var(--color-fog); border-bottom: 1px solid rgba(163,166,175,0.2);">
                    <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink);">Nama Universitas</th>
                    <th style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--color-ink); text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $universities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $univ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr style="border-bottom: 1px solid rgba(163,166,175,0.15);">
                        <td style="padding: 16px; font-size: 14px; color: var(--color-ink);"><?php echo e($univ->name); ?></td>
                        <td style="padding: 16px; text-align: right;">
                            <form method="POST" action="/admin/master/universitas/<?php echo e($univ->id); ?>" onsubmit="return confirm('Hapus universitas ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-ghost" style="font-size: 12px; color: #b91c1c; padding: 4px 8px;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="2" style="padding: 32px; text-align: center; color: var(--color-graphite); font-size: 14px;">Belum ada data universitas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if($universities->hasPages()): ?>
            <div style="padding: 16px; border-top: 1px solid rgba(163,166,175,0.2);">
                <?php echo e($universities->links()); ?>

            </div>
        <?php endif; ?>
    </div>

    <div class="card" style="position: sticky; top: 24px;">
        <h3 style="font-size: 15px; font-weight: 600; color: var(--color-ink); margin-bottom: 16px;">Tambah Universitas Baru</h3>
        <form method="POST" action="/admin/master/universitas">
            <?php echo csrf_field(); ?>
            <div style="margin-bottom: 16px;">
                <label class="form-label">Nama Universitas</label>
                <input type="text" name="name" class="form-input" placeholder="Contoh: Universitas Indonesia" required>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Tambah</button>
        </form>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/admin/master/universitas.blade.php ENDPATH**/ ?>