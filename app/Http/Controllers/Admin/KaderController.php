<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\KaderApprovedMail;
use App\Mail\KaderRejectedMail;
use App\Models\Kader;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class KaderController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');

        $kaders = Kader::query()
            ->with(['user', 'approvedBy', 'rejectedBy'])
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->get();

        $statusOptions = $this->statusOptions();

        return view('admin.kaders.index', [
            'pageTitle' => 'Approval Kader',
            'kaders' => $kaders,
            'activeStatus' => $status,
            'statusOptions' => $statusOptions,
            'statusCounts' => Kader::query()
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status'),
        ]);
    }

    public function show(Kader $kader): View
    {
        $kader->load(['user', 'klinik', 'approvedBy', 'rejectedBy']);

        return view('admin.kaders.show', [
            'pageTitle' => 'Detail Kader',
            'kader' => $kader,
        ]);
    }

    public function approve(Request $request, Kader $kader): RedirectResponse
    {
        if (! $kader->isPending()) {
            return back()->withErrors([
                'approve' => 'Pendaftaran ini sudah diproses sebelumnya.',
            ]);
        }

        if (User::query()->where('email', $kader->email)->exists()) {
            throw ValidationException::withMessages([
                'email' => 'Email kader sudah digunakan oleh user lain.',
            ]);
        }

        $token = null;
        $user = null;

        DB::transaction(function () use ($request, $kader, &$token, &$user) {
            $user = User::query()->create([
                'name' => $kader->nama,
                'email' => $kader->email,
                'phone_number' => $kader->hp,
                'password' => Str::random(64),
                'role' => User::ROLE_KADER,
                'is_active' => true,
            ]);

            $kader->forceFill([
                'user_id' => $user->id,
                'status' => Kader::STATUS_AKTIF,
                'approved_at' => now(),
                'approved_by' => $request->user()->id,
                'rejected_at' => null,
                'rejected_by' => null,
                'rejection_reason' => null,
            ])->save();

            $token = Password::broker()->createToken($user);
        });

        $setPasswordUrl = route('kader.password.edit', [
            'token' => $token,
            'email' => $user->email,
        ]);

        Mail::to($user->email)->send(new KaderApprovedMail($kader->fresh(), $user, $token));

        return redirect()
            ->route('admin.kaders.show', $kader)
            ->with('status', 'Kader berhasil disetujui. Link set password sudah dibuat.')
            ->with('set_password_url', $setPasswordUrl);
    }

    public function reject(Request $request, Kader $kader): RedirectResponse
    {
        if (! $kader->isPending()) {
            return back()->withErrors([
                'reject' => 'Pendaftaran ini sudah diproses sebelumnya.',
            ]);
        }

        $validated = $request->validate([
            'rejection_reason' => ['required', 'string', 'max:1000'],
        ], [
            'rejection_reason.required' => 'Alasan penolakan wajib diisi.',
            'rejection_reason.max' => 'Alasan penolakan maksimal 1000 karakter.',
        ]);

        DB::transaction(function () use ($request, $kader, $validated) {
            $kader->forceFill([
                'status' => Kader::STATUS_DITOLAK,
                'rejected_at' => now(),
                'rejected_by' => $request->user()->id,
                'rejection_reason' => $validated['rejection_reason'],
            ])->save();
        });

        Mail::to($kader->email)->send(new KaderRejectedMail($kader->fresh()));

        return redirect()
            ->route('admin.kaders.show', $kader)
            ->with('status', 'Pendaftaran kader berhasil ditolak. Email penolakan sudah dikirim.');
    }

    private function statusOptions(): array
    {
        return [
            Kader::STATUS_VERIFIKASI => 'Menunggu Verifikasi',
            Kader::STATUS_AKTIF => 'Aktif',
            Kader::STATUS_DITOLAK => 'Ditolak',
            Kader::STATUS_SUSPEND => 'Suspend',
        ];
    }
}
