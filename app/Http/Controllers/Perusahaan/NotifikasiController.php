<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        $perusahaan = Auth::guard('perusahaan')->user();
        $notifikasis = $perusahaan->notifikasis()->latest()->paginate(20);
        
        // Mark all as read when viewed
        $perusahaan->notifikasis()->where('status', 'belum_dibaca')->update(['status' => 'dibaca']);

        return view('perusahaan.notifikasi.index', compact('notifikasis'));
    }
}
