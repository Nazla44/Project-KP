<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\KegiatanSosial;
use App\Models\ScreeningResult;
use App\Models\ScreeningSession;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RiwayatScreeningController extends Controller
{
    public function riwayatJadwal(Request $request): View
    {
        $kader = $request->user()->kader;

        abort_unless($kader, 403, 'Akun belum terhubung dengan data kader.');

        $kegiatans = KegiatanSosial::query()
            ->whereHas('kaders', function ($query) use ($kader) {
                $query->where('kaders.id', $kader->id);
            })
            ->with([
                'kaders',
                'screeningSessions' => function ($query) use ($kader) {
                    $query
                        ->where('kader_id', $kader->id)
                        ->withCount('results')
                        ->latest();
                },
            ])
            ->latest('tanggal')
            ->paginate(10)
            ->withQueryString();

        return view('kader.riwayat-jadwal', [
            'kader' => $kader,
            'kegiatans' => $kegiatans,
        ]);
    }

    public function index(Request $request): View
    {
        $kader = $request->user()->kader;

        abort_unless($kader, 403, 'Akun belum terhubung dengan data kader.');

        $kegiatans = KegiatanSosial::query()
            ->whereHas('kaders', function ($query) use ($kader) {
                $query->where('kaders.id', $kader->id);
            })
            ->with([
                'screeningSessions' => function ($query) use ($kader) {
                    $query
                        ->where('kader_id', $kader->id)
                        ->withCount('results')
                        ->latest();
                },
            ])
            ->latest('tanggal')
            ->paginate(10)
            ->withQueryString();

        return view('kader.riwayat-screening.index', [
            'kader' => $kader,
            'kegiatans' => $kegiatans,
        ]);
    }

    public function show(Request $request, KegiatanSosial $kegiatan): View
    {
        $kader = $request->user()->kader;

        abort_unless($kader, 403, 'Akun belum terhubung dengan data kader.');

        abort_unless(
            $kegiatan->kaders()->where('kaders.id', $kader->id)->exists(),
            403,
            'Kegiatan ini tidak ditugaskan kepada Anda.'
        );

        $sessionIds = ScreeningSession::query()
            ->where('kader_id', $kader->id)
            ->where('kegiatan_id', $kegiatan->id)
            ->pluck('id');

        $results = ScreeningResult::query()
            ->with(['warga', 'klinik', 'session'])
            ->whereIn('sesi_id', $sessionIds)
            ->latest('diperiksa_pada')
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total' => ScreeningResult::query()
                ->whereIn('sesi_id', $sessionIds)
                ->count(),

            'rendah' => ScreeningResult::query()
                ->whereIn('sesi_id', $sessionIds)
                ->where('level_risiko', 'rendah')
                ->count(),

            'sedang' => ScreeningResult::query()
                ->whereIn('sesi_id', $sessionIds)
                ->where('level_risiko', 'sedang')
                ->count(),

            'tinggi' => ScreeningResult::query()
                ->whereIn('sesi_id', $sessionIds)
                ->where('level_risiko', 'tinggi')
                ->count(),
        ];

        return view('kader.riwayat-screening.show', [
            'kader' => $kader,
            'kegiatan' => $kegiatan,
            'results' => $results,
            'stats' => $stats,
        ]);
    }
}