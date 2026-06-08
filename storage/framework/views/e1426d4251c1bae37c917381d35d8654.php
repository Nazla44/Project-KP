<?php $__env->startSection('title', 'Detail Kegiatan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-3">
        <a href="<?php echo e(route('kader.dashboard')); ?>" class="text-decoration-none text-muted">
            <i class="bi bi-arrow-left"></i>
            Kembali ke dashboard
        </a>
    </div>

    <div class="kader-card p-4 mb-4">
        <span class="badge kader-badge-red mb-3"><?php echo e($kegiatan->status_label); ?></span>

        <h1 class="h3 fw-bold mb-2"><?php echo e($kegiatan->judul); ?></h1>

        <div class="text-muted mb-2">
            <i class="bi bi-calendar-event"></i>
            <?php echo e($kegiatan->tanggal->format('d M Y')); ?>


            <?php if($kegiatan->jam_mulai): ?>
                · <?php echo e(substr($kegiatan->jam_mulai, 0, 5)); ?>

            <?php endif; ?>

            <?php if($kegiatan->jam_selesai): ?>
                - <?php echo e(substr($kegiatan->jam_selesai, 0, 5)); ?>

            <?php endif; ?>
        </div>

        <div class="text-muted mb-3">
            <i class="bi bi-geo-alt"></i>
            <?php echo e($kegiatan->lokasi); ?>

        </div>

        <p class="mb-4"><?php echo e($kegiatan->deskripsi); ?></p>

        <a href="<?php echo e(route('kader.screening.create', $kegiatan)); ?>" class="btn kader-btn-primary">
            <i class="bi bi-clipboard2-pulse"></i>
            Mulai / Lanjut Screening
        </a>
    </div>

    <div class="kader-card p-4">
        <h2 class="h5 fw-bold mb-3">Sesi Screening Saya</h2>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Warga Diperiksa</th>
                        <th>Rendah</th>
                        <th>Sedang</th>
                        <th>Tinggi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $kegiatan->screeningSessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($session->tanggal_sesi->format('d/m/Y')); ?></td>

                            <td>
                                <span class="badge <?php echo e($session->status === 'selesai' ? 'text-bg-success' : 'text-bg-warning'); ?>">
                                    <?php echo e(ucfirst($session->status)); ?>

                                </span>
                            </td>

                            <td><?php echo e($session->total_diperiksa); ?></td>
                            <td><?php echo e($session->total_rendah); ?></td>
                            <td><?php echo e($session->total_sedang); ?></td>
                            <td><?php echo e($session->total_tinggi); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada sesi screening untuk kegiatan ini.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.kader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/kader/kegiatan-show.blade.php ENDPATH**/ ?>