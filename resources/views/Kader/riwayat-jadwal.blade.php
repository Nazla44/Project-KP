@extends('layouts.kader')

@section('title', 'Riwayat Jadwal Sosialisasi')

@section('page_title', 'Riwayat Jadwal')

@section('content')
    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Riwayat</p>
            <h1>Riwayat Jadwal Sosialisasi</h1>
            <p class="kader-page-desc">
                Daftar seluruh jadwal sosialisasi yang pernah ditugaskan kepada Anda.
            </p>
        </div>

        <a href="{{ route('kader.jadwal.index') }}" class="kader-btn-light">
            <i class="bi bi-calendar-event"></i>
            Jadwal Aktif
        </a>
    </div>

    @if($kegiatans->count())
        <div class="kader-table-card">
            <div class="kader-table-head">
                <div>
                    <h2>Daftar Riwayat Jadwal</h2>
                    <p>Jadwal sosialisasi yang ditugaskan oleh admin kepada kader.</p>
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
                            <th>Total Screening</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($kegiatans as $item)
                            @php
                                $totalScreening = 0;

                                if (isset($item->screeningSessions)) {
                                    $totalScreening = $item->screeningSessions->sum('results_count');
                                }
                            @endphp

                            <tr>
                                <td>
                                    <strong>{{ $item->judul }}</strong>

                                    <div class="text-muted small">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi ?? '-'), 70) }}
                                    </div>
                                </td>

                                <td>
                                    {{ optional($item->tanggal)->format('d M Y') ?? '-' }}

                                    @if($item->jam_mulai)
                                        <div class="text-muted small">
                                            {{ substr($item->jam_mulai, 0, 5) }}

                                            @if($item->jam_selesai)
                                                - {{ substr($item->jam_selesai, 0, 5) }}
                                            @endif
                                        </div>
                                    @endif
                                </td>

                                <td>{{ $item->lokasi ?? '-' }}</td>

                                <td>
                                    <span class="kader-status-badge">
                                        {{ $item->status_label ?? ucfirst($item->status ?? 'draft') }}
                                    </span>
                                </td>

                                <td>
                                    <strong>{{ $totalScreening }}</strong>
                                    <span class="text-muted small">warga</span>
                                </td>

                                <td class="text-end">
                                    <div class="kader-table-actions">
                                        <a href="{{ route('kader.kegiatan.show', $item) }}" class="kader-btn-light">
                                            Detail
                                        </a>

                                        <a href="{{ route('kader.riwayat-screening.show', $item) }}" class="kader-btn-red">
                                            Riwayat Screening
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(method_exists($kegiatans, 'links'))
                <div class="kader-pagination">
                    {{ $kegiatans->links() }}
                </div>
            @endif
        </div>
    @else
        <div class="kader-empty-page">
            <div class="kader-empty-page-icon">
                <i class="bi bi-calendar-x"></i>
            </div>

            <h2>Belum Ada Riwayat Jadwal</h2>

            <p>
                Riwayat jadwal sosialisasi akan muncul setelah admin membuat jadwal dan memilih Anda
                sebagai kader yang bertugas pada kegiatan tersebut.
            </p>

            <div class="kader-empty-steps">
                <div>
                    <span>1</span>
                    <strong>Admin membuat jadwal</strong>
                    <small>Admin menambahkan jadwal sosialisasi melalui dashboard admin.</small>
                </div>

                <div>
                    <span>2</span>
                    <strong>Admin memilih kader</strong>
                    <small>Nama Anda dipilih sebagai kader yang bertugas pada wilayah atau kegiatan tersebut.</small>
                </div>

                <div>
                    <span>3</span>
                    <strong>Jadwal masuk riwayat</strong>
                    <small>Jadwal yang ditugaskan akan muncul di halaman ini beserta total screening.</small>
                </div>
            </div>

            <div class="kader-empty-actions">
                <a href="{{ route('kader.jadwal.index') }}" class="kader-btn-red">
                    <i class="bi bi-calendar-event"></i>
                    Cek Jadwal Aktif
                </a>

                <a href="{{ route('kader.dashboard') }}" class="kader-btn-light">
                    <i class="bi bi-grid-1x2-fill"></i>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    @endif
@endsection