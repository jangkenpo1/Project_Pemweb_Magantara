<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MaganTara — Platform Magang Terpercaya Indonesia</title>
    <meta name="description" content="MaganTara menghubungkan mahasiswa dengan peluang magang terbaik dari ratusan perusahaan di seluruh Indonesia. Temukan magang impianmu sekarang.">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body style="background: var(--color-fog);">

    <!-- ─── NAVBAR ──────────────────────────────────────── -->
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="/" class="logo-text">MaganTara</a>
            <div style="display: flex; align-items: center; gap: 20px;">
                <a href="/lowongan" class="nav-link">Cari Lowongan</a>
                <a href="/perusahaan/login" class="nav-link">Untuk Perusahaan</a>
            </div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <a href="/mahasiswa/login" class="btn-ghost">Masuk</a>
                <a href="/mahasiswa/register" class="btn-primary" style="padding: 10px 22px; font-size: 14px;">Daftar Gratis</a>
            </div>
        </div>
    </nav>

    <!-- ─── HERO ─────────────────────────────────────────── -->
    <section style="padding: 96px 0 80px; overflow: hidden;">
        <div class="page-container">
            <div style="max-width: 780px; margin: 0 auto; text-align: center;">

                <!-- Label pill removed as requested -->

                <!-- Headline -->
                <h1 class="text-hero" style="margin-bottom: 24px; animation: fadeInUp 0.5s ease 0.1s both;">
                    Temukan Magang<br>
                    <span style="font-style: italic; color: var(--color-graphite);">yang Mengubah</span><br>
                    Kariermu
                </h1>

                <!-- Subtitle -->
                <p style="font-size: 18px; color: var(--color-ash); line-height: 1.7; max-width: 520px; margin: 0 auto 40px; animation: fadeInUp 0.5s ease 0.2s both;">
                    MaganTara menghubungkan mahasiswa Indonesia dengan peluang magang terbaik di Nusantara.
                </p>

                <!-- Search Bar -->
                <div style="max-width: 580px; margin: 0 auto 40px; animation: fadeInUp 0.5s ease 0.3s both;">
                    <form action="/lowongan" method="GET">
                        <div class="search-bar">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--color-dove)" stroke-width="2" style="margin-left: 20px; flex-shrink: 0;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            <input type="text" name="q" placeholder="Cari posisi magang atau perusahaan...">
                            <button type="submit">Cari</button>
                        </div>
                    </form>
                </div>

                <!-- CTA buttons -->
                <div style="display: flex; align-items: center; justify-content: center; gap: 12px; flex-wrap: wrap; animation: fadeInUp 0.5s ease 0.4s both;">
                    <a href="/mahasiswa/register" class="btn-primary" style="padding: 14px 32px; font-size: 15px;">Mulai Sebagai Mahasiswa</a>
                    <a href="/perusahaan/register" class="btn-outline" style="padding: 14px 32px; font-size: 15px;">Pasang Lowongan</a>
                </div>

                <!-- Stats row -->
                <div style="display: flex; align-items: center; justify-content: center; gap: 80px; margin-top: 64px; padding-top: 40px; border-top: 1px solid rgba(163,166,175,0.3); animation: fadeIn 0.6s ease 0.5s both;">
                    <div style="text-align: center;">
                        <p class="stat-number counter" data-target="<?php echo e($stats['mahasiswa']); ?>" style="font-size: 32px; margin-bottom: 8px;">0</p>
                        <p class="stat-label" style="font-size: 11px; letter-spacing: 0.05em;">Mahasiswa Terdaftar</p>
                    </div>
                    <div style="width: 1px; height: 50px; background: rgba(163,166,175,0.4);"></div>
                    <div style="text-align: center;">
                        <p class="stat-number counter" data-target="<?php echo e($stats['perusahaan']); ?>" style="font-size: 32px; margin-bottom: 8px;">0</p>
                        <p class="stat-label" style="font-size: 11px; letter-spacing: 0.05em;">Perusahaan Mitra</p>
                    </div>
                    <div style="width: 1px; height: 50px; background: rgba(163,166,175,0.4);"></div>
                    <div style="text-align: center;">
                        <p class="stat-number counter" data-target="<?php echo e($stats['lowongan']); ?>" style="font-size: 32px; margin-bottom: 8px;">0</p>
                        <p class="stat-label" style="font-size: 11px; letter-spacing: 0.05em;">Lowongan Aktif</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ─── FEATURED TAGS ────────────────────────────────── -->
    <section style="padding: 24px 0 48px;">
        <div class="page-container">
            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap; justify-content: center;">
                <span style="font-size: 13px; color: var(--color-graphite); margin-right: 4px;">Populer:</span>
                <?php $__currentLoopData = ['UI/UX Design', 'React Developer', 'Data Analyst', 'Marketing Digital', 'Business Development', 'Mobile Developer', 'Backend Developer', 'Content Creator']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/lowongan?q=<?php echo e(urlencode($tag)); ?>" class="filter-pill"><?php echo e($tag); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- ─── HOW IT WORKS ──────────────────────────────────── -->
    <section style="background: var(--color-pure-white); padding: 96px 0;">
        <div class="page-container">
            <div style="text-align: center; margin-bottom: 60px;">
                <p style="font-size: 12px; font-weight: 600; color: var(--color-graphite); text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 12px;">Cara Kerja</p>
                <h2 class="text-section-title">Magang dalam 3 Langkah</h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 32px; max-width: 960px; margin: 0 auto;">
                <!-- Card 1 -->
                <div style="text-align: center; padding: 32px 24px; border-radius: var(--radius-card); background: var(--color-fog); position: relative; overflow: hidden; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div style="width: 60px; height: 60px; border-radius: 18px; background: white; color: var(--color-ink); border: 1.5px solid var(--color-ink); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <div style="font-size: 11px; font-weight: 700; color: var(--color-graphite); letter-spacing: 0.15em; margin-bottom: 8px;">LANGKAH 01</div>
                    <h3 style="font-size: 18px; font-weight: 600; color: var(--color-ink); margin-bottom: 10px;">Buat Profil</h3>
                    <p style="font-size: 14px; color: var(--color-ash); line-height: 1.65;">Lengkapi profil, upload CV, dan tambahkan skill yang kamu kuasai.</p>
                </div>

                <!-- Card 2 -->
                <div style="text-align: center; padding: 32px 24px; border-radius: var(--radius-card); background: var(--color-fog); position: relative; overflow: hidden; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div style="width: 60px; height: 60px; border-radius: 18px; background: white; color: var(--color-ink); border: 1.5px solid var(--color-ink); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                    <div style="font-size: 11px; font-weight: 700; color: var(--color-graphite); letter-spacing: 0.15em; margin-bottom: 8px;">LANGKAH 02</div>
                    <h3 style="font-size: 18px; font-weight: 600; color: var(--color-ink); margin-bottom: 10px;">Temukan Lowongan</h3>
                    <p style="font-size: 14px; color: var(--color-ash); line-height: 1.65;">Cari dan filter ribuan lowongan magang yang sesuai dengan bidang studimu.</p>
                </div>

                <!-- Card 3 -->
                <div style="text-align: center; padding: 32px 24px; border-radius: var(--radius-card); background: var(--color-fog); position: relative; overflow: hidden; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div style="width: 60px; height: 60px; border-radius: 18px; background: white; color: var(--color-ink); border: 1.5px solid var(--color-ink); display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                    </div>
                    <div style="font-size: 11px; font-weight: 700; color: var(--color-graphite); letter-spacing: 0.15em; margin-bottom: 8px;">LANGKAH 03</div>
                    <h3 style="font-size: 18px; font-weight: 600; color: var(--color-ink); margin-bottom: 10px;">Lamar & Pantau</h3>
                    <p style="font-size: 14px; color: var(--color-ash); line-height: 1.65;">Kirim lamaran dalam satu klik dan pantau status seleksimu secara real-time.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── LATEST JOBS PREVIEW ───────────────────────────── -->
    <section style="padding: 96px 0;">
        <div class="page-container">
            <div style="display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 40px;">
                <div>
                    <p style="font-size: 12px; font-weight: 600; color: var(--color-graphite); text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 8px;">Lowongan Terbaru</p>
                    <h2 class="text-section-title" style="font-size: 36px;">Mulai dari sini</h2>
                </div>
                <a href="/lowongan" class="btn-outline">Lihat Semua →</a>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
                <?php $__empty_1 = true; $__currentLoopData = $latestLowongan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="/lowongan/<?php echo e($job->id); ?>" class="job-card card-hover">
                        <div style="display: flex; align-items: flex-start; gap: 14px; margin-bottom: 16px;">
                            <div style="width: 44px; height: 44px; border-radius: var(--radius-image); background: white; border: 1px solid rgba(163,166,175,0.3); display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0;">
                                <?php if($job->perusahaan->logo): ?>
                                    <img src="<?php echo e(Storage::url($job->perusahaan->logo)); ?>" alt="Logo <?php echo e($job->perusahaan->name); ?>" style="width: 100%; height: 100%; object-fit: contain; padding: 4px;">
                                <?php else: ?>
                                    <span style="font-weight: 700; color: var(--color-ink); font-size: 16px;"><?php echo e(strtoupper(substr($job->perusahaan->name, 0, 1))); ?></span>
                                <?php endif; ?>
                            </div>
                            <div style="flex: 1; min-width: 0;">
                                <h3 style="font-size: 15px; font-weight: 600; color: var(--color-ink); margin-bottom: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo e($job->title); ?></h3>
                                <p style="font-size: 13px; color: var(--color-graphite);"><?php echo e($job->perusahaan->name); ?></p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 6px; flex-wrap: wrap; margin-bottom: 16px;">
                            <span class="badge <?php echo e(strtolower($job->work_system) === 'remote' ? 'badge-sky' : 'badge-fog'); ?>">
                                <?php echo e($job->work_system_label); ?>

                            </span>
                            <span class="badge <?php echo e(strtolower($job->payment_type) === 'paid' ? 'badge-apricot' : 'badge-fog'); ?>">
                                <?php echo e($job->payment_type_label); ?>

                            </span>
                            <span class="badge badge-fog"><?php echo e($job->duration_months); ?> Bulan</span>
                        </div>
                        <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                            <?php $__currentLoopData = $job->skills->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span style="font-size: 11px; color: var(--color-graphite); background: var(--color-fog); padding: 3px 8px; border-radius: 6px;"><?php echo e($skill->name); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($job->skills->count() > 3): ?>
                                <span style="font-size: 11px; color: var(--color-graphite); background: var(--color-fog); padding: 3px 8px; border-radius: 6px;">+<?php echo e($job->skills->count() - 3); ?></span>
                            <?php endif; ?>
                        </div>
                        <div style="display: flex; align-items: center; gap: 4px; margin-top: 16px; padding-top: 16px; border-top: 1px solid rgba(163,166,175,0.2);">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--color-dove)" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span style="font-size: 12px; color: var(--color-graphite);"><?php echo e($job->city ? $job->city->name : 'Indonesia'); ?></span>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p style="grid-column: span 3; text-align: center; color: var(--color-ash); padding: 40px 0;">Belum ada lowongan terbaru.</p>
                <?php endif; ?>
            </div>

            <div style="text-align: center; margin-top: 40px;">
                <a href="/mahasiswa/register" class="btn-primary" style="padding: 14px 40px; font-size: 15px;">Lihat Semua Lowongan</a>
            </div>
        </div>
    </section>

    <!-- ─── FOR COMPANIES ─────────────────────────────────── -->
    <section style="background: var(--color-ink); padding: 96px 0; position: relative; overflow: hidden;">
        <!-- Decorative blur -->
        <div style="position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: rgba(251,225,209,0.08); border-radius: 50%; filter: blur(80px);"></div>

        <div class="page-container" style="position: relative;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center;">
                <div>
                    <p style="font-size: 12px; font-weight: 600; color: rgba(163,166,175,0.8); text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 16px;">Untuk Perusahaan</p>
                    <h2 style="font-family: var(--font-serif); font-size: clamp(32px, 4vw, 48px); font-weight: 400; color: white; line-height: 1.15; letter-spacing: -0.02em; margin-bottom: 24px;">
                        Temukan Kandidat<br>
                        <span style="font-style: italic; color: var(--color-apricot-wash);">Magang Terbaik</span>
                    </h2>
                    <p style="font-size: 16px; color: rgba(163,166,175,0.9); line-height: 1.7; margin-bottom: 36px;">
                        Publikasikan lowongan, kelola pelamar, dan temukan kandidat terbaik dengan sistem Skill Match kami yang cerdas.
                    </p>
                    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <a href="/perusahaan/register" style="background: var(--color-apricot-wash); color: var(--color-rust); padding: 13px 28px; border-radius: 9999px; font-size: 14px; font-weight: 600; text-decoration: none; transition: opacity 0.2s;">Daftar Perusahaan</a>
                        <a href="/perusahaan/login" style="background: transparent; color: rgba(255,255,255,0.8); padding: 13px 28px; border-radius: 9999px; font-size: 14px; font-weight: 500; text-decoration: none; border: 1.5px solid rgba(163,166,175,0.3);">Masuk sebagai Perusahaan</a>
                    </div>
                </div>
                <div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <!-- Card 1 -->
                        <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 24px;">
                            <div style="margin-bottom: 12px; color: white;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                            </div>
                            <h3 style="font-size: 15px; font-weight: 600; color: white; margin-bottom: 8px;">Posting Mudah</h3>
                            <p style="font-size: 13px; color: rgba(163,166,175,0.8); line-height: 1.6;">Buat lowongan dalam menit dengan form yang intuitif</p>
                        </div>

                        <!-- Card 2 -->
                        <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 24px;">
                            <div style="margin-bottom: 12px; color: white;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                            </div>
                            <h3 style="font-size: 15px; font-weight: 600; color: white; margin-bottom: 8px;">Skill Match</h3>
                            <p style="font-size: 13px; color: rgba(163,166,175,0.8); line-height: 1.6;">Sistem kami mencocokkan kandidat berdasarkan keahlian</p>
                        </div>

                        <!-- Card 3 -->
                        <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 24px;">
                            <div style="margin-bottom: 12px; color: white;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/></svg>
                            </div>
                            <h3 style="font-size: 15px; font-weight: 600; color: white; margin-bottom: 8px;">Dasbor Analitik</h3>
                            <p style="font-size: 13px; color: rgba(163,166,175,0.8); line-height: 1.6;">Pantau statistik lamaran dan performa lowongan</p>
                        </div>

                        <!-- Card 4 -->
                        <div style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 24px;">
                            <div style="margin-bottom: 12px; color: white;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2-1 4-2 7-2 2.5 0 4.5 1 6 2a1 1 0 0 1 1 1v7z"/><path d="m9 12 2 2 4-4"/></svg>
                            </div>
                            <h3 style="font-size: 15px; font-weight: 600; color: white; margin-bottom: 8px;">Terverifikasi</h3>
                            <p style="font-size: 13px; color: rgba(163,166,175,0.8); line-height: 1.6;">Platform terpercaya dengan proses verifikasi perusahaan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── TESTIMONIALS REMOVED ──────────────────────────── -->

    <!-- ─── FINAL CTA ─────────────────────────────────────── -->
    <section style="padding: 96px 0;">
        <div class="page-container">
            <div style="background: var(--color-apricot-wash); border-radius: var(--radius-card); padding: 64px; text-align: center; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -60px; left: -60px; width: 200px; height: 200px; background: rgba(93,42,26,0.06); border-radius: 50%;"></div>
                <div style="position: absolute; bottom: -40px; right: -40px; width: 160px; height: 160px; background: rgba(93,42,26,0.06); border-radius: 50%;"></div>
                <div style="position: relative;">
                    <h2 class="text-section-title" style="color: var(--color-ink); font-size: 40px; margin-bottom: 16px;">Siap memulai?</h2>
                    <p style="font-size: 16px; color: var(--color-ash); margin-bottom: 36px; line-height: 1.6;">Bergabunglah dengan ribuan mahasiswa yang sudah menemukan<br>magang impian mereka lewat MaganTara.</p>
                    <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
                        <a href="/mahasiswa/register" class="btn-primary" style="padding: 14px 36px; font-size: 15px;">Daftar Gratis Sekarang</a>
                        <a href="/lowongan" class="btn-outline" style="padding: 14px 36px; font-size: 15px;">Jelajahi Lowongan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ─── FOOTER ────────────────────────────────────────── -->
    <footer style="background: var(--color-ink); padding: 48px 0 32px;">
        <div class="page-container">
            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 48px; margin-bottom: 40px;">
                <div>
                    <a href="/" class="logo-text" style="color: white; display: block; margin-bottom: 14px;">MaganTara</a>
                    <p style="font-size: 13px; color: rgba(163,166,175,0.8); line-height: 1.7; max-width: 260px;">Platform pencarian dan publikasi lowongan magang terpusat untuk mahasiswa Indonesia.</p>
                </div>
                <div>
                    <p style="font-size: 11px; font-weight: 600; color: rgba(163,166,175,0.6); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 16px;">Mahasiswa</p>
                    <?php $__currentLoopData = ['Cari Lowongan', 'Daftar', 'Masuk', 'Wishlist']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="#" style="display: block; font-size: 13px; color: rgba(163,166,175,0.8); text-decoration: none; margin-bottom: 8px; transition: color 0.15s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(163,166,175,0.8)'"><?php echo e($link); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div>
                    <p style="font-size: 11px; font-weight: 600; color: rgba(163,166,175,0.6); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 16px;">Perusahaan</p>
                    <?php $__currentLoopData = ['Pasang Lowongan', 'Daftar Perusahaan', 'Masuk', 'Verifikasi']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="#" style="display: block; font-size: 13px; color: rgba(163,166,175,0.8); text-decoration: none; margin-bottom: 8px; transition: color 0.15s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(163,166,175,0.8)'"><?php echo e($link); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div>
                    <p style="font-size: 11px; font-weight: 600; color: rgba(163,166,175,0.6); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 16px;">Platform</p>
                    <?php $__currentLoopData = ['Tentang Kami', 'Kebijakan Privasi', 'Syarat & Ketentuan', 'Hubungi Kami']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="#" style="display: block; font-size: 13px; color: rgba(163,166,175,0.8); text-decoration: none; margin-bottom: 8px; transition: color 0.15s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(163,166,175,0.8)'"><?php echo e($link); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div style="border-top: 1px solid rgba(163,166,175,0.15); padding-top: 24px; display: flex; align-items: center; justify-content: space-between;">
                <p style="font-size: 12px; color: rgba(163,166,175,0.5);">© 2026 MaganTara. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll('.counter');
            
            const animate = () => {
                counters.forEach(counter => {
                    const updateCount = () => {
                        const target = +counter.getAttribute('data-target');
                        const count = +counter.innerText;
                        
                        // Increase calculation for smooth animation
                        const inc = target / 30;

                        if (count < target) {
                            counter.innerText = Math.ceil(count + inc);
                            setTimeout(updateCount, 40);
                        } else {
                            counter.innerText = target;
                        }
                    };
                    updateCount();
                });
            };

            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    animate();
                    observer.disconnect();
                }
            }, { threshold: 0.5 });
            
            if (counters.length > 0) {
                observer.observe(counters[0]);
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\PEMWEB_ASLI\resources\views/welcome.blade.php ENDPATH**/ ?>