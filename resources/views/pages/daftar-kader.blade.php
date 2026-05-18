@extends('layouts.guest')

@section('title', 'Daftar Jadi Kader – Stop TB Partnership Indonesia')

@push('styles')
    <link href="{{ asset('css/form-kader.css') }}" rel="stylesheet">
@endpush

@section('content')

{{-- ── HERO ─────────────────────────────────────────────────────────────── --}}
<section class="fk-hero">
    <div class="fk-hero-overlay"></div>
    <div class="container-xl px-4 px-lg-5 position-relative" style="z-index:2;">
        <nav class="ad-breadcrumb mb-4">
            <a href="{{ route('home') }}">Home</a>
            <i class="bi bi-chevron-right mx-2"></i>
            <a href="{{ route('program-komunitas') }}">Program Komunitas</a>
            <i class="bi bi-chevron-right mx-2"></i>
            <span>Daftar Jadi Kader</span>
        </nav>
        <span class="section-tag-pill mb-4 d-inline-block">Pendaftaran Kader</span>
        <h1 class="fk-hero-title">
            Bergabung Sebagai<br>
            <span class="fk-hero-accent">Kader Komunitas TBC</span>
        </h1>
        <p class="fk-hero-desc">
            Isi formulir di bawah untuk mendaftar sebagai kader komunitas TBC.
            Tim kami akan menghubungi Anda dalam 3–5 hari kerja setelah pendaftaran diterima.
        </p>

        {{-- 3 Info Pill --}}
        <div class="fk-info-pills">
            <div class="fk-info-pill">
                <i class="bi bi-clock me-2"></i>Proses 3–5 hari kerja
            </div>
            <div class="fk-info-pill">
                <i class="bi bi-shield-check me-2"></i>Data aman & terjaga
            </div>
            <div class="fk-info-pill">
                <i class="bi bi-mortarboard me-2"></i>Pelatihan disediakan
            </div>
        </div>
    </div>
</section>

