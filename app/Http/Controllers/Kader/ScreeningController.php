<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\KegiatanSosial;
use App\Models\Klinik;
use App\Models\ScoringRule;
use App\Models\ScreeningResult;
use App\Models\ScreeningSession;
use App\Models\Warga;
use App\Services\TbRiskScoringService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ScreeningController extends Controller
{
    public function create(Request $request, KegiatanSosial $kegiatan): View
    {
        $kader = $request->user()->kader;

        abort_unless($kader, 403, 'Akun belum terhubung dengan data kader.');
        $this->authorizeAssignedKegiatan($kader->id, $kegiatan);

        $rules = ScoringRule::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('group');

        $activeSession = ScreeningSession::query()
            ->where('kegiatan_id', $kegiatan->id)
            ->where('kader_id', $kader->id)
            ->where('status', ScreeningSession::STATUS_AKTIF)
            ->latest()
            ->first();

        return view('kader.screening-create', [
            'kader' => $kader,
            'kegiatan' => $kegiatan,
            'rules' => $rules,
            'activeSession' => $activeSession,
        ]);
    }

    public function store(Request $request, KegiatanSosial $kegiatan, TbRiskScoringService $scoringService): RedirectResponse
    {
        $kader = $request->user()->kader;

        abort_unless($kader, 403, 'Akun belum terhubung dengan data kader.');
        $this->authorizeAssignedKegiatan($kader->id, $kegiatan);

        $validated = $request->validate([
            'nik' => ['required', 'digits:16'],
            'nama_lengkap' => ['required', 'string', 'max:150'],
            'alamat' => ['required', 'string'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', 'in:L,P'],
            'consent_verbal' => ['accepted'],

            'lokasi_alamat' => ['nullable', 'string'],
            'lokasi_lat' => ['nullable', 'numeric', 'between:-90,90'],
            'lokasi_lng' => ['nullable', 'numeric', 'between:-180,180'],

            'answers' => ['nullable', 'array'],
            'catatan_kader' => ['nullable', 'string'],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus 16 digit.',
            'nama_lengkap.required' => 'Nama warga wajib diisi.',
            'alamat.required' => 'Alamat warga wajib diisi.',
            'consent_verbal.accepted' => 'Persetujuan warga wajib dicentang.',
        ]);

        $answers = collect($validated['answers'] ?? [])
            ->mapWithKeys(fn ($value, $key) => [(string) $key => (bool) $value])
            ->all();

        $risk = $scoringService->calculate($answers);

        $nearestKlinik = $this->findRecommendedKlinik(
            lat: $validated['lokasi_lat'] ?? $kegiatan->latitude,
            lng: $validated['lokasi_lng'] ?? $kegiatan->longitude,
            kota: $kader->kab_kota,
            provinsi: $kader->provinsi,
            onlyForRisk: $risk['level'] !== 'rendah'
        );

        DB::transaction(function () use ($validated, $answers, $risk, $nearestKlinik, $kader, $kegiatan) {
            Warga::query()->updateOrCreate(
                ['nik' => $validated['nik']],
                [
                    'nama_lengkap' => $validated['nama_lengkap'],
                    'alamat' => $validated['alamat'],
                    'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
                    'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
                    'consent_verbal' => true,
                    'consent_at' => now(),
                ]
            );

            $session = ScreeningSession::query()->firstOrCreate(
                [
                    'kegiatan_id' => $kegiatan->id,
                    'kader_id' => $kader->id,
                    'status' => ScreeningSession::STATUS_AKTIF,
                ],
                [
                    'event_id' => null,
                    'tanggal_sesi' => now()->toDateString(),
                    'lokasi_alamat' => $validated['lokasi_alamat'] ?? $kegiatan->lokasi,
                    'lokasi_lat' => $validated['lokasi_lat'] ?? $kegiatan->latitude,
                    'lokasi_lng' => $validated['lokasi_lng'] ?? $kegiatan->longitude,
                    'total_diperiksa' => 0,
                    'total_rendah' => 0,
                    'total_sedang' => 0,
                    'total_tinggi' => 0,
                ]
            );

            ScreeningResult::query()->updateOrCreate(
                [
                    'sesi_id' => $session->id,
                    'warga_nik' => $validated['nik'],
                ],
                [
                    'jawaban_gejala' => $answers,
                    'skor_total' => $risk['score'],
                    'level_risiko' => $risk['level'],
                    'rekomendasi_tindakan' => $risk['recommendation'],
                    'klinik_id' => $nearestKlinik?->id,
                    'catatan_kader' => $validated['catatan_kader'] ?? null,
                    'diperiksa_pada' => now(),
                ]
            );

            $this->recalculateSessionSummary($session);
        });

        return redirect()
            ->route('kader.screening.create', $kegiatan)
            ->with('success', 'Data screening berhasil disimpan.')
            ->with('screening_result', [
                'nama' => $validated['nama_lengkap'],
                'level' => $risk['level'],
                'score' => $risk['score'],
                'recommendation' => $risk['recommendation'],
                'klinik' => $nearestKlinik ? [
                    'nama' => $nearestKlinik->nama,
                    'alamat' => $nearestKlinik->alamat,
                    'kota' => $nearestKlinik->kota,
                    'telepon' => $nearestKlinik->telepon,
                    'maps' => 'https://www.google.com/maps/search/?api=1&query=' . urlencode($nearestKlinik->nama . ' ' . $nearestKlinik->alamat),
                ] : null,
            ]);
    }

    public function closeSession(Request $request, ScreeningSession $session): RedirectResponse
    {
        $kader = $request->user()->kader;

        abort_unless($kader && $session->kader_id === $kader->id, 403);

        $session->update([
            'status' => ScreeningSession::STATUS_SELESAI,
            'closed_at' => now(),
        ]);

        return back()->with('success', 'Sesi screening berhasil ditutup.');
    }

    private function authorizeAssignedKegiatan(int $kaderId, KegiatanSosial $kegiatan): void
    {
        abort_unless(
            $kegiatan->kaders()->where('kaders.id', $kaderId)->exists(),
            403,
            'Kegiatan ini tidak ditugaskan kepada Anda.'
        );
    }

    private function recalculateSessionSummary(ScreeningSession $session): void
    {
        $session->load('results');

        $session->update([
            'total_diperiksa' => $session->results->count(),
            'total_rendah' => $session->results->where('level_risiko', 'rendah')->count(),
            'total_sedang' => $session->results->where('level_risiko', 'sedang')->count(),
            'total_tinggi' => $session->results->where('level_risiko', 'tinggi')->count(),
        ]);
    }

    private function findRecommendedKlinik($lat, $lng, ?string $kota, ?string $provinsi, bool $onlyForRisk): ?Klinik
    {
        if (! $onlyForRisk) {
            return null;
        }

        $query = Klinik::query()
            ->where('status', 'aktif')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude');

        if ($lat && $lng) {
            return $query
                ->select('*')
                ->selectRaw(
                    '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS jarak',
                    [$lat, $lng, $lat]
                )
                ->orderBy('jarak')
                ->first();
        }

        return Klinik::query()
            ->where('status', 'aktif')
            ->when($kota, fn ($q) => $q->where('kota', 'like', "%{$kota}%"))
            ->when($provinsi, fn ($q) => $q->orWhere('provinsi', 'like', "%{$provinsi}%"))
            ->orderBy('nama')
            ->first();
    }
}