<?php $__env->startSection('content'); ?>
    <div class="admin-page-header">
        <div>
            <div class="admin-page-subtitle">Fase 5</div>
            <h1>Laporan Dashboard Admin</h1>
            <p>
                Ringkasan kegiatan sosialisasi, hasil screening warga, dan rekap laporan kader.
            </p>
        </div>

        <a href="<?php echo e(route('admin.reports.overview.export', request()->query())); ?>" class="admin-primary-button">
            <i class="bi bi-download"></i>
            Export CSV
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-md-3">
            <div class="admin-stat-card">
                <div class="admin-stat-icon">
                    <i class="bi bi-calendar-event"></i>
                </div>
                <div>
                    <span>Total Kegiatan</span>
                    <strong><?php echo e($summary['total_kegiatan']); ?></strong>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="admin-stat-card">
                <div class="admin-stat-icon">
                    <i class="bi bi-clipboard2-pulse"></i>
                </div>
                <div>
                    <span>Total Screening</span>
                    <strong><?php echo e($summary['total_screening']); ?></strong>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-2">
            <div class="admin-stat-card">
                <div>
                    <span>Risiko Rendah</span>
                    <strong><?php echo e($summary['risiko_rendah']); ?></strong>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-2">
            <div class="admin-stat-card">
                <div>
                    <span>Risiko Sedang</span>
                    <strong><?php echo e($summary['risiko_sedang']); ?></strong>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-2">
            <div class="admin-stat-card">
                <div>
                    <span>Risiko Tinggi</span>
                    <strong><?php echo e($summary['risiko_tinggi']); ?></strong>
                </div>
            </div>
        </div>
    </div>

    <form method="GET" class="admin-filter-card mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-12 col-md-3">
                <label class="form-label">Cari Kegiatan / Lokasi</label>
                <input type="text" name="q" value="<?php echo e(request('q')); ?>" class="form-control" placeholder="Cari...">
            </div>

            <div class="col-12 col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua</option>
                    <option value="draft" <?php if(request('status') === 'draft'): echo 'selected'; endif; ?>>Draft</option>
                    <option value="published" <?php if(request('status') === 'published'): echo 'selected'; endif; ?>>Akan Datang</option>
                    <option value="ongoing" <?php if(request('status') === 'ongoing'): echo 'selected'; endif; ?>>Berlangsung</option>
                    <option value="completed" <?php if(request('status') === 'completed'): echo 'selected'; endif; ?>>Selesai</option>
                    <option value="cancelled" <?php if(request('status') === 'cancelled'): echo 'selected'; endif; ?>>Dibatalkan</option>
                </select>
            </div>

            <div class="col-12 col-md-2">
                <label class="form-label">Dari</label>
                <input type="date" name="from" value="<?php echo e(request('from')); ?>" class="form-control">
            </div>

            <div class="col-12 col-md-2">
                <label class="form-label">Sampai</label>
                <input type="date" name="to" value="<?php echo e(request('to')); ?>" class="form-control">
            </div>

            <div class="col-12 col-md-3 d-flex gap-2">
                <button type="submit" class="admin-primary-button">
                    Filter
                </button>

                <a href="<?php echo e(route('admin.reports.overview')); ?>" class="admin-secondary-button">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <div class="admin-table-card">
        <div class="admin-table-header">
            <div>
                <h2>Rekap Kegiatan Sosialisasi</h2>
                <p>Data berasal dari rekap yang diisi kader dan hasil screening warga.</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table admin-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Peserta</th>
                        <th>Materi</th>
                        <th>Foto</th>
                        <th>Sesi Screening</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $kegiatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <strong><?php echo e($item->judul); ?></strong>
                                <div class="text-muted small">
                                    <?php echo e($item->ringkasan ? 'Sudah direkap' : 'Belum direkap'); ?>

                                </div>
                            </td>

                            <td><?php echo e(optional($item->tanggal)->format('d M Y') ?? '-'); ?></td>
                            <td><?php echo e($item->lokasi ?? '-'); ?></td>

                            <td>
                                <span class="badge text-bg-light">
                                    <?php echo e($item->status_label ?? ucfirst($item->status)); ?>

                                </span>
                            </td>

                            <td><?php echo e($item->ringkasan?->jumlah_peserta ?? 0); ?></td>
                            <td><?php echo e($item->ringkasan?->jumlah_materi ?? 0); ?></td>
                            <td><?php echo e($item->dokumentasi_count ?? 0); ?></td>
                            <td><?php echo e($item->screening_sessions_count ?? 0); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                Belum ada laporan kegiatan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="admin-table-footer">
            <?php echo e($kegiatans->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/admin/reports/overview.blade.php ENDPATH**/ ?>