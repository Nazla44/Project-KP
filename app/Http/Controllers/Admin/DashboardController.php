<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $users = User::query();

        return view('admin.dashboard', [
            'pageTitle' => 'Overview',
            'stats' => [
                'total_users' => (clone $users)->count(),
                'super_admins' => (clone $users)->where('role', User::ROLE_SUPER_ADMIN)->count(),
                'kaders' => (clone $users)->where('role', User::ROLE_KADER)->count(),
                'active_users' => (clone $users)->where('is_active', true)->count(),
            ],
            'recentUsers' => User::query()->latest()->take(5)->get(),
        ]);
    }
}
