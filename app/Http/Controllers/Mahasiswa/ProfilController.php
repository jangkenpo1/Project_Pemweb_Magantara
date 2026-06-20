<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\Major;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function edit()
    {
        $mahasiswa  = Auth::guard('mahasiswa')->user();
        $universities = University::orderBy('name')->get();
        $majors       = Major::orderBy('name')->get();
        $skills       = Skill::orderBy('name')->get();
        $mySkillIds   = $mahasiswa->skills()->pluck('skills.id')->toArray();

        return view('mahasiswa.profil.edit', compact('mahasiswa', 'universities', 'majors', 'skills', 'mySkillIds'));
    }

    public function update(Request $request)
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();

        $data = $request->validate([
            'name'          => ['required', 'string', 'max:100'],
            'university_id' => ['nullable', 'exists:universities,id'],
            'major_id'      => ['nullable', 'exists:majors,id'],
            'semester'      => ['nullable', 'integer', 'min:1', 'max:14'],
            'bio'           => ['nullable', 'string', 'max:1000'],
            'experience'    => ['nullable', 'string'],
            'portfolio_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url'  => ['nullable', 'url', 'max:255'],
            'github_url'    => ['nullable', 'url', 'max:255'],
            'skills'        => ['nullable', 'array'],
            'skills.*'      => ['exists:skills,id'],
            'avatar'        => ['nullable', 'image', 'max:2048'],
            'cv'            => ['nullable', 'mimes:pdf', 'max:5120'],
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            if ($mahasiswa->avatar) Storage::disk('public')->delete($mahasiswa->avatar);
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        // Handle CV upload
        if ($request->hasFile('cv')) {
            if ($mahasiswa->cv_path) Storage::disk('public')->delete($mahasiswa->cv_path);
            $data['cv_path'] = $request->file('cv')->store('cvs', 'public');
        }

        $mahasiswa->update(\Illuminate\Support\Arr::except($data, ['skills']));
        $mahasiswa->skills()->sync($data['skills'] ?? []);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
