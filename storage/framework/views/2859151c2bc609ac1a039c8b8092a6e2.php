<?php $__env->startSection('title', 'Daftar Jadi Kader – Stop TB Partnership Indonesia'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/form-kader.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="fk-hero">
        <div class="fk-hero-overlay"></div>

        <div class="container-xl px-4 px-lg-5 position-relative" style="z-index:2;">
            <nav class="ad-breadcrumb mb-4">
                <a href="<?php echo e(route('home')); ?>">Home</a>
                <i class="bi bi-chevron-right mx-2"></i>
                <a href="<?php echo e(route('program-komunitas')); ?>">Program Komunitas</a>
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

    
    <section class="fk-body py-5">
        <div class="container-xl px-4 px-lg-5">
            <div class="row g-5 justify-content-center">

                
                <div class="col-12 col-lg-8">
                    <form action="<?php echo e(route('kader.submit')); ?>" method="POST" class="fk-form" novalidate>
                        <?php echo csrf_field(); ?>

                        <?php if($errors->any()): ?>
                            <div class="fk-alert-error mb-4">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                Mohon periksa kembali isian Anda. Ada
                                <strong><?php echo e($errors->count()); ?></strong>
                                field yang perlu diperbaiki.
                            </div>
                        <?php endif; ?>

                        
                        <div class="fk-section-card mb-4">
                            <div class="fk-section-header">
                                <span class="fk-section-num">01</span>

                                <div>
                                    <h2 class="fk-section-title">Data Diri</h2>
                                    <p class="fk-section-subtitle">Informasi pribadi pendaftar</p>
                                </div>
                            </div>

                            <div class="fk-fields">

                                
                                <div class="fk-field-group">
                                    <label class="fk-label" for="nama_lengkap">
                                        Nama Lengkap <span class="fk-required">*</span>
                                    </label>

                                    <input type="text" id="nama_lengkap" name="nama_lengkap"
                                        class="fk-input <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('nama_lengkap')); ?>" placeholder="Sesuai KTP" autocomplete="name">

                                    <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="fk-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="fk-field-group">
                                    <label class="fk-label" for="nik">
                                        NIK (Nomor Induk Kependudukan) <span class="fk-required">*</span>
                                    </label>

                                    <input type="text" id="nik" name="nik"
                                        class="fk-input <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('nik')); ?>"
                                        placeholder="16 digit angka sesuai KTP" maxlength="16" inputmode="numeric">

                                    <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="fk-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="row g-3">
                                    <div class="col-12 col-md-8">
                                        <div class="fk-field-group">
                                            <label class="fk-label" for="tempat_lahir">
                                                Tempat Lahir <span class="fk-required">*</span>
                                            </label>

                                            
                                            <div class="fk-region-picker">
                                                <div class="fk-region-input-wrap">
                                                    <input type="text" id="tempat_lahir" name="tempat_lahir"
                                                        class="fk-input fk-region-input <?php $__errorArgs = ['tempat_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                        value="<?php echo e(old('tempat_lahir')); ?>" placeholder="Pilih tempat lahir"
                                                        readonly autocomplete="off">

                                                    <button type="button" class="fk-region-open-btn"
                                                        id="openTempatLahirPicker" aria-label="Pilih tempat lahir">
                                                        <i class="bi bi-chevron-down"></i>
                                                    </button>
                                                </div>

                                                <div class="fk-region-panel" id="tempatLahirPanel">
                                                    <div class="fk-region-panel-grid">
                                                        <div>
                                                            <label class="fk-region-panel-label"
                                                                for="tempat_lahir_provinsi">
                                                                Provinsi
                                                            </label>

                                                            <select id="tempat_lahir_provinsi" class="fk-input fk-select"
                                                                autocomplete="off">
                                                                <option value="">Memuat provinsi...</option>
                                                            </select>
                                                        </div>

                                                        <div>
                                                            <label class="fk-region-panel-label"
                                                                for="tempat_lahir_kabupaten">
                                                                Kabupaten / Kota
                                                            </label>

                                                            <select id="tempat_lahir_kabupaten" class="fk-input fk-select"
                                                                autocomplete="off" disabled>
                                                                <option value="">Pilih provinsi dulu</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <small class="fk-region-panel-hint">
                                                        Pilih provinsi terlebih dahulu, lalu pilih kota/kabupaten tempat
                                                        lahir.
                                                    </small>
                                                </div>
                                            </div>

                                            <?php $__errorArgs = ['tempat_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="fk-error"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="fk-field-group">
                                            <label class="fk-label" for="tanggal_lahir">
                                                Tanggal Lahir <span class="fk-required">*</span>
                                            </label>

                                            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                                class="fk-input <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                value="<?php echo e(old('tanggal_lahir')); ?>" max="<?php echo e(date('Y-m-d')); ?>">

                                            <?php $__errorArgs = ['tanggal_lahir'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="fk-error"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="fk-field-group">
                                    <label class="fk-label">
                                        Jenis Kelamin <span class="fk-required">*</span>
                                    </label>

                                    <div class="fk-radio-group">
                                        <label class="fk-radio-card <?php echo e(old('jenis_kelamin') === 'L' ? 'selected' : ''); ?>">
                                            <input type="radio" name="jenis_kelamin" value="L"
                                                <?php echo e(old('jenis_kelamin') === 'L' ? 'checked' : ''); ?>>
                                            <i class="bi bi-gender-male me-2"></i>
                                            Laki-laki
                                        </label>

                                        <label class="fk-radio-card <?php echo e(old('jenis_kelamin') === 'P' ? 'selected' : ''); ?>">
                                            <input type="radio" name="jenis_kelamin" value="P"
                                                <?php echo e(old('jenis_kelamin') === 'P' ? 'checked' : ''); ?>>
                                            <i class="bi bi-gender-female me-2"></i>
                                            Perempuan
                                        </label>
                                    </div>

                                    <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="fk-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                            </div>
                        </div>

                        
                        <div class="fk-section-card mb-4">
                            <div class="fk-section-header">
                                <span class="fk-section-num">02</span>

                                <div>
                                    <h2 class="fk-section-title">Kontak & Domisili</h2>
                                    <p class="fk-section-subtitle">
                                        Kami akan menghubungi Anda melalui nomor atau email ini
                                    </p>
                                </div>
                            </div>

                            <div class="fk-fields">

                                
                                <div class="fk-field-group">
                                    <label class="fk-label" for="no_hp">
                                        Nomor HP / WhatsApp <span class="fk-required">*</span>
                                    </label>

                                    <div class="fk-input-prefix-wrap">
                                        <span class="fk-input-prefix">+62</span>

                                        <input type="tel" id="no_hp" name="no_hp"
                                            class="fk-input fk-input-prefixed <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            value="<?php echo e(old('no_hp')); ?>" placeholder="81234567890" inputmode="numeric">
                                    </div>

                                    <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="fk-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="fk-field-group">
                                    <label class="fk-label" for="email">
                                        Email <span class="fk-required">*</span>
                                    </label>

                                    <input type="email" id="email" name="email"
                                        class="fk-input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>"
                                        placeholder="nama@email.com" autocomplete="email">

                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="fk-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="fk-field-group">
                                    <label class="fk-label" for="alamat">
                                        Alamat Lengkap <span class="fk-required">*</span>
                                    </label>

                                    <textarea id="alamat" name="alamat" rows="3"
                                        class="fk-input fk-textarea <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Nama jalan, nomor rumah, RT/RW"><?php echo e(old('alamat')); ?></textarea>

                                    <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="fk-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
                                        <div class="fk-field-group">
                                            <label class="fk-label" for="provinsi">
                                                Provinsi <span class="fk-required">*</span>
                                            </label>

                                            <select id="provinsi" name="provinsi"
                                                class="fk-input fk-select <?php $__errorArgs = ['provinsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                data-old="<?php echo e(old('provinsi')); ?>" autocomplete="off">
                                                <option value="">Memuat provinsi...</option>
                                            </select>

                                            <?php $__errorArgs = ['provinsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="fk-error"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="fk-field-group">
                                            <label class="fk-label" for="kab_kota">
                                                Kab / Kota <span class="fk-required">*</span>
                                            </label>

                                            <select id="kab_kota" name="kab_kota"
                                                class="fk-input fk-select <?php $__errorArgs = ['kab_kota'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                data-old="<?php echo e(old('kab_kota')); ?>" disabled autocomplete="off">
                                                <option value="">Pilih provinsi dulu</option>
                                            </select>

                                            <?php $__errorArgs = ['kab_kota'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="fk-error"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="fk-field-group">
                                            <label class="fk-label" for="kecamatan">
                                                Kecamatan <span class="fk-required">*</span>
                                            </label>

                                            <select id="kecamatan" name="kecamatan"
                                                class="fk-input fk-select <?php $__errorArgs = ['kecamatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                data-old="<?php echo e(old('kecamatan')); ?>" disabled autocomplete="off">
                                                <option value="">Pilih kab/kota dulu</option>
                                            </select>

                                            <?php $__errorArgs = ['kecamatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="fk-error"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        
                        <div class="fk-section-card mb-4">
                            <div class="fk-section-header">
                                <span class="fk-section-num">03</span>

                                <div>
                                    <h2 class="fk-section-title">Latar Belakang</h2>
                                    <p class="fk-section-subtitle">Bantu kami mengenal Anda lebih baik</p>
                                </div>
                            </div>

                            <div class="fk-fields">

                                
                                <div class="fk-field-group">
                                    <label class="fk-label" for="pekerjaan">
                                        Pekerjaan Saat Ini <span class="fk-required">*</span>
                                    </label>

                                    <input type="text" id="pekerjaan" name="pekerjaan"
                                        class="fk-input <?php $__errorArgs = ['pekerjaan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('pekerjaan')); ?>"
                                        placeholder="Contoh: Ibu Rumah Tangga, Guru, Wiraswasta">

                                    <?php $__errorArgs = ['pekerjaan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="fk-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="fk-field-group">
                                    <label class="fk-label" for="pendidikan">
                                        Pendidikan Terakhir <span class="fk-required">*</span>
                                    </label>

                                    <select id="pendidikan" name="pendidikan"
                                        class="fk-input fk-select <?php $__errorArgs = ['pendidikan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <option value="" disabled <?php echo e(old('pendidikan') ? '' : 'selected'); ?>>
                                            Pilih pendidikan terakhir
                                        </option>

                                        <?php $__currentLoopData = [
            'SD' => 'SD / Sederajat',
            'SMP' => 'SMP / Sederajat',
            'SMA' => 'SMA / SMK / Sederajat',
            'D3' => 'Diploma (D1–D3)',
            'S1' => 'Sarjana (S1)',
            'S2' => 'Magister (S2)',
            'S3' => 'Doktor (S3)',
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($val); ?>"
                                                <?php echo e(old('pendidikan') === $val ? 'selected' : ''); ?>>
                                                <?php echo e($label); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>

                                    <?php $__errorArgs = ['pendidikan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="fk-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="fk-field-group">
                                    <label class="fk-label">
                                        Hubungan dengan TBC <span class="fk-required">*</span>
                                    </label>

                                    <p class="fk-field-hint">
                                        Pilih yang paling sesuai dengan kondisi Anda
                                    </p>

                                    <div class="fk-radio-list">
                                        <?php $__currentLoopData = [
            'penyintas' => [
                'icon' => 'bi-heart-pulse-fill',
                'label' => 'Penyintas TBC',
                'desc' => 'Saya pernah menderita TBC dan sudah sembuh',
            ],
            'keluarga' => [
                'icon' => 'bi-people-fill',
                'label' => 'Keluarga Pasien TBC',
                'desc' => 'Anggota keluarga saya pernah/sedang menderita TBC',
            ],
            'relawan' => [
                'icon' => 'bi-hand-thumbs-up-fill',
                'label' => 'Relawan Kesehatan',
                'desc' => 'Saya aktif di kegiatan sosial/kesehatan komunitas',
            ],
            'belum' => [
                'icon' => 'bi-person-plus-fill',
                'label' => 'Belum ada pengalaman langsung',
                'desc' => 'Saya ingin berkontribusi meski belum punya pengalaman TBC',
            ],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label
                                                class="fk-radio-list-item <?php echo e(old('pengalaman_tb') === $val ? 'selected' : ''); ?>">
                                                <input type="radio" name="pengalaman_tb" value="<?php echo e($val); ?>"
                                                    <?php echo e(old('pengalaman_tb') === $val ? 'checked' : ''); ?>>

                                                <div class="fk-radio-list-icon">
                                                    <i class="bi <?php echo e($opt['icon']); ?>"></i>
                                                </div>

                                                <div>
                                                    <div class="fk-radio-list-label"><?php echo e($opt['label']); ?></div>
                                                    <div class="fk-radio-list-desc"><?php echo e($opt['desc']); ?></div>
                                                </div>
                                            </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                    <?php $__errorArgs = ['pengalaman_tb'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="fk-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="fk-field-group">
                                    <label class="fk-label">
                                        Ketersediaan Waktu <span class="fk-required">*</span>
                                    </label>

                                    <div class="fk-radio-group">
                                        <?php $__currentLoopData = [
            'penuh' => 'Penuh Waktu',
            'paruh' => 'Paruh Waktu',
            'akhir_pekan' => 'Akhir Pekan Saja',
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label
                                                class="fk-radio-card <?php echo e(old('ketersediaan') === $val ? 'selected' : ''); ?>">
                                                <input type="radio" name="ketersediaan" value="<?php echo e($val); ?>"
                                                    <?php echo e(old('ketersediaan') === $val ? 'checked' : ''); ?>>
                                                <?php echo e($label); ?>

                                            </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                    <?php $__errorArgs = ['ketersediaan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="fk-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div class="fk-field-group">
                                    <label class="fk-label" for="motivasi">
                                        Motivasi Bergabung <span class="fk-required">*</span>
                                    </label>

                                    <textarea id="motivasi" name="motivasi" rows="5"
                                        class="fk-input fk-textarea <?php $__errorArgs = ['motivasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Ceritakan mengapa Anda ingin menjadi kader komunitas TBC (min. 50 karakter)..."><?php echo e(old('motivasi')); ?></textarea>

                                    <div class="fk-char-counter">
                                        <span id="motivasi-count">0</span> / 1000 karakter
                                    </div>

                                    <?php $__errorArgs = ['motivasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="fk-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                            </div>
                        </div>

                        
                        <div class="fk-section-card mb-4">
                            <div class="fk-fields">

                                <div class="fk-checkbox-wrap <?php $__errorArgs = ['setuju'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <input type="checkbox" id="setuju" name="setuju" value="1"
                                        class="fk-checkbox" <?php echo e(old('setuju') ? 'checked' : ''); ?>>

                                    <label for="setuju" class="fk-checkbox-label">
                                        Saya menyetujui bahwa data yang saya isi adalah benar, dan bersedia
                                        dihubungi oleh tim Stop TB Partnership Indonesia untuk proses seleksi
                                        dan pelatihan kader.
                                    </label>
                                </div>

                                <?php $__errorArgs = ['setuju'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="fk-error d-block mt-2"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                <button type="submit" class="fk-submit-btn mt-4">
                                    <i class="bi bi-send-fill me-2"></i>
                                    Kirim Pendaftaran
                                    <span class="fk-submit-arrow">
                                        <i class="bi bi-arrow-up-right"></i>
                                    </span>
                                </button>

                            </div>
                        </div>

                    </form>
                </div>

                
                <div class="col-12 col-lg-4">
                    <div class="fk-sidebar">

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

                        <div class="fk-sidebar-block mb-4">
                            <h3 class="fk-sidebar-title">
                                <i class="bi bi-gift me-2"></i>Yang Anda Dapatkan
                            </h3>

                            <div class="fk-benefit-list">
                                <?php $__currentLoopData = [['icon' => 'bi-mortarboard-fill', 'text' => 'Pelatihan kader bersertifikat'], ['icon' => 'bi-currency-dollar', 'text' => 'Insentif bulanan dari program'], ['icon' => 'bi-people-fill', 'text' => 'Jejaring relawan TBC nasional'], ['icon' => 'bi-bag-heart-fill', 'text' => 'Perlengkapan kader (APD, ATK)'], ['icon' => 'bi-graph-up-arrow', 'text' => 'Pengembangan kapasitas rutin']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="fk-benefit-item">
                                        <div class="fk-benefit-icon">
                                            <i class="bi <?php echo e($b['icon']); ?>"></i>
                                        </div>
                                        <span><?php echo e($b['text']); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            /*
            |--------------------------------------------------------------------------
            | Radio card interaktif
            |--------------------------------------------------------------------------
            */

            document.querySelectorAll('.fk-radio-card input, .fk-radio-list-item input').forEach(radio => {
                radio.addEventListener('change', function() {
                    const group = this.closest('.fk-radio-group, .fk-radio-list');

                    if (group) {
                        group.querySelectorAll('.fk-radio-card, .fk-radio-list-item')
                            .forEach(el => el.classList.remove('selected'));
                    }

                    this.closest('.fk-radio-card, .fk-radio-list-item')?.classList.add('selected');
                });
            });

            /*
            |--------------------------------------------------------------------------
            | Counter karakter motivasi
            |--------------------------------------------------------------------------
            */

            const motivasi = document.getElementById('motivasi');
            const counter = document.getElementById('motivasi-count');

            if (motivasi && counter) {
                const update = () => {
                    const len = motivasi.value.length;
                    counter.textContent = len;
                    counter.style.color = len > 900 ? 'var(--color-primary)' : '';
                };

                motivasi.addEventListener('input', update);
                update();
            }

            /*
            |--------------------------------------------------------------------------
            | NIK & Nomor HP hanya angka
            |--------------------------------------------------------------------------
            */

            document.getElementById('nik')?.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '').slice(0, 16);
            });

            document.getElementById('no_hp')?.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '').replace(/^0+/, '');
            });

            /*
            |--------------------------------------------------------------------------
            | Dropdown Wilayah Indonesia via API
            |--------------------------------------------------------------------------
            */

            const API_BASE = 'https://www.emsifa.com/api-wilayah-indonesia/api';

            const tempatLahirInput = document.getElementById('tempat_lahir');
            const tempatLahirPanel = document.getElementById('tempatLahirPanel');
            const openTempatLahirPicker = document.getElementById('openTempatLahirPicker');
            const tempatLahirProvinsiSelect = document.getElementById('tempat_lahir_provinsi');
            const tempatLahirKabupatenSelect = document.getElementById('tempat_lahir_kabupaten');

            const provinsiSelect = document.getElementById('provinsi');
            const kabKotaSelect = document.getElementById('kab_kota');
            const kecamatanSelect = document.getElementById('kecamatan');

            const oldTempatLahir = tempatLahirInput?.value || '';
            const oldProvinsi = provinsiSelect?.dataset.old || '';
            const oldKabKota = kabKotaSelect?.dataset.old || '';
            const oldKecamatan = kecamatanSelect?.dataset.old || '';

            let provincesCache = [];
            let regenciesCache = {};
            let districtsCache = {};

            async function fetchJson(url) {
                const response = await fetch(url);

                if (!response.ok) {
                    throw new Error('Gagal mengambil data wilayah.');
                }

                return await response.json();
            }

            function resetSelect(select, text, disabled = true) {
                if (!select) return;

                select.innerHTML = `<option value="">${text}</option>`;
                select.disabled = disabled;
            }

            function fillSelect(select, items, placeholder, selectedValue = '') {
                if (!select) return;

                select.innerHTML = `<option value="">${placeholder}</option>`;

                items.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.name;
                    option.textContent = item.name;

                    if (
                        selectedValue &&
                        selectedValue.toLowerCase() === item.name.toLowerCase()
                    ) {
                        option.selected = true;
                    }

                    select.appendChild(option);
                });

                select.disabled = false;
            }

            async function getProvinces() {
                if (!provincesCache.length) {
                    provincesCache = await fetchJson(`${API_BASE}/provinces.json`);
                }

                return provincesCache;
            }

            async function getRegencies(provinceId) {
                if (!regenciesCache[provinceId]) {
                    regenciesCache[provinceId] = await fetchJson(`${API_BASE}/regencies/${provinceId}.json`);
                }

                return regenciesCache[provinceId];
            }

            async function getDistricts(regencyId) {
                if (!districtsCache[regencyId]) {
                    districtsCache[regencyId] = await fetchJson(`${API_BASE}/districts/${regencyId}.json`);
                }

                return districtsCache[regencyId];
            }

            function findProvinceByName(name) {
                return provincesCache.find(item => item.name === name);
            }

            function findRegencyByName(provinceId, name) {
                const regencies = regenciesCache[provinceId] || [];
                return regencies.find(item => item.name === name);
            }

            function toggleTempatLahirPanel(forceOpen = null) {
                if (!tempatLahirPanel) return;

                const shouldOpen = forceOpen === null ?
                    !tempatLahirPanel.classList.contains('show') :
                    forceOpen;

                tempatLahirPanel.classList.toggle('show', shouldOpen);
            }

            tempatLahirInput?.addEventListener('click', function() {
                toggleTempatLahirPanel(true);
            });

            openTempatLahirPicker?.addEventListener('click', function() {
                toggleTempatLahirPanel();
            });

            document.addEventListener('click', function(event) {
                const picker = event.target.closest('.fk-region-picker');

                if (!picker) {
                    toggleTempatLahirPanel(false);
                }
            });

            async function restoreOldTempatLahir() {
                if (!oldTempatLahir || !tempatLahirProvinsiSelect || !tempatLahirKabupatenSelect) return;

                for (const province of provincesCache) {
                    const regencies = await getRegencies(province.id);

                    const matchedRegency = regencies.find(item => {
                        return item.name.toLowerCase() === oldTempatLahir.toLowerCase();
                    });

                    if (matchedRegency) {
                        tempatLahirProvinsiSelect.value = province.name;
                        fillSelect(
                            tempatLahirKabupatenSelect,
                            regencies,
                            'Pilih kabupaten/kota',
                            oldTempatLahir
                        );
                        break;
                    }
                }
            }

            async function initDropdowns() {
                try {
                    resetSelect(tempatLahirProvinsiSelect, 'Memuat provinsi...', true);
                    resetSelect(provinsiSelect, 'Memuat provinsi...', true);

                    const provinces = await getProvinces();

                    fillSelect(tempatLahirProvinsiSelect, provinces, 'Pilih provinsi');
                    fillSelect(provinsiSelect, provinces, 'Pilih provinsi', oldProvinsi);

                    resetSelect(tempatLahirKabupatenSelect, 'Pilih provinsi dulu', true);
                    resetSelect(kabKotaSelect, 'Pilih provinsi dulu', true);
                    resetSelect(kecamatanSelect, 'Pilih kab/kota dulu', true);

                    await restoreOldTempatLahir();

                    if (oldProvinsi) {
                        const selectedProvince = findProvinceByName(oldProvinsi);

                        if (selectedProvince) {
                            const regencies = await getRegencies(selectedProvince.id);
                            fillSelect(kabKotaSelect, regencies, 'Pilih kabupaten/kota', oldKabKota);

                            if (oldKabKota) {
                                const selectedRegency = findRegencyByName(selectedProvince.id, oldKabKota);

                                if (selectedRegency) {
                                    const districts = await getDistricts(selectedRegency.id);
                                    fillSelect(kecamatanSelect, districts, 'Pilih kecamatan', oldKecamatan);
                                }
                            }
                        }
                    }
                } catch (error) {
                    console.error(error);

                    resetSelect(tempatLahirProvinsiSelect, 'Gagal memuat provinsi', true);
                    resetSelect(tempatLahirKabupatenSelect, 'Gagal memuat kab/kota', true);
                    resetSelect(provinsiSelect, 'Gagal memuat provinsi', true);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Event Tempat Lahir
            |--------------------------------------------------------------------------
            */

            tempatLahirProvinsiSelect?.addEventListener('change', async function() {
                const selectedProvince = findProvinceByName(this.value);

                resetSelect(tempatLahirKabupatenSelect, 'Pilih provinsi dulu', true);

                if (!selectedProvince) return;

                try {
                    resetSelect(tempatLahirKabupatenSelect, 'Memuat kabupaten/kota...', true);

                    const regencies = await getRegencies(selectedProvince.id);

                    fillSelect(tempatLahirKabupatenSelect, regencies, 'Pilih kabupaten/kota');
                } catch (error) {
                    console.error(error);
                    resetSelect(tempatLahirKabupatenSelect, 'Gagal memuat kab/kota', true);
                }
            });

            tempatLahirKabupatenSelect?.addEventListener('change', function() {
                if (!tempatLahirInput) return;

                tempatLahirInput.value = this.value;
                toggleTempatLahirPanel(false);
            });

            /*
            |--------------------------------------------------------------------------
            | Event Domisili
            |--------------------------------------------------------------------------
            */

            provinsiSelect?.addEventListener('change', async function() {
                const selectedProvince = findProvinceByName(this.value);

                resetSelect(kabKotaSelect, 'Pilih provinsi dulu', true);
                resetSelect(kecamatanSelect, 'Pilih kab/kota dulu', true);

                if (!selectedProvince) return;

                try {
                    resetSelect(kabKotaSelect, 'Memuat kabupaten/kota...', true);

                    const regencies = await getRegencies(selectedProvince.id);

                    fillSelect(kabKotaSelect, regencies, 'Pilih kabupaten/kota');
                } catch (error) {
                    console.error(error);
                    resetSelect(kabKotaSelect, 'Gagal memuat kabupaten/kota', true);
                }
            });

            kabKotaSelect?.addEventListener('change', async function() {
                const selectedProvince = findProvinceByName(provinsiSelect.value);

                resetSelect(kecamatanSelect, 'Pilih kab/kota dulu', true);

                if (!selectedProvince) return;

                const selectedRegency = findRegencyByName(selectedProvince.id, this.value);

                if (!selectedRegency) return;

                try {
                    resetSelect(kecamatanSelect, 'Memuat kecamatan...', true);

                    const districts = await getDistricts(selectedRegency.id);

                    fillSelect(kecamatanSelect, districts, 'Pilih kecamatan');
                } catch (error) {
                    console.error(error);
                    resetSelect(kecamatanSelect, 'Gagal memuat kecamatan', true);
                }
            });

            initDropdowns();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/pages/daftar-kader.blade.php ENDPATH**/ ?>