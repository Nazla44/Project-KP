<?php $__env->startSection('title', 'Riwayat Screening Warga'); ?>

<?php $__env->startSection('page_title', 'Riwayat Screening'); ?>

<?php $__env->startSection('content'); ?>
    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Riwayat Screening</p>
            <h1><?php echo e($kegiatan->judul); ?></h1>
            <p class="kader-page-desc">
                Daftar warga yang sudah diskrining pada jadwal sosialisasi ini.
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="<?php echo e(route('kader.riwayat-screening.index')); ?>" class="kader-btn-light">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

            <a href="<?php echo e(route('kader.screening.create', $kegiatan)); ?>" class="kader-btn-red">
                <i class="bi bi-plus-lg"></i>
                Tambah Screening
            </a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="kader-stat-card">
                <div class="kader-stat-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <div class="kader-stat-label">Total Warga</div>
                    <div class="kader-stat-num"><?php echo e($stats['total'] ?? 0); ?></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kader-stat-card">
                <div class="kader-stat-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <div class="kader-stat-label">Risiko Rendah</div>
                    <div class="kader-stat-num"><?php echo e($stats['rendah'] ?? 0); ?></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kader-stat-card">
                <div class="kader-stat-icon">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div>
                    <div class="kader-stat-label">Risiko Sedang</div>
                    <div class="kader-stat-num"><?php echo e($stats['sedang'] ?? 0); ?></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kader-stat-card">
                <div class="kader-stat-icon danger">
                    <i class="bi bi-exclamation-octagon-fill"></i>
                </div>
                <div>
                    <div class="kader-stat-label">Risiko Tinggi</div>
                    <div class="kader-stat-num"><?php echo e($stats['tinggi'] ?? 0); ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="kader-table-card">
        <div class="kader-table-head">
            <div>
                <h2>Daftar Hasil Screening</h2>
                <p>Data warga, skor risiko, rekomendasi tindakan, dan faskes rujukan.</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table kader-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Warga</th>
                        <th>NIK</th>
                        <th>Skor</th>
                        <th>Risiko</th>
                        <th>Faskes Rujukan</th>
                        <th>Waktu Periksa</th>
                        <th>Catatan</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <strong><?php echo e($result->warga->nama_lengkap ?? '-'); ?></strong>
                                <div class="text-muted small">
                                    <?php echo e($result->warga->alamat ?? '-'); ?>

                                </div>
                            </td>

                            <td><?php echo e($result->warga_nik); ?></td>

                            <td>
                                <strong><?php echo e($result->skor_total); ?></strong>
                                <span class="text-muted small">poin</span>
                            </td>

                            <td>
                                <span class="risk-badge <?php echo e($result->level_risiko); ?>">
                                    <?php echo e(ucfirst($result->level_risiko)); ?>

                                </span>
                            </td>

                            <td>
                                <?php if($result->klinik): ?>
                                    <strong><?php echo e($result->klinik->nama); ?></strong>
                                    <div class="text-muted small">
                                        <?php echo e($result->klinik->alamat); ?>

                                    </div>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php echo e(optional($result->diperiksa_pada)->format('d M Y H:i')); ?>

                            </td>

                            <td>
                                <?php echo e($result->catatan_kader ?: '-'); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Belum ada data screening untuk jadwal ini.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="kader-pagination">
            <?php echo e($results->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.kader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/kader/riwayat-screening/show.blade.php ENDPATH**/ ?>