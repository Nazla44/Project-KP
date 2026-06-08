@extends('layouts.kader')

@section('title', 'Riwayat Screening Warga')

@section('page_title', 'Riwayat Screening')

@section('content')
    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Riwayat Screening</p>
            <h1>{{ $kegiatan->judul }}</h1>
            <p class="kader-page-desc">
                Daftar warga yang sudah diskrining pada jadwal sosialisasi ini.
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('kader.riwayat-screening.index') }}" class="kader-btn-light">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

            <a href="{{ route('kader.screening.create', $kegiatan) }}" class="kader-btn-red">
                <i class="bi bi-plus-lg"></i>
                Tambah Screening
            </a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="kader-stat-card">
                <div class="kader-stat-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <div class="kader-stat-label">Total Warga</div>
                    <div class="kader-stat-num">{{ $stats['total'] ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kader-stat-card">
                <div class="kader-stat-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <div class="kader-stat-label">Risiko Rendah</div>
                    <div class="kader-stat-num">{{ $stats['rendah'] ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kader-stat-card">
                <div class="kader-stat-icon">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div>
                    <div class="kader-stat-label">Risiko Sedang</div>
                    <div class="kader-stat-num">{{ $stats['sedang'] ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kader-stat-card">
                <div class="kader-stat-icon danger">
                    <i class="bi bi-exclamation-octagon-fill"></i>
                </div>
                <div>
                    <div class="kader-stat-label">Risiko Tinggi</div>
                    <div class="kader-stat-num">{{ $stats['tinggi'] ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="kader-table-card">
        <div class="kader-table-head">
            <div>
                <h2>Daftar Hasil Screening</h2>
                <p>Data warga, skor risiko, rekomendasi tindakan, dan faskes rujukan.</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table kader-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Warga</th>
                        <th>NIK</th>
                        <th>Skor</th>
                        <th>Risiko</th>
                        <th>Faskes Rujukan</th>
                        <th>Waktu Periksa</th>
                        <th>Catatan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($results as $result)
                        <tr>
                            <td>
                                <strong>{{ $result->warga->nama_lengkap ?? '-' }}</strong>
                                <div class="text-muted small">
                                    {{ $result->warga->alamat ?? '-' }}
                                </div>
                            </td>

                            <td>{{ $result->warga_nik }}</td>

                            <td>
                                <strong>{{ $result->skor_total }}</strong>
                                <span class="text-muted small">poin</span>
                            </td>

                            <td>
                                <span class="risk-badge {{ $result->level_risiko }}">
                                    {{ ucfirst($result->level_risiko) }}
                                </span>
                            </td>

                            <td>
                                @if($result->klinik)
                                    <strong>{{ $result->klinik->nama }}</strong>
                                    <div class="text-muted small">
                                        {{ $result->klinik->alamat }}
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td>
                                {{ optional($result->diperiksa_pada)->format('d M Y H:i') }}
                            </td>

                            <td>
                                {{ $result->catatan_kader ?: '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Belum ada data screening untuk jadwal ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="kader-pagination">
            {{ $results->links() }}
        </div>
    </div>
@endsection