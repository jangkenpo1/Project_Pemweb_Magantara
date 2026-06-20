<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();
        $lamarans = $mahasiswa->lamarans()->with('lowongan.perusahaan')->latest()->take(5)->get();
        $totalLamaran = $mahasiswa->lamarans()->count();
        $lamaranDiterima = $mahasiswa->lamarans()->where('status', 'diterima')->count();
        $lamaranProses = $mahasiswa->lamarans()->whereIn('status', ['dikirim', 'dilihat', 'seleksi', 'interview'])->count();
        $totalBookmark = $mahasiswa->bookmarks()->count();
        $lowonganTerbaru = Lowongan::published()->with('perusahaan')->latest()->take(6)->get();

        return view('mahasiswa.dashboard', compact(
            'mahasiswa', 'lamarans', 'totalLamaran',
            'lamaranDiterima', 'lamaranProses', 'totalBookmark', 'lowonganTerbaru'
        ));
    }
}