{{-- ── FORM AREA ────────────────────────────────────────────────────────── --}}
<section class="fk-body py-5">
    <div class="container-xl px-4 px-lg-5">
        <div class="row g-5 justify-content-center">

            {{-- ── KOLOM FORM (kiri) ──────────────────────────────────── --}}
            <div class="col-12 col-lg-8">
                <form action="{{ route('kader.submit') }}" method="POST" class="fk-form" novalidate>
                    @csrf

                    {{-- Error Global --}}
                    @if ($errors->any())
                        <div class="fk-alert-error mb-4">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            Mohon periksa kembali isian Anda. Ada <strong>{{ $errors->count() }}</strong> field yang perlu diperbaiki.
                        </div>
                    @endif

                    {{-- ═══════════════ BAGIAN 1: DATA DIRI ═══════════════ --}}
                    <div class="fk-section-card mb-4">
                        <div class="fk-section-header">
                            <span class="fk-section-num">01</span>
                            <div>
                                <h2 class="fk-section-title">Data Diri</h2>
                                <p class="fk-section-subtitle">Informasi pribadi pendaftar</p>
                            </div>
                        </div>

                        <div class="fk-fields">

                            {{-- Nama Lengkap --}}
                            <div class="fk-field-group">
                                <label class="fk-label" for="nama_lengkap">
                                    Nama Lengkap <span class="fk-required">*</span>
                                </label>
                                <input type="text"
                                       id="nama_lengkap"
                                       name="nama_lengkap"
                                       class="fk-input @error('nama_lengkap') is-invalid @enderror"
                                       value="{{ old('nama_lengkap') }}"
                                       placeholder="Sesuai KTP"
                                       autocomplete="name">
                                @error('nama_lengkap')
                                    <span class="fk-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- NIK --}}
                            <div class="fk-field-group">
                                <label class="fk-label" for="nik">
                                    NIK (Nomor Induk Kependudukan) <span class="fk-required">*</span>
                                </label>
                                <input type="text"
                                       id="nik"
                                       name="nik"
                                       class="fk-input @error('nik') is-invalid @enderror"
                                       value="{{ old('nik') }}"
                                       placeholder="16 digit angka sesuai KTP"
                                       maxlength="16"
                                       inputmode="numeric">
                                @error('nik')
                                    <span class="fk-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Tempat & Tanggal Lahir --}}
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="fk-field-group">
                                        <label class="fk-label" for="tempat_lahir">
                                            Tempat Lahir <span class="fk-required">*</span>
                                        </label>
                                        <input type="text"
                                               id="tempat_lahir"
                                               name="tempat_lahir"
                                               class="fk-input @error('tempat_lahir') is-invalid @enderror"
                                               value="{{ old('tempat_lahir') }}"
                                               placeholder="Kota/Kabupaten">
                                        @error('tempat_lahir')
                                            <span class="fk-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="fk-field-group">
                                        <label class="fk-label" for="tanggal_lahir">
                                            Tanggal Lahir <span class="fk-required">*</span>
                                        </label>
                                        <input type="date"
                                               id="tanggal_lahir"
                                               name="tanggal_lahir"
                                               class="fk-input @error('tanggal_lahir') is-invalid @enderror"
                                               value="{{ old('tanggal_lahir') }}"
                                               max="{{ date('Y-m-d') }}">
                                        @error('tanggal_lahir')
                                            <span class="fk-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="fk-field-group">
                                <label class="fk-label">
                                    Jenis Kelamin <span class="fk-required">*</span>
                                </label>
                                <div class="fk-radio-group">
                                    <label class="fk-radio-card {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}">
                                        <input type="radio" name="jenis_kelamin" value="L"
                                               {{ old('jenis_kelamin') === 'L' ? 'checked' : '' }}>
                                        <i class="bi bi-gender-male me-2"></i> Laki-laki
                                    </label>
                                    <label class="fk-radio-card {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}">
                                        <input type="radio" name="jenis_kelamin" value="P"
                                               {{ old('jenis_kelamin') === 'P' ? 'checked' : '' }}>
                                        <i class="bi bi-gender-female me-2"></i> Perempuan
                                    </label>
                                </div>
                                @error('jenis_kelamin')
                                    <span class="fk-error">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- ═══════════════ BAGIAN 2: KONTAK ═════════════════ --}}
                    <div class="fk-section-card mb-4">
                        <div class="fk-section-header">
                            <span class="fk-section-num">02</span>
                            <div>
                                <h2 class="fk-section-title">Kontak & Domisili</h2>
                                <p class="fk-section-subtitle">Kami akan menghubungi Anda melalui nomor atau email ini</p>
                            </div>
                        </div>

                        <div class="fk-fields">

                            {{-- No HP --}}
                            <div class="fk-field-group">
                                <label class="fk-label" for="no_hp">
                                    Nomor HP / WhatsApp <span class="fk-required">*</span>
                                </label>
                                <div class="fk-input-prefix-wrap">
                                    <span class="fk-input-prefix">+62</span>
                                    <input type="tel"
                                           id="no_hp"
                                           name="no_hp"
                                           class="fk-input fk-input-prefixed @error('no_hp') is-invalid @enderror"
                                           value="{{ old('no_hp') }}"
                                           placeholder="81234567890"
                                           inputmode="numeric">
                                </div>
                                @error('no_hp')
                                    <span class="fk-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="fk-field-group">
                                <label class="fk-label" for="email">
                                    Email <span class="fk-required">*</span>
                                </label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       class="fk-input @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       placeholder="nama@email.com"
                                       autocomplete="email">
                                @error('email')
                                    <span class="fk-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Alamat --}}
                            <div class="fk-field-group">
                                <label class="fk-label" for="alamat">
                                    Alamat Lengkap <span class="fk-required">*</span>
                                </label>
                                <textarea id="alamat"
                                          name="alamat"
                                          rows="3"
                                          class="fk-input fk-textarea @error('alamat') is-invalid @enderror"
                                          placeholder="Nama jalan, nomor rumah, RT/RW">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <span class="fk-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Provinsi & Kab/Kota --}}
                            <div class="row g-3">
                                <div class="col-12 col-md-4">
                                    <div class="fk-field-group">
                                        <label class="fk-label" for="provinsi">
                                            Provinsi <span class="fk-required">*</span>
                                        </label>
                                        <input type="text"
                                               id="provinsi"
                                               name="provinsi"
                                               class="fk-input @error('provinsi') is-invalid @enderror"
                                               value="{{ old('provinsi') }}"
                                               placeholder="Provinsi">
                                        @error('provinsi')
                                            <span class="fk-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="fk-field-group">
                                        <label class="fk-label" for="kab_kota">
                                            Kab / Kota <span class="fk-required">*</span>
                                        </label>
                                        <input type="text"
                                               id="kab_kota"
                                               name="kab_kota"
                                               class="fk-input @error('kab_kota') is-invalid @enderror"
                                               value="{{ old('kab_kota') }}"
                                               placeholder="Kab / Kota">
                                        @error('kab_kota')
                                            <span class="fk-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="fk-field-group">
                                        <label class="fk-label" for="kecamatan">
                                            Kecamatan <span class="fk-required">*</span>
                                        </label>
                                        <input type="text"
                                               id="kecamatan"
                                               name="kecamatan"
                                               class="fk-input @error('kecamatan') is-invalid @enderror"
                                               value="{{ old('kecamatan') }}"
                                               placeholder="Kecamatan">
                                        @error('kecamatan')
                                            <span class="fk-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- ═══════════════ BAGIAN 3: LATAR BELAKANG ══════════ --}}
                    <div class="fk-section-card mb-4">
                        <div class="fk-section-header">
                            <span class="fk-section-num">03</span>
                            <div>
                                <h2 class="fk-section-title">Latar Belakang</h2>
                                <p class="fk-section-subtitle">Bantu kami mengenal Anda lebih baik</p>
                            </div>
                        </div>

                        <div class="fk-fields">

                            {{-- Pekerjaan --}}
                            <div class="fk-field-group">
                                <label class="fk-label" for="pekerjaan">
                                    Pekerjaan Saat Ini <span class="fk-required">*</span>
                                </label>
                                <input type="text"
                                       id="pekerjaan"
                                       name="pekerjaan"
                                       class="fk-input @error('pekerjaan') is-invalid @enderror"
                                       value="{{ old('pekerjaan') }}"
                                       placeholder="Contoh: Ibu Rumah Tangga, Guru, Wiraswasta">
                                @error('pekerjaan')
                                    <span class="fk-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Pendidikan --}}
                            <div class="fk-field-group">
                                <label class="fk-label" for="pendidikan">
                                    Pendidikan Terakhir <span class="fk-required">*</span>
                                </label>
                                <select id="pendidikan"
                                        name="pendidikan"
                                        class="fk-input fk-select @error('pendidikan') is-invalid @enderror">
                                    <option value="" disabled {{ old('pendidikan') ? '' : 'selected' }}>Pilih pendidikan terakhir</option>
                                    @foreach(['SD' => 'SD / Sederajat', 'SMP' => 'SMP / Sederajat', 'SMA' => 'SMA / SMK / Sederajat', 'D3' => 'Diploma (D1–D3)', 'S1' => 'Sarjana (S1)', 'S2' => 'Magister (S2)', 'S3' => 'Doktor (S3)'] as $val => $label)
                                        <option value="{{ $val }}" {{ old('pendidikan') === $val ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('pendidikan')
                                    <span class="fk-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Pengalaman TBC --}}
                            <div class="fk-field-group">
                                <label class="fk-label">
                                    Hubungan dengan TBC <span class="fk-required">*</span>
                                </label>
                                <p class="fk-field-hint">Pilih yang paling sesuai dengan kondisi Anda</p>
                                <div class="fk-radio-list">
                                    @foreach([
                                        'penyintas'  => ['icon' => 'bi-heart-pulse-fill', 'label' => 'Penyintas TBC', 'desc' => 'Saya pernah menderita TBC dan sudah sembuh'],
                                        'keluarga'   => ['icon' => 'bi-people-fill',      'label' => 'Keluarga Pasien TBC', 'desc' => 'Anggota keluarga saya pernah/sedang menderita TBC'],
                                        'relawan'    => ['icon' => 'bi-hand-thumbs-up-fill','label' => 'Relawan Kesehatan', 'desc' => 'Saya aktif di kegiatan sosial/kesehatan komunitas'],
                                        'belum'      => ['icon' => 'bi-person-plus-fill', 'label' => 'Belum ada pengalaman langsung', 'desc' => 'Saya ingin berkontribusi meski belum punya pengalaman TBC'],
                                    ] as $val => $opt)
                                        <label class="fk-radio-list-item {{ old('pengalaman_tb') === $val ? 'selected' : '' }}">
                                            <input type="radio" name="pengalaman_tb" value="{{ $val }}"
                                                   {{ old('pengalaman_tb') === $val ? 'checked' : '' }}>
                                            <div class="fk-radio-list-icon">
                                                <i class="bi {{ $opt['icon'] }}"></i>
                                            </div>
                                            <div>
                                                <div class="fk-radio-list-label">{{ $opt['label'] }}</div>
                                                <div class="fk-radio-list-desc">{{ $opt['desc'] }}</div>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                @error('pengalaman_tb')
                                    <span class="fk-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Ketersediaan Waktu --}}
                            <div class="fk-field-group">
                                <label class="fk-label">
                                    Ketersediaan Waktu <span class="fk-required">*</span>
                                </label>
                                <div class="fk-radio-group">
                                    @foreach([
                                        'penuh'       => 'Penuh Waktu',
                                        'paruh'       => 'Paruh Waktu',
                                        'akhir_pekan' => 'Akhir Pekan Saja',
                                    ] as $val => $label)
                                        <label class="fk-radio-card {{ old('ketersediaan') === $val ? 'selected' : '' }}">
                                            <input type="radio" name="ketersediaan" value="{{ $val }}"
                                                   {{ old('ketersediaan') === $val ? 'checked' : '' }}>
                                            {{ $label }}
                                        </label>
                                    @endforeach
                                </div>
                                @error('ketersediaan')
                                    <span class="fk-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Motivasi --}}
                            <div class="fk-field-group">
                                <label class="fk-label" for="motivasi">
                                    Motivasi Bergabung <span class="fk-required">*</span>
                                </label>
                                <textarea id="motivasi"
                                          name="motivasi"
                                          rows="5"
                                          class="fk-input fk-textarea @error('motivasi') is-invalid @enderror"
                                          placeholder="Ceritakan mengapa Anda ingin menjadi kader komunitas TBC (min. 50 karakter)...">{{ old('motivasi') }}</textarea>
                                <div class="fk-char-counter">
                                    <span id="motivasi-count">0</span> / 1000 karakter
                                </div>
                                @error('motivasi')
                                    <span class="fk-error">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- ═══════════════ PERSETUJUAN & SUBMIT ═════════════ --}}
                    <div class="fk-section-card mb-4">
                        <div class="fk-fields">

                            <div class="fk-checkbox-wrap @error('setuju') is-invalid @enderror">
                                <input type="checkbox"
                                       id="setuju"
                                       name="setuju"
                                       value="1"
                                       class="fk-checkbox"
                                       {{ old('setuju') ? 'checked' : '' }}>
                                <label for="setuju" class="fk-checkbox-label">
                                    Saya menyetujui bahwa data yang saya isi adalah benar, dan bersedia dihubungi oleh tim Stop TB Partnership Indonesia untuk proses seleksi dan pelatihan kader.
                                </label>
                            </div>
                            @error('setuju')
                                <span class="fk-error d-block mt-2">{{ $message }}</span>
                            @enderror

                            <button type="submit" class="fk-submit-btn mt-4">
                                <i class="bi bi-send-fill me-2"></i>
                                Kirim Pendaftaran
                                <span class="fk-submit-arrow"><i class="bi bi-arrow-up-right"></i></span>
                            </button>

                        </div>
                    </div>

                </form>
            </div>

            {{-- ── KOLOM INFO SIDEBAR (kanan) ─────────────────────────── --}}
            <div class="col-12 col-lg-4">
                <div class="fk-sidebar">

                    {{-- Syarat Kader --}}
                    <div class="fk-sidebar-block mb-4">
                        <h3 class="fk-sidebar-title">
                            <i class="bi bi-clipboard-check me-2"></i>Syarat Kader
                        </h3>
                        <ul class="fk-sidebar-list">
                            <li>Warga Negara Indonesia, usia 18–55 tahun</li>
                            <li>Berdomisili di wilayah program aktif STPI</li>
                            <li>Sehat jasmani dan rohani</li>
                            <li>Bersedia mengikuti pelatihan kader (online/offline)</li>
                            <li>Memiliki waktu minimal 10 jam/minggu untuk kegiatan</li>
                            <li>Diutamakan penyintas TBC atau keluarga pasien TBC</li>
                        </ul>
                    </div>

                    {{-- Apa yang Didapat --}}
                    <div class="fk-sidebar-block mb-4">
                        <h3 class="fk-sidebar-title">
                            <i class="bi bi-gift me-2"></i>Yang Anda Dapatkan
                        </h3>
                        <div class="fk-benefit-list">
                            @foreach([
                                ['icon' => 'bi-mortarboard-fill',    'text' => 'Pelatihan kader bersertifikat'],
                                ['icon' => 'bi-currency-dollar',     'text' => 'Insentif bulanan dari program'],
                                ['icon' => 'bi-people-fill',         'text' => 'Jejaring relawan TBC nasional'],
                                ['icon' => 'bi-bag-heart-fill',      'text' => 'Perlengkapan kader (APD, ATK)'],
                                ['icon' => 'bi-graph-up-arrow',      'text' => 'Pengembangan kapasitas rutin'],
                            ] as $b)
                                <div class="fk-benefit-item">
                                    <div class="fk-benefit-icon">
                                        <i class="bi {{ $b['icon'] }}"></i>
                                    </div>
                                    <span>{{ $b['text'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Butuh Bantuan --}}
                    <div class="fk-sidebar-help">
                        <i class="bi bi-question-circle-fill fk-help-icon"></i>
                        <h4 class="fk-help-title">Ada Pertanyaan?</h4>
                        <p class="fk-help-desc">
                            Hubungi tim kami jika mengalami kesulitan dalam pengisian formulir.
                        </p>
                        <a href="https://wa.me/6281234567890" target="_blank" class="fk-help-wa">
                            <i class="bi bi-whatsapp me-2"></i>Chat via WhatsApp
                        </a>
                        <a href="mailto:komunitas@stoptbindonesia.org" class="fk-help-email">
                            <i class="bi bi-envelope me-2"></i>komunitas@stoptbindonesia.org
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // ── Radio card interaktif ────────────────────────────────────────────────
    document.querySelectorAll('.fk-radio-card input, .fk-radio-list-item input').forEach(radio => {
        radio.addEventListener('change', function () {
            const group = this.closest('.fk-radio-group, .fk-radio-list');
            if (group) {
                group.querySelectorAll('.fk-radio-card, .fk-radio-list-item').forEach(el => el.classList.remove('selected'));
            }
            this.closest('.fk-radio-card, .fk-radio-list-item')?.classList.add('selected');
        });
    });

    // ── Counter karakter motivasi ────────────────────────────────────────────
    const motivasi = document.getElementById('motivasi');
    const counter  = document.getElementById('motivasi-count');
    if (motivasi && counter) {
        const update = () => {
            const len = motivasi.value.length;
            counter.textContent = len;
            counter.style.color = len > 900 ? 'var(--color-primary)' : '';
        };
        motivasi.addEventListener('input', update);
        update();
    }

    // ── NIK: hanya angka ─────────────────────────────────────────────────────
    document.getElementById('nik')?.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').slice(0, 16);
    });
</script>
@endpush
