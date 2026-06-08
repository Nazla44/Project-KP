@extends('layouts.kader')

@section('title', 'Screening Masyarakat')

@section('page_title', 'Screening Masyarakat')

@section('content')
    @php
        $screeningResult = session('screening_result');

        $riskRules = collect($rules ?? []);

        $fallbackRules = collect([
            'gejala_utama' => collect([
                (object) [
                    'code' => 'batuk_2_minggu',
                    'label' => 'Batuk terus-menerus',
                    'description' => 'Berlangsung 2 minggu atau lebih, tidak kunjung sembuh',
                    'score' => 3,
                ],
                (object) [
                    'code' => 'demam_berkepanjangan',
                    'label' => 'Demam berkepanjangan',
                    'description' => 'Lebih dari 2 minggu tanpa penyebab jelas',
                    'score' => 2,
                ],
                (object) [
                    'code' => 'keringat_malam',
                    'label' => 'Keringat malam berlebih',
                    'description' => 'Terjadi tanpa aktivitas fisik berat sebelumnya',
                    'score' => 2,
                ],
                (object) [
                    'code' => 'berat_badan_turun',
                    'label' => 'Penurunan berat badan',
                    'description' => 'Berat badan turun signifikan tanpa program diet',
                    'score' => 2,
                ],
            ]),
            'faktor_risiko' => collect([
                (object) [
                    'code' => 'kontak_pasien_tbc',
                    'label' => 'Kontak serumah dengan pasien TBC',
                    'description' => 'Tinggal serumah atau kontak erat dengan pasien TBC aktif',
                    'score' => 3,
                ],
                (object) [
                    'code' => 'penyakit_penyerta',
                    'label' => 'Penyakit penyerta: DM atau HIV',
                    'description' => 'Memiliki riwayat diabetes melitus, HIV, atau kondisi imunitas rendah',
                    'score' => 2,
                ],
                (object) [
                    'code' => 'merokok_aktif',
                    'label' => 'Merokok aktif',
                    'description' => 'Masih merokok hingga saat ini',
                    'score' => 1,
                ],
                (object) [
                    'code' => 'lingkungan_padat',
                    'label' => 'Tinggal di lingkungan padat / kumuh',
                    'description' => 'Rumah berdesakan, ventilasi buruk, atau sanitasi terbatas',
                    'score' => 1,
                ],
            ]),
        ]);

        if ($riskRules->isEmpty()) {
            $riskRules = $fallbackRules;
        }

        $gejalaRules = collect($riskRules->get('gejala_utama', []));
        $faktorRules = collect($riskRules->get('faktor_risiko', $riskRules->get('faktor_pemberat', [])));
    @endphp

    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Screening</p>
            <h1>Form Screening Masyarakat</h1>
            <p class="kader-page-desc">
                Isi data warga, pilih gejala yang dialami, lalu sistem akan menghitung estimasi risiko TBC secara otomatis.
            </p>
        </div>

        <a href="{{ route('kader.kegiatan.show', $kegiatan) }}" class="kader-btn-light">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    @if($screeningResult)
        @php
            $level = $screeningResult['level'] ?? 'rendah';
            $score = $screeningResult['score'] ?? 0;

            $resultClass = match ($level) {
                'tinggi' => 'high',
                'sedang' => 'medium',
                default => 'low',
            };
        @endphp

        <div class="screening-web-result {{ $resultClass }} mb-4">
            <div>
                <span>Hasil Screening Terakhir</span>
                <h2>Risiko {{ ucfirst($level) }}</h2>
                <p>
                    Skor total: <strong>{{ $score }} poin</strong>.
                    {{ $screeningResult['recommendation'] ?? 'Lakukan tindak lanjut sesuai hasil pemeriksaan.' }}
                </p>
            </div>

            <a href="{{ route('kader.screening.create', $kegiatan) }}" class="screening-web-result-btn">
                Screening Warga Berikutnya
            </a>
        </div>
    @endif

    <form
        method="POST"
        action="{{ route('kader.screening.store', $kegiatan) }}"
        class="screening-web-form js-confirm-submit"
        data-title="Simpan hasil screening?"
        data-text="Pastikan data warga dan gejala yang dipilih sudah benar."
        data-confirm="Ya, simpan"
    >
        @csrf

        <input type="hidden" name="consent_verbal" value="1">
        <input type="hidden" name="lokasi_alamat" value="{{ old('lokasi_alamat', $kegiatan->lokasi ?? '') }}">
        <input type="hidden" name="lokasi_lat" value="{{ old('lokasi_lat', $kegiatan->latitude ?? '') }}">
        <input type="hidden" name="lokasi_lng" value="{{ old('lokasi_lng', $kegiatan->longitude ?? '') }}">

        <div class="screening-web-grid">
            <div class="screening-web-main">

                <div class="screening-web-card">
                    <div class="screening-web-card-head">
                        <div>
                            <h2>Data Identitas Warga</h2>
                            <p>Data ini digunakan untuk pencatatan hasil screening pada kegiatan sosialisasi.</p>
                        </div>

                        <span class="screening-web-step">1</span>
                    </div>

                    <div class="screening-web-card-body">
                        <div class="screening-form-group">
                            <label>NIK <span>*</span></label>

                            <input
                                type="text"
                                name="nik"
                                id="nikInput"
                                value="{{ old('nik') }}"
                                maxlength="16"
                                placeholder="Masukkan 16 digit NIK"
                                required
                            >

                            <div class="screening-form-help">
                                <span>Gunakan NIK yang tertera pada KTP warga.</span>
                                <span id="nikCounter">0 / 16 digit</span>
                            </div>

                            @error('nik')
                                <div class="screening-form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="screening-form-grid two">
                            <div class="screening-form-group">
                                <label>Nama Lengkap <span>*</span></label>

                                <input
                                    type="text"
                                    name="nama_lengkap"
                                    value="{{ old('nama_lengkap') }}"
                                    placeholder="Nama lengkap warga"
                                    required
                                >

                                @error('nama_lengkap')
                                    <div class="screening-form-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="screening-form-group">
                                <label>No. Telepon <small>(Opsional)</small></label>

                                <input
                                    type="text"
                                    name="no_telepon"
                                    value="{{ old('no_telepon') }}"
                                    placeholder="08xxxxxxxxxx"
                                >

                                @error('no_telepon')
                                    <div class="screening-form-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="screening-form-group">
                            <label>Alamat <span>*</span></label>

                            <input
                                type="text"
                                name="alamat"
                                value="{{ old('alamat') }}"
                                placeholder="Alamat tempat tinggal warga"
                                required
                            >

                            @error('alamat')
                                <div class="screening-form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="screening-form-grid two">
                            <div class="screening-form-group">
                                <label>Tanggal Lahir <span>*</span></label>

                                <input
                                    type="date"
                                    name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir') }}"
                                    required
                                >

                                @error('tanggal_lahir')
                                    <div class="screening-form-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="screening-form-group">
                                <label>Jenis Kelamin <span>*</span></label>

                                <select name="jenis_kelamin" required>
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="L" @selected(old('jenis_kelamin') === 'L')>Laki-laki</option>
                                    <option value="P" @selected(old('jenis_kelamin') === 'P')>Perempuan</option>
                                </select>

                                @error('jenis_kelamin')
                                    <div class="screening-form-error">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="screening-web-card">
                    <div class="screening-web-card-head">
                        <div>
                            <h2>Gejala Utama TBC</h2>
                            <p>Centang gejala yang sedang dialami warga saat ini.</p>
                        </div>

                        <span class="screening-web-step">2</span>
                    </div>

                    <div class="screening-web-card-body">
                        <div class="screening-alert-info">
                            <i class="bi bi-info-circle-fill"></i>
                            <span>
                                Tanyakan satu per satu. Skor akan dihitung otomatis berdasarkan gejala dan faktor risiko yang dipilih.
                            </span>
                        </div>

                        <div class="screening-check-grid">
                            @foreach($gejalaRules as $rule)
                                <label class="screening-web-check">
                                    <input
                                        type="checkbox"
                                        name="answers[{{ $rule->code }}]"
                                        value="1"
                                        data-score="{{ $rule->score }}"
                                    >

                                    <span class="screening-web-check-box"></span>

                                    <span class="screening-web-check-text">
                                        <strong>{{ $rule->label }}</strong>
                                        <small>{{ $rule->description ?? 'Gejala utama TBC' }}</small>
                                    </span>

                                    <span class="screening-web-score danger">
                                        +{{ $rule->score }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="screening-web-card">
                    <div class="screening-web-card-head">
                        <div>
                            <h2>Faktor Risiko Tambahan</h2>
                            <p>Centang faktor pemberat yang sesuai dengan kondisi warga.</p>
                        </div>

                        <span class="screening-web-step">3</span>
                    </div>

                    <div class="screening-web-card-body">
                        <div class="screening-check-grid">
                            @foreach($faktorRules as $rule)
                                <label class="screening-web-check">
                                    <input
                                        type="checkbox"
                                        name="answers[{{ $rule->code }}]"
                                        value="1"
                                        data-score="{{ $rule->score }}"
                                    >

                                    <span class="screening-web-check-box"></span>

                                    <span class="screening-web-check-text">
                                        <strong>{{ $rule->label }}</strong>
                                        <small>{{ $rule->description ?? 'Faktor risiko tambahan' }}</small>
                                    </span>

                                    <span class="screening-web-score">
                                        +{{ $rule->score }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="screening-web-card">
                    <div class="screening-web-card-head">
                        <div>
                            <h2>Catatan Kader</h2>
                            <p>Opsional, isi bila ada kondisi tambahan yang perlu dicatat.</p>
                        </div>
                    </div>

                    <div class="screening-web-card-body">
                        <textarea
                            name="catatan_kader"
                            class="screening-web-textarea"
                            placeholder="Contoh: warga mengaku sudah batuk 3 minggu dan belum pernah memeriksakan diri ke faskes."
                        >{{ old('catatan_kader') }}</textarea>

                        @error('catatan_kader')
                            <div class="screening-form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <aside class="screening-web-side">
                <div class="screening-web-sticky">
                    <div class="screening-web-card">
                        <div class="screening-web-card-head">
                            <div>
                                <h2>Info Kegiatan</h2>
                                <p>Jadwal sosialisasi yang sedang digunakan.</p>
                            </div>
                        </div>

                        <div class="screening-info-list">
                            <div>
                                <span>Nama Kegiatan</span>
                                <strong>{{ $kegiatan->judul ?? '-' }}</strong>
                            </div>

                            <div>
                                <span>Tanggal</span>
                                <strong>{{ optional($kegiatan->tanggal)->format('d M Y') ?? '-' }}</strong>
                            </div>

                            <div>
                                <span>Lokasi</span>
                                <strong>{{ $kegiatan->lokasi ?? '-' }}</strong>
                            </div>

                            <div>
                                <span>Kader</span>
                                <strong>{{ auth()->user()->name }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="screening-web-card">
                        <div class="screening-web-card-head">
                            <div>
                                <h2>Kalkulasi Risiko</h2>
                                <p>Skor berubah otomatis saat gejala dipilih.</p>
                            </div>
                        </div>

                        <div class="screening-score-panel">
                            <div class="screening-score-number">
                                <span>Total Skor</span>
                                <strong id="scorePreview">0</strong>
                            </div>

                            <div class="screening-score-bar">
                                <span id="scoreFill"></span>
                            </div>

                            <div class="screening-score-scale">
                                <span>0</span>
                                <span>3</span>
                                <span>7</span>
                                <span>14+</span>
                            </div>

                            <div class="screening-risk-box-web low" id="riskPreview">
                                <i class="bi bi-check-circle-fill"></i>

                                <div>
                                    <strong>Risiko Rendah</strong>
                                    <p>Belum ada indikasi kuat. Tetap edukasi warga mengenai gejala TBC.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="screening-submit-button">
                        <i class="bi bi-save"></i>
                        Simpan Hasil Screening
                    </button>
                </div>
            </aside>
        </div>
    </form>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const nikInput = document.getElementById('nikInput');
                const nikCounter = document.getElementById('nikCounter');

                if (nikInput && nikCounter) {
                    const updateCounter = () => {
                        nikInput.value = nikInput.value.replace(/\D/g, '').slice(0, 16);
                        nikCounter.textContent = `${nikInput.value.length} / 16 digit`;
                    };

                    nikInput.addEventListener('input', updateCounter);
                    updateCounter();
                }

                const checks = document.querySelectorAll('.screening-web-check input[type="checkbox"]');
                const scorePreview = document.getElementById('scorePreview');
                const scoreFill = document.getElementById('scoreFill');
                const riskPreview = document.getElementById('riskPreview');

                function updateScore() {
                    let total = 0;

                    checks.forEach((check) => {
                        const card = check.closest('.screening-web-check');

                        if (check.checked) {
                            total += Number(check.dataset.score || 0);
                            card.classList.add('checked');
                        } else {
                            card.classList.remove('checked');
                        }
                    });

                    scorePreview.textContent = total;

                    const percentage = Math.min((total / 14) * 100, 100);
                    scoreFill.style.width = percentage + '%';

                    riskPreview.classList.remove('low', 'medium', 'high');

                    if (total >= 7) {
                        riskPreview.classList.add('high');
                        riskPreview.innerHTML = `
                            <i class="bi bi-exclamation-octagon-fill"></i>
                            <div>
                                <strong>Risiko Tinggi</strong>
                                <p>Segera arahkan warga untuk pemeriksaan lanjutan ke faskes atau klinik TBC terdekat.</p>
                            </div>
                        `;
                    } else if (total >= 3) {
                        riskPreview.classList.add('medium');
                        riskPreview.innerHTML = `
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <div>
                                <strong>Risiko Sedang</strong>
                                <p>Sarankan warga memantau gejala dan melakukan pemeriksaan ke puskesmas atau faskes terdekat.</p>
                            </div>
                        `;
                    } else {
                        riskPreview.classList.add('low');
                        riskPreview.innerHTML = `
                            <i class="bi bi-check-circle-fill"></i>
                            <div>
                                <strong>Risiko Rendah</strong>
                                <p>Belum ada indikasi kuat. Tetap edukasi warga mengenai gejala TBC.</p>
                            </div>
                        `;
                    }
                }

                checks.forEach((check) => {
                    check.addEventListener('change', updateScore);
                });

                updateScore();
            });
        </script>
    @endpush
@endsection