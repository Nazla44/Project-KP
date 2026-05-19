@extends('admin.layouts.master')

@section('title', 'Kelola Laporan - STPI Admin')
@section('page-title', 'Kelola Laporan')
@section('page-subtitle', 'Upload dan kelola dokumen laporan website')

@section('content')

<div class="card content-card">
    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="fw-bold mb-1">Daftar Laporan</h5>
                <p class="text-muted mb-0">Data laporan yang tampil di halaman akuntabilitas.</p>
            </div>

            <a href="{{ route('laporan.create') }}" class="btn btn-danger">
                <i class="bi bi-plus-circle me-1"></i>
                Tambah Laporan
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Laporan</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>File</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($laporans as $laporan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td class="fw-semibold">
                                {{ $laporan->nama }}
                            </td>

                            <td>
                                {{ $laporan->kategori }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}
                            </td>

                            <td>
                                <span class="badge {{ $laporan->status === 'tayang' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($laporan->status) }}
                                </span>
                            </td>

                            <td>
                                @php
                                    $fileUrl = str_starts_with($laporan->file, 'http') || $laporan->file === '#'
                                        ? $laporan->file
                                        : asset('storage/' . $laporan->file);
                                @endphp

                                @if ($laporan->file === '#')
                                    <button class="btn btn-sm btn-outline-secondary" disabled>
                                        File belum tersedia
                                    </button>
                                @else
                                    <a href="{{ $fileUrl }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        Lihat File
                                    </a>
                                @endif
                            </td>

                            <td class="text-end">
                                <a href="{{ route('laporan.edit', $laporan->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('laporan.destroy', $laporan->id) }}" method="POST" class="form-delete d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Belum ada laporan yang diupload.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection