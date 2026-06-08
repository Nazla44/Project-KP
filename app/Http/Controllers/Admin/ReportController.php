<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KegiatanSosial;
use App\Models\ScreeningResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function overview(Request $request): View
    {
        $kegiatanQuery = $this->kegiatanQuery($request);
        $screeningQuery = $this->screeningQuery($request);

        return view('admin.reports.overview', [
            'pageTitle' => 'Laporan Admin',
            'kegiatans' => $kegiatanQuery->paginate(10)->withQueryString(),
            'summary' => [
                'total_kegiatan' => (clone $this->kegiatanQuery($request))->count(),
                'total_screening' => (clone $screeningQuery)->count(),
                'risiko_rendah' => (clone $screeningQuery)->where('level_risiko', 'rendah')->count(),
                'risiko_sedang' => (clone $screeningQuery)->where('level_risiko', 'sedang')->count(),
                'risiko_tinggi' => (clone $screeningQuery)->where('level_risiko', 'tinggi')->count(),
            ],
        ]);
    }

    public function exportOverview(Request $request): StreamedResponse
    {
        $fileName = 'laporan-admin-' . now()->format('Ymd-His') . '.csv';

        $query = $this->kegiatanQuery($request);

        return Response::streamDownload(function () use ($query) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'Tanggal',
                'Judul Kegiatan',
                'Lokasi',
                'Status',
                'Jumlah Peserta',
                'Jumlah Kader',
                'Jumlah Materi',
                'Jumlah Dokumentasi',
                'Jumlah Sesi Screening',
                'Catatan Rekap',
            ]);

            $query->chunk(200, function ($kegiatans) use ($handle) {
                foreach ($kegiatans as $kegiatan) {
                    fputcsv($handle, [
                        optional($kegiatan->tanggal)->format('Y-m-d'),
                        $kegiatan->judul,
                        $kegiatan->lokasi,
                        $kegiatan->status,
                        $kegiatan->ringkasan?->jumlah_peserta ?? 0,
                        $kegiatan->ringkasan?->jumlah_kader ?? 0,
                        $kegiatan->ringkasan?->jumlah_materi ?? 0,
                        $kegiatan->dokumentasi_count ?? 0,
                        $kegiatan->screening_sessions_count ?? 0,
                        $kegiatan->ringkasan?->catatan_internal,
                    ]);
                }
            });

            fclose($handle);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function kegiatanQuery(Request $request)
    {
        return KegiatanSosial::query()
            ->with(['ringkasan', 'dokumentasi'])
            ->withCount(['dokumentasi', 'screeningSessions'])
            ->when($request->query('status'), function ($query, string $status) {
                $query->where('status', $status);
            })
            ->when($request->query('from'), function ($query, string $from) {
                $query->whereDate('tanggal', '>=', $from);
            })
            ->when($request->query('to'), function ($query, string $to) {
                $query->whereDate('tanggal', '<=', $to);
            })
            ->when($request->query('q'), function ($query, string $keyword) {
                $query->where(function ($sub) use ($keyword) {
                    $sub->where('judul', 'like', "%{$keyword}%")
                        ->orWhere('lokasi', 'like', "%{$keyword}%");
                });
            })
            ->orderByDesc('tanggal');
    }

    private function screeningQuery(Request $request)
    {
        return ScreeningResult::query()
            ->when($request->query('from'), function ($query, string $from) {
                $query->whereDate('created_at', '>=', $from);
            })
            ->when($request->query('to'), function ($query, string $to) {
                $query->whereDate('created_at', '<=', $to);
            });
    }
}