@extends('layouts.kader')

@section('title', 'Rekap Sosialisasi')

@section('page_title', 'Rekap Sosialisasi')

@section('content')
    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Report A</p>
            <h1>Rekap Sosialisasi</h1>
            <p class="kader-page-desc">
                Isi rekap kegiatan sosialisasi setelah kegiatan selesai dilaksanakan.
            </p>
        </div>
    </div>

    @if ($kegiatans->count())
        <div class="history-schedule-grid">
            @foreach ($kegiatans as $item)
                <article class="history-schedule-card">
                    <div class="history-schedule-top">
                        <span class="kader-status-badge">
                            {{ $item->status_label ?? ucfirst($item->status) }}
                        </span>

                        @if ($item->ringkasan)
                            <span class="history-screening-count">
                                Sudah direkap
                            </span>
                        @else
                            <span class="history-screening-count">
                                Belum direkap
                            </span>
                        @endif
                    </div>

                    <h2>{{ $item->judul }}</h2>

                    <div class="history-schedule-meta">
                        <p>
                            <i class="bi bi-calendar-event"></i>
                            <span>{{ optional($item->tanggal)->format('d M Y') ?? '-' }}</span>
                        </p>

                        <p>
                            <i class="bi bi-geo-alt"></i>
                            <span>{{ $item->lokasi ?? '-' }}</span>
                        </p>

                        <p>
                            <i class="bi bi-people"></i>
                            <span>
                                Peserta:
                                {{ $item->ringkasan?->jumlah_peserta ?? 0 }}
                            </span>
                        </p>

                        <p>
                            <i class="bi bi-image"></i>
                            <span>
                                Dokumentasi:
                                {{ $item->dokumentasi_count ?? 0 }} foto
                            </span>
                        </p>
                    </div>

                    <div class="history-schedule-actions">
                        <a href="{{ route('kader.rekap-sosialisasi.edit', $item) }}" class="kader-btn-red">
                            <i class="bi bi-journal-check"></i>
                            {{ $item->ringkasan ? 'Edit Rekap' : 'Isi Rekap' }}
                        </a>

                        <a href="{{ route('kader.kegiatan.show', $item) }}" class="kader-btn-light">
                            <i class="bi bi-eye"></i>
                            Detail Jadwal
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $kegiatans->links() }}
        </div>
    @else
        <div class="kader-empty-page">
            <div class="kader-empty-page-icon">
                <i class="bi bi-journal-check"></i>
            </div>

            <h2>Belum Ada Jadwal untuk Direkap</h2>

            <p>
                Rekap sosialisasi akan muncul setelah admin menugaskan jadwal sosialisasi
                kepada Anda.
            </p>

            <div class="kader-empty-actions">
                <a href="{{ route('kader.jadwal.index') }}" class="kader-btn-red">
                    <i class="bi bi-calendar-event"></i>
                    Lihat Jadwal Sosialisasi
                </a>
            </div>
        </div>
    @endif
@endsection
