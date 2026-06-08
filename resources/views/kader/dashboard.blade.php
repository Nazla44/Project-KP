@extends('layouts.kader')

@section('title', 'Dashboard Kader')

@section('page_title', 'Dashboard')

@section('content')
    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Overview</p>
            <h1>Dashboard Kader</h1>
            <p class="kader-page-desc">
                Halo, {{ $kader->nama }}. Berikut ringkasan jadwal sosialisasi dan screening Anda.
            </p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="kader-stat-card">
                <div class="kader-stat-icon">
                    <i class="bi bi-calendar-event-fill"></i>
                </div>
                <div>
                    <div class="kader-stat-label">Total Jadwal</div>
                    <div class="kader-stat-num">{{ $stats['total_jadwal'] ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kader-stat-card">
                <div class="kader-stat-icon">
                    <i class="bi bi-clipboard2-pulse-fill"></i>
                </div>
                <div>
                    <div class="kader-stat-label">Sesi Screening</div>
                    <div class="kader-stat-num">{{ $stats['total_sesi'] ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kader-stat-card">
                <div class="kader-stat-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <div class="kader-stat-label">Warga Diperiksa</div>
                    <div class="kader-stat-num">{{ $stats['total_warga'] ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kader-stat-card">
                <div class="kader-stat-icon danger">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div>
                    <div class="kader-stat-label">Risiko Tinggi</div>
                    <div class="kader-stat-num">{{ $stats['risiko_tinggi'] ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="kader-table-card mb-4">
        <div class="kader-table-head">
            <div>
                <h2>Jadwal Sosialisasi Terdekat</h2>
                <p>Jadwal yang ditugaskan admin kepada Anda.</p>
            </div>

            <a href="{{ route('kader.jadwal.index') }}" class="kader-btn-red">
                Lihat Semua
            </a>
        </div>

        <div class="kader-schedule-list">
            @forelse($jadwalMendatang as $item)
                <div class="kader-schedule-item">
                    <div>
                        <span class="kader-status-badge">
                            {{ $item->status_label ?? ucfirst($item->status) }}
                        </span>

                        <h3>{{ $item->judul }}</h3>

                        <p>
                            <i class="bi bi-calendar-event"></i>
                            {{ optional($item->tanggal)->format('d M Y') }}

                            @if($item->jam_mulai)
                                · {{ substr($item->jam_mulai, 0, 5) }}
                            @endif
                        </p>

                        <p>
                            <i class="bi bi-geo-alt"></i>
                            {{ $item->lokasi }}
                        </p>
                    </div>

                    <div class="kader-schedule-actions">
                        <a href="{{ route('kader.kegiatan.show', $item) }}" class="kader-btn-light">
                            Detail
                        </a>

                        <a href="{{ route('kader.screening.create', $item) }}" class="kader-btn-red">
                            Screening
                        </a>
                    </div>
                </div>
            @empty
                <div class="kader-empty-state">
                    Belum ada jadwal sosialisasi mendatang.
                </div>
            @endforelse
        </div>
    </div>

    <div class="kader-table-card">
        <div class="kader-table-head">
            <div>
                <h2>Riwayat Jadwal Saya</h2>
                <p>Lima jadwal terbaru yang pernah ditugaskan.</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table kader-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($semuaKegiatan as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->judul }}</strong>
                            </td>

                            <td>{{ optional($item->tanggal)->format('d/m/Y') }}</td>

                            <td>{{ $item->lokasi }}</td>

                            <td>
                                <span class="kader-status-badge">
                                    {{ $item->status_label ?? ucfirst($item->status) }}
                                </span>
                            </td>

                            <td class="text-end">
                                <a href="{{ route('kader.kegiatan.show', $item) }}" class="kader-btn-light">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Belum ada jadwal yang ditugaskan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection