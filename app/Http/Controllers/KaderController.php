<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use App\Models\Klinik;
use Illuminate\Http\Request;

class KaderController extends Controller
{
    public function index()
    {
        $kaders = Kader::with('klinik')->latest()->get();

        return view('admin.kader.index', compact('kaders'));
    }

    public function create()
    {
        $klinik = Klinik::where('status', 'aktif')->orderBy('nama')->get();

        return view('admin.kader.create', compact('klinik'));
    }

    public function store(Request $request)
    {
        Kader::create($this->validatedData($request));

        return redirect()
            ->route('kader.index')
            ->with('success', 'Kader berhasil ditambahkan.');
    }

    public function edit(Kader $kader)
    {
        $klinik = Klinik::where('status', 'aktif')->orderBy('nama')->get();

        return view('admin.kader.edit', compact('kader', 'klinik'));
    }

    public function update(Request $request, Kader $kader)
    {
        $kader->update($this->validatedData($request));

        return redirect()
            ->route('kader.index')
            ->with('success', 'Kader berhasil diperbarui.');
    }

    public function destroy(Kader $kader)
    {
        $kader->delete();

        return redirect()
            ->route('kader.index')
            ->with('success', 'Kader berhasil dihapus.');
    }

    public function verifikasi(Kader $kader)
    {
        $kader->update(['status' => 'aktif']);

        return redirect()
            ->route('kader.index')
            ->with('success', 'Kader berhasil diverifikasi.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'klinik_id' => ['required', 'exists:klinik,id'],
            'hp' => ['required', 'string', 'max:50'],
            'tgl_bergabung' => ['required', 'date'],
            'status' => ['required', 'in:aktif,verifikasi'],
        ]);
    }
}
