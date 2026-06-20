<?php $__env->startSection('title', 'Daftar Perusahaan'); ?>
<?php $__env->startSection('auth-subtitle', 'Mulai rekrut peserta magang terbaik'); ?>

<?php $__env->startSection('content'); ?>
    <h2 style="font-family: var(--font-serif); font-size: 22px; font-weight: 500; color: var(--color-ink); margin-bottom: 24px; text-align: center;">Daftarkan Perusahaan Anda</h2>

    <form method="POST" action="/perusahaan/register">
        <?php echo csrf_field(); ?>
        <div style="margin-bottom: 16px;">
            <label class="form-label">Nama Perusahaan</label>
            <input type="text" name="name" class="form-input" value="<?php echo e(old('name')); ?>" placeholder="PT Contoh Indonesia" required autofocus>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div style="margin-bottom: 16px;">
            <label class="form-label">Email Perusahaan</label>
            <input type="email" name="email" class="form-input" value="<?php echo e(old('email')); ?>" placeholder="hr@perusahaan.com" required>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div style="margin-bottom: 16px;">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-input" placeholder="Minimal 8 karakter" required>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div style="margin-bottom: 24px;">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-input" placeholder="Ulangi password" required>
        </div>
        <div style="background: var(--color-sky-wash); border-radius: 12px; padding: 12px 16px; font-size: 13px; color: #1d4ed8; margin-bottom: 20px;">
            ℹ️ Setelah mendaftar, akun akan diverifikasi oleh tim MaganTara sebelum dapat memposting lowongan.
        </div>
        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Daftar Sekarang</button>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('auth-links'); ?>
    <p style="font-size: 13px; color: var(--color-graphite);">Sudah terdaftar? <a href="/perusahaan/login" style="color: var(--color-ink); font-weight: 600;">Masuk</a></p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/auth/perusahaan/register.blade.php ENDPATH**/ ?>