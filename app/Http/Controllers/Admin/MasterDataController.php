<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\Industry;
use App\Models\University;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    // SKILLS
    public function skills()
    {
        $skills = Skill::orderBy('name')->paginate(30);
        return view('admin.master.skills', compact('skills'));
    }

    public function storeSkill(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:100', 'unique:skills,name']]);
        Skill::create($data);
        return back()->with('success', 'Skill berhasil ditambahkan.');
    }

    public function destroySkill(Skill $skill)
    {
        $skill->delete();
        return back()->with('success', 'Skill berhasil dihapus.');
    }

    // INDUSTRI
    public function industri()
    {
        $industries = Industry::orderBy('name')->paginate(30);
        return view('admin.master.industri', compact('industries'));
    }

    public function storeIndustri(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:100', 'unique:industries,name']]);
        Industry::create($data);
        return back()->with('success', 'Bidang industri berhasil ditambahkan.');
    }

    public function destroyIndustri(Industry $industry)
    {
        $industry->delete();
        return back()->with('success', 'Bidang industri berhasil dihapus.');
    }

    // UNIVERSITAS
    public function universitas()
    {
        $universities = University::orderBy('name')->paginate(30);
        return view('admin.master.universitas', compact('universities'));
    }

    public function storeUniversitas(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:150', 'unique:universities,name']]);
        University::create($data);
        return back()->with('success', 'Universitas berhasil ditambahkan.');
    }

    public function destroyUniversitas(University $university)
    {
        $university->delete();
        return back()->with('success', 'Universitas berhasil dihapus.');
    }
}
