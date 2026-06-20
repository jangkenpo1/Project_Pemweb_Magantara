<?php $__env->startSection('title', 'Masuk Perusahaan'); ?>
<?php $__env->startSection('auth-subtitle', 'Portal rekrutmen perusahaan'); ?>

<?php $__env->startSection('content'); ?>
    <h2 style="font-family: var(--font-serif); font-size: 22px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px; text-align: center;">Masuk sebagai Perusahaan</h2>
    <p style="font-size: 13px; color: var(--color-graphite); text-align: center; margin-bottom: 24px;">Kelola lowongan dan seleksi pelamar terbaik</p>

    <form method="POST" action="/perusahaan/login">
        <?php echo csrf_field(); ?>
        <div style="margin-bottom: 16px;">
            <label class="form-label">Email Perusahaan</label>
            <input type="email" name="email" class="form-input" value="<?php echo e(old('email')); ?>" placeholder="email@perusahaan.com" required autofocus>
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
        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Masuk</button>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('auth-links'); ?>
    <p style="font-size: 13px; color: var(--color-graphite);">Belum terdaftar? <a href="/perusahaan/register" style="color: var(--color-ink); font-weight: 600;">Daftar perusahaan</a></p>
    <p style="font-size: 12px; color: var(--color-dove); margin-top: 12px;">Masuk sebagai <a href="/mahasiswa/login" style="color: var(--color-ash);">Mahasiswa</a></p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/auth/perusahaan/login.blade.php ENDPATH**/ ?>