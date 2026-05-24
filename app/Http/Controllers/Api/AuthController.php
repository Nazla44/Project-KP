<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
            'device_name' => ['nullable', 'string', 'max:100'],
        ], [
            'login.required' => 'Email atau nomor HP wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::query()
            ->where('is_active', true)
            ->where('role', User::ROLE_KADER)
            ->where(function ($query) use ($validated) {
                $query->where('email', $validated['login'])
                    ->orWhere('phone_number', $validated['login']);
            })
            ->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'login' => ['Kredensial yang diberikan tidak valid.'],
            ]);
        }

        $token = $user->createToken($validated['device_name'] ?? 'api-client')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil.',
            'token_type' => 'Bearer',
            'access_token' => $token,
            'user' => $this->userPayload($user->load('kader')),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()?->delete();

        return response()->json([
            'message' => 'Logout berhasil.',
        ]);
    }

    private function userPayload(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'role' => $user->role,
            'is_active' => $user->is_active,
            'kader' => $user->kader ? [
                'id' => $user->kader->id,
                'nik' => $user->kader->nik,
                'status' => $user->kader->status,
                'provinsi' => $user->kader->provinsi,
                'kab_kota' => $user->kader->kab_kota,
                'kecamatan' => $user->kader->kecamatan,
            ] : null,
        ];
    }
}
