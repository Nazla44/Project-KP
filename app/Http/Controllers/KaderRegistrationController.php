<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class KaderRegistrationController extends Controller
{
    public function create(): View
    {
        return view('pages.daftar-kader', [
            'pageTitle' => 'Daftar Jadi Kader',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:100'],
            'nik' => ['required', 'digits:16', Rule::unique('kaders', 'nik')],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'no_hp' => ['required', 'string', 'min:10', 'max:20'],
            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('kaders', 'email'),
                Rule::unique('users', 'email'),
            ],
            'alamat' => ['required', 'string', 'max:300'],
            'provinsi' => ['required', 'string', 'max:100'],
            'kab_kota' => ['required', 'string', 'max:100'],
            'kecamatan' => ['required', 'string', 'max:100'],
            'pekerjaan' => ['required', 'string', 'max:100'],
            'pendidikan' => ['required', Rule::in(['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'])],
            'motivasi' => ['required', 'string', 'max:1000'],
            'pengalaman_tb' => ['required', Rule::in(['penyintas', 'keluarga', 'relawan', 'belum'])],
            'ketersediaan' => ['required', Rule::in(['penuh', 'paruh', 'akhir_pekan'])],
            'setuju' => ['required', 'accepted'],
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus 16 digit angka.',
            'nik.unique' => 'NIK sudah pernah terdaftar.',
            'tanggal_lahir.before' => 'Tanggal lahir tidak valid.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan atau sedang dalam proses verifikasi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'motivasi.required' => 'Mohon tuliskan motivasi Anda.',
            'motivasi.max' => 'Motivasi maksimal 1000 karakter.',
            'setuju.accepted' => 'Anda harus menyetujui syarat & ketentuan.',
        ]);

        $kader = Kader::query()->create([
            'nama' => $validated['nama_lengkap'],
            'nik' => $validated['nik'],
            'klinik_id' => null,
            'hp' => $validated['no_hp'],
            'email' => $validated['email'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'alamat' => $validated['alamat'],
            'provinsi' => $validated['provinsi'],
            'kab_kota' => $validated['kab_kota'],
            'kecamatan' => $validated['kecamatan'],
            'pekerjaan' => $validated['pekerjaan'],
            'pendidikan' => $validated['pendidikan'],
            'motivasi' => $validated['motivasi'],
            'pengalaman_tb' => $validated['pengalaman_tb'],
            'ketersediaan' => $validated['ketersediaan'],
            'tgl_bergabung' => now()->toDateString(),
            'status' => Kader::STATUS_VERIFIKASI,
        ]);

        session([
            'kader_nama' => $kader->nama,
            'kader_email' => $kader->email,
            'kader_hp' => $kader->hp,
        ]);

        return redirect()->route('kader.sukses');
    }

    public function success(): View|RedirectResponse
    {
        if (! session('kader_nama')) {
            return redirect()->route('kader.form');
        }

        return view('pages.kader-sukses', [
            'pageTitle' => 'Pendaftaran Berhasil',
            'nama' => session('kader_nama'),
            'email' => session('kader_email'),
        ]);
    }
}