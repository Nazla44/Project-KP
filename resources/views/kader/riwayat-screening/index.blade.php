@extends('layouts.kader')

@section('title', 'Riwayat Screening')

@section('page_title', 'Riwayat Screening')

@section('content')
    @php
        $dataKegiatan = $kegiatans ?? collect();
    @endphp

    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Riwayat</p>
            <h1>Riwayat Screening</h1>
            <p class="kader-page-desc">
                Pilih jadwal sosialisasi terlebih dahulu untuk melihat daftar warga yang sudah diskrining.
            </p>
        </div>
    </div>

    @if ($dataKegiatan->count())
        <div class="history-screening-grid">
            @foreach ($dataKegiatan as $item)
                @php
                    $totalScreening = 0;
                    $lastScreening = null;

                    if (isset($item->screeningSessions)) {
                        $totalScreening = $item->screeningSessions->sum('results_count');

                        $lastScreening = $item->screeningSessions
                            ->flatMap(function ($session) {
                                return $session->results ?? collect();
                            })
                            ->sortByDesc('created_at')
                            ->first();
                    }

                    $status = $item->status ?? 'draft';

                    $statusLabel = match ($status) {
                        'published' => 'Akan Datang',
                        'ongoing' => 'Berlangsung',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                        default => ucfirst($status),
                    };
                @endphp

                <article class="history-screening-card">
                    <div class="history-screening-card-top">
                        <span class="history-screening-status {{ $status }}">
                            {{ $statusLabel }}
                        </span>

                        <span class="history-screening-count">
                            {{ $totalScreening }} warga
                        </span>
                    </div>

                    <h2>{{ $item->judul }}</h2>

                    <div class="history-screening-meta">
                        <p>
                            <i class="bi bi-calendar-event"></i>
                            <span>{{ optional($item->tanggal)->format('d M Y') ?? '-' }}</span>
                        </p>

                        <p>
                            <i class="bi bi-geo-alt"></i>
                            <span>{{ $item->lokasi ?? '-' }}</span>
                        </p>

                        <p>
                            <i class="bi bi-clock-history"></i>
                            <span>
                                Terakhir screening:
                                @if ($lastScreening)
                                    {{ optional($lastScreening->created_at)->format('d M Y H:i') }}
                                @else
                                    Belum ada
                                @endif
                            </span>
                        </p>
                    </div>

                    <div class="history-screening-actions">
                        <a href="{{ route('kader.riwayat-screening.show', $item) }}" class="kader-btn-red">
                            <i class="bi bi-eye"></i>
                            Lihat Riwayat
                        </a>

                        <a href="{{ route('kader.screening.create', $item) }}" class="kader-btn-light">
                            <i class="bi bi-plus-circle"></i>
                            Tambah Screening
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        @if (method_exists($dataKegiatan, 'links'))
            <div class="mt-4">
                {{ $dataKegiatan->links() }}
            </div>
        @endif
    @else
        <div class="kader-empty-page">
            <div class="kader-empty-page-icon">
                <i class="bi bi-clipboard2-pulse"></i>
            </div>

            <h2>Belum Ada Riwayat Screening</h2>

            <p>
                Riwayat screening akan muncul setelah Anda melakukan screening warga pada jadwal
                sosialisasi yang sudah ditugaskan oleh admin.
            </p>

            <div class="kader-empty-steps">
                <div>
                    <span>1</span>
                    <strong>Pilih jadwal</strong>
                    <small>Buka jadwal sosialisasi aktif yang ditugaskan kepada Anda.</small>
                </div>

                <div>
                    <span>2</span>
                    <strong>Isi form screening</strong>
                    <small>Masukkan identitas warga dan pilih gejala atau faktor risiko TBC.</small>
                </div>

                <div>
                    <span>3</span>
                    <strong>Riwayat tersimpan</strong>
                    <small>Data screening warga akan tersimpan dan tampil pada halaman ini.</small>
                </div>
            </div>

            <div class="kader-empty-actions">
                <a href="{{ route('kader.jadwal.index') }}" class="kader-btn-red">
                    <i class="bi bi-calendar-event"></i>
                    Lihat Jadwal Sosialisasi
                </a>

                <a href="{{ route('kader.dashboard') }}" class="kader-btn-light">
                    <i class="bi bi-grid-1x2-fill"></i>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    @endif
@endsection
