@extends('layouts.admin')

@section('content')
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
        <div>
            <div class="text-muted small fw-semibold">Master Data</div>
            <h1 class="h3 mb-0">Kelola Klinik</h1>
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#importKlinikModal">
                <i class="bi bi-upload me-1"></i>Import CSV
            </button>
            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#createKlinikModal">
                <i class="bi bi-plus-lg me-1"></i>Tambah Klinik
            </button>
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Proses belum berhasil.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php($preview = session('import_preview'))
    @if ($preview)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
                    <div>
                        <h2 class="h5 mb-1">Preview Import CSV</h2>
                        <div class="text-muted small">{{ $preview['filename'] ?? 'File CSV' }}</div>
                    </div>
                    <span class="badge text-bg-{{ ($preview['invalid_rows'] ?? 0) > 0 ? 'danger' : 'success' }}">
                        {{ ($preview['invalid_rows'] ?? 0) > 0 ? 'Perlu Perbaikan' : 'Siap Import' }}
                    </span>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-3"><div class="border rounded p-3"><div class="small text-muted">Total Baris</div><div class="h4 mb-0">{{ $preview['total_rows'] ?? 0 }}</div></div></div>
                    <div class="col-md-3"><div class="border rounded p-3"><div class="small text-muted">Valid</div><div class="h4 mb-0 text-success">{{ $preview['valid_rows'] ?? 0 }}</div></div></div>
                    <div class="col-md-3"><div class="border rounded p-3"><div class="small text-muted">Invalid</div><div class="h4 mb-0 text-danger">{{ $preview['invalid_rows'] ?? 0 }}</div></div></div>
                    <div class="col-md-3"><div class="border rounded p-3"><div class="small text-muted">Import ID</div><div class="h4 mb-0">{{ $preview['import_id'] ?? '-' }}</div></div></div>
                </div>

                @if (!empty($preview['invalid_items']))
                    <div class="table-responsive mt-3">
                        <table class="table table-sm align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Baris</th>
                                    <th>Error</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($preview['invalid_items'] as $item)
                                    <tr>
                                        <td>{{ $item['row_number'] }}</td>
                                        <td>{{ implode(' | ', $item['errors'] ?? []) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if (($preview['invalid_rows'] ?? 0) === 0 && !empty($preview['import_id']))
                    <form method="POST" action="{{ route('admin.kliniks.import.commit') }}" class="mt-3">
                        @csrf
                        <input type="hidden" name="import_id" value="{{ $preview['import_id'] }}">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-database-check me-1"></i>Commit Import
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0" id="kliniks-table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Lokasi</th>
                            <th>Operasional</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kliniks as $klinik)
                            <tr>
                                <td>{{ $klinik->kode_klinik ?: '-' }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $klinik->nama }}</div>
                                    <div class="small text-muted">{{ $klinik->tipe }}</div>
                                </td>
                                <td>
                                    <div>{{ $klinik->kota }}, {{ $klinik->provinsi }}</div>
                                    <div class="small text-muted">{{ $klinik->latitude }}, {{ $klinik->longitude }}</div>
                                </td>
                                <td>
                                    <div>{{ $klinik->jam_buka ?: '-' }} - {{ $klinik->jam_tutup ?: '-' }}</div>
                                    <div class="small text-muted">Buka: {{ $klinik->hari_buka ?: '-' }}</div>
                                    <div class="small text-muted">Tutup: {{ $klinik->hari_tutup ?: '-' }}</div>
                                </td>
                                <td>
                                    <span class="badge text-bg-{{ $klinik->status === 'aktif' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($klinik->status) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="modal"
                                        data-bs-target="#editKlinikModal-{{ $klinik->id }}">
                                        Edit
                                    </button>
                                    <form method="POST" action="{{ route('admin.kliniks.destroy', $klinik) }}" class="d-inline"
                                        onsubmit="return confirm('Hapus klinik ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h2 class="h5 mb-3">Riwayat Import Terbaru</h2>
            <div class="table-responsive">
                <table class="table table-sm align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>File</th>
                            <th>Status</th>
                            <th>Ringkasan</th>
                            <th>Pengunggah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentImports as $import)
                            <tr>
                                <td>{{ optional($import->created_at)->format('d M Y H:i') }}</td>
                                <td>{{ $import->original_filename }}</td>
                                <td>{{ ucfirst($import->status) }}</td>
                                <td>{{ $import->valid_rows }}/{{ $import->total_rows }} valid</td>
                                <td>{{ $import->user?->name ?: '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-muted">Belum ada riwayat import.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createKlinikModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.kliniks.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Klinik</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">@include('admin.kliniks.partials.form', ['klinik' => null])</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Simpan Klinik</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="importKlinikModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.kliniks.import.preview') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Import Klinik CSV</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">File CSV</label>
                            <input type="file" name="file" class="form-control" accept=".csv,.txt" required>
                        </div>
                        <div class="small text-muted">
                            Header: kode_klinik, nama, tipe, alamat, kota, provinsi, telepon, latitude, longitude, jam_buka, jam_tutup, hari_buka, hari_tutup, layanan, status
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Preview Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($kliniks as $klinik)
        <div class="modal fade" id="editKlinikModal-{{ $klinik->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.kliniks.update', $klinik) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Klinik</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">@include('admin.kliniks.partials.form', ['klinik' => $klinik])</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script>
        initAdminDataTable('#kliniks-table', {
            pageLength: 10,
            actionColumn: 5
        });
    </script>
@endpush
