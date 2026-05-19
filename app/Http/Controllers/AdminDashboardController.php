<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use App\Models\Artikel;
use App\Models\Klinik;
use App\Models\Laporan;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalKader = Kader::count();
        $totalKlinik = Klinik::count();
        $totalArtikel = Artikel::where('status', 'tayang')->count();
        $totalLaporan = Laporan::count();

        return view('admin.dashboard', compact('totalKader', 'totalKlinik', 'totalArtikel', 'totalLaporan'));
    }
}