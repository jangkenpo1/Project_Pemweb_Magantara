<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();
        $bookmarks = $mahasiswa->bookmarkedLowongans()->with('perusahaan', 'skills')->latest('bookmarks.created_at')->paginate(12);
        return view('mahasiswa.wishlist.index', compact('bookmarks'));
    }

    public function toggle(Lowongan $lowongan)
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();
        $exists    = $mahasiswa->bookmarks()->where('lowongan_id', $lowongan->id)->exists();

        if ($exists) {
            $mahasiswa->bookmarks()->where('lowongan_id', $lowongan->id)->delete();
            $message = 'Lowongan dihapus dari wishlist.';
        } else {
            $mahasiswa->bookmarks()->create(['lowongan_id' => $lowongan->id]);
            $message = 'Lowongan disimpan ke wishlist!';
        }

        if (request()->wantsJson()) {
            return response()->json(['bookmarked' => !$exists, 'message' => $message]);
        }
        return back()->with('success', $message);
    }
}
