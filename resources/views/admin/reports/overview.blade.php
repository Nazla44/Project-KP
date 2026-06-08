@extends('layouts.admin')

@section('content')
    <div class="admin-page-header">
        <div>
            <div class="admin-page-subtitle">Fase 5</div>
            <h1>Laporan Dashboard Admin</h1>
            <p>
                Ringkasan kegiatan sosialisasi, hasil screening warga, dan rekap laporan kader.
            </p>
        </div>

        <a href="{{ route('admin.reports.overview.export', request()->query()) }}" class="admin-primary-button">
            <i class="bi bi-download"></i>
            Export CSV
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-md-3">
            <div class="admin-stat-card">
                <div class="admin-stat-icon">
                    <i class="bi bi-calendar-event"></i>
                </div>
                <div>
                    <span>Total Kegiatan</span>
                    <strong>{{ $summary['total_kegiatan'] }}</strong>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="admin-stat-card">
                <div class="admin-stat-icon">
                    <i class="bi bi-clipboard2-pulse"></i>
                </div>
                <div>
                    <span>Total Screening</span>
                    <strong>{{ $summary['total_screening'] }}</strong>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-2">
            <div class="admin-stat-card">
                <div>
                    <span>Risiko Rendah</span>
                    <strong>{{ $summary['risiko_rendah'] }}</strong>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-2">
            <div class="admin-stat-card">
                <div>
                    <span>Risiko Sedang</span>
                    <strong>{{ $summary['risiko_sedang'] }}</strong>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-2">
            <div class="admin-stat-card">
                <div>
                    <span>Risiko Tinggi</span>
                    <strong>{{ $summary['risiko_tinggi'] }}</strong>
                </div>
            </div>
        </div>
    </div>

    <form method="GET" class="admin-filter-card mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-12 col-md-3">
                <label class="form-label">Cari Kegiatan / Lokasi</label>
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari...">
            </div>

            <div class="col-12 col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua</option>
                    <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                    <option value="published" @selected(request('status') === 'published')>Akan Datang</option>
                    <option value="ongoing" @selected(request('status') === 'ongoing')>Berlangsung</option>
                    <option value="completed" @selected(request('status') === 'completed')>Selesai</option>
                    <option value="cancelled" @selected(request('status') === 'cancelled')>Dibatalkan</option>
                </select>
            </div>

            <div class="col-12 col-md-2">
                <label class="form-label">Dari</label>
                <input type="date" name="from" value="{{ request('from') }}" class="form-control">
            </div>

            <div class="col-12 col-md-2">
                <label class="form-label">Sampai</label>
                <input type="date" name="to" value="{{ request('to') }}" class="form-control">
            </div>

            <div class="col-12 col-md-3 d-flex gap-2">
                <button type="submit" class="admin-primary-button">
                    Filter
                </button>

                <a href="{{ route('admin.reports.overview') }}" class="admin-secondary-button">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <div class="admin-table-card">
        <div class="admin-table-header">
            <div>
                <h2>Rekap Kegiatan Sosialisasi</h2>
                <p>Data berasal dari rekap yang diisi kader dan hasil screening warga.</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table admin-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Peserta</th>
                        <th>Materi</th>
                        <th>Foto</th>
                        <th>Sesi Screening</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($kegiatans as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->judul }}</strong>
                                <div class="text-muted small">
                                    {{ $item->ringkasan ? 'Sudah direkap' : 'Belum direkap' }}
                                </div>
                            </td>

                            <td>{{ optional($item->tanggal)->format('d M Y') ?? '-' }}</td>
                            <td>{{ $item->lokasi ?? '-' }}</td>

                            <td>
                                <span class="badge text-bg-light">
                                    {{ $item->status_label ?? ucfirst($item->status) }}
                                </span>
                            </td>

                            <td>{{ $item->ringkasan?->jumlah_peserta ?? 0 }}</td>
                            <td>{{ $item->ringkasan?->jumlah_materi ?? 0 }}</td>
                            <td>{{ $item->dokumentasi_count ?? 0 }}</td>
                            <td>{{ $item->screening_sessions_count ?? 0 }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                Belum ada laporan kegiatan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="admin-table-footer">
            {{ $kegiatans->links() }}
        </div>
    </div>
@endsection
