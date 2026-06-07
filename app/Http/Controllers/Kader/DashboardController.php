<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\KegiatanSosial;
use App\Models\ScreeningResult;
use App\Models\ScreeningSession;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        if ($request->user()->role !== 'kader') {
            abort(403, 'Akses hanya untuk kader.');
        }

        $kader = $request->user()->kader;

        abort_unless($kader, 403, 'Akun belum terhubung dengan data kader.');

        $kegiatanQuery = KegiatanSosial::query()
            ->whereHas('kaders', function ($query) use ($kader) {
                $query->where('kaders.id', $kader->id);
            });

        $jadwalMendatang = (clone $kegiatanQuery)
            ->whereIn('status', ['published', 'ongoing'])
            ->whereDate('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal')
            ->take(5)
            ->get();

        $semuaKegiatan = (clone $kegiatanQuery)
            ->latest('tanggal')
            ->take(5)
            ->get();

        $sessionIds = ScreeningSession::query()
            ->where('kader_id', $kader->id)
            ->pluck('id');

        $stats = [
            'total_jadwal' => (clone $kegiatanQuery)->count(),

            'total_sesi' => ScreeningSession::query()
                ->where('kader_id', $kader->id)
                ->count(),

            'total_warga' => ScreeningResult::query()
                ->whereIn('sesi_id', $sessionIds)
                ->count(),

            'risiko_tinggi' => ScreeningResult::query()
                ->whereIn('sesi_id', $sessionIds)
                ->where('level_risiko', 'tinggi')
                ->count(),
        ];

        return view('kader.dashboard', [
            'kader' => $kader,
            'stats' => $stats,
            'jadwalMendatang' => $jadwalMendatang,
            'semuaKegiatan' => $semuaKegiatan,
        ]);
    }

    public function jadwal(Request $request): View
    {
        if ($request->user()->role !== 'kader') {
            abort(403, 'Akses hanya untuk kader.');
        }

        $kader = $request->user()->kader;

        abort_unless($kader, 403, 'Akun belum terhubung dengan data kader.');

        $semuaKegiatan = KegiatanSosial::query()
            ->whereHas('kaders', function ($query) use ($kader) {
                $query->where('kaders.id', $kader->id);
            })
            ->latest('tanggal')
            ->paginate(10)
            ->withQueryString();

        return view('kader.jadwal', [
            'kader' => $kader,
            'semuaKegiatan' => $semuaKegiatan,
        ]);
    }

    public function showKegiatan(Request $request, KegiatanSosial $kegiatan): View
    {
        if ($request->user()->role !== 'kader') {
            abort(403, 'Akses hanya untuk kader.');
        }

        $kader = $request->user()->kader;

        abort_unless($kader, 403, 'Akun belum terhubung dengan data kader.');

        abort_unless(
            $kegiatan->kaders()->where('kaders.id', $kader->id)->exists(),
            403,
            'Kegiatan ini tidak ditugaskan kepada Anda.'
        );

        $kegiatan->load([
            'kaders',
            'materi',
            'screeningSessions' => function ($query) use ($kader) {
                $query
                    ->where('kader_id', $kader->id)
                    ->latest();
            },
        ]);

        return view('kader.kegiatan-show', [
            'kader' => $kader,
            'kegiatan' => $kegiatan,
        ]);
    }
}