<?php

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

// Auth: Mahasiswa
use App\Http\Controllers\Auth\Mahasiswa\LoginController as MahasiswaLoginController;
use App\Http\Controllers\Auth\Mahasiswa\RegisterController as MahasiswaRegisterController;

// Auth: Perusahaan
use App\Http\Controllers\Auth\Perusahaan\LoginController as PerusahaanLoginController;
use App\Http\Controllers\Auth\Perusahaan\RegisterController as PerusahaanRegisterController;

// Auth: Admin
use App\Http\Controllers\Auth\Admin\LoginController as AdminLoginController;

// Mahasiswa
use App\Http\Controllers\Mahasiswa\DashboardController as MahasiswaDashboard;
use App\Http\Controllers\Mahasiswa\ProfilController as MahasiswaProfil;
use App\Http\Controllers\Mahasiswa\LamaranController;
use App\Http\Controllers\Mahasiswa\BookmarkController;

// Public Lowongan
use App\Http\Controllers\LowonganController;

// Perusahaan
use App\Http\Controllers\Perusahaan\DashboardController as PerusahaanDashboard;
use App\Http\Controllers\Perusahaan\LowonganController as PerusahaanLowongan;
use App\Http\Controllers\Perusahaan\PelamarController;
use App\Http\Controllers\Perusahaan\ProfilController as PerusahaanProfil;

// Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\PerusahaanController as AdminPerusahaan;
use App\Http\Controllers\Admin\MahasiswaController as AdminMahasiswa;
use App\Http\Controllers\Admin\LowonganController as AdminLowongan;
use App\Http\Controllers\Admin\MasterDataController;

// ─── Landing Page ─────────────────────────────────────────────────
Route::get('/', function () {
    $stats = [
        'mahasiswa'  => \App\Models\Mahasiswa::count(),
        'perusahaan' => \App\Models\Perusahaan::where('status_verification', 'verified')->count(),
        'lowongan'   => \App\Models\Lowongan::where('status', 'published')->count(),
    ];

    $latestLowongan = \App\Models\Lowongan::with(['perusahaan', 'city', 'skills'])
        ->where('status', 'published')
        ->latest()
        ->take(6)
        ->get();

    return view('welcome', compact('stats', 'latestLowongan'));
})->name('home');

// ─── Auth: Mahasiswa ───────────────────────────────────────────────
Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/login',    [MahasiswaLoginController::class,    'showLogin'])->name('login');
    Route::post('/login',   [MahasiswaLoginController::class,    'login']);
    Route::post('/logout',  [MahasiswaLoginController::class,    'logout'])->name('logout');
    Route::get('/register', [MahasiswaRegisterController::class, 'showRegister'])->name('register');
    Route::post('/register',[MahasiswaRegisterController::class, 'register']);
});

// ─── Mahasiswa Dashboard (protected) ──────────────────────────────
Route::prefix('mahasiswa')->name('mahasiswa.')->middleware('auth:mahasiswa')->group(function () {
    Route::get('/dashboard', [MahasiswaDashboard::class, 'index'])->name('dashboard');

    // Profil
    Route::get('/profil',    [MahasiswaProfil::class, 'edit'])->name('profil.edit');
    Route::post('/profil',   [MahasiswaProfil::class, 'update'])->name('profil.update');

    // Notifikasi
    Route::get('/notifikasi', [\App\Http\Controllers\Mahasiswa\NotifikasiController::class, 'index'])->name('notifikasi.index');

    // Lamaran
    Route::get('/lamaran',                [LamaranController::class, 'index'])->name('lamaran.index');
    Route::post('/lamaran/{lowongan}',    [LamaranController::class, 'store'])->name('lamaran.store');
    Route::post('/lamaran/{lamaran}/cancel', [LamaranController::class, 'cancel'])->name('lamaran.cancel');

    // Wishlist / Bookmark
    Route::get('/wishlist',                  [BookmarkController::class, 'index'])->name('wishlist.index');
    Route::post('/bookmark/{lowongan}',      [BookmarkController::class, 'toggle'])->name('bookmark.toggle');
});

// ─── Public: Lowongan ──────────────────────────────────────────────
Route::prefix('lowongan')->name('lowongan.')->group(function () {
    Route::get('/',           [LowonganController::class, 'index'])->name('index');
    Route::get('/{lowongan}', [LowonganController::class, 'show'])->name('show');
});

// ─── Auth: Perusahaan ─────────────────────────────────────────────
Route::prefix('perusahaan')->name('perusahaan.')->group(function () {
    Route::get('/login',     [PerusahaanLoginController::class,    'showLogin'])->name('login');
    Route::post('/login',    [PerusahaanLoginController::class,    'login']);
    Route::post('/logout',   [PerusahaanLoginController::class,    'logout'])->name('logout');
    Route::get('/register',  [PerusahaanRegisterController::class, 'showRegister'])->name('register');
    Route::post('/register', [PerusahaanRegisterController::class, 'register']);
});

// ─── Perusahaan Dashboard (protected) ─────────────────────────────
Route::prefix('perusahaan')->name('perusahaan.')->middleware('auth:perusahaan')->group(function () {
    Route::get('/dashboard', [PerusahaanDashboard::class, 'index'])->name('dashboard');

    // Profil
    Route::get('/profil',    [PerusahaanProfil::class, 'edit'])->name('profil.edit');
    Route::post('/profil',   [PerusahaanProfil::class, 'update'])->name('profil.update');


    // Notifikasi
    Route::get('/notifikasi', [\App\Http\Controllers\Perusahaan\NotifikasiController::class, 'index'])->name('notifikasi.index');

    // Lowongan
    Route::get('/lowongan',              [PerusahaanLowongan::class, 'index'])->name('lowongan.index');
    Route::get('/lowongan/create',       [PerusahaanLowongan::class, 'create'])->name('lowongan.create');
    Route::post('/lowongan',             [PerusahaanLowongan::class, 'store'])->name('lowongan.store');
    Route::get('/lowongan/{lowongan}/edit',   [PerusahaanLowongan::class, 'edit'])->name('lowongan.edit');
    Route::put('/lowongan/{lowongan}',        [PerusahaanLowongan::class, 'update'])->name('lowongan.update');
    Route::delete('/lowongan/{lowongan}',     [PerusahaanLowongan::class, 'destroy'])->name('lowongan.destroy');

    // Pelamar
    Route::get('/pelamar',                      [PelamarController::class, 'index'])->name('pelamar.index');
    Route::get('/pelamar/{lamaran}',             [PelamarController::class, 'show'])->name('pelamar.show');
    Route::put('/pelamar/{lamaran}/status',     [PelamarController::class, 'updateStatus'])->name('pelamar.updateStatus');
});

// ─── Auth: Admin ──────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',    [AdminLoginController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AdminLoginController::class, 'login']);
    Route::post('/logout',  [AdminLoginController::class, 'logout'])->name('logout');
});

// ─── Admin Panel (protected) ───────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Perusahaan Management
    Route::get('/perusahaan',                    [AdminPerusahaan::class, 'index'])->name('perusahaan.index');
    Route::get('/perusahaan/{perusahaan}',        [AdminPerusahaan::class, 'show'])->name('perusahaan.show');
    Route::post('/perusahaan/{perusahaan}/verify',[AdminPerusahaan::class, 'verify'])->name('perusahaan.verify');
    Route::post('/perusahaan/{perusahaan}/reject',[AdminPerusahaan::class, 'reject'])->name('perusahaan.reject');
    Route::delete('/perusahaan/{perusahaan}',     [AdminPerusahaan::class, 'destroy'])->name('perusahaan.destroy');

    // Mahasiswa Management
    Route::get('/mahasiswa',             [AdminMahasiswa::class, 'index'])->name('mahasiswa.index');
    Route::delete('/mahasiswa/{mahasiswa}', [AdminMahasiswa::class, 'destroy'])->name('mahasiswa.destroy');

    // Lowongan Management
    Route::get('/lowongan',              [AdminLowongan::class, 'index'])->name('lowongan.index');
    Route::delete('/lowongan/{lowongan}',[AdminLowongan::class, 'destroy'])->name('lowongan.destroy');

    // Master Data
    Route::get('/master/skill',               [MasterDataController::class, 'skills'])->name('master.skill');
    Route::post('/master/skill',              [MasterDataController::class, 'storeSkill'])->name('master.skill.store');
    Route::delete('/master/skill/{skill}',    [MasterDataController::class, 'destroySkill'])->name('master.skill.destroy');

    Route::get('/master/industri',               [MasterDataController::class, 'industri'])->name('master.industri');
    Route::post('/master/industri',              [MasterDataController::class, 'storeIndustri'])->name('master.industri.store');
    Route::delete('/master/industri/{industry}', [MasterDataController::class, 'destroyIndustri'])->name('master.industri.destroy');

    Route::get('/master/universitas',                  [MasterDataController::class, 'universitas'])->name('master.universitas');
    Route::post('/master/universitas',                 [MasterDataController::class, 'storeUniversitas'])->name('master.universitas.store');
    Route::delete('/master/universitas/{university}',  [MasterDataController::class, 'destroyUniversitas'])->name('master.universitas.destroy');
});

// API endpoint for dynamic cities
Route::get('/api/provinces/{province}/cities', function (\App\Models\Province $province) {
    return response()->json($province->cities()->orderBy('name')->get(['id', 'name']));
});
