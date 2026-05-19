<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Klinik;
use App\Models\KlinikImport;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $users = User::query();
        $kliniks = Klinik::query();
        $articles = Artikel::query();
        $hasKlinikImportsTable = Schema::hasTable('klinik_imports');

        return view('admin.dashboard', [
            'pageTitle' => 'Overview',
            'stats' => [
                'total_users' => (clone $users)->count(),
                'active_kliniks' => (clone $kliniks)->where('status', 'aktif')->count(),
                'published_articles' => (clone $articles)->where('status', 'tayang')->count(),
                'draft_articles' => (clone $articles)->where('status', 'draft')->count(),
            ],
            'recentArticles' => Artikel::query()->latest('updated_at')->take(5)->get(),
            'recentKliniks' => Klinik::query()->latest('updated_at')->take(5)->get(),
            'recentUsers' => User::query()->latest()->take(5)->get(),
            'recentImports' => $hasKlinikImportsTable
                ? KlinikImport::query()->latest()->take(5)->get()
                : collect(),
        ]);
    }
}
