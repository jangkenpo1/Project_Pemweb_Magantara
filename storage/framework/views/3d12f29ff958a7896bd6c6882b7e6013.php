<?php $__env->startSection('title', 'Edit Lowongan'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom: 32px; max-width: 800px;">
    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
        <a href="/perusahaan/lowongan" class="btn-ghost" style="padding: 8px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
        </a>
        <h1 style="font-family: var(--font-serif); font-size: 28px; font-weight: 500; color: var(--color-ink);">Edit Lowongan</h1>
    </div>
    <p style="font-size: 14px; color: var(--color-graphite); margin-left: 52px;">Perbarui detail lowongan magang Anda.</p>
</div>

<form method="POST" action="/perusahaan/lowongan/<?php echo e($lowongan->id); ?>" style="max-width: 800px; margin-left: 52px;">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <?php if($errors->any()): ?>
        <div style="background: #fee2e2; border: 1px solid #f87171; border-radius: 8px; padding: 16px; margin-bottom: 24px;">
            <div style="font-weight: 600; color: #b91c1c; margin-bottom: 8px;">Terdapat beberapa kesalahan:</div>
            <ul style="margin: 0; padding-left: 20px; color: #b91c1c; font-size: 14px;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card" style="margin-bottom: 24px;">
        <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 20px;">Informasi Utama</h2>
        
        <div style="margin-bottom: 16px;">
            <label class="form-label">Status Lowongan</label>
            <select name="status" class="form-select" style="background-color: var(--color-fog);">
                <option value="published" <?php echo e(old('status', $lowongan->status) === 'published' ? 'selected' : ''); ?>>🟢 Aktif / Dipublikasikan</option>
                <option value="closed" <?php echo e(old('status', $lowongan->status) === 'closed' ? 'selected' : ''); ?>>🔴 Ditutup</option>
            </select>
        </div>

        <div style="margin-bottom: 16px;">
            <label class="form-label">Judul Lowongan *</label>
            <input type="text" name="title" class="form-input" value="<?php echo e(old('title', $lowongan->title)); ?>" required>
            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="form-error"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
            <div>
                <label class="form-label">Sistem Kerja *</label>
                <select name="work_system" class="form-select" required>
                    <option value="remote" <?php echo e(old('work_system', $lowongan->work_system) == 'remote' ? 'selected' : ''); ?>>Remote</option>
                    <option value="hybrid" <?php echo e(old('work_system', $lowongan->work_system) == 'hybrid' ? 'selected' : ''); ?>>Hybrid</option>
                    <option value="onsite" <?php echo e(old('work_system', $lowongan->work_system) == 'onsite' ? 'selected' : ''); ?>>On-Site</option>
                </select>
            </div>
            <div>
                <label class="form-label">Tipe Pembayaran *</label>
                <select name="payment_type" class="form-select" required>
                    <option value="paid" <?php echo e(old('payment_type', $lowongan->payment_type) == 'paid' ? 'selected' : ''); ?>>Paid</option>
                    <option value="unpaid" <?php echo e(old('payment_type', $lowongan->payment_type) == 'unpaid' ? 'selected' : ''); ?>>Unpaid</option>
                </select>
            </div>
            <div>
                <label class="form-label">Durasi (Bulan) *</label>
                <input type="number" name="duration_months" class="form-input" value="<?php echo e(old('duration_months', $lowongan->duration_months)); ?>" min="1" max="12" required>
            </div>
            <div>
                <label class="form-label">Kuota Penerimaan *</label>
                <input type="number" name="quota" class="form-input" value="<?php echo e(old('quota', $lowongan->quota)); ?>" min="1" required>
            </div>
        </div>

        <div>
            <label class="form-label">Batas Akhir Lamaran (Deadline) *</label>
            <input type="date" name="deadline" class="form-input" value="<?php echo e(old('deadline', $lowongan->deadline->format('Y-m-d'))); ?>" required>
        </div>
    </div>

    <div class="card" style="margin-bottom: 24px;">
        <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 20px;">Detail Pekerjaan</h2>
        
        <div style="margin-bottom: 16px;">
            <label class="form-label">Deskripsi *</label>
            <textarea name="description" class="form-textarea" style="min-height: 100px;" required><?php echo e(old('description', $lowongan->description)); ?></textarea>
        </div>
        
        <div style="margin-bottom: 16px;">
            <label class="form-label">Tanggung Jawab *</label>
            <textarea name="responsibilities" class="form-textarea" style="min-height: 100px;" required><?php echo e(old('responsibilities', $lowongan->responsibilities)); ?></textarea>
        </div>

        <div style="margin-bottom: 16px;">
            <label class="form-label">Kualifikasi *</label>
            <textarea name="qualifications" class="form-textarea" style="min-height: 100px;" required><?php echo e(old('qualifications', $lowongan->qualifications)); ?></textarea>
        </div>

        <div>
            <label class="form-label">Benefit</label>
            <textarea name="benefits" class="form-textarea" style="min-height: 80px;"><?php echo e(old('benefits', $lowongan->benefits)); ?></textarea>
        </div>
    </div>

    <div class="card" style="margin-bottom: 24px;">
        <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 6px;">Skill & Jurusan yang Relevan</h2>
        <p style="font-size: 13px; color: var(--color-graphite); margin-bottom: 20px;">Pilih skill dan jurusan untuk membantu sistem mencocokkan kandidat terbaik.</p>
        
        <?php
            $selectedSkills = old('skills', $lowongan->skills->pluck('id')->toArray());
            $selectedMajors = old('majors', $lowongan->majors->pluck('id')->toArray());
        ?>

        <div style="margin-bottom: 24px;" x-data="{ search: '' }">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <label class="form-label" style="margin-bottom: 0;">Skill (Pilih yang sesuai)</label>
                <input type="text" x-model="search" placeholder="Cari skill..." class="form-input" style="padding: 6px 12px; font-size: 13px; max-width: 250px; min-height: 0;">
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label x-show="search === '' ? (<?php echo e($loop->index); ?> < 20 || <?php echo e(in_array($skill->id, $selectedSkills) ? 'true' : 'false'); ?>) : '<?php echo e(strtolower($skill->name)); ?>'.includes(search.toLowerCase())" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 9999px; border: 1.5px solid <?php echo e(in_array($skill->id, $selectedSkills) ? 'var(--color-ink)' : 'var(--color-dove)'); ?>; background: <?php echo e(in_array($skill->id, $selectedSkills) ? 'var(--color-ink)' : 'transparent'); ?>; color: <?php echo e(in_array($skill->id, $selectedSkills) ? 'white' : 'var(--color-ash)'); ?>; font-size: 13px; font-weight: 500; cursor: pointer; transition: all 0.15s;">
                        <input type="checkbox" name="skills[]" value="<?php echo e($skill->id); ?>" <?php echo e(in_array($skill->id, $selectedSkills) ? 'checked' : ''); ?> style="display: none;" onchange="this.parentElement.style.background = this.checked ? 'var(--color-ink)' : 'transparent'; this.parentElement.style.borderColor = this.checked ? 'var(--color-ink)' : 'var(--color-dove)'; this.parentElement.style.color = this.checked ? 'white' : 'var(--color-ash)';">
                        <?php echo e($skill->name); ?>

                    </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div x-data="{ search: '' }">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <label class="form-label" style="margin-bottom: 0;">Jurusan (Pilih yang sesuai)</label>
                <input type="text" x-model="search" placeholder="Cari jurusan..." class="form-input" style="padding: 6px 12px; font-size: 13px; max-width: 250px; min-height: 0;">
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                <?php $__currentLoopData = $majors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $major): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label x-show="search === '' ? (<?php echo e($loop->index); ?> < 20 || <?php echo e(in_array($major->id, $selectedMajors) ? 'true' : 'false'); ?>) : '<?php echo e(strtolower($major->name)); ?>'.includes(search.toLowerCase())" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 9999px; border: 1.5px solid <?php echo e(in_array($major->id, $selectedMajors) ? 'var(--color-ink)' : 'var(--color-dove)'); ?>; background: <?php echo e(in_array($major->id, $selectedMajors) ? 'var(--color-ink)' : 'transparent'); ?>; color: <?php echo e(in_array($major->id, $selectedMajors) ? 'white' : 'var(--color-ash)'); ?>; font-size: 13px; font-weight: 500; cursor: pointer; transition: all 0.15s;">
                        <input type="checkbox" name="majors[]" value="<?php echo e($major->id); ?>" <?php echo e(in_array($major->id, $selectedMajors) ? 'checked' : ''); ?> style="display: none;" onchange="this.parentElement.style.background = this.checked ? 'var(--color-ink)' : 'transparent'; this.parentElement.style.borderColor = this.checked ? 'var(--color-ink)' : 'var(--color-dove)'; this.parentElement.style.color = this.checked ? 'white' : 'var(--color-ash)';">
                        <?php echo e($major->name); ?>

                    </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom: 24px;" x-data="locationDropdown('<?php echo e(old('province_id', $lowongan->province_id)); ?>', '<?php echo e(old('city_id', $lowongan->city_id)); ?>')">
        <h2 style="font-size: 16px; font-weight: 600; color: var(--color-ink); margin-bottom: 20px;">Lokasi Penempatan</h2>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
            <div>
                <label class="form-label">Provinsi (Opsional)</label>
                <select name="province_id" class="form-select" x-model="province" @change="fetchCities()">
                    <option value="">Pilih provinsi...</option>
                    <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($prov->id); ?>"><?php echo e($prov->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <label class="form-label">Kota (Opsional)</label>
                <select name="city_id" class="form-select" x-model="city" :disabled="!province || isLoading">
                    <option value="">Pilih kota...</option>
                    <template x-for="c in cities" :key="c.id">
                        <option :value="c.id" x-text="c.name"></option>
                    </template>
                </select>
            </div>
        </div>
        <div>
            <label class="form-label">URL Google Maps (Opsional)</label>
            <input type="url" name="gmaps_url" class="form-input" placeholder="https://maps.app.goo.gl/..." value="<?php echo e(old('gmaps_url', $lowongan->gmaps_url)); ?>">
        </div>
    </div>

    <div style="display: flex; gap: 12px; align-items: center;">
        <button type="submit" name="status" value="published" class="btn-primary" style="padding: 13px 32px;">Simpan Perubahan</button>
        <button type="submit" name="status" value="draft" class="btn-outline" style="padding: 13px 24px;">Simpan Draft</button>
        <a href="/perusahaan/lowongan" class="btn-ghost" style="padding: 13px 24px;">Batal</a>
    </div>
</form>
<script>
    function locationDropdown(initialProvince, initialCity) {
        return {
            province: initialProvince,
            city: initialCity,
            cities: [],
            isLoading: false,
            init() {
                if (this.province) {
                    this.fetchCities(true);
                }
            },
            fetchCities(isInit = false) {
                if (!this.province) {
                    this.cities = [];
                    this.city = '';
                    return;
                }
                this.isLoading = true;
                let oldCity = this.city;
                fetch('/api/provinces/' + this.province + '/cities')
                    .then(res => res.json())
                    .then(data => {
                        this.cities = data;
                        if (!isInit) {
                            this.city = '';
                        } else {
                            this.$nextTick(() => {
                                this.city = oldCity;
                            });
                        }
                        this.isLoading = false;
                    });
            }
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.perusahaan', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/perusahaan/lowongan/edit.blade.php ENDPATH**/ ?>