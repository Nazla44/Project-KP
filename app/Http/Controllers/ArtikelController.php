<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikel = Artikel::latest()->get();

        return view('admin.artikel.index', compact('artikel'));
    }

    public function create()
    {
        return view('admin.artikel.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        Artikel::create($data);

        return redirect()
            ->route('artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, Artikel $artikel)
    {
        $data = $this->validatedData($request);

        $artikel->update($data);

        return redirect()
            ->route('artikel.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        $artikel->delete();

        return redirect()
            ->route('artikel.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    public function publish(Artikel $artikel)
    {
        $artikel->update(['status' => 'tayang']);

        return redirect()
            ->route('artikel.index')
            ->with('success', 'Artikel berhasil dipublish.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'penulis' => ['required', 'string', 'max:120'],
            'tanggal' => ['required', 'date'],
            'status' => ['required', 'in:draft,tayang'],
            'isi' => ['required', 'string'],
        ]);
    }
}
