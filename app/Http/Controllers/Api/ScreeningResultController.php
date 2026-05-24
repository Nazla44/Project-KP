<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ScreeningResult;
use App\Models\ScreeningSession;
use App\Models\Warga;
use App\Services\TbRiskScoringService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScreeningResultController extends Controller
{
    public function store(Request $request, ScreeningSession $screeningSession, TbRiskScoringService $scoring): JsonResponse
    {
        abort_unless($screeningSession->kader_id === $request->user()->kader->id, 403);
        abort_unless($screeningSession->status === ScreeningSession::STATUS_AKTIF, 422, 'Sesi sudah ditutup.');

        $validated = $request->validate([
            'warga.nik' => ['required','digits:16'],
            'warga.nama_lengkap' => ['required','string','max:150'],
            'warga.alamat' => ['required','string','max:1000'],
            'warga.tanggal_lahir' => ['nullable','date','before:today'],
            'warga.jenis_kelamin' => ['nullable','in:L,P'],
            'warga.consent_verbal' => ['accepted'],
            'jawaban_gejala' => ['required','array'],
            'klinik_id' => ['nullable','exists:klinik,id'],
            'catatan_kader' => ['nullable','string','max:2000'],
        ]);

        $result = DB::transaction(function () use ($validated, $screeningSession, $scoring) {
            $wargaPayload = $validated['warga'];
            $wargaPayload['consent_verbal'] = true;
            $wargaPayload['consent_at'] = now();

            $warga = Warga::query()->updateOrCreate(['nik' => $wargaPayload['nik']], $wargaPayload);
            $score = $scoring->calculate($validated['jawaban_gejala']);

            $result = ScreeningResult::query()->updateOrCreate(
                ['sesi_id' => $screeningSession->id, 'warga_nik' => $warga->nik],
                [
                    'jawaban_gejala' => $validated['jawaban_gejala'],
                    'skor_total' => $score['score'],
                    'level_risiko' => $score['level'],
                    'rekomendasi_tindakan' => $score['recommendation'],
                    'klinik_id' => $validated['klinik_id'] ?? null,
                    'catatan_kader' => $validated['catatan_kader'] ?? null,
                    'diperiksa_pada' => now(),
                ]
            );

            $this->refreshSessionSummary($screeningSession);

            return $result->load('warga', 'klinik');
        });

        return response()->json(['message' => 'Hasil skrining berhasil disimpan.', 'data' => $result], 201);
    }

    private function refreshSessionSummary(ScreeningSession $session): void
    {
        $summary = ScreeningResult::query()
            ->where('sesi_id', $session->id)
            ->selectRaw('COUNT(*) as total')
            ->selectRaw("SUM(CASE WHEN level_risiko = 'rendah' THEN 1 ELSE 0 END) as rendah")
            ->selectRaw("SUM(CASE WHEN level_risiko = 'sedang' THEN 1 ELSE 0 END) as sedang")
            ->selectRaw("SUM(CASE WHEN level_risiko = 'tinggi' THEN 1 ELSE 0 END) as tinggi")
            ->first();

        $session->update([
            'total_diperiksa' => (int) $summary->total,
            'total_rendah' => (int) $summary->rendah,
            'total_sedang' => (int) $summary->sedang,
            'total_tinggi' => (int) $summary->tinggi,
        ]);
    }
}
