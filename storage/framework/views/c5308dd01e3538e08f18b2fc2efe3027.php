<?php $__env->startSection('title', 'Screening Masyarakat'); ?>

<?php $__env->startSection('page_title', 'Screening Masyarakat'); ?>

<?php $__env->startSection('content'); ?>
    <?php
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
    ?>

    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Screening</p>
            <h1>Form Screening Masyarakat</h1>
            <p class="kader-page-desc">
                Isi data warga, pilih gejala yang dialami, lalu sistem akan menghitung estimasi risiko TBC secara otomatis.
            </p>
        </div>

        <a href="<?php echo e(route('kader.kegiatan.show', $kegiatan)); ?>" class="kader-btn-light">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    <?php if($screeningResult): ?>
        <?php
            $level = $screeningResult['level'] ?? 'rendah';
            $score = $screeningResult['score'] ?? 0;

            $resultClass = match ($level) {
                'tinggi' => 'high',
                'sedang' => 'medium',
                default => 'low',
            };
        ?>

        <div class="screening-web-result <?php echo e($resultClass); ?> mb-4">
            <div>
                <span>Hasil Screening Terakhir</span>
                <h2>Risiko <?php echo e(ucfirst($level)); ?></h2>
                <p>
                    Skor total: <strong><?php echo e($score); ?> poin</strong>.
                    <?php echo e($screeningResult['recommendation'] ?? 'Lakukan tindak lanjut sesuai hasil pemeriksaan.'); ?>

                </p>
            </div>

            <a href="<?php echo e(route('kader.screening.create', $kegiatan)); ?>" class="screening-web-result-btn">
                Screening Warga Berikutnya
            </a>
        </div>
    <?php endif; ?>

    <form
        method="POST"
        action="<?php echo e(route('kader.screening.store', $kegiatan)); ?>"
        class="screening-web-form js-confirm-submit"
        data-title="Simpan hasil screening?"
        data-text="Pastikan data warga dan gejala yang dipilih sudah benar."
        data-confirm="Ya, simpan"
    >
        <?php echo csrf_field(); ?>

        <input type="hidden" name="consent_verbal" value="1">
        <input type="hidden" name="lokasi_alamat" value="<?php echo e(old('lokasi_alamat', $kegiatan->lokasi ?? '')); ?>">
        <input type="hidden" name="lokasi_lat" value="<?php echo e(old('lokasi_lat', $kegiatan->latitude ?? '')); ?>">
        <input type="hidden" name="lokasi_lng" value="<?php echo e(old('lokasi_lng', $kegiatan->longitude ?? '')); ?>">

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
                                value="<?php echo e(old('nik')); ?>"
                                maxlength="16"
                                placeholder="Masukkan 16 digit NIK"
                                required
                            >

                            <div class="screening-form-help">
                                <span>Gunakan NIK yang tertera pada KTP warga.</span>
                                <span id="nikCounter">0 / 16 digit</span>
                            </div>

                            <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="screening-form-error"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="screening-form-grid two">
                            <div class="screening-form-group">
                                <label>Nama Lengkap <span>*</span></label>

                                <input
                                    type="text"
                                    name="nama_lengkap"
                                    value="<?php echo e(old('nama_lengkap')); ?>"
                                    placeholder="Nama lengkap warga"
                                    required
                                >

                                <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="screening-form-error"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="screening-form-group">
                                <label>No. Telepon <small>(Opsional)</small></label>

                                <input
                                    type="text"
                                    name="no_telepon"
                                    value="<?php echo e(old('no_telepon')); ?>"
                                    placeholder="08xxxxxxxxxx"
                                >

                                <?php $__errorArgs = ['no_telepon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="screening-form-error"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="screening-form-group">
                            <label>Alamat <span>*</span></label>

                            <input
                                type="text"
                                name="alamat"
                                value="<?php echo e(old('alamat')); ?>"
                                placeholder="Alamat tempat tinggal warga"
                                required
                            >

                            <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="screening-form-error"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="screening-form-grid two">
                            <div class="screening-form-group">
                                <label>Tanggal Lahir <span>*</span></label>

                                <input
                                    type="date"
                                    name="tanggal_lahir"
                                    value="<?php echo e(old('tanggal_lahir')); ?>"
                                    required
                                >

                                <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="screening-form-error"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="screening-form-group">
                                <label>Jenis Kelamin <span>*</span></label>

                                <select name="jenis_kelamin" required>
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="L" <?php if(old('jenis_kelamin') === 'L'): echo 'selected'; endif; ?>>Laki-laki</option>
                                    <option value="P" <?php if(old('jenis_kelamin') === 'P'): echo 'selected'; endif; ?>>Perempuan</option>
                                </select>

                                <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="screening-form-error"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                            <?php $__currentLoopData = $gejalaRules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="screening-web-check">
                                    <input
                                        type="checkbox"
                                        name="answers[<?php echo e($rule->code); ?>]"
                                        value="1"
                                        data-score="<?php echo e($rule->score); ?>"
                                    >

                                    <span class="screening-web-check-box"></span>

                                    <span class="screening-web-check-text">
                                        <strong><?php echo e($rule->label); ?></strong>
                                        <small><?php echo e($rule->description ?? 'Gejala utama TBC'); ?></small>
                                    </span>

                                    <span class="screening-web-score danger">
                                        +<?php echo e($rule->score); ?>

                                    </span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <?php $__currentLoopData = $faktorRules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="screening-web-check">
                                    <input
                                        type="checkbox"
                                        name="answers[<?php echo e($rule->code); ?>]"
                                        value="1"
                                        data-score="<?php echo e($rule->score); ?>"
                                    >

                                    <span class="screening-web-check-box"></span>

                                    <span class="screening-web-check-text">
                                        <strong><?php echo e($rule->label); ?></strong>
                                        <small><?php echo e($rule->description ?? 'Faktor risiko tambahan'); ?></small>
                                    </span>

                                    <span class="screening-web-score">
                                        +<?php echo e($rule->score); ?>

                                    </span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                        ><?php echo e(old('catatan_kader')); ?></textarea>

                        <?php $__errorArgs = ['catatan_kader'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="screening-form-error"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                <strong><?php echo e($kegiatan->judul ?? '-'); ?></strong>
                            </div>

                            <div>
                                <span>Tanggal</span>
                                <strong><?php echo e(optional($kegiatan->tanggal)->format('d M Y') ?? '-'); ?></strong>
                            </div>

                            <div>
                                <span>Lokasi</span>
                                <strong><?php echo e($kegiatan->lokasi ?? '-'); ?></strong>
                            </div>

                            <div>
                                <span>Kader</span>
                                <strong><?php echo e(auth()->user()->name); ?></strong>
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

    <?php $__env->startPush('scripts'); ?>
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
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.kader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/kader/screening-create.blade.php ENDPATH**/ ?>