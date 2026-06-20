<?php $__env->startSection('title', 'Masuk Mahasiswa'); ?>
<?php $__env->startSection('auth-subtitle', 'Masuk ke akun mahasiswamu'); ?>

<?php $__env->startSection('content'); ?>
    <h2 style="font-family: var(--font-serif); font-size: 22px; font-weight: 500; color: var(--color-ink); margin-bottom: 24px; text-align: center;">Selamat Datang Kembali</h2>

    <form method="POST" action="/mahasiswa/login">
        <?php echo csrf_field(); ?>
        <div style="margin-bottom: 16px;">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-input" value="<?php echo e(old('email')); ?>" placeholder="nama@email.com" required autofocus>
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
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
            <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--color-ash); cursor: pointer;">
                <input type="checkbox" name="remember" style="accent-color: var(--color-ink);"> Ingat saya
            </label>
        </div>
        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Masuk</button>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('auth-links'); ?>
    <p style="font-size: 13px; color: var(--color-graphite);">Belum punya akun? <a href="/mahasiswa/register" style="color: var(--color-ink); font-weight: 600;">Daftar sekarang</a></p>
    <p style="font-size: 12px; color: var(--color-dove); margin-top: 12px;">Daftar sebagai <a href="/perusahaan/login" style="color: var(--color-ash);">Perusahaan</a></p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/auth/mahasiswa/login.blade.php ENDPATH**/ ?>