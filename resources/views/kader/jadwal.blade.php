@extends('layouts.kader')

@section('title', 'Jadwal Sosialisasi')

@section('page_title', 'Jadwal Sosialisasi')

@section('content')
    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Jadwal</p>
            <h1>Jadwal Sosialisasi</h1>
            <p class="kader-page-desc">
                Daftar jadwal sosialisasi aktif yang ditugaskan kepada Anda oleh admin.
            </p>
        </div>

        <a href="{{ route('kader.riwayat-jadwal.index') }}" class="kader-btn-light">
            <i class="bi bi-clock-history"></i>
            Riwayat Jadwal
        </a>
    </div>

    @if ($semuaKegiatan->count())
        <div class="kader-table-card">
            <div class="kader-table-head">
                <div>
                    <h2>Daftar Jadwal Aktif</h2>
                    <p>
                        Klik tombol screening untuk mulai mengisi data screening masyarakat pada jadwal yang dipilih.
                    </p>
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
                        @foreach ($semuaKegiatan as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item->judul }}</strong>

                                    <div class="text-muted small">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi ?? '-'), 70) }}
                                    </div>
                                </td>

                                <td>
                                    {{ optional($item->tanggal)->format('d M Y') ?? '-' }}

                                    @if ($item->jam_mulai)
                                        <div class="text-muted small">
                                            {{ substr($item->jam_mulai, 0, 5) }}

                                            @if ($item->jam_selesai)
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

                                <td class="text-end">
                                    <div class="kader-action-group">
                                        <a href="{{ route('kader.kegiatan.show', $item) }}" class="kader-action-button view"
                                            title="Detail jadwal">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('kader.screening.create', $item) }}"
                                            class="kader-action-button screening" title="Mulai screening">
                                            <i class="bi bi-clipboard2-pulse"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if (method_exists($semuaKegiatan, 'links'))
                <div class="kader-pagination">
                    {{ $semuaKegiatan->links() }}
                </div>
            @endif
        </div>
    @else
        <div class="kader-empty-page">
            <div class="kader-empty-page-icon">
                <i class="bi bi-calendar-event"></i>
            </div>

            <h2>Belum Ada Jadwal Sosialisasi Aktif</h2>

            <p>
                Jadwal sosialisasi akan muncul setelah admin membuat jadwal kegiatan dan memilih Anda
                sebagai kader yang bertugas. Setelah jadwal tersedia, Anda dapat membuka detail kegiatan
                dan mulai melakukan screening masyarakat.
            </p>

            <div class="kader-empty-steps">
                <div>
                    <span>1</span>
                    <strong>Admin membuat jadwal</strong>
                    <small>Admin menambahkan jadwal sosialisasi melalui dashboard admin.</small>
                </div>

                <div>
                    <span>2</span>
                    <strong>Kader ditugaskan</strong>
                    <small>Admin memilih Anda sebagai kader yang bertugas pada jadwal tersebut.</small>
                </div>

                <div>
                    <span>3</span>
                    <strong>Screening masyarakat</strong>
                    <small>Jadwal akan muncul di sini dan Anda dapat mulai mengisi form screening.</small>
                </div>
            </div>

            <div class="kader-empty-actions">
                <a href="{{ route('kader.dashboard') }}" class="kader-btn-red">
                    <i class="bi bi-grid-1x2-fill"></i>
                    Kembali ke Dashboard
                </a>

                <a href="{{ route('kader.riwayat-jadwal.index') }}" class="kader-btn-light">
                    <i class="bi bi-clock-history"></i>
                    Lihat Riwayat Jadwal
                </a>
            </div>
        </div>
    @endif
@endsection
