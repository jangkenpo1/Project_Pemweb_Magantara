<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\Lowongan;
use App\Models\Province;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LowonganController extends Controller
{
    public function index(Request $request)
    {
        $query = Lowongan::published()->with('perusahaan', 'skills', 'city', 'province');

        if ($request->filled('q')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                  ->orWhereHas('perusahaan', fn($p) => $p->where('name', 'like', '%' . $request->q . '%'));
            });
        }
        if ($request->filled('industri')) {
            $query->whereHas('perusahaan', fn($p) => $p->where('industry_id', $request->industri));
        }
        if ($request->filled('work_system')) {
            $query->where('work_system', $request->work_system);
        }
        if ($request->filled('payment_type')) {
            $query->where('payment_type', $request->payment_type);
        }
        if ($request->filled('skill')) {
            $query->whereHas('skills', fn($s) => $s->where('skills.id', $request->skill));
        }
        if ($request->filled('provinsi')) {
            $query->where('province_id', $request->provinsi);
        }

        $lowongans  = $query->latest()->paginate(12)->withQueryString();
        $industries = Industry::orderBy('name')->get();
        $skills     = Skill::orderBy('name')->get();
        $provinces  = Province::orderBy('name')->get();

        return view('lowongan.index', compact('lowongans', 'industries', 'skills', 'provinces'));
    }

    public function show(Lowongan $lowongan)
    {
        if ($lowongan->status !== 'published') abort(404);

        $lowongan->load('perusahaan.industry', 'skills', 'majors', 'city', 'province');
        $mahasiswa   = Auth::guard('mahasiswa')->user();
        $sudahLamar  = false;
        $sudahSimpan = false;
        $skillMatch  = 0;

        if ($mahasiswa) {
            $sudahLamar  = $mahasiswa->lamarans()->where('lowongan_id', $lowongan->id)->exists();
            $sudahSimpan = $mahasiswa->bookmarks()->where('lowongan_id', $lowongan->id)->exists();
            $skillMatch  = $mahasiswa->skillMatchPercentage($lowongan);
        }

        $lowonganLain = Lowongan::published()
            ->where('id', '!=', $lowongan->id)
            ->whereHas('perusahaan', fn($p) => $p->where('industry_id', $lowongan->perusahaan->industry_id))
            ->with('perusahaan', 'skills')
            ->take(4)->get();

        return view('lowongan.show', compact('lowongan', 'sudahLamar', 'sudahSimpan', 'skillMatch', 'lowonganLain', 'mahasiswa'));
    }
}
