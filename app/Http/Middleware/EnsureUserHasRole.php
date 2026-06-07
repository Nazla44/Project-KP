<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! Auth::check()) {
            if ($request->is('admin') || $request->is('admin/*')) {
                return redirect()->route('admin.login');
            }

            if ($request->is('kader') || $request->is('kader/*')) {
                return redirect()->route('kader.login');
            }

            return redirect()->route('home');
        }

        $user = Auth::user();

        if (! in_array($user->role, $roles, true)) {
            /*
            |--------------------------------------------------------------------------
            | Sedang login sebagai kader, tapi akses halaman admin
            |--------------------------------------------------------------------------
            */
            if ($request->is('admin') || $request->is('admin/*')) {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()
                    ->route('admin.login')
                    ->withErrors([
                        'email' => 'Silakan login menggunakan akun admin.',
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Sedang login sebagai admin, tapi akses halaman kader
            |--------------------------------------------------------------------------
            */
            if ($request->is('kader') || $request->is('kader/*')) {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()
                    ->route('kader.login')
                    ->withErrors([
                        'login' => 'Silakan login menggunakan akun kader.',
                    ]);
            }

            abort(403);
        }

        return $next($request);
    }
}