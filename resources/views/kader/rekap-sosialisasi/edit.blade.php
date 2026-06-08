@extends('layouts.kader')

@section('title', 'Isi Rekap Sosialisasi')

@section('page_title', 'Rekap Sosialisasi')

@section('content')
    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Report A</p>
            <h1>Isi Rekap Sosialisasi</h1>
            <p class="kader-page-desc">
                Lengkapi data hasil sosialisasi dan dokumentasi kegiatan.
            </p>
        </div>

        <a href="{{ route('kader.rekap-sosialisasi.index') }}" class="kader-btn-light">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="kader-table-card">
        <div class="kader-table-head">
            <div>
                <h2>{{ $kegiatan->judul }}</h2>
                <p>
                    {{ optional($kegiatan->tanggal)->format('d M Y') ?? '-' }}
                    —
                    {{ $kegiatan->lokasi ?? '-' }}
                </p>
            </div>

            <span class="kader-status-badge">
                {{ $kegiatan->status_label ?? ucfirst($kegiatan->status) }}
            </span>
        </div>

        <form method="POST" action="{{ route('kader.rekap-sosialisasi.update', $kegiatan) }}" enctype="multipart/form-data"
            class="rekap-form">
            @csrf
            @method('PUT')

            <div class="rekap-form-grid">
                <div class="rekap-form-main">
                    <div class="kader-card p-4 mb-3">
                        <h3 class="rekap-section-title">Data Rekap Sosialisasi</h3>

                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label class="rekap-label">
                                    Jumlah Peserta <span>*</span>
                                </label>

                                <input type="number" name="jumlah_peserta"
                                    class="rekap-input @error('jumlah_peserta') is-invalid @enderror"
                                    value="{{ old('jumlah_peserta', $ringkasan?->jumlah_peserta ?? 0) }}" min="0">

                                @error('jumlah_peserta')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="rekap-label">
                                    Jumlah Materi
                                </label>

                                <input type="number" name="jumlah_materi"
                                    class="rekap-input @error('jumlah_materi') is-invalid @enderror"
                                    value="{{ old('jumlah_materi', $ringkasan?->jumlah_materi ?? 0) }}" min="0">

                                @error('jumlah_materi')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="rekap-label">
                                Catatan Kegiatan
                            </label>

                            <textarea name="catatan_internal" rows="6" class="rekap-textarea @error('catatan_internal') is-invalid @enderror"
                                placeholder="Tuliskan ringkasan kegiatan, kendala, respons peserta, dan catatan penting lainnya.">{{ old('catatan_internal', $ringkasan?->catatan_internal) }}</textarea>

                            @error('catatan_internal')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="kader-card p-4">
                        <h3 class="rekap-section-title">Upload Dokumentasi</h3>

                        <p class="rekap-help">
                            Unggah foto kegiatan. Format JPG, PNG, atau WEBP. Maksimal 2 MB per foto.
                        </p>

                        <div class="rekap-upload-list">
                            @for ($i = 0; $i < 3; $i++)
                                <div class="rekap-upload-item">
                                    <label class="rekap-label">
                                        Foto {{ $i + 1 }}
                                    </label>

                                    <input type="file" name="foto[]" class="form-control"
                                        accept="image/png,image/jpeg,image/webp">

                                    <input type="text" name="caption[]" class="rekap-input mt-2"
                                        placeholder="Caption foto">
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <aside class="rekap-form-side">
                    <div class="kader-card p-4">
                        <h3 class="rekap-section-title">Ringkasan</h3>

                        <div class="rekap-summary-list">
                            <div>
                                <span>Jumlah Kader Bertugas</span>
                                <strong>{{ $kegiatan->kaders->count() }}</strong>
                            </div>

                            <div>
                                <span>Jumlah Foto</span>
                                <strong>{{ $kegiatan->dokumentasi->count() }}</strong>
                            </div>

                            <div>
                                <span>Status Rekap</span>
                                <strong>{{ $ringkasan ? 'Sudah diisi' : 'Belum diisi' }}</strong>
                            </div>
                        </div>

                        <button type="submit" class="kader-btn-red w-100 mt-4">
                            <i class="bi bi-save"></i>
                            Simpan Rekap
                        </button>
                    </div>

                    @if ($kegiatan->dokumentasi->count())
                        <div class="kader-card p-4 mt-3">
                            <h3 class="rekap-section-title">Dokumentasi Tersimpan</h3>

                            <div class="rekap-photo-grid">
                                @foreach ($kegiatan->dokumentasi as $foto)
                                    <a href="{{ $foto->url }}" target="_blank">
                                        <img src="{{ $foto->url }}" alt="{{ $foto->caption ?? 'Dokumentasi' }}">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </aside>
            </div>
        </form>
    </div>
@endsection
