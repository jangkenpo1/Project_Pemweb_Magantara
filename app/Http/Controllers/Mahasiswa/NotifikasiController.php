<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();
        $notifikasis = $mahasiswa->notifikasis()->latest()->paginate(20);
        
        // Mark all as read when viewed
        $mahasiswa->notifikasis()->where('status', 'belum_dibaca')->update(['status' => 'dibaca']);

        return view('mahasiswa.notifikasi.index', compact('notifikasis'));
    }
}
