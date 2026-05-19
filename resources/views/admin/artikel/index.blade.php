@extends('admin.layouts.master')

@section('title', 'Manajemen Artikel - STPI')
@section('page_title', 'Manajemen Artikel')
@section('page_subtitle', 'Tambah, edit, publish, dan hapus artikel website.')

@section('content')
    <div class="card card-soft">
        <div class="card-body p-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h5 class="fw-bold mb-1">Daftar Artikel</h5>
                    <p class="text-muted mb-0">Total {{ $artikel->count() }} artikel.</p>
                </div>
                <a href="{{ route('artikel.create') }}" class="btn btn-danger">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Artikel
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($artikel as $item)
                            <tr>
                                <td class="fw-semibold">{{ $item->judul }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->penulis }}</td>
                                <td>{{ optional($item->tanggal)->format('d M Y') ?? $item->tanggal }}</td>
                                <td>
                                    @if ($item->status === 'tayang')
                                        <span class="badge rounded-pill badge-soft-success">Tayang</span>
                                    @else
                                        <span class="badge rounded-pill badge-soft-warning">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end gap-2">
                                        @if ($item->status !== 'tayang')
                                            <form method="POST" action="{{ route('artikel.publish', $item) }}">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-primary" type="submit">Publish</button>
                                            </form>
                                        @endif

                                        <a href="{{ route('artikel.edit', $item) }}" class="btn btn-sm btn-outline-secondary">Edit</a>

                                        <form method="POST" action="{{ route('artikel.destroy', $item) }}" class="form-delete d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">Belum ada artikel.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
