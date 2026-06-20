<?php $__env->startSection('title', 'Edit Profil'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-container" style="padding-top: 40px; padding-bottom: 60px; max-width: 800px;">
    <div style="margin-bottom: 32px;">
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px;">Profil Saya</h1>
        <p style="font-size: 14px; color: var(--color-graphite);">Lengkapi profil untuk meningkatkan peluang diterima magang.</p>
    </div>

    <form method="POST" action="/mahasiswa/profil" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <!-- Avatar & Basic -->
        <div class="card" style="margin-bottom: 20px;">
            <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 20px;">Informasi Dasar</h2>
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 24px;">
                <?php if($mahasiswa->avatar): ?>
                    <img src="<?php echo e(Storage::url($mahasiswa->avatar)); ?>" class="avatar-lg" alt="Avatar">
                <?php else: ?>
                    <div class="avatar-initials" style="width: 64px; height: 64px; font-size: 22px;"><?php echo e(strtoupper(substr($mahasiswa->name, 0, 1))); ?></div>
                <?php endif; ?>
                <div>
                    <label class="form-label">Foto Profil</label>
                    <input type="file" name="avatar" accept="image/*" style="font-size: 13px; color: var(--color-ash);">
                    <p style="font-size: 11px; color: var(--color-dove); margin-top: 4px;">JPG, PNG. Maks 2MB.</p>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div>
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" name="name" class="form-input" value="<?php echo e(old('name', $mahasiswa->name)); ?>" required>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" value="<?php echo e($mahasiswa->email); ?>" disabled style="opacity: 0.6; cursor: not-allowed;">
                </div>
                <div>
                    <label class="form-label">Universitas</label>
                    <select name="university_id" class="form-select">
                        <option value="">Pilih universitas...</option>
                        <?php $__currentLoopData = $universities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $univ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($univ->id); ?>" <?php echo e(old('university_id', $mahasiswa->university_id) == $univ->id ? 'selected' : ''); ?>><?php echo e($univ->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="form-label">Jurusan</label>
                    <select name="major_id" class="form-select">
                        <option value="">Pilih jurusan...</option>
                        <?php $__currentLoopData = $majors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $major): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($major->id); ?>" <?php echo e(old('major_id', $mahasiswa->major_id) == $major->id ? 'selected' : ''); ?>><?php echo e($major->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="form-label">Semester</label>
                    <select name="semester" class="form-select">
                        <option value="">Pilih semester...</option>
                        <?php for($i = 1; $i <= 14; $i++): ?>
                            <option value="<?php echo e($i); ?>" <?php echo e(old('semester', $mahasiswa->semester) == $i ? 'selected' : ''); ?>>Semester <?php echo e($i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
        </div>

        <!-- Bio & Experience -->
        <div class="card" style="margin-bottom: 20px;">
            <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 20px;">Tentang Saya</h2>
            <div style="margin-bottom: 16px;">
                <label class="form-label">Deskripsi Diri</label>
                <textarea name="bio" class="form-textarea" placeholder="Ceritakan tentang dirimu, minat, dan tujuan kariermu..."><?php echo e(old('bio', $mahasiswa->bio)); ?></textarea>
            </div>
            <div>
                <label class="form-label">Pengalaman</label>
                <textarea name="experience" class="form-textarea" placeholder="Ceritakan pengalaman organisasi, project, atau kerja sebelumnya..."><?php echo e(old('experience', $mahasiswa->experience)); ?></textarea>
            </div>
        </div>

        <!-- Skills -->
        <div class="card" style="margin-bottom: 20px;">
            <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 6px;">Skill</h2>
            <p style="font-size: 13px; color: var(--color-graphite); margin-bottom: 20px;">Pilih skill yang kamu kuasai. Ini digunakan untuk fitur Skill Match lowongan.</p>
            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 9999px; border: 1.5px solid <?php echo e(in_array($skill->id, $mySkillIds) ? 'var(--color-ink)' : 'var(--color-dove)'); ?>; background: <?php echo e(in_array($skill->id, $mySkillIds) ? 'var(--color-ink)' : 'transparent'); ?>; color: <?php echo e(in_array($skill->id, $mySkillIds) ? 'white' : 'var(--color-ash)'); ?>; font-size: 13px; font-weight: 500; cursor: pointer; transition: all 0.15s;">
                        <input type="checkbox" name="skills[]" value="<?php echo e($skill->id); ?>" <?php echo e(in_array($skill->id, $mySkillIds) ? 'checked' : ''); ?> style="display: none;" onchange="this.parentElement.style.background = this.checked ? 'var(--color-ink)' : 'transparent'; this.parentElement.style.borderColor = this.checked ? 'var(--color-ink)' : 'var(--color-dove)'; this.parentElement.style.color = this.checked ? 'white' : 'var(--color-ash)';">
                        <?php echo e($skill->name); ?>

                    </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- CV & Links -->
        <div class="card" style="margin-bottom: 24px;">
            <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 20px;">CV & Tautan</h2>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div>
                    <label class="form-label">Upload CV (PDF) *</label>
                    <?php if($mahasiswa->cv_path): ?>
                        <p style="font-size: 12px; color: #15803d; margin-bottom: 6px;">✓ CV sudah diupload. <a href="<?php echo e(Storage::url($mahasiswa->cv_path)); ?>" target="_blank" style="color: var(--color-ink);">Lihat CV</a></p>
                    <?php endif; ?>
                    <input type="file" name="cv" accept=".pdf" style="font-size: 13px; color: var(--color-ash);">
                    <p style="font-size: 11px; color: var(--color-dove); margin-top: 4px;">PDF. Maks 5MB.</p>
                    <?php $__errorArgs = ['cv'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label class="form-label">URL Portfolio</label>
                    <input type="url" name="portfolio_url" class="form-input" value="<?php echo e(old('portfolio_url', $mahasiswa->portfolio_url)); ?>" placeholder="https://portofolio.com">
                </div>
                <div>
                    <label class="form-label">URL LinkedIn</label>
                    <input type="url" name="linkedin_url" class="form-input" value="<?php echo e(old('linkedin_url', $mahasiswa->linkedin_url)); ?>" placeholder="https://linkedin.com/in/...">
                </div>
                <div>
                    <label class="form-label">URL GitHub</label>
                    <input type="url" name="github_url" class="form-input" value="<?php echo e(old('github_url', $mahasiswa->github_url)); ?>" placeholder="https://github.com/...">
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 12px;">
            <button type="submit" class="btn-primary" style="padding: 13px 32px;">Simpan Perubahan</button>
            <a href="/mahasiswa/dashboard" class="btn-outline" style="padding: 13px 24px;">Batal</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/mahasiswa/profil/edit.blade.php ENDPATH**/ ?>