@extends('admin.layouts.master')

@section('title', 'Manajemen Kader - STPI')
@section('page_title', 'Manajemen Kader')
@section('page_subtitle', 'Kelola data kader yang terhubung dengan klinik.')

@section('content')
    <div class="card card-soft">
        <div class="card-body p-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h5 class="fw-bold mb-1">Daftar Kader</h5>
                    <p class="text-muted mb-0">Total {{ $kaders->count() }} kader.</p>
                </div>
                <a href="{{ route('kader.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Kader
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Klinik</th>
                            <th>No HP</th>
                            <th>Bergabung</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kaders as $kader)
                            <tr>
                                <td class="fw-semibold">{{ $kader->nama }}</td>
                                <td>{{ $kader->klinik->nama ?? '-' }}</td>
                                <td>{{ $kader->hp }}</td>
                                <td>{{ optional($kader->tgl_bergabung)->format('d M Y') ?? $kader->tgl_bergabung }}</td>
                                <td>
                                    @if ($kader->status === 'aktif')
                                        <span class="badge rounded-pill badge-soft-success">Aktif</span>
                                    @else
                                        <span class="badge rounded-pill badge-soft-warning">Verifikasi</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        @if ($kader->status !== 'aktif')
                                            <form method="POST" action="{{ route('kader.verifikasi', $kader) }}">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-primary" type="submit">Verifikasi</button>
                                            </form>
                                        @endif

                                        <a href="{{ route('kader.edit', $kader) }}" class="btn btn-sm btn-outline-secondary">Edit</a>

                                        <form method="POST" action="{{ route('kader.destroy', $kader) }}" class="form-delete d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">Belum ada kader.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
