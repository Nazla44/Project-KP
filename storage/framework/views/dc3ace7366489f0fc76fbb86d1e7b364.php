<?php $__env->startSection('title', 'Dashboard Kader'); ?>

<?php $__env->startSection('page_title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Overview</p>
            <h1>Dashboard Kader</h1>
            <p class="kader-page-desc">
                Halo, <?php echo e($kader->nama); ?>. Berikut ringkasan jadwal sosialisasi dan screening Anda.
            </p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="kader-stat-card">
                <div class="kader-stat-icon">
                    <i class="bi bi-calendar-event-fill"></i>
                </div>
                <div>
                    <div class="kader-stat-label">Total Jadwal</div>
                    <div class="kader-stat-num"><?php echo e($stats['total_jadwal'] ?? 0); ?></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kader-stat-card">
                <div class="kader-stat-icon">
                    <i class="bi bi-clipboard2-pulse-fill"></i>
                </div>
                <div>
                    <div class="kader-stat-label">Sesi Screening</div>
                    <div class="kader-stat-num"><?php echo e($stats['total_sesi'] ?? 0); ?></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kader-stat-card">
                <div class="kader-stat-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <div class="kader-stat-label">Warga Diperiksa</div>
                    <div class="kader-stat-num"><?php echo e($stats['total_warga'] ?? 0); ?></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="kader-stat-card">
                <div class="kader-stat-icon danger">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div>
                    <div class="kader-stat-label">Risiko Tinggi</div>
                    <div class="kader-stat-num"><?php echo e($stats['risiko_tinggi'] ?? 0); ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="kader-table-card mb-4">
        <div class="kader-table-head">
            <div>
                <h2>Jadwal Sosialisasi Terdekat</h2>
                <p>Jadwal yang ditugaskan admin kepada Anda.</p>
            </div>

            <a href="<?php echo e(route('kader.jadwal.index')); ?>" class="kader-btn-red">
                Lihat Semua
            </a>
        </div>

        <div class="kader-schedule-list">
            <?php $__empty_1 = true; $__currentLoopData = $jadwalMendatang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="kader-schedule-item">
                    <div>
                        <span class="kader-status-badge">
                            <?php echo e($item->status_label ?? ucfirst($item->status)); ?>

                        </span>

                        <h3><?php echo e($item->judul); ?></h3>

                        <p>
                            <i class="bi bi-calendar-event"></i>
                            <?php echo e(optional($item->tanggal)->format('d M Y')); ?>


                            <?php if($item->jam_mulai): ?>
                                · <?php echo e(substr($item->jam_mulai, 0, 5)); ?>

                            <?php endif; ?>
                        </p>

                        <p>
                            <i class="bi bi-geo-alt"></i>
                            <?php echo e($item->lokasi); ?>

                        </p>
                    </div>

                    <div class="kader-schedule-actions">
                        <a href="<?php echo e(route('kader.kegiatan.show', $item)); ?>" class="kader-btn-light">
                            Detail
                        </a>

                        <a href="<?php echo e(route('kader.screening.create', $item)); ?>" class="kader-btn-red">
                            Screening
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="kader-empty-state">
                    Belum ada jadwal sosialisasi mendatang.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="kader-table-card">
        <div class="kader-table-head">
            <div>
                <h2>Riwayat Jadwal Saya</h2>
                <p>Lima jadwal terbaru yang pernah ditugaskan.</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table kader-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $semuaKegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <strong><?php echo e($item->judul); ?></strong>
                            </td>

                            <td><?php echo e(optional($item->tanggal)->format('d/m/Y')); ?></td>

                            <td><?php echo e($item->lokasi); ?></td>

                            <td>
                                <span class="kader-status-badge">
                                    <?php echo e($item->status_label ?? ucfirst($item->status)); ?>

                                </span>
                            </td>

                            <td class="text-end">
                                <a href="<?php echo e(route('kader.kegiatan.show', $item)); ?>" class="kader-btn-light">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Belum ada jadwal yang ditugaskan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.kader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/kader/dashboard.blade.php ENDPATH**/ ?>