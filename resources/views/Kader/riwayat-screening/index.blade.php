@extends('layouts.kader')

@section('title', 'Riwayat Screening')

@section('page_title', 'Riwayat Screening')

@section('content')
    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Riwayat</p>
            <h1>Riwayat Screening</h1>
            <p class="kader-page-desc">
                Pilih jadwal sosialisasi terlebih dahulu untuk melihat daftar warga yang sudah diskrining.
            </p>
        </div>
    </div>

    @if($kegiatans->count())
        <div class="history-schedule-grid">
            @foreach($kegiatans as $item)
                @php
                    $totalScreening = $item->screeningSessions->sum('results_count');
                    $lastSession = $item->screeningSessions->first();
                @endphp

                <div class="history-schedule-card">
                    <div class="history-schedule-top">
                        <span class="kader-status-badge">
                            {{ $item->status_label ?? ucfirst($item->status) }}
                        </span>

                        <span class="history-screening-count">
                            {{ $totalScreening }} warga
                        </span>
                    </div>

                    <h2>{{ $item->judul }}</h2>

                    <div class="history-schedule-meta">
                        <p>
                            <i class="bi bi-calendar-event"></i>
                            {{ optional($item->tanggal)->format('d M Y') ?? '-' }}
                        </p>

                        <p>
                            <i class="bi bi-geo-alt"></i>
                            {{ $item->lokasi ?? '-' }}
                        </p>

                        <p>
                            <i class="bi bi-clock-history"></i>
                            Terakhir screening:
                            {{ $lastSession?->updated_at?->format('d M Y H:i') ?? 'Belum ada' }}
                        </p>
                    </div>

                    <div class="history-schedule-actions">
                        <a href="{{ route('kader.riwayat-screening.show', $item) }}" class="kader-btn-red">
                            Lihat Riwayat
                        </a>

                        <a href="{{ route('kader.screening.create', $item) }}" class="kader-btn-light">
                            Tambah Screening
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="kader-pagination mt-3">
            {{ $kegiatans->links() }}
        </div>
    @else
        <div class="kader-empty-page">
            <div class="kader-empty-page-icon">
                <i class="bi bi-clipboard2-pulse"></i>
            </div>

            <h2>Belum Ada Riwayat Screening</h2>

            <p>
                Riwayat screening akan muncul setelah admin menugaskan jadwal sosialisasi kepada Anda
                dan Anda mulai mengisi form screening masyarakat.
            </p>

            <div class="kader-empty-steps">
                <div>
                    <span>1</span>
                    <strong>Admin membuat jadwal</strong>
                    <small>Admin menambahkan jadwal sosialisasi dan memilih kader yang bertugas.</small>
                </div>

                <div>
                    <span>2</span>
                    <strong>Kader melakukan screening</strong>
                    <small>Kader membuka jadwal dan mengisi form screening warga.</small>
                </div>

                <div>
                    <span>3</span>
                    <strong>Riwayat tersimpan</strong>
                    <small>Data warga yang sudah diskrining akan tampil di halaman ini.</small>
                </div>
            </div>

            <div class="kader-empty-actions">
                <a href="{{ route('kader.jadwal.index') }}" class="kader-btn-red">
                    <i class="bi bi-calendar-event"></i>
                    Cek Jadwal Sosialisasi
                </a>

                <a href="{{ route('kader.dashboard') }}" class="kader-btn-light">
                    <i class="bi bi-grid-1x2-fill"></i>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    @endif
@endsection