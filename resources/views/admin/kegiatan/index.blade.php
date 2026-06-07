@extends('layouts.admin')

@section('title', 'Jadwal Sosialisasi')

@section('content')
    @php
        $items = $kegiatans ?? $kegiatanList ?? $kegiatan ?? collect();
    @endphp

    <div class="admin-page-header">
        <div>
            <p class="admin-page-label">Manajemen</p>
            <h1 class="admin-page-title">Jadwal Sosialisasi</h1>
        </div>

        <a href="{{ route('admin.kegiatan-sosial.create') }}" class="admin-primary-button">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Kegiatan</span>
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="admin-table-card">
        <div class="admin-table-card-head">
            <div>
                <h2>Daftar Jadwal</h2>
                <p>Data jadwal sosialisasi yang ditampilkan pada dashboard admin.</p>
            </div>

            <form method="GET" action="{{ route('admin.kegiatan-sosial.index') }}" class="admin-filter-form">
                <div class="admin-search-box">
                    <i class="bi bi-search"></i>
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Cari judul kegiatan..."
                    >
                </div>

                <select name="status" class="admin-filter-select">
                    <option value="">Semua Status</option>
                    <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                    <option value="published" @selected(request('status') === 'published')>Published</option>
                    <option value="ongoing" @selected(request('status') === 'ongoing')>Berlangsung</option>
                    <option value="completed" @selected(request('status') === 'completed')>Selesai</option>
                    <option value="cancelled" @selected(request('status') === 'cancelled')>Dibatalkan</option>
                </select>

                <button type="submit" class="admin-filter-button">
                    Filter
                </button>

                @if(request('q') || request('status'))
                    <a href="{{ route('admin.kegiatan-sosial.index') }}" class="admin-reset-button">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="table-responsive">
            <table class="table admin-data-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Kader</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>
                                <div class="admin-table-title">
                                    {{ $item->judul }}
                                </div>

                                <div class="admin-table-subtitle">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($item->deskripsi ?? '-'), 70) }}
                                </div>
                            </td>

                            <td>
                                <div class="admin-date-main">
                                    {{ optional($item->tanggal)->format('d M Y') }}
                                </div>

                                <div class="admin-date-sub">
                                    @if($item->jam_mulai)
                                        {{ substr($item->jam_mulai, 0, 5) }}
                                    @else
                                        -
                                    @endif

                                    @if($item->jam_selesai)
                                        - {{ substr($item->jam_selesai, 0, 5) }}
                                    @endif
                                </div>
                            </td>

                            <td>
                                <div class="admin-location-text">
                                    <i class="bi bi-geo-alt"></i>
                                    <span>{{ $item->lokasi }}</span>
                                </div>
                            </td>

                            <td>
                                @php
                                    $status = $item->status ?? 'draft';

                                    $statusClass = match ($status) {
                                        'published' => 'published',
                                        'ongoing' => 'ongoing',
                                        'completed' => 'completed',
                                        'cancelled' => 'cancelled',
                                        default => 'draft',
                                    };

                                    $statusLabel = $item->status_label ?? match ($status) {
                                        'published' => 'Published',
                                        'ongoing' => 'Berlangsung',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                        default => 'Draft',
                                    };
                                @endphp

                                <span class="admin-status-badge {{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>

                            <td>
                                @if(isset($item->kaders) && $item->kaders->count())
                                    <div class="admin-kader-stack">
                                        @foreach($item->kaders->take(3) as $kader)
                                            <span class="admin-kader-pill">
                                                {{ $kader->nama }}
                                            </span>
                                        @endforeach

                                        @if($item->kaders->count() > 3)
                                            <span class="admin-kader-more">
                                                +{{ $item->kaders->count() - 3 }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted small">Belum dipilih</span>
                                @endif
                            </td>

                            <td class="text-end">
                                <div class="admin-action-group">
                                    <a href="{{ route('admin.kegiatan-sosial.show', $item) }}" class="admin-action-button view">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.kegiatan-sosial.edit', $item) }}" class="admin-action-button edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.kegiatan-sosial.destroy', $item) }}"
                                        class="d-inline js-confirm-delete"
                                        data-title="Hapus jadwal sosialisasi?"
                                        data-text="Jadwal ini akan dihapus dari dashboard admin dan kader."
                                        data-confirm="Ya, hapus"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="admin-action-button delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="admin-empty-state">
                                    <div class="admin-empty-icon">
                                        <i class="bi bi-calendar-x"></i>
                                    </div>

                                    <h3>Belum ada kegiatan sosial.</h3>

                                    <p>
                                        Tambahkan jadwal sosialisasi pertama agar kader dapat melihat jadwal dan melakukan screening masyarakat.
                                    </p>

                                    <a href="{{ route('admin.kegiatan-sosial.create') }}" class="admin-primary-button">
                                        <i class="bi bi-plus-lg"></i>
                                        <span>Tambah Kegiatan</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($items, 'links'))
            <div class="admin-table-footer">
                <div class="admin-pagination-info">
                    Menampilkan data jadwal sosialisasi.
                </div>

                <div>
                    {{ $items->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection