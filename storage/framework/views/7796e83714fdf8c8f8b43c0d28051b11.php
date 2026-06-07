<?php $__env->startSection('title', 'Riwayat Screening'); ?>

<?php $__env->startSection('page_title', 'Riwayat Screening'); ?>

<?php $__env->startSection('content'); ?>
    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Riwayat</p>
            <h1>Riwayat Screening</h1>
            <p class="kader-page-desc">
                Pilih jadwal sosialisasi terlebih dahulu untuk melihat daftar warga yang sudah diskrining.
            </p>
        </div>
    </div>

    <?php if($kegiatans->count()): ?>
        <div class="history-schedule-grid">
            <?php $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $totalScreening = $item->screeningSessions->sum('results_count');
                    $lastSession = $item->screeningSessions->first();
                ?>

                <div class="history-schedule-card">
                    <div class="history-schedule-top">
                        <span class="kader-status-badge">
                            <?php echo e($item->status_label ?? ucfirst($item->status)); ?>

                        </span>

                        <span class="history-screening-count">
                            <?php echo e($totalScreening); ?> warga
                        </span>
                    </div>

                    <h2><?php echo e($item->judul); ?></h2>

                    <div class="history-schedule-meta">
                        <p>
                            <i class="bi bi-calendar-event"></i>
                            <?php echo e(optional($item->tanggal)->format('d M Y') ?? '-'); ?>

                        </p>

                        <p>
                            <i class="bi bi-geo-alt"></i>
                            <?php echo e($item->lokasi ?? '-'); ?>

                        </p>

                        <p>
                            <i class="bi bi-clock-history"></i>
                            Terakhir screening:
                            <?php echo e($lastSession?->updated_at?->format('d M Y H:i') ?? 'Belum ada'); ?>

                        </p>
                    </div>

                    <div class="history-schedule-actions">
                        <a href="<?php echo e(route('kader.riwayat-screening.show', $item)); ?>" class="kader-btn-red">
                            Lihat Riwayat
                        </a>

                        <a href="<?php echo e(route('kader.screening.create', $item)); ?>" class="kader-btn-light">
                            Tambah Screening
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="kader-pagination mt-3">
            <?php echo e($kegiatans->links()); ?>

        </div>
    <?php else: ?>
        <div class="kader-empty-page">
            <div class="kader-empty-page-icon">
                <i class="bi bi-clipboard2-pulse"></i>
            </div>

            <h2>Belum Ada Riwayat Screening</h2>

            <p>
                Riwayat screening akan muncul setelah admin menugaskan jadwal sosialisasi kepada Anda
                dan Anda mulai mengisi form screening masyarakat.
            </p>

            <div class="kader-empty-steps">
                <div>
                    <span>1</span>
                    <strong>Admin membuat jadwal</strong>
                    <small>Admin menambahkan jadwal sosialisasi dan memilih kader yang bertugas.</small>
                </div>

                <div>
                    <span>2</span>
                    <strong>Kader melakukan screening</strong>
                    <small>Kader membuka jadwal dan mengisi form screening warga.</small>
                </div>

                <div>
                    <span>3</span>
                    <strong>Riwayat tersimpan</strong>
                    <small>Data warga yang sudah diskrining akan tampil di halaman ini.</small>
                </div>
            </div>

            <div class="kader-empty-actions">
                <a href="<?php echo e(route('kader.jadwal.index')); ?>" class="kader-btn-red">
                    <i class="bi bi-calendar-event"></i>
                    Cek Jadwal Sosialisasi
                </a>

                <a href="<?php echo e(route('kader.dashboard')); ?>" class="kader-btn-light">
                    <i class="bi bi-grid-1x2-fill"></i>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.kader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/kader/riwayat-screening/index.blade.php ENDPATH**/ ?>