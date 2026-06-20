<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $perusahaan     = Auth::guard('perusahaan')->user();
        $totalLowongan  = $perusahaan->lowongans()->count();
        $lowonganAktif  = $perusahaan->lowongans()->where('status', 'published')->count();
        $totalPelamar   = \App\Models\Lamaran::whereHas('lowongan', fn($q) => $q->where('perusahaan_id', $perusahaan->id))->count();
        $pelamarBaru    = \App\Models\Lamaran::whereHas('lowongan', fn($q) => $q->where('perusahaan_id', $perusahaan->id))
                            ->where('status', 'dikirim')->count();
        $lowongans      = $perusahaan->lowongans()->withCount('lamarans')->latest()->take(5)->get();
        $pelamarTerbaru = \App\Models\Lamaran::whereHas('lowongan', fn($q) => $q->where('perusahaan_id', $perusahaan->id))
                            ->with('mahasiswa', 'lowongan')->latest()->take(5)->get();

        return view('perusahaan.dashboard', compact(
            'perusahaan', 'totalLowongan', 'lowonganAktif',
            'totalPelamar', 'pelamarBaru', 'lowongans', 'pelamarTerbaru'
        ));
    }
}
