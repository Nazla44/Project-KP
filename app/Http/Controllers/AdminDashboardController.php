<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use App\Models\Artikel;
use App\Models\Klinik;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalKader = Kader::count();
        $totalKlinik = Klinik::count();
        $totalArtikel = Artikel::where('status', 'tayang')->count();

        return view('admin.dashboard', compact('totalKader', 'totalKlinik', 'totalArtikel'));
    }
}