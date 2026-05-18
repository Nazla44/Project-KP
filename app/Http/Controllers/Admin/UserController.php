<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', [
            'pageTitle' => 'Kelola User',
            'users' => User::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone_number' => ['nullable', 'string', 'max:20', 'unique:users,phone_number'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in([User::ROLE_SUPER_ADMIN, User::ROLE_KADER])],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'email.unique' => 'Email sudah digunakan.',
            'phone_number.unique' => 'Nomor HP sudah digunakan.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'role.in' => 'Role tidak valid.',
        ]);

        User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'] ?? null,
            'password' => $validated['password'],
            'role' => $validated['role'],
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ]);

        return redirect()->route('admin.users.index')->with('status', 'User berhasil dibuat.');
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone_number' => ['nullable', 'string', 'max:20', Rule::unique('users', 'phone_number')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in([User::ROLE_SUPER_ADMIN, User::ROLE_KADER])],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'email.unique' => 'Email sudah digunakan.',
            'phone_number.unique' => 'Nomor HP sudah digunakan.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'role.in' => 'Role tidak valid.',
        ]);

        if (blank($validated['password'] ?? null)) {
            unset($validated['password']);
        }

        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        $user->fill($validated);
        $user->save();

        return redirect()->route('admin.users.index')->with('status', 'Data user berhasil diperbarui.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($request->user()?->is($user)) {
            return redirect()->route('admin.users.index')->with('status', 'Akun yang sedang digunakan tidak dapat dihapus.');
        }

        $user->tokens()->delete();
        $user->delete();

        return redirect()->route('admin.users.index')->with('status', 'User berhasil dihapus.');
    }
}
