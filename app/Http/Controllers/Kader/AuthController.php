<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()->role === 'kader') {
            return redirect()->route('kader.dashboard');
        }

        return view('kader.auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'login.required' => 'Email atau nomor HP wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::query()
            ->where('role', 'kader')
            ->where('is_active', true)
            ->where(function ($query) use ($validated) {
                $query
                    ->where('email', $validated['login'])
                    ->orWhere('phone_number', $validated['login']);
            })
            ->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'login' => 'Email/nomor HP atau password tidak valid.',
            ]);
        }

        if (! $user->kader || $user->kader->status !== 'aktif') {
            throw ValidationException::withMessages([
                'login' => 'Akun kader belum aktif atau belum diverifikasi admin.',
            ]);
        }

        if (Auth::check()) {
            Auth::logout();
        }

        Auth::login($user, $request->boolean('remember'));

        $request->session()->regenerate();

       return redirect()
        ->route('kader.dashboard')
        ->with('success', 'Login kader berhasil. Selamat datang.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('kader.login');
    }
}