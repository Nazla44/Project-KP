<?php $__env->startSection('title', 'Jadwal Sosialisasi'); ?>

<?php $__env->startSection('page_title', 'Jadwal Sosialisasi'); ?>

<?php $__env->startSection('content'); ?>
    <div class="kader-page-header">
        <div>
            <p class="kader-page-label">Jadwal</p>
            <h1>Jadwal Sosialisasi</h1>
            <p class="kader-page-desc">
                Daftar jadwal sosialisasi aktif yang ditugaskan kepada Anda oleh admin.
            </p>
        </div>

        <a href="<?php echo e(route('kader.riwayat-jadwal.index')); ?>" class="kader-btn-light">
            <i class="bi bi-clock-history"></i>
            Riwayat Jadwal
        </a>
    </div>

    <?php if($semuaKegiatan->count()): ?>
        <div class="kader-table-card">
            <div class="kader-table-head">
                <div>
                    <h2>Daftar Jadwal Aktif</h2>
                    <p>
                        Klik tombol screening untuk mulai mengisi data screening masyarakat pada jadwal yang dipilih.
                    </p>
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
                        <?php $__currentLoopData = $semuaKegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                                <td class="text-end">
                                    <a href="<?php echo e(route('kader.kegiatan.show', $item)); ?>" class="kader-btn-light">
                                        Detail
                                    </a>

                                    <a href="<?php echo e(route('kader.screening.create', $item)); ?>" class="kader-btn-red">
                                        Screening
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <?php if(method_exists($semuaKegiatan, 'links')): ?>
                <div class="kader-pagination">
                    <?php echo e($semuaKegiatan->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="kader-empty-page">
            <div class="kader-empty-page-icon">
                <i class="bi bi-calendar-event"></i>
            </div>

            <h2>Belum Ada Jadwal Sosialisasi Aktif</h2>

            <p>
                Jadwal sosialisasi akan muncul setelah admin membuat jadwal kegiatan dan memilih Anda
                sebagai kader yang bertugas. Setelah jadwal tersedia, Anda dapat membuka detail kegiatan
                dan mulai melakukan screening masyarakat.
            </p>

            <div class="kader-empty-steps">
                <div>
                    <span>1</span>
                    <strong>Admin membuat jadwal</strong>
                    <small>Admin menambahkan jadwal sosialisasi melalui dashboard admin.</small>
                </div>

                <div>
                    <span>2</span>
                    <strong>Kader ditugaskan</strong>
                    <small>Admin memilih Anda sebagai kader yang bertugas pada jadwal tersebut.</small>
                </div>

                <div>
                    <span>3</span>
                    <strong>Screening masyarakat</strong>
                    <small>Jadwal akan muncul di sini dan Anda dapat mulai mengisi form screening.</small>
                </div>
            </div>

            <div class="kader-empty-actions">
                <a href="<?php echo e(route('kader.dashboard')); ?>" class="kader-btn-red">
                    <i class="bi bi-grid-1x2-fill"></i>
                    Kembali ke Dashboard
                </a>

                <a href="<?php echo e(route('kader.riwayat-jadwal.index')); ?>" class="kader-btn-light">
                    <i class="bi bi-clock-history"></i>
                    Lihat Riwayat Jadwal
                </a>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.kader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/kader/jadwal.blade.php ENDPATH**/ ?>