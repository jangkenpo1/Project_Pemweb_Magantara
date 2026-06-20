<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use App\Models\Province;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function edit()
    {
        $perusahaan = Auth::guard('perusahaan')->user();
        $industries = Industry::orderBy('name')->get();
        $provinces  = Province::orderBy('name')->get();
        $cities     = $perusahaan->province_id ? City::where('province_id', $perusahaan->province_id)->get() : collect();
        return view('perusahaan.profil.edit', compact('perusahaan', 'industries', 'provinces', 'cities'));
    }

    public function update(Request $request)
    {
        $perusahaan = Auth::guard('perusahaan')->user();

        $data = $request->validate([
            'name'                => ['required', 'string', 'max:100'],
            'email'               => ['required', 'email', 'unique:perusahaans,email,' . $perusahaan->id],
            'description'         => ['nullable', 'string'],
            'industry_id'         => ['nullable', 'exists:industries,id'],
            'website_url'         => ['nullable', 'url'],
            'employee_scale'      => ['nullable', 'string'],
            'office_address'      => ['nullable', 'url'],
            'province_id'         => ['nullable', 'exists:provinces,id'],
            'city_id'             => ['nullable', 'exists:cities,id'],
            'logo'                => ['nullable', 'image', 'max:2048'],
            'legal_document'      => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ]);

        if ($request->hasFile('logo')) {
            if ($perusahaan->logo) Storage::disk('public')->delete($perusahaan->logo);
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        if ($request->hasFile('legal_document')) {
            if ($perusahaan->legal_document_path) Storage::disk('public')->delete($perusahaan->legal_document_path);
            $data['legal_document_path'] = $request->file('legal_document')->store('legal_documents', 'public');
        }

        if ($request->boolean('submit_verification') || $request->boolean('resubmit')) {
            if (!$perusahaan->legal_document_path && !$request->hasFile('legal_document')) {
                return back()->withInput()->withErrors(['legal_document' => 'Dokumen NIB/NPWP wajib diunggah untuk pengajuan verifikasi.']);
            }
            $data['status_verification'] = 'pending';
        }

        $perusahaan->update($data);

        return back()->with('success', 'Profil perusahaan berhasil diperbarui.');
    }

}
