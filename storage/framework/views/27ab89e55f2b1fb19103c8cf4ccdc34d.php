<?php $__env->startSection('title', 'Rekap Sosialisasi'); ?>

<?php $__env->startSection('page_title', 'Rekap Sosialisasi'); ?>

<?php $__env->startSection('content'); ?>
    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Report A</p>
            <h1>Rekap Sosialisasi</h1>
            <p class="kader-page-desc">
                Isi rekap kegiatan sosialisasi setelah kegiatan selesai dilaksanakan.
            </p>
        </div>
    </div>

    <?php if($kegiatans->count()): ?>
        <div class="history-schedule-grid">
            <?php $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="history-schedule-card">
                    <div class="history-schedule-top">
                        <span class="kader-status-badge">
                            <?php echo e($item->status_label ?? ucfirst($item->status)); ?>

                        </span>

                        <?php if($item->ringkasan): ?>
                            <span class="history-screening-count">
                                Sudah direkap
                            </span>
                        <?php else: ?>
                            <span class="history-screening-count">
                                Belum direkap
                            </span>
                        <?php endif; ?>
                    </div>

                    <h2><?php echo e($item->judul); ?></h2>

                    <div class="history-schedule-meta">
                        <p>
                            <i class="bi bi-calendar-event"></i>
                            <span><?php echo e(optional($item->tanggal)->format('d M Y') ?? '-'); ?></span>
                        </p>

                        <p>
                            <i class="bi bi-geo-alt"></i>
                            <span><?php echo e($item->lokasi ?? '-'); ?></span>
                        </p>

                        <p>
                            <i class="bi bi-people"></i>
                            <span>
                                Peserta:
                                <?php echo e($item->ringkasan?->jumlah_peserta ?? 0); ?>

                            </span>
                        </p>

                        <p>
                            <i class="bi bi-image"></i>
                            <span>
                                Dokumentasi:
                                <?php echo e($item->dokumentasi_count ?? 0); ?> foto
                            </span>
                        </p>
                    </div>

                    <div class="history-schedule-actions">
                        <a href="<?php echo e(route('kader.rekap-sosialisasi.edit', $item)); ?>" class="kader-btn-red">
                            <i class="bi bi-journal-check"></i>
                            <?php echo e($item->ringkasan ? 'Edit Rekap' : 'Isi Rekap'); ?>

                        </a>

                        <a href="<?php echo e(route('kader.kegiatan.show', $item)); ?>" class="kader-btn-light">
                            <i class="bi bi-eye"></i>
                            Detail Jadwal
                        </a>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-4">
            <?php echo e($kegiatans->links()); ?>

        </div>
    <?php else: ?>
        <div class="kader-empty-page">
            <div class="kader-empty-page-icon">
                <i class="bi bi-journal-check"></i>
            </div>

            <h2>Belum Ada Jadwal untuk Direkap</h2>

            <p>
                Rekap sosialisasi akan muncul setelah admin menugaskan jadwal sosialisasi
                kepada Anda.
            </p>

            <div class="kader-empty-actions">
                <a href="<?php echo e(route('kader.jadwal.index')); ?>" class="kader-btn-red">
                    <i class="bi bi-calendar-event"></i>
                    Lihat Jadwal Sosialisasi
                </a>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.kader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/kader/rekap-sosialisasi/index.blade.php ENDPATH**/ ?>