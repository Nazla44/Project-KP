<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\View\View;

class KaderPasswordController extends Controller
{
    public function edit(Request $request, string $token): View
    {
        return view('auth.kader-set-password', [
            'pageTitle' => 'Buat Password Kader',
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'token' => ['required', 'string'],
                'email' => ['required', 'email'],
                'password' => ['required', 'confirmed', PasswordRule::min(8)],
            ],
            [
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'password.required' => 'Password wajib diisi.',
                'password.confirmed' => 'Konfirmasi password tidak sesuai.',
                'password.min' => 'Password minimal 8 karakter.',
            ],
        );

        $status = Password::broker()->reset($validated, function (User $user, string $password) {
            $user
                ->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                    'is_active' => true,
                ])
                ->save();

            event(new PasswordReset($user));
        });

        if ($status !== Password::PASSWORD_RESET) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => __($status),
                ]);
        }

        return redirect()->route('kader.password.created')->with('password_created_success', true)->with('kader_email', $validated['email']);
    }

    public function created(): Response|RedirectResponse
    {
        if (!session('password_created_success')) {
            return redirect()->route('home');
        }

        return response()
            ->view('auth.kader-password-created', [
                'pageTitle' => 'Password Berhasil Dibuat',
                'email' => session('kader_email'),
            ])
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }
}
