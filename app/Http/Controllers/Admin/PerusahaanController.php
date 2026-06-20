<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Perusahaan::with('industry');
        if ($request->filled('status')) {
            $query->where('status_verification', $request->status);
        }
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }
        $perusahaans = $query->latest()->paginate(20)->withQueryString();
        return view('admin.perusahaan.index', compact('perusahaans'));
    }

    public function show(Perusahaan $perusahaan)
    {
        $perusahaan->load('industry', 'province', 'city');
        return view('admin.perusahaan.show', compact('perusahaan'));
    }

    public function verify(Perusahaan $perusahaan)
    {
        $perusahaan->update([
            'status_verification' => 'verified',
            'verification_notes' => null
        ]);
        return back()->with('success', "Perusahaan {$perusahaan->name} berhasil diverifikasi.");
    }

    public function reject(Request $request, Perusahaan $perusahaan)
    {
        $data = $request->validate([
            'verification_notes' => ['nullable', 'string']
        ]);

        $perusahaan->update([
            'status_verification' => 'rejected',
            'verification_notes' => $data['verification_notes'] ?? null
        ]);
        return back()->with('success', "Perusahaan {$perusahaan->name} ditolak.");
    }

    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan->delete();
        return redirect()->route('admin.perusahaan.index')->with('success', 'Akun perusahaan berhasil dihapus.');
    }
}
