<?php

namespace App\Http\Controllers;

use App\Models\KegiatanSosial;
use Illuminate\Http\Request;

class KegiatanSosialController extends Controller
{
    // -------------------------------------------------------
    // LIST PUBLIK — /kegiatan-sosial
    // -------------------------------------------------------
    public function index(Request $request)
    {
        $query = KegiatanSosial::published()
            ->with(['ringkasan'])
            ->latest('tanggal');

        // Filter status opsional
        if ($request->filled('status') && in_array($request->status, ['published', 'ongoing', 'completed'])) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                    ->orWhere('lokasi', 'like', '%' . $request->search . '%');
            });
        }

        $kegiatan = $query->paginate(9)->withQueryString();

        // Statistik ringkasan untuk hero section
        $stats = [
            'total' => KegiatanSosial::published()->count(),
            'completed' => KegiatanSosial::completed()->count(),
            'upcoming' => KegiatanSosial::upcoming()->count(),
        ];

        return view('pages.kegiatan-sosial', compact('kegiatan', 'stats'));
    }

    public function show(string $slug)
    {
        $kegiatan = KegiatanSosial::published()
            ->with([
                'kaders.user',          // nama kader pelaksana
                'materi',               // materi edukasi TBC
                'dokumentasi',          // galeri foto
                'ringkasan',            // statistik umum
            ])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.kegiatan-sosial.detail', compact('kegiatan'));
    }
}