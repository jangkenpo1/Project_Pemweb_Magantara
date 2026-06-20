<?php $__env->startSection('title', 'Admin Login'); ?>
<?php $__env->startSection('auth-subtitle', 'Akses terbatas untuk administrator'); ?>

<?php $__env->startSection('content'); ?>
    <div style="text-align: center; margin-bottom: 20px;">
        <div style="width: 48px; height: 48px; background: var(--color-ink); border-radius: 14px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h2 style="font-family: var(--font-serif); font-size: 20px; font-weight: 500; color: var(--color-ink); margin-bottom: 4px;">Admin Panel</h2>
        <p style="font-size: 13px; color: var(--color-graphite);">MaganTara Administration</p>
    </div>

    <form method="POST" action="/admin/login">
        <?php echo csrf_field(); ?>
        <div style="margin-bottom: 16px;">
            <label class="form-label">Email Admin</label>
            <input type="email" name="email" class="form-input" value="<?php echo e(old('email')); ?>" placeholder="admin@magantara.id" required autofocus>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div style="margin-bottom: 24px;">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-input" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Masuk ke Panel Admin</button>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('auth-links'); ?>
    <a href="/" style="font-size: 13px; color: var(--color-graphite);">← Kembali ke MaganTara</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/auth/admin/login.blade.php ENDPATH**/ ?>