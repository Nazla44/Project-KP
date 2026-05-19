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
        return view('admin.dashboard', [
            'pageTitle' => 'Dashboard',

            'stats' => [
                'total_users' => User::query()->count(),
                'active_users' => User::query()->where('is_active', true)->count(),

                'total_kliniks' => Klinik::query()->count(),
                'active_kliniks' => Klinik::query()->where('status', 'aktif')->count(),

                'total_articles' => Artikel::query()->count(),
                'published_articles' => Artikel::query()->where('status', 'tayang')->count(),
                'draft_articles' => Artikel::query()->where('status', 'draft')->count(),
            ],

            'recentUsers' => User::query()
                ->latest()
                ->take(5)
                ->get(),

            'recentArticles' => Artikel::query()
                ->latest()
                ->take(5)
                ->get(),

            'recentKliniks' => Klinik::query()
                ->latest()
                ->take(5)
                ->get(),

            'recentImports' => Schema::hasTable('klinik_imports')
                ? KlinikImport::query()
                    ->with('user')
                    ->latest()
                    ->take(5)
                    ->get()
                : collect(),
        ]);
    }
}