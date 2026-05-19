<?php

namespace App\Http\Controllers;

use App\Models\Klinik;
use Illuminate\Http\Request;

class KlinikController extends Controller
{
    public function index()
    {
        $klinik = Klinik::latest()->get();

        return view('admin.klinik.index', compact('klinik'));
    }

    public function create()
    {
        return view('admin.klinik.create');
    }

    public function store(Request $request)
    {
        Klinik::create($this->validatedData($request));

        return redirect()
            ->route('klinik.index')
            ->with('success', 'Klinik berhasil ditambahkan.');
    }

    public function edit(Klinik $klinik)
    {
        return view('admin.klinik.edit', compact('klinik'));
    }

    public function update(Request $request, Klinik $klinik)
    {
        $klinik->update($this->validatedData($request));

        return redirect()
            ->route('klinik.index')
            ->with('success', 'Klinik berhasil diperbarui.');
    }

    public function destroy(Klinik $klinik)
    {
        $klinik->delete();

        return redirect()
            ->route('klinik.index')
            ->with('success', 'Klinik berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'tipe' => ['required', 'string', 'max:100'],
            'kota' => ['nullable', 'string', 'max:120'],
            'provinsi' => ['nullable', 'string', 'max:120'],
            'alamat' => ['required', 'string'],
            'telepon' => ['nullable', 'string', 'max:50'],
            'lat' => ['nullable', 'numeric'],
            'lng' => ['nullable', 'numeric'],
            'jam_buka' => ['nullable', 'date_format:H:i'],
            'jam_tutup' => ['nullable', 'date_format:H:i'],
            'hari_buka' => ['nullable', 'string', 'max:120'],
            'layanan' => ['nullable', 'string'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        $data['layanan'] = collect(explode(',', $data['layanan'] ?? ''))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();

        return $data;
    }
}
