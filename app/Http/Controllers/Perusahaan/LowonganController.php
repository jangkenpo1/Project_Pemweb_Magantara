<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use App\Models\Skill;
use App\Models\Major;
use App\Models\Province;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LowonganController extends Controller
{
    protected function perusahaan()
    {
        return Auth::guard('perusahaan')->user();
    }

    public function index()
    {
        $lowongans = $this->perusahaan()->lowongans()->withCount('lamarans')->latest()->paginate(15);
        return view('perusahaan.lowongan.index', compact('lowongans'));
    }

    public function create()
    {
        if (!$this->perusahaan()->isVerified()) {
            return redirect()->route('perusahaan.lowongan.index')
                ->with('error', 'Akun Anda belum diverifikasi. Silakan lengkapi profil dan tunggu verifikasi admin.');
        }
        $skills    = Skill::orderBy('name')->get();
        $majors    = Major::orderBy('name')->get();
        $provinces = Province::orderBy('name')->get();
        $cities    = old('province_id') ? City::where('province_id', old('province_id'))->get() : collect();
        return view('perusahaan.lowongan.create', compact('skills', 'majors', 'provinces', 'cities'));
    }

    public function store(Request $request)
    {
        if (!$this->perusahaan()->isVerified()) abort(403);

        $data = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'description'      => ['required', 'string'],
            'responsibilities' => ['nullable', 'string'],
            'qualifications'   => ['nullable', 'string'],
            'benefits'         => ['nullable', 'string'],
            'work_system'      => ['required', 'in:remote,hybrid,onsite'],
            'payment_type'     => ['required', 'in:paid,unpaid'],
            'duration_months'  => ['required', 'in:1,2,3,6'],
            'quota'            => ['required', 'integer', 'min:1'],
            'deadline'         => ['required', 'date', 'after:today'],
            'status'           => ['required', 'in:draft,published'],
            'province_id'      => ['nullable', 'exists:provinces,id'],
            'city_id'          => ['nullable', 'exists:cities,id'],
            'address'          => ['nullable', 'string'],
            'gmaps_url'        => ['nullable', 'url'],
            'skills'           => ['nullable', 'array'],
            'skills.*'         => ['exists:skills,id'],
            'majors'           => ['nullable', 'array'],
            'majors.*'         => ['exists:majors,id'],
        ]);

        $lowongan = $this->perusahaan()->lowongans()->create(\Illuminate\Support\Arr::except($data, ['skills', 'majors']));
        $lowongan->skills()->sync($data['skills'] ?? []);
        $lowongan->majors()->sync($data['majors'] ?? []);

        return redirect()->route('perusahaan.lowongan.index')->with('success', 'Lowongan berhasil ' . ($data['status'] === 'published' ? 'dipublikasikan' : 'disimpan sebagai draft') . '!');
    }

    public function edit(Lowongan $lowongan)
    {
        if ($lowongan->perusahaan_id !== $this->perusahaan()->id) abort(403);
        $skills    = Skill::orderBy('name')->get();
        $majors    = Major::orderBy('name')->get();
        $provinces = Province::orderBy('name')->get();
        $cities    = $lowongan->province_id ? City::where('province_id', $lowongan->province_id)->get() : collect();
        $mySkills  = $lowongan->skills()->pluck('skills.id')->toArray();
        $myMajors  = $lowongan->majors()->pluck('majors.id')->toArray();
        return view('perusahaan.lowongan.edit', compact('lowongan', 'skills', 'majors', 'provinces', 'cities', 'mySkills', 'myMajors'));
    }

    public function update(Request $request, Lowongan $lowongan)
    {
        if ($lowongan->perusahaan_id !== $this->perusahaan()->id) abort(403);

        $data = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'description'      => ['required', 'string'],
            'responsibilities' => ['nullable', 'string'],
            'qualifications'   => ['nullable', 'string'],
            'benefits'         => ['nullable', 'string'],
            'work_system'      => ['required', 'in:remote,hybrid,onsite'],
            'payment_type'     => ['required', 'in:paid,unpaid'],
            'duration_months'  => ['required', 'in:1,2,3,6'],
            'quota'            => ['required', 'integer', 'min:1'],
            'deadline'         => ['required', 'date'],
            'status'           => ['required', 'in:draft,published,closed'],
            'province_id'      => ['nullable', 'exists:provinces,id'],
            'city_id'          => ['nullable', 'exists:cities,id'],
            'address'          => ['nullable', 'string'],
            'gmaps_url'        => ['nullable', 'url'],
            'skills'           => ['nullable', 'array'],
            'skills.*'         => ['exists:skills,id'],
            'majors'           => ['nullable', 'array'],
            'majors.*'         => ['exists:majors,id'],
        ]);

        $lowongan->update(\Illuminate\Support\Arr::except($data, ['skills', 'majors']));
        $lowongan->skills()->sync($data['skills'] ?? []);
        $lowongan->majors()->sync($data['majors'] ?? []);

        return redirect()->route('perusahaan.lowongan.index')->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(Lowongan $lowongan)
    {
        if ($lowongan->perusahaan_id !== $this->perusahaan()->id) abort(403);
        $lowongan->delete();
        return back()->with('success', 'Lowongan berhasil dihapus.');
    }
}
