<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\DokumentasiKegiatan;
use App\Models\Kader;
use App\Models\KegiatanSosial;
use App\Models\RingkasanKegiatan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RekapSosialisasiController extends Controller
{
    public function index(): View
    {
        $kader = $this->currentKader();

        $kegiatans = KegiatanSosial::query()
            ->with(['ringkasan', 'dokumentasi'])
            ->withCount(['dokumentasi'])
            ->whereHas('kaders', function ($query) use ($kader) {
                $query->where('kaders.id', $kader->id);
            })
            ->orderByDesc('tanggal')
            ->paginate(10);

        return view('kader.rekap-sosialisasi.index', [
            'kader' => $kader,
            'kegiatans' => $kegiatans,
        ]);
    }

    public function edit(KegiatanSosial $kegiatan): View
    {
        $kader = $this->currentKader();

        $this->ensureAssignedKader($kegiatan, $kader);

        $kegiatan->load(['ringkasan', 'dokumentasi', 'kaders']);

        return view('kader.rekap-sosialisasi.edit', [
            'kader' => $kader,
            'kegiatan' => $kegiatan,
            'ringkasan' => $kegiatan->ringkasan,
        ]);
    }

    public function update(Request $request, KegiatanSosial $kegiatan): RedirectResponse
    {
        $kader = $this->currentKader();

        $this->ensureAssignedKader($kegiatan, $kader);

        $validated = $request->validate([
            'jumlah_peserta' => ['required', 'integer', 'min:0'],
            'jumlah_materi' => ['nullable', 'integer', 'min:0'],
            'catatan_internal' => ['nullable', 'string', 'max:5000'],
            'foto.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'caption.*' => ['nullable', 'string', 'max:255'],
        ]);

        RingkasanKegiatan::updateOrCreate(
            [
                'kegiatan_id' => $kegiatan->id,
            ],
            [
                'jumlah_peserta' => $validated['jumlah_peserta'],
                'jumlah_kader' => $kegiatan->kaders()->count(),
                'jumlah_materi' => $validated['jumlah_materi'] ?? 0,
                'catatan_internal' => $validated['catatan_internal'] ?? null,
                'diisi_oleh' => auth()->id(),
            ]
        );

        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $index => $file) {
                if (! $file) {
                    continue;
                }

                $path = $file->store('kegiatan-dokumentasi', 'public');

                DokumentasiKegiatan::create([
                    'kegiatan_id' => $kegiatan->id,
                    'file_path' => $path,
                    'caption' => $request->input("caption.$index"),
                    'urutan' => $index + 1,
                ]);
            }
        }

        return redirect()
            ->route('kader.rekap-sosialisasi.index')
            ->with('success', 'Rekap sosialisasi berhasil disimpan.');
    }

    private function currentKader(): Kader
    {
        return Kader::where('user_id', auth()->id())->firstOrFail();
    }

    private function ensureAssignedKader(KegiatanSosial $kegiatan, Kader $kader): void
    {
        $isAssigned = $kegiatan->kaders()
            ->where('kaders.id', $kader->id)
            ->exists();

        abort_unless($isAssigned, 403);
    }
}