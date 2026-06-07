<?php $__env->startSection('title', isset($kegiatan) ? 'Edit Jadwal Sosialisasi' : 'Tambah Jadwal Sosialisasi'); ?>

<?php $__env->startSection('content'); ?>
    <div class="admin-page-header">
        <div>
            <p class="admin-page-label">Jadwal Sosialisasi</p>

            <h1 class="admin-page-title">
                <?php echo e(isset($kegiatan) ? 'Edit Jadwal Sosialisasi' : 'Tambah Jadwal Sosialisasi'); ?>

            </h1>

            <p class="admin-page-desc">
                Atur informasi kegiatan, pilih kader yang bertugas, dan siapkan materi edukasi TBC.
            </p>
        </div>

        <a href="<?php echo e(route('admin.kegiatan-sosial.index')); ?>" class="admin-secondary-button">
            <i class="bi bi-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <form
        action="<?php echo e(isset($kegiatan) ? route('admin.kegiatan-sosial.update', $kegiatan) : route('admin.kegiatan-sosial.store')); ?>"
        method="POST"
        enctype="multipart/form-data"
        class="admin-form-stack js-confirm-submit"
        data-title="<?php echo e(isset($kegiatan) ? 'Update jadwal sosialisasi?' : 'Tambah jadwal sosialisasi?'); ?>"
        data-text="<?php echo e(isset($kegiatan) ? 'Perubahan jadwal sosialisasi akan disimpan.' : 'Jadwal sosialisasi baru akan ditambahkan.'); ?>"
        data-confirm="<?php echo e(isset($kegiatan) ? 'Ya, update' : 'Ya, tambah'); ?>"
    >
        <?php echo csrf_field(); ?>

        <?php if(isset($kegiatan)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

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
                        value="<?php echo e(old('judul', $kegiatan->judul ?? '')); ?>"
                        class="admin-form-control <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        placeholder="Contoh: Sosialisasi TBC Kelurahan Tembalang"
                    >

                    <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="admin-form-error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="admin-form-grid three">
                    <div class="admin-form-group">
                        <label class="admin-form-label">
                            Tanggal <span>*</span>
                        </label>

                        <input
                            type="date"
                            name="tanggal"
                            value="<?php echo e(old('tanggal', isset($kegiatan) && $kegiatan->tanggal ? $kegiatan->tanggal->format('Y-m-d') : '')); ?>"
                            class="admin-form-control <?php $__errorArgs = ['tanggal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        >

                        <?php $__errorArgs = ['tanggal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="admin-form-error"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-form-label">Jam Mulai</label>

                        <input
                            type="time"
                            name="jam_mulai"
                            value="<?php echo e(old('jam_mulai', isset($kegiatan) && $kegiatan->jam_mulai ? substr($kegiatan->jam_mulai, 0, 5) : '')); ?>"
                            class="admin-form-control <?php $__errorArgs = ['jam_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        >

                        <?php $__errorArgs = ['jam_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="admin-form-error"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-form-label">Jam Selesai</label>

                        <input
                            type="time"
                            name="jam_selesai"
                            value="<?php echo e(old('jam_selesai', isset($kegiatan) && $kegiatan->jam_selesai ? substr($kegiatan->jam_selesai, 0, 5) : '')); ?>"
                            class="admin-form-control <?php $__errorArgs = ['jam_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        >

                        <?php $__errorArgs = ['jam_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="admin-form-error"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label">
                        Lokasi <span>*</span>
                    </label>

                    <input
                        type="text"
                        name="lokasi"
                        value="<?php echo e(old('lokasi', $kegiatan->lokasi ?? '')); ?>"
                        class="admin-form-control <?php $__errorArgs = ['lokasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        placeholder="Nama tempat atau alamat lengkap kegiatan"
                    >

                    <?php $__errorArgs = ['lokasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="admin-form-error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label">
                        Deskripsi Kegiatan <span>*</span>
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="5"
                        class="admin-form-control admin-form-textarea <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        placeholder="Jelaskan tujuan dan gambaran kegiatan sosialisasi..."
                    ><?php echo e(old('deskripsi', $kegiatan->deskripsi ?? '')); ?></textarea>

                    <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="admin-form-error"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="admin-form-grid two">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Banner / Thumbnail</label>

                        <?php if(isset($kegiatan) && $kegiatan->banner): ?>
                            <div class="admin-current-image">
                                <img src="<?php echo e($kegiatan->banner_url); ?>" alt="Banner kegiatan">
                                <small>Upload gambar baru untuk mengganti banner.</small>
                            </div>
                        <?php endif; ?>

                        <input
                            type="file"
                            name="banner"
                            accept="image/*"
                            class="admin-form-control <?php $__errorArgs = ['banner'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        >

                        <div class="admin-form-help">
                            Format JPG, PNG, WEBP. Maksimal 2MB.
                        </div>

                        <?php $__errorArgs = ['banner'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="admin-form-error"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-form-label">
                            Status <span>*</span>
                        </label>

                        <select
                            name="status"
                            class="admin-form-control admin-form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        >
                            <option value="draft" <?php if(old('status', $kegiatan->status ?? 'draft') === 'draft'): echo 'selected'; endif; ?>>
                                Draft
                            </option>

                            <option value="published" <?php if(old('status', $kegiatan->status ?? '') === 'published'): echo 'selected'; endif; ?>>
                                Published
                            </option>

                            <?php if(isset($kegiatan)): ?>
                                <option value="ongoing" <?php if(old('status', $kegiatan->status ?? '') === 'ongoing'): echo 'selected'; endif; ?>>
                                    Berlangsung
                                </option>

                                <option value="completed" <?php if(old('status', $kegiatan->status ?? '') === 'completed'): echo 'selected'; endif; ?>>
                                    Selesai
                                </option>

                                <option value="cancelled" <?php if(old('status', $kegiatan->status ?? '') === 'cancelled'): echo 'selected'; endif; ?>>
                                    Dibatalkan
                                </option>
                            <?php endif; ?>
                        </select>

                        <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="admin-form-error"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                <?php if($kaders->isEmpty()): ?>
                    <div class="admin-empty-mini">
                        Belum ada kader aktif. Silakan verifikasi kader terlebih dahulu.
                    </div>
                <?php else: ?>
                    <div class="admin-kader-grid">
                        <?php $__currentLoopData = $kaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kader): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $isSelected = in_array($kader->id, old('kader_ids', $selectedKaderIds ?? []));

                                $currentPeran = old(
                                    "peran_kader.{$kader->id}",
                                    isset($kegiatan)
                                        ? ($kegiatan->kaders->firstWhere('id', $kader->id)?->pivot->peran ?? 'pelaksana')
                                        : 'pelaksana'
                                );
                            ?>

                            <label class="admin-kader-option <?php echo e($isSelected ? 'selected' : ''); ?>">
                                <input
                                    type="checkbox"
                                    name="kader_ids[]"
                                    value="<?php echo e($kader->id); ?>"
                                    <?php if($isSelected): echo 'checked'; endif; ?>
                                    onchange="togglePeran(this, <?php echo e($kader->id); ?>)"
                                >

                                <div class="admin-kader-option-body">
                                    <div class="admin-kader-option-name">
                                        <?php echo e($kader->nama); ?>

                                    </div>

                                    <div class="admin-kader-option-meta">
                                        <?php echo e($kader->kab_kota ?: '-'); ?> · <?php echo e($kader->kecamatan ?: '-'); ?>

                                    </div>

                                    <select
                                        name="peran_kader[<?php echo e($kader->id); ?>]"
                                        id="peran_<?php echo e($kader->id); ?>"
                                        class="admin-form-control admin-form-select admin-kader-role <?php echo e(!$isSelected ? 'is-disabled' : ''); ?>"
                                    >
                                        <option value="pelaksana" <?php if($currentPeran === 'pelaksana'): echo 'selected'; endif; ?>>
                                            Pelaksana
                                        </option>

                                        <option value="koordinator" <?php if($currentPeran === 'koordinator'): echo 'selected'; endif; ?>>
                                            Koordinator
                                        </option>

                                        <option value="pendamping" <?php if($currentPeran === 'pendamping'): echo 'selected'; endif; ?>>
                                            Pendamping
                                        </option>
                                    </select>
                                </div>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
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
                    <?php
                        $existingMateri = isset($kegiatan)
                            ? $kegiatan->materi
                            : collect($materiDefault ?? []);
                    ?>

                    <?php $__currentLoopData = $existingMateri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="admin-materi-item">
                            <div class="admin-materi-fields">
                                <input
                                    type="text"
                                    name="materi[<?php echo e($i); ?>][judul]"
                                    value="<?php echo e(old("materi.{$i}.judul", is_array($m) ? $m['judul'] : $m->judul)); ?>"
                                    class="admin-form-control"
                                    placeholder="Judul materi"
                                >

                                <textarea
                                    name="materi[<?php echo e($i); ?>][konten]"
                                    rows="2"
                                    class="admin-form-control admin-form-textarea small"
                                    placeholder="Isi materi atau catatan singkat"
                                ><?php echo e(old("materi.{$i}.konten", is_array($m) ? ($m['konten'] ?? '') : $m->konten)); ?></textarea>

                                <input type="hidden" name="materi[<?php echo e($i); ?>][urutan]" value="<?php echo e($i + 1); ?>">
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <div class="admin-form-actions">
            <button type="submit" class="admin-primary-button">
                <i class="bi bi-save"></i>
                <span><?php echo e(isset($kegiatan) ? 'Simpan Perubahan' : 'Buat Jadwal'); ?></span>
            </button>

            <a href="<?php echo e(route('admin.kegiatan-sosial.index')); ?>" class="admin-secondary-button">
                Batal
            </a>
        </div>
    </form>

    <?php $__env->startPush('scripts'); ?>
        <script>
            let materiIndex = <?php echo e(count($existingMateri ?? [])); ?>;

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
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/admin/kegiatan/create.blade.php ENDPATH**/ ?>