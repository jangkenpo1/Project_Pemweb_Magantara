<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Perusahaan;
use App\Models\Lowongan;
use App\Models\Lamaran;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_mahasiswa'  => Mahasiswa::count(),
            'total_perusahaan' => Perusahaan::count(),
            'total_lowongan'   => Lowongan::withTrashed()->count(),
            'total_lamaran'    => Lamaran::count(),
            'pending_verify'   => Perusahaan::where('status_verification', 'pending')->count(),
            'lowongan_aktif'   => Lowongan::where('status', 'published')->count(),
        ];

        $perusahaanPending = Perusahaan::where('status_verification', 'pending')
            ->with('industry')->latest()->take(5)->get();

        $lowonganTerbaru = Lowongan::with('perusahaan')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'perusahaanPending', 'lowonganTerbaru'));
    }
}
