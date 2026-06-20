<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Login'); ?> — MaganTara</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body style="background: var(--color-fog); min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px;">
    <div style="width: 100%; max-width: 460px;">

        <!-- Logo -->
        <div style="text-align: center; margin-bottom: 32px;">
            <a href="/" class="logo-text" style="font-size: 24px;">MaganTara</a>
            <p style="font-size: 13px; color: var(--color-graphite); margin-top: 6px;"><?php echo $__env->yieldContent('auth-subtitle', 'Masuk ke akun Anda'); ?></p>
        </div>

        <!-- Card -->
        <div class="card">
            <?php if(session('error')): ?>
                <div style="background: #fee2e2; color: #991b1b; padding: 12px 16px; border-radius: 12px; font-size: 13px; margin-bottom: 20px;">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('success')): ?>
                <div style="background: #dcfce7; color: #15803d; padding: 12px 16px; border-radius: 12px; font-size: 13px; margin-bottom: 20px;">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <!-- Links -->
        <div style="text-align: center; margin-top: 20px;">
            <?php echo $__env->yieldContent('auth-links'); ?>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/layouts/auth.blade.php ENDPATH**/ ?>