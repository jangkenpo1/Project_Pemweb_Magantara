<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelamarController extends Controller
{
    protected function perusahaan()
    {
        return Auth::guard('perusahaan')->user();
    }

    public function index(Request $request)
    {
        $query = Lamaran::whereHas('lowongan', fn($q) => $q->where('perusahaan_id', $this->perusahaan()->id))
            ->with('mahasiswa.skills', 'lowongan');

        if ($request->filled('lowongan_id')) {
            $query->where('lowongan_id', $request->lowongan_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('min_match')) {
            // Filter by skill match done in PHP (collection)
        }

        $lamarans  = $query->latest()->paginate(15)->withQueryString();
        $lowongans = $this->perusahaan()->lowongans()->get();

        return view('perusahaan.pelamar.index', compact('lamarans', 'lowongans'));
    }

    public function show(Lamaran $lamaran)
    {
        if ($lamaran->lowongan->perusahaan_id !== $this->perusahaan()->id) abort(403);
        $lamaran->load('mahasiswa.skills', 'mahasiswa.university', 'mahasiswa.major', 'lowongan');

        if ($lamaran->status === 'dikirim') {
            $lamaran->update(['status' => 'dilihat']);
        }

        $skillMatch = $lamaran->mahasiswa->skillMatchPercentage($lamaran->lowongan);
        return view('perusahaan.pelamar.show', compact('lamaran', 'skillMatch'));
    }

    public function updateStatus(Request $request, Lamaran $lamaran)
    {
        if ($lamaran->lowongan->perusahaan_id !== $this->perusahaan()->id) abort(403);
        if ($lamaran->status === 'dibatalkan') {
            return back()->with('error', 'Status lamaran yang dibatalkan tidak bisa diubah.');
        }

        $data = $request->validate([
            'status'          => ['required', 'in:dilihat,interview,diterima,ditolak'],
            'interview_date'  => ['nullable', 'required_if:status,interview', 'date'],
            'interview_url'   => ['nullable', 'required_if:status,interview', 'url'],
            'recruiter_notes' => ['nullable', 'string'],
        ]);

        $oldStatus = $lamaran->status;
        $lamaran->update($data);

        // Notifikasi Mahasiswa
        if ($oldStatus !== $data['status'] || $data['status'] === 'interview') {
            $judul = 'Status Lamaran Diperbarui';
            $isi = "Status lamaranmu untuk posisi {$lamaran->lowongan->title} di {$lamaran->lowongan->perusahaan->name} telah diperbarui menjadi {$lamaran->status_label}.";
            
            if ($data['status'] === 'interview') {
                $isi .= " Silakan cek detail jadwal dan tautan interview di halaman lamaranmu.";
            }

            $lamaran->mahasiswa->notifikasis()->create([
                'judul'  => $judul,
                'isi'    => $isi,
                'url'    => '/mahasiswa/lamaran',
                'status' => 'belum_dibaca'
            ]);
        }

        return back()->with('success', 'Status lamaran berhasil diperbarui.');
    }
}
