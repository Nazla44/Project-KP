@extends('layouts.admin')

@section('title', isset($kegiatan) ? 'Edit Jadwal Sosialisasi' : 'Tambah Jadwal Sosialisasi')

@section('content')
    <div class="admin-page-header">
        <div>
            <p class="admin-page-label">Jadwal Sosialisasi</p>

            <h1 class="admin-page-title">
                {{ isset($kegiatan) ? 'Edit Jadwal Sosialisasi' : 'Tambah Jadwal Sosialisasi' }}
            </h1>

            <p class="admin-page-desc">
                Atur informasi kegiatan, pilih kader yang bertugas, dan siapkan materi edukasi TBC.
            </p>
        </div>

        <a href="{{ route('admin.kegiatan-sosial.index') }}" class="admin-secondary-button">
            <i class="bi bi-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <form
        action="{{ isset($kegiatan) ? route('admin.kegiatan-sosial.update', $kegiatan) : route('admin.kegiatan-sosial.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="admin-form-stack js-confirm-submit"
        data-title="{{ isset($kegiatan) ? 'Update jadwal sosialisasi?' : 'Tambah jadwal sosialisasi?' }}"
        data-text="{{ isset($kegiatan) ? 'Perubahan jadwal sosialisasi akan disimpan.' : 'Jadwal sosialisasi baru akan ditambahkan.' }}"
        data-confirm="{{ isset($kegiatan) ? 'Ya, update' : 'Ya, tambah' }}"
    >
        @csrf

        @if(isset($kegiatan))
            @method('PUT')
        @endif

        <div class="admin-form-card">
            <div class="admin-form-card-head">
                <div>
                    <h2>Informasi Jadwal Sosialisasi</h2>
                    <p>Lengkapi data utama kegiatan sosialisasi TBC.</p>
                </div>
            </div>

            <div class="admin-form-card-body">
                <div class="admin-form-group">
                    <label class="admin-form-label">
                        Judul Kegiatan <span>*</span>
                    </label>

                    <input
                        type="text"
                        name="judul"
                        value="{{ old('judul', $kegiatan->judul ?? '') }}"
                        class="admin-form-control @error('judul') is-invalid @enderror"
                        placeholder="Contoh: Sosialisasi TBC Kelurahan Tembalang"
                    >

                    @error('judul')
                        <div class="admin-form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="admin-form-grid three">
                    <div class="admin-form-group">
                        <label class="admin-form-label">
                            Tanggal <span>*</span>
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            value="{{ old('tanggal', isset($kegiatan) && $kegiatan->tanggal ? $kegiatan->tanggal->format('Y-m-d') : '') }}"
                            class="admin-form-control @error('tanggal') is-invalid @enderror"
                        >

                        @error('tanggal')
                            <div class="admin-form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-form-label">Jam Mulai</label>

                        <input
                            type="time"
                            name="jam_mulai"
                            value="{{ old('jam_mulai', isset($kegiatan) && $kegiatan->jam_mulai ? substr($kegiatan->jam_mulai, 0, 5) : '') }}"
                            class="admin-form-control @error('jam_mulai') is-invalid @enderror"
                        >

                        @error('jam_mulai')
                            <div class="admin-form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-form-label">Jam Selesai</label>

                        <input
                            type="time"
                            name="jam_selesai"
                            value="{{ old('jam_selesai', isset($kegiatan) && $kegiatan->jam_selesai ? substr($kegiatan->jam_selesai, 0, 5) : '') }}"
                            class="admin-form-control @error('jam_selesai') is-invalid @enderror"
                        >

                        @error('jam_selesai')
                            <div class="admin-form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label">
                        Lokasi <span>*</span>
                    </label>

                    <input
                        type="text"
                        name="lokasi"
                        value="{{ old('lokasi', $kegiatan->lokasi ?? '') }}"
                        class="admin-form-control @error('lokasi') is-invalid @enderror"
                        placeholder="Nama tempat atau alamat lengkap kegiatan"
                    >

                    @error('lokasi')
                        <div class="admin-form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label">
                        Deskripsi Kegiatan <span>*</span>
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="5"
                        class="admin-form-control admin-form-textarea @error('deskripsi') is-invalid @enderror"
                        placeholder="Jelaskan tujuan dan gambaran kegiatan sosialisasi..."
                    >{{ old('deskripsi', $kegiatan->deskripsi ?? '') }}</textarea>

                    @error('deskripsi')
                        <div class="admin-form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="admin-form-grid two">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Banner / Thumbnail</label>

                        @if(isset($kegiatan) && $kegiatan->banner)
                            <div class="admin-current-image">
                                <img src="{{ $kegiatan->banner_url }}" alt="Banner kegiatan">
                                <small>Upload gambar baru untuk mengganti banner.</small>
                            </div>
                        @endif

                        <input
                            type="file"
                            name="banner"
                            accept="image/*"
                            class="admin-form-control @error('banner') is-invalid @enderror"
                        >

                        <div class="admin-form-help">
                            Format JPG, PNG, WEBP. Maksimal 2MB.
                        </div>

                        @error('banner')
                            <div class="admin-form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-form-label">
                            Status <span>*</span>
                        </label>

                        <select
                            name="status"
                            class="admin-form-control admin-form-select @error('status') is-invalid @enderror"
                        >
                            <option value="draft" @selected(old('status', $kegiatan->status ?? 'draft') === 'draft')>
                                Draft
                            </option>

                            <option value="published" @selected(old('status', $kegiatan->status ?? '') === 'published')>
                                Published
                            </option>

                            @if(isset($kegiatan))
                                <option value="ongoing" @selected(old('status', $kegiatan->status ?? '') === 'ongoing')>
                                    Berlangsung
                                </option>

                                <option value="completed" @selected(old('status', $kegiatan->status ?? '') === 'completed')>
                                    Selesai
                                </option>

                                <option value="cancelled" @selected(old('status', $kegiatan->status ?? '') === 'cancelled')>
                                    Dibatalkan
                                </option>
                            @endif
                        </select>

                        @error('status')
                            <div class="admin-form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-form-card">
            <div class="admin-form-card-head">
                <div>
                    <h2>Pilih Kader yang Bertugas</h2>
                    <p>Kader yang dipilih akan melihat jadwal ini pada dashboard kader.</p>
                </div>
            </div>

            <div class="admin-form-card-body">
                @if($kaders->isEmpty())
                    <div class="admin-empty-mini">
                        Belum ada kader aktif. Silakan verifikasi kader terlebih dahulu.
                    </div>
                @else
                    <div class="admin-kader-grid">
                        @foreach($kaders as $kader)
                            @php
                                $isSelected = in_array($kader->id, old('kader_ids', $selectedKaderIds ?? []));

                                $currentPeran = old(
                                    "peran_kader.{$kader->id}",
                                    isset($kegiatan)
                                        ? ($kegiatan->kaders->firstWhere('id', $kader->id)?->pivot->peran ?? 'pelaksana')
                                        : 'pelaksana'
                                );
                            @endphp

                            <label class="admin-kader-option {{ $isSelected ? 'selected' : '' }}">
                                <input
                                    type="checkbox"
                                    name="kader_ids[]"
                                    value="{{ $kader->id }}"
                                    @checked($isSelected)
                                    onchange="togglePeran(this, {{ $kader->id }})"
                                >

                                <div class="admin-kader-option-body">
                                    <div class="admin-kader-option-name">
                                        {{ $kader->nama }}
                                    </div>

                                    <div class="admin-kader-option-meta">
                                        {{ $kader->kab_kota ?: '-' }} · {{ $kader->kecamatan ?: '-' }}
                                    </div>

                                    <select
                                        name="peran_kader[{{ $kader->id }}]"
                                        id="peran_{{ $kader->id }}"
                                        class="admin-form-control admin-form-select admin-kader-role {{ !$isSelected ? 'is-disabled' : '' }}"
                                    >
                                        <option value="pelaksana" @selected($currentPeran === 'pelaksana')>
                                            Pelaksana
                                        </option>

                                        <option value="koordinator" @selected($currentPeran === 'koordinator')>
                                            Koordinator
                                        </option>

                                        <option value="pendamping" @selected($currentPeran === 'pendamping')>
                                            Pendamping
                                        </option>
                                    </select>
                                </div>
                            </label>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="admin-form-card">
            <div class="admin-form-card-head">
                <div>
                    <h2>Materi Edukasi TBC</h2>
                    <p>Tambahkan materi yang akan digunakan pada kegiatan sosialisasi.</p>
                </div>

                <button type="button" onclick="tambahMateri()" class="admin-outline-button">
                    <i class="bi bi-plus-lg"></i>
                    Tambah Materi
                </button>
            </div>

            <div class="admin-form-card-body">
                <div id="materi-list" class="admin-materi-list">
                    @php
                        $existingMateri = isset($kegiatan)
                            ? $kegiatan->materi
                            : collect($materiDefault ?? []);
                    @endphp

                    @foreach($existingMateri as $i => $m)
                        <div class="admin-materi-item">
                            <div class="admin-materi-fields">
                                <input
                                    type="text"
                                    name="materi[{{ $i }}][judul]"
                                    value="{{ old("materi.{$i}.judul", is_array($m) ? $m['judul'] : $m->judul) }}"
                                    class="admin-form-control"
                                    placeholder="Judul materi"
                                >

                                <textarea
                                    name="materi[{{ $i }}][konten]"
                                    rows="2"
                                    class="admin-form-control admin-form-textarea small"
                                    placeholder="Isi materi atau catatan singkat"
                                >{{ old("materi.{$i}.konten", is_array($m) ? ($m['konten'] ?? '') : $m->konten) }}</textarea>

                                <input type="hidden" name="materi[{{ $i }}][urutan]" value="{{ $i + 1 }}">
                            </div>

                            <button
                                type="button"
                                onclick="this.closest('.admin-materi-item').remove()"
                                class="admin-materi-remove"
                                title="Hapus materi"
                            >
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="admin-primary-button">
                <i class="bi bi-save"></i>
                <span>{{ isset($kegiatan) ? 'Simpan Perubahan' : 'Buat Jadwal' }}</span>
            </button>

            <a href="{{ route('admin.kegiatan-sosial.index') }}" class="admin-secondary-button">
                Batal
            </a>
        </div>
    </form>

    @push('scripts')
        <script>
            let materiIndex = {{ count($existingMateri ?? []) }};

            function tambahMateri() {
                const html = `
                    <div class="admin-materi-item">
                        <div class="admin-materi-fields">
                            <input
                                type="text"
                                name="materi[${materiIndex}][judul]"
                                class="admin-form-control"
                                placeholder="Judul materi"
                            >

                            <textarea
                                name="materi[${materiIndex}][konten]"
                                rows="2"
                                class="admin-form-control admin-form-textarea small"
                                placeholder="Isi materi atau catatan singkat"
                            ></textarea>

                            <input type="hidden" name="materi[${materiIndex}][urutan]" value="${materiIndex + 1}">
                        </div>

                        <button
                            type="button"
                            onclick="this.closest('.admin-materi-item').remove()"
                            class="admin-materi-remove"
                            title="Hapus materi"
                        >
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                `;

                document.getElementById('materi-list').insertAdjacentHTML('beforeend', html);
                materiIndex++;
            }

            function togglePeran(checkbox, kaderId) {
                const select = document.getElementById('peran_' + kaderId);
                const label = checkbox.closest('.admin-kader-option');

                if (!select || !label) return;

                if (checkbox.checked) {
                    select.classList.remove('is-disabled');
                    label.classList.add('selected');
                } else {
                    select.classList.add('is-disabled');
                    label.classList.remove('selected');
                }
            }
        </script>
    @endpush
@endsection