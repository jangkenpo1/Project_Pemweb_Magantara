<?php $__env->startSection('title', 'Daftar Mahasiswa'); ?>
<?php $__env->startSection('auth-subtitle', 'Buat akun mahasiswamu secara gratis'); ?>

<?php $__env->startSection('content'); ?>
    <h2 style="font-family: var(--font-serif); font-size: 22px; font-weight: 500; color: var(--color-ink); margin-bottom: 24px; text-align: center;">Bergabung dengan MaganTara</h2>

    <form method="POST" action="/mahasiswa/register">
        <?php echo csrf_field(); ?>
        <div style="margin-bottom: 16px;">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-input" value="<?php echo e(old('name')); ?>" placeholder="Nama lengkapmu" required autofocus>
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
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-input" value="<?php echo e(old('email')); ?>" placeholder="nama@email.com" required>
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
        <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Buat Akun</button>
        <p style="font-size: 11px; color: var(--color-graphite); text-align: center; margin-top: 14px; line-height: 1.6;">Dengan mendaftar, kamu setuju dengan <a href="#" style="color: var(--color-ash);">Syarat & Ketentuan</a> dan <a href="#" style="color: var(--color-ash);">Kebijakan Privasi</a> MaganTara.</p>
    </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('auth-links'); ?>
    <p style="font-size: 13px; color: var(--color-graphite);">Sudah punya akun? <a href="/mahasiswa/login" style="color: var(--color-ink); font-weight: 600;">Masuk</a></p>
    <p style="font-size: 12px; color: var(--color-dove); margin-top: 12px;">Daftar sebagai <a href="/perusahaan/register" style="color: var(--color-ash);">Perusahaan</a></p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/auth/mahasiswa/register.blade.php ENDPATH**/ ?>