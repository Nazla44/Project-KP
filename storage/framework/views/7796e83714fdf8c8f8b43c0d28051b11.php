<?php $__env->startSection('title', 'Riwayat Screening'); ?>

<?php $__env->startSection('page_title', 'Riwayat Screening'); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $dataKegiatan = $kegiatans ?? collect();
    ?>

    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Riwayat</p>
            <h1>Riwayat Screening</h1>
            <p class="kader-page-desc">
                Pilih jadwal sosialisasi terlebih dahulu untuk melihat daftar warga yang sudah diskrining.
            </p>
        </div>
    </div>

    <?php if($dataKegiatan->count()): ?>
        <div class="history-screening-grid">
            <?php $__currentLoopData = $dataKegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $totalScreening = 0;
                    $lastScreening = null;

                    if (isset($item->screeningSessions)) {
                        $totalScreening = $item->screeningSessions->sum('results_count');

                        $lastScreening = $item->screeningSessions
                            ->flatMap(function ($session) {
                                return $session->results ?? collect();
                            })
                            ->sortByDesc('created_at')
                            ->first();
                    }

                    $status = $item->status ?? 'draft';

                    $statusLabel = match ($status) {
                        'published' => 'Akan Datang',
                        'ongoing' => 'Berlangsung',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                        default => ucfirst($status),
                    };
                ?>

                <article class="history-screening-card">
                    <div class="history-screening-card-top">
                        <span class="history-screening-status <?php echo e($status); ?>">
                            <?php echo e($statusLabel); ?>

                        </span>

                        <span class="history-screening-count">
                            <?php echo e($totalScreening); ?> warga
                        </span>
                    </div>

                    <h2><?php echo e($item->judul); ?></h2>

                    <div class="history-screening-meta">
                        <p>
                            <i class="bi bi-calendar-event"></i>
                            <span><?php echo e(optional($item->tanggal)->format('d M Y') ?? '-'); ?></span>
                        </p>

                        <p>
                            <i class="bi bi-geo-alt"></i>
                            <span><?php echo e($item->lokasi ?? '-'); ?></span>
                        </p>

                        <p>
                            <i class="bi bi-clock-history"></i>
                            <span>
                                Terakhir screening:
                                <?php if($lastScreening): ?>
                                    <?php echo e(optional($lastScreening->created_at)->format('d M Y H:i')); ?>

                                <?php else: ?>
                                    Belum ada
                                <?php endif; ?>
                            </span>
                        </p>
                    </div>

                    <div class="history-screening-actions">
                        <a href="<?php echo e(route('kader.riwayat-screening.show', $item)); ?>" class="kader-btn-red">
                            <i class="bi bi-eye"></i>
                            Lihat Riwayat
                        </a>

                        <a href="<?php echo e(route('kader.screening.create', $item)); ?>" class="kader-btn-light">
                            <i class="bi bi-plus-circle"></i>
                            Tambah Screening
                        </a>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if(method_exists($dataKegiatan, 'links')): ?>
            <div class="mt-4">
                <?php echo e($dataKegiatan->links()); ?>

            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="kader-empty-page">
            <div class="kader-empty-page-icon">
                <i class="bi bi-clipboard2-pulse"></i>
            </div>

            <h2>Belum Ada Riwayat Screening</h2>

            <p>
                Riwayat screening akan muncul setelah Anda melakukan screening warga pada jadwal
                sosialisasi yang sudah ditugaskan oleh admin.
            </p>

            <div class="kader-empty-steps">
                <div>
                    <span>1</span>
                    <strong>Pilih jadwal</strong>
                    <small>Buka jadwal sosialisasi aktif yang ditugaskan kepada Anda.</small>
                </div>

                <div>
                    <span>2</span>
                    <strong>Isi form screening</strong>
                    <small>Masukkan identitas warga dan pilih gejala atau faktor risiko TBC.</small>
                </div>

                <div>
                    <span>3</span>
                    <strong>Riwayat tersimpan</strong>
                    <small>Data screening warga akan tersimpan dan tampil pada halaman ini.</small>
                </div>
            </div>

            <div class="kader-empty-actions">
                <a href="<?php echo e(route('kader.jadwal.index')); ?>" class="kader-btn-red">
                    <i class="bi bi-calendar-event"></i>
                    Lihat Jadwal Sosialisasi
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