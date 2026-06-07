@extends('layouts.kader')

@section('title', 'Detail Kegiatan')

@section('content')
    <div class="mb-3">
        <a href="{{ route('kader.dashboard') }}" class="text-decoration-none text-muted">
            <i class="bi bi-arrow-left"></i>
            Kembali ke dashboard
        </a>
    </div>

    <div class="kader-card p-4 mb-4">
        <span class="badge kader-badge-red mb-3">{{ $kegiatan->status_label }}</span>

        <h1 class="h3 fw-bold mb-2">{{ $kegiatan->judul }}</h1>

        <div class="text-muted mb-2">
            <i class="bi bi-calendar-event"></i>
            {{ $kegiatan->tanggal->format('d M Y') }}

            @if($kegiatan->jam_mulai)
                · {{ substr($kegiatan->jam_mulai, 0, 5) }}
            @endif

            @if($kegiatan->jam_selesai)
                - {{ substr($kegiatan->jam_selesai, 0, 5) }}
            @endif
        </div>

        <div class="text-muted mb-3">
            <i class="bi bi-geo-alt"></i>
            {{ $kegiatan->lokasi }}
        </div>

        <p class="mb-4">{{ $kegiatan->deskripsi }}</p>

        <a href="{{ route('kader.screening.create', $kegiatan) }}" class="btn kader-btn-primary">
            <i class="bi bi-clipboard2-pulse"></i>
            Mulai / Lanjut Screening
        </a>
    </div>

    <div class="kader-card p-4">
        <h2 class="h5 fw-bold mb-3">Sesi Screening Saya</h2>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Warga Diperiksa</th>
                        <th>Rendah</th>
                        <th>Sedang</th>
                        <th>Tinggi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($kegiatan->screeningSessions as $session)
                        <tr>
                            <td>{{ $session->tanggal_sesi->format('d/m/Y') }}</td>

                            <td>
                                <span class="badge {{ $session->status === 'selesai' ? 'text-bg-success' : 'text-bg-warning' }}">
                                    {{ ucfirst($session->status) }}
                                </span>
                            </td>

                            <td>{{ $session->total_diperiksa }}</td>
                            <td>{{ $session->total_rendah }}</td>
                            <td>{{ $session->total_sedang }}</td>
                            <td>{{ $session->total_tinggi }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada sesi screening untuk kegiatan ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection