<?php $__env->startSection('title', 'Riwayat Jadwal Sosialisasi'); ?>

<?php $__env->startSection('page_title', 'Riwayat Jadwal'); ?>

<?php $__env->startSection('content'); ?>
    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Riwayat</p>
            <h1>Riwayat Jadwal Sosialisasi</h1>
            <p class="kader-page-desc">
                Daftar seluruh jadwal sosialisasi yang pernah ditugaskan kepada Anda.
            </p>
        </div>

        <a href="<?php echo e(route('kader.jadwal.index')); ?>" class="kader-btn-light">
            <i class="bi bi-calendar-event"></i>
            Jadwal Aktif
        </a>
    </div>

    <?php if($kegiatans->count()): ?>
        <div class="kader-table-card">
            <div class="kader-table-head">
                <div>
                    <h2>Daftar Riwayat Jadwal</h2>
                    <p>Jadwal sosialisasi yang ditugaskan oleh admin kepada kader.</p>
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
                            <th>Total Screening</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $totalScreening = 0;

                                if (isset($item->screeningSessions)) {
                                    $totalScreening = $item->screeningSessions->sum('results_count');
                                }
                            ?>

                            <tr>
                                <td>
                                    <strong><?php echo e($item->judul); ?></strong>

                                    <div class="text-muted small">
                                        <?php echo e(\Illuminate\Support\Str::limit(strip_tags($item->deskripsi ?? '-'), 70)); ?>

                                    </div>
                                </td>

                                <td>
                                    <?php echo e(optional($item->tanggal)->format('d M Y') ?? '-'); ?>


                                    <?php if($item->jam_mulai): ?>
                                        <div class="text-muted small">
                                            <?php echo e(substr($item->jam_mulai, 0, 5)); ?>


                                            <?php if($item->jam_selesai): ?>
                                                - <?php echo e(substr($item->jam_selesai, 0, 5)); ?>

                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </td>

                                <td><?php echo e($item->lokasi ?? '-'); ?></td>

                                <td>
                                    <span class="kader-status-badge">
                                        <?php echo e($item->status_label ?? ucfirst($item->status ?? 'draft')); ?>

                                    </span>
                                </td>

                                <td>
                                    <strong><?php echo e($totalScreening); ?></strong>
                                    <span class="text-muted small">warga</span>
                                </td>

                                <td class="text-end">
                                    <div class="kader-table-actions">
                                        <a href="<?php echo e(route('kader.kegiatan.show', $item)); ?>" class="kader-btn-light">
                                            Detail
                                        </a>

                                        <a href="<?php echo e(route('kader.riwayat-screening.show', $item)); ?>" class="kader-btn-red">
                                            Riwayat Screening
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <?php if(method_exists($kegiatans, 'links')): ?>
                <div class="kader-pagination">
                    <?php echo e($kegiatans->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="kader-empty-page">
            <div class="kader-empty-page-icon">
                <i class="bi bi-calendar-x"></i>
            </div>

            <h2>Belum Ada Riwayat Jadwal</h2>

            <p>
                Riwayat jadwal sosialisasi akan muncul setelah admin membuat jadwal dan memilih Anda
                sebagai kader yang bertugas pada kegiatan tersebut.
            </p>

            <div class="kader-empty-steps">
                <div>
                    <span>1</span>
                    <strong>Admin membuat jadwal</strong>
                    <small>Admin menambahkan jadwal sosialisasi melalui dashboard admin.</small>
                </div>

                <div>
                    <span>2</span>
                    <strong>Admin memilih kader</strong>
                    <small>Nama Anda dipilih sebagai kader yang bertugas pada wilayah atau kegiatan tersebut.</small>
                </div>

                <div>
                    <span>3</span>
                    <strong>Jadwal masuk riwayat</strong>
                    <small>Jadwal yang ditugaskan akan muncul di halaman ini beserta total screening.</small>
                </div>
            </div>

            <div class="kader-empty-actions">
                <a href="<?php echo e(route('kader.jadwal.index')); ?>" class="kader-btn-red">
                    <i class="bi bi-calendar-event"></i>
                    Cek Jadwal Aktif
                </a>

                <a href="<?php echo e(route('kader.dashboard')); ?>" class="kader-btn-light">
                    <i class="bi bi-grid-1x2-fill"></i>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.kader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/kader/riwayat-jadwal.blade.php ENDPATH**/ ?>