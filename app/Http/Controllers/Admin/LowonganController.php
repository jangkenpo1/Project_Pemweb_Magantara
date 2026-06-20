<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index(Request $request)
    {
        $query = Lowongan::with('perusahaan');
        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $lowongans = $query->latest()->paginate(20)->withQueryString();
        return view('admin.lowongan.index', compact('lowongans'));
    }

    public function destroy(Lowongan $lowongan)
    {
        $lowongan->forceDelete();
        return back()->with('success', 'Lowongan berhasil dihapus permanen.');
    }
}
