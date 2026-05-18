<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Throwable;

class ArtikelController extends Controller
{
    public function index(): View
    {
        return view('admin.artikel.index', [
            'pageTitle' => 'Kelola Artikel',
            'articles' => Artikel::query()->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.artikel.create', [
            'pageTitle' => 'Tambah Artikel',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateArticle($request);
        $uploadedCoverPath = null;

        try {
            $artikel = new Artikel();
            $artikel->judul = $validated['judul'];
            $artikel->slug = $artikel->buildUniqueSlug($validated['judul']);
            $artikel->topik = $validated['topik'];
            $artikel->penulis = (string) $request->user()->name;
            $artikel->tanggal = now()->toDateString();
            $artikel->status = $validated['status'];
            $artikel->isi = trim($validated['isi']);

            if ($request->hasFile('cover_image')) {
                $uploadedCoverPath = $request->file('cover_image')->store('articles/covers', 'public');
                $artikel->cover_image = $uploadedCoverPath;
            }

            DB::transaction(function () use ($artikel) {
                $artikel->save();
            });
        } catch (Throwable $exception) {
            $this->deleteStoredCover($uploadedCoverPath);

            throw $exception;
        }

        return redirect()->route('admin.articles.index')->with('status', 'Artikel berhasil dibuat.');
    }

    public function edit(Artikel $artikel): View
    {
        return view('admin.artikel.edit', [
            'pageTitle' => 'Edit Artikel',
            'artikel' => $artikel,
        ]);
    }

    public function update(Request $request, Artikel $artikel): RedirectResponse
    {
        $validated = $this->validateArticle($request, $artikel);
        $oldCoverPath = $artikel->cover_image;
        $uploadedCoverPath = null;

        try {
            $artikel->judul = $validated['judul'];
            $artikel->slug = $artikel->buildUniqueSlug($validated['judul']);
            $artikel->topik = $validated['topik'];
            $artikel->status = $validated['status'];
            $artikel->isi = trim($validated['isi']);
            $artikel->penulis = (string) $request->user()->name;

            if ($request->hasFile('cover_image')) {
                $uploadedCoverPath = $request->file('cover_image')->store('articles/covers', 'public');
                $artikel->cover_image = $uploadedCoverPath;
            }

            DB::transaction(function () use ($artikel) {
                $artikel->save();
            });
        } catch (Throwable $exception) {
            $this->deleteStoredCover($uploadedCoverPath);
            $artikel->cover_image = $oldCoverPath;

            throw $exception;
        }

        if ($uploadedCoverPath && $oldCoverPath && $oldCoverPath !== $uploadedCoverPath) {
            $this->deleteStoredCover($oldCoverPath);
        }

        return redirect()->route('admin.articles.index')->with('status', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel): RedirectResponse
    {
        if ($artikel->cover_image) {
            Storage::disk('public')->delete($artikel->cover_image);
        }

        $artikel->delete();

        return redirect()->route('admin.articles.index')->with('status', 'Artikel berhasil dihapus.');
    }

    private function validateArticle(Request $request, ?Artikel $artikel = null): array
    {
        return $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'topik' => ['required', 'string', 'max:100'],
            'cover_image' => [
                $artikel ? 'nullable' : 'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:3072',
            ],
            'status' => ['required', Rule::in(['draft', 'tayang'])],
            'isi' => ['required', 'string'],
        ], [
            'judul.required' => 'Judul artikel wajib diisi.',
            'topik.required' => 'Topik artikel wajib diisi.',
            'cover_image.required' => 'Cover artikel wajib diunggah.',
            'cover_image.image' => 'File cover harus berupa gambar.',
            'cover_image.mimes' => 'Format cover harus JPG, JPEG, PNG, atau WEBP.',
            'cover_image.max' => 'Ukuran cover maksimal 3 MB.',
            'status.required' => 'Status artikel wajib dipilih.',
            'isi.required' => 'Isi artikel wajib diisi.',
        ]);
    }

    private function deleteStoredCover(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
