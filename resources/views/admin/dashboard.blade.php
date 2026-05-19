@extends('admin.layouts.master')

@section('title', 'Dashboard Admin - STPI')
@section('page_title', 'Dashboard Admin')
@section('page_subtitle', 'Ringkasan data klinik, artikel, dan kader website STPI.')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-lg-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center p-4">
                    <div>
                        <p class="text-muted mb-1">Total Kader</p>
                        <h2 class="fw-bold mb-0">{{ $totalKader ?? 0 }}</h2>
                    </div>
                    <div class="stat-icon bg-soft-green"><i class="bi bi-people-fill"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center p-4">
                    <div>
                        <p class="text-muted mb-1">Total Klinik</p>
                        <h2 class="fw-bold mb-0">{{ $totalKlinik ?? 0 }}</h2>
                    </div>
                    <div class="stat-icon bg-soft-blue"><i class="bi bi-hospital-fill"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center p-4">
                    <div>
                        <p class="text-muted mb-1">Artikel Tayang</p>
                        <h2 class="fw-bold mb-0">{{ $totalArtikel ?? 0 }}</h2>
                    </div>
                    <div class="stat-icon bg-soft-red"><i class="bi bi-newspaper"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6">
            <div class="card stat-card">
                <div class="card-body d-flex justify-content-between align-items-center p-4">
                    <div>
                        <p class="text-muted mb-1">Total Laporan</p>
                        <h2 class="fw-bold mb-0">{{ $totalLaporan ?? 0 }}</h2>
                    </div>
                    <div class="stat-icon bg-soft-blue">
                        <i class="bi bi-file-earmark-text-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card content-card">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-2">Selamat Datang, {{ auth('admin')->user()->name ?? 'Admin' }}</h5>
                    <p class="text-muted mb-4">
                        Gunakan panel ini untuk mengelola data yang tampil pada website STPI.
                    </p>

                    <hr class="my-4">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('artikel.index') }}" class="btn btn-outline-danger">
                            <i class="bi bi-newspaper me-1"></i> Kelola Artikel
                        </a>
                        <a href="{{ route('klinik.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-hospital-fill me-1"></i> Kelola Klinik
                        </a>
                        <a href="{{ route('kader.index') }}" class="btn btn-outline-success">
                            <i class="bi bi-people-fill me-1"></i> Kelola Kader
                        </a>
                        <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-file-earmark-text-fill me-1"></i> Kelola Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card content-card">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Notifikasi Sistem</h5>

                    <div class="d-flex gap-3 mb-3">
                        <div class="stat-icon bg-soft-red" style="width:42px;height:42px;font-size:18px;">
                            <i class="bi bi-person-check-fill"></i>
                        </div>
                        <div>
                            <p class="mb-0 fw-semibold">Login berhasil</p>
                            <small class="text-muted">Anda sedang masuk sebagai admin.</small>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <div class="stat-icon bg-soft-blue" style="width:42px;height:42px;font-size:18px;">
                            <i class="bi bi-globe2"></i>
                        </div>
                        <div>
                            <p class="mb-0 fw-semibold">Website tersambung</p>
                            <small class="text-muted">Data aktif akan tampil di halaman publik.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
