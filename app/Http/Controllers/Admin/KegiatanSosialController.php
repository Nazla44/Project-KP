<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DokumentasiKegiatan;
use App\Models\Kader;
use App\Models\KegiatanSosial;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class KegiatanSosialController extends Controller
{
    /**
     * Daftar kegiatan sosial untuk admin.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('search') ?? $request->input('q');

        $query = KegiatanSosial::with(['creator', 'ringkasan', 'kaders'])
            ->latest('tanggal');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if (! empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', '%' . $keyword . '%')
                    ->orWhere('lokasi', 'like', '%' . $keyword . '%')
                    ->orWhere('deskripsi', 'like', '%' . $keyword . '%');
            });
        }

        $kegiatan = $query->paginate(10)->withQueryString();

        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    /**
     * Form tambah kegiatan sosial.
     */
    public function create()
    {
        $kaders = Kader::where('status', Kader::STATUS_AKTIF)
            ->with('user')
            ->orderBy('nama')
            ->get();

        $materiDefault = [
            ['judul' => 'Apa itu TBC?', 'urutan' => 1],
            ['judul' => 'Gejala TBC', 'urutan' => 2],
            ['judul' => 'Cara Penularan', 'urutan' => 3],
            ['judul' => 'Cara Pencegahan', 'urutan' => 4],
            ['judul' => 'Pentingnya Pengobatan Sampai Tuntas', 'urutan' => 5],
        ];

        $selectedKaderIds = [];

        return view('admin.kegiatan.create', compact('kaders', 'materiDefault', 'selectedKaderIds'));
    }

    /**
     * Simpan kegiatan sosial baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'nullable|date_format:H:i',
            'jam_selesai' => 'nullable|date_format:H:i|after:jam_mulai',
            'lokasi' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'deskripsi' => 'required|string',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => ['required', Rule::in(['draft', 'published'])],
            'kader_ids' => 'nullable|array',
            'kader_ids.*' => 'exists:kaders,id',
            'peran_kader' => 'nullable|array',
            'materi' => 'nullable|array',
            'materi.*.judul' => 'required_with:materi|string|max:255',
            'materi.*.konten' => 'nullable|string',
            'materi.*.urutan' => 'nullable|integer',
        ], [
            'judul.required' => 'Judul kegiatan wajib diisi.',
            'tanggal.required' => 'Tanggal kegiatan wajib diisi.',
            'tanggal.after_or_equal' => 'Tanggal kegiatan tidak boleh sebelum hari ini.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
            'lokasi.required' => 'Lokasi kegiatan wajib diisi.',
            'deskripsi.required' => 'Deskripsi kegiatan wajib diisi.',
            'banner.image' => 'Banner harus berupa file gambar.',
            'banner.max' => 'Ukuran banner maksimal 2MB.',
            'status.required' => 'Status kegiatan wajib dipilih.',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('banner')) {
                $validated['banner'] = $request->file('banner')->store('kegiatan/banner', 'public');
            }

            $validated['created_by'] = auth()->id();

            if ($validated['status'] === 'published') {
                $validated['published_at'] = now();
            }

            $kegiatanData = Arr::except($validated, ['kader_ids', 'peran_kader', 'materi']);

            $kegiatan = KegiatanSosial::create($kegiatanData);

            $this->syncKaders(
                $kegiatan,
                $validated['kader_ids'] ?? [],
                $request->input('peran_kader', [])
            );

            $this->syncMateri($kegiatan, $validated['materi'] ?? []);

            DB::commit();

            return redirect()
                ->route('admin.kegiatan-sosial.index')
                ->with('success', 'Jadwal sosialisasi berhasil ditambahkan.');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Gagal menambahkan jadwal sosialisasi. ' . $e->getMessage());
        }
    }

    /**
     * Detail kegiatan sosial di admin.
     */
    public function show(KegiatanSosial $kegiatan)
    {
        $kegiatan->load([
            'creator',
            'kaders.user',
            'materi',
            'dokumentasi',
            'ringkasan.pengisi',
        ]);

        return view('admin.kegiatan.show', compact('kegiatan'));
    }

    /**
     * Form edit kegiatan sosial.
     */
    public function edit(KegiatanSosial $kegiatan)
    {
        $kegiatan->load(['kaders', 'materi', 'dokumentasi', 'ringkasan']);

        $kaders = Kader::where('status', Kader::STATUS_AKTIF)
            ->with('user')
            ->orderBy('nama')
            ->get();

        $selectedKaderIds = $kegiatan->kaders->pluck('id')->toArray();
        $materiDefault = [];

        return view('admin.kegiatan.create', compact(
            'kegiatan',
            'kaders',
            'selectedKaderIds',
            'materiDefault'
        ));
    }

    /**
     * Update kegiatan sosial.
     */
    public function update(Request $request, KegiatanSosial $kegiatan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam_mulai' => 'nullable|date_format:H:i',
            'jam_selesai' => 'nullable|date_format:H:i|after:jam_mulai',
            'lokasi' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'deskripsi' => 'required|string',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => ['required', Rule::in(['draft', 'published', 'ongoing', 'completed', 'cancelled'])],
            'kader_ids' => 'nullable|array',
            'kader_ids.*' => 'exists:kaders,id',
            'peran_kader' => 'nullable|array',
            'materi' => 'nullable|array',
            'materi.*.judul' => 'required_with:materi|string|max:255',
            'materi.*.konten' => 'nullable|string',
            'materi.*.urutan' => 'nullable|integer',
        ], [
            'judul.required' => 'Judul kegiatan wajib diisi.',
            'tanggal.required' => 'Tanggal kegiatan wajib diisi.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
            'lokasi.required' => 'Lokasi kegiatan wajib diisi.',
            'deskripsi.required' => 'Deskripsi kegiatan wajib diisi.',
            'banner.image' => 'Banner harus berupa file gambar.',
            'banner.max' => 'Ukuran banner maksimal 2MB.',
            'status.required' => 'Status kegiatan wajib dipilih.',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('banner')) {
                if ($kegiatan->banner) {
                    Storage::disk('public')->delete($kegiatan->banner);
                }

                $validated['banner'] = $request->file('banner')->store('kegiatan/banner', 'public');
            }

            if ($validated['status'] === 'published' && ! $kegiatan->published_at) {
                $validated['published_at'] = now();
            }

            $kegiatanData = Arr::except($validated, ['kader_ids', 'peran_kader', 'materi']);

            $kegiatan->update($kegiatanData);

            $this->syncKaders(
                $kegiatan,
                $validated['kader_ids'] ?? [],
                $request->input('peran_kader', [])
            );

            if (array_key_exists('materi', $validated)) {
                $kegiatan->materi()->delete();
                $this->syncMateri($kegiatan, $validated['materi'] ?? []);
            }

            DB::commit();

            return redirect()
                ->route('admin.kegiatan-sosial.show', $kegiatan)
                ->with('success', 'Jadwal sosialisasi berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui jadwal sosialisasi. ' . $e->getMessage());
        }
    }

    /**
     * Hapus kegiatan sosial. Model sudah memakai SoftDeletes.
     */
    public function destroy(KegiatanSosial $kegiatan)
    {
        try {
            if ($kegiatan->banner) {
                Storage::disk('public')->delete($kegiatan->banner);
            }

            $kegiatan->delete();

            return redirect()
                ->route('admin.kegiatan-sosial.index')
                ->with('success', 'Jadwal sosialisasi berhasil dihapus.');
        } catch (\Throwable $e) {
            return back()
                ->with('error', 'Gagal menghapus jadwal sosialisasi. ' . $e->getMessage());
        }
    }

    /**
     * Upload dokumentasi kegiatan lewat Ajax.
     */
    public function uploadDokumentasi(Request $request, KegiatanSosial $kegiatan)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
            'caption' => 'nullable|string|max:255',
        ], [
            'foto.required' => 'Foto dokumentasi wajib dipilih.',
            'foto.image' => 'File dokumentasi harus berupa gambar.',
            'foto.max' => 'Ukuran foto dokumentasi maksimal 3MB.',
        ]);

        try {
            $path = $request->file('foto')->store('kegiatan/dokumentasi', 'public');
            $urutan = ((int) $kegiatan->dokumentasi()->max('urutan')) + 1;

            $dok = $kegiatan->dokumentasi()->create([
                'file_path' => $path,
                'caption' => $request->caption,
                'urutan' => $urutan,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Dokumentasi kegiatan berhasil diunggah.',
                'id' => $dok->id,
                'url' => $dok->url,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengunggah dokumentasi. ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Hapus dokumentasi kegiatan lewat Ajax.
     */
    public function deleteDokumentasi(DokumentasiKegiatan $dokumentasi)
    {
        try {
            Storage::disk('public')->delete($dokumentasi->file_path);
            $dokumentasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Dokumentasi kegiatan berhasil dihapus.',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus dokumentasi. ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Simpan ringkasan hasil kegiatan.
     */
    public function simpanRingkasan(Request $request, KegiatanSosial $kegiatan)
    {
        $validated = $request->validate([
            'jumlah_peserta' => 'required|integer|min:0',
            'jumlah_kader' => 'required|integer|min:0',
            'jumlah_materi' => 'required|integer|min:0',
            'catatan_internal' => 'nullable|string',
        ], [
            'jumlah_peserta.required' => 'Jumlah peserta wajib diisi.',
            'jumlah_kader.required' => 'Jumlah kader wajib diisi.',
            'jumlah_materi.required' => 'Jumlah materi wajib diisi.',
        ]);

        try {
            $validated['diisi_oleh'] = auth()->id();

            $kegiatan->ringkasan()->updateOrCreate(
                ['kegiatan_id' => $kegiatan->id],
                $validated
            );

            $kegiatan->update(['status' => 'completed']);

            return back()
                ->with('success', 'Ringkasan kegiatan berhasil disimpan.');
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal menyimpan ringkasan kegiatan. ' . $e->getMessage());
        }
    }

    /**
     * Update status cepat.
     */
    public function updateStatus(Request $request, KegiatanSosial $kegiatan)
    {
        $request->validate([
            'status' => ['required', Rule::in(['draft', 'published', 'ongoing', 'completed', 'cancelled'])],
        ], [
            'status.required' => 'Status kegiatan wajib dipilih.',
        ]);

        try {
            $data = ['status' => $request->status];

            if ($request->status === 'published' && ! $kegiatan->published_at) {
                $data['published_at'] = now();
            }

            $kegiatan->update($data);

            return back()
                ->with('success', 'Status kegiatan berhasil diperbarui.');
        } catch (\Throwable $e) {
            return back()
                ->with('error', 'Gagal memperbarui status kegiatan. ' . $e->getMessage());
        }
    }

    private function syncKaders(KegiatanSosial $kegiatan, array $kaderIds, array $peranKader = []): void
    {
        $syncData = [];

        foreach ($kaderIds as $kaderId) {
            $syncData[$kaderId] = [
                'peran' => $peranKader[$kaderId] ?? 'pelaksana',
            ];
        }

        $kegiatan->kaders()->sync($syncData);
    }

    private function syncMateri(KegiatanSosial $kegiatan, array $materi): void
    {
        foreach ($materi as $i => $m) {
            if (! empty($m['judul'])) {
                $kegiatan->materi()->create([
                    'judul' => $m['judul'],
                    'konten' => $m['konten'] ?? '',
                    'urutan' => $m['urutan'] ?? ($i + 1),
                ]);
            }
        }
    }
}