<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LamaranController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();
        $lamarans  = $mahasiswa->lamarans()->with('lowongan.perusahaan')->latest()->paginate(10);
        return view('mahasiswa.lamaran.index', compact('lamarans'));
    }

    public function store(Request $request, Lowongan $lowongan)
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();

        if (!$mahasiswa->cv_path) {
            return back()->with('error', 'Anda harus mengupload CV terlebih dahulu sebelum melamar.');
        }
        if ($mahasiswa->lamarans()->where('lowongan_id', $lowongan->id)->exists()) {
            return back()->with('error', 'Anda sudah melamar pada lowongan ini.');
        }
        if ($lowongan->status !== 'published') {
            return back()->with('error', 'Lowongan ini sudah tidak tersedia.');
        }

        $mahasiswa->lamarans()->create([
            'lowongan_id'      => $lowongan->id,
            'cv_snapshot_path' => $mahasiswa->cv_path,
            'portfolio_url'    => $mahasiswa->portfolio_url,
            'cover_letter'     => $request->cover_letter,
            'status'           => 'dikirim',
        ]);

        return redirect()->route('mahasiswa.lamaran.index')->with('success', 'Lamaran berhasil dikirim!');
    }

    public function cancel(Lamaran $lamaran)
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();

        if ($lamaran->mahasiswa_id !== $mahasiswa->id) abort(403);
        if ($lamaran->status !== 'dikirim') {
            return back()->with('error', 'Lamaran hanya bisa dibatalkan saat masih berstatus Dikirim.');
        }

        $lamaran->update(['status' => 'dibatalkan']);
        return back()->with('success', 'Lamaran berhasil dibatalkan.');
    }
}
