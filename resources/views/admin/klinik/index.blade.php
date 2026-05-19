@extends('admin.layouts.master')

@section('title', 'Manajemen Klinik - STPI')
@section('page_title', 'Manajemen Klinik')
@section('page_subtitle', 'Kelola data klinik TBC yang tampil di halaman program klinik.')

@section('content')
    <div class="card card-soft">
        <div class="card-body p-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h5 class="fw-bold mb-1">Daftar Klinik</h5>
                    <p class="text-muted mb-0">Total {{ $klinik->count() }} klinik.</p>
                </div>
                <a href="{{ route('klinik.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Klinik
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Kota / Provinsi</th>
                            <th>Telepon</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($klinik as $item)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $item->nama }}</div>
                                    <small class="text-muted">{{ \Illuminate\Support\Str::limit($item->alamat, 70) }}</small>
                                </td>
                                <td>{{ $item->tipe }}</td>
                                <td>
                                    {{ $item->kota ?? '-' }}<br>
                                    <small class="text-muted">{{ $item->provinsi ?? '-' }}</small>
                                </td>
                                <td>{{ $item->telepon ?? '-' }}</td>
                                <td>
                                    @if ($item->status === 'aktif')
                                        <span class="badge rounded-pill badge-soft-success">Aktif</span>
                                    @else
                                        <span class="badge rounded-pill badge-soft-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('klinik.edit', $item) }}" class="btn btn-sm btn-outline-secondary">Edit</a>

                                        <form method="POST" action="{{ route('klinik.destroy', $item) }}" class="form-delete d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">Belum ada klinik.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
