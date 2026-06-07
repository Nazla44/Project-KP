<?php $__env->startSection('title', 'Jadwal Sosialisasi'); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $items = $kegiatans ?? $kegiatanList ?? $kegiatan ?? collect();
    ?>

    <div class="admin-page-header">
        <div>
            <p class="admin-page-label">Manajemen</p>
            <h1 class="admin-page-title">Jadwal Sosialisasi</h1>
        </div>

        <a href="<?php echo e(route('admin.kegiatan-sosial.create')); ?>" class="admin-primary-button">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Kegiatan</span>
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger mb-4">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="admin-table-card">
        <div class="admin-table-card-head">
            <div>
                <h2>Daftar Jadwal</h2>
                <p>Data jadwal sosialisasi yang ditampilkan pada dashboard admin.</p>
            </div>

            <form method="GET" action="<?php echo e(route('admin.kegiatan-sosial.index')); ?>" class="admin-filter-form">
                <div class="admin-search-box">
                    <i class="bi bi-search"></i>
                    <input
                        type="text"
                        name="q"
                        value="<?php echo e(request('q')); ?>"
                        placeholder="Cari judul kegiatan..."
                    >
                </div>

                <select name="status" class="admin-filter-select">
                    <option value="">Semua Status</option>
                    <option value="draft" <?php if(request('status') === 'draft'): echo 'selected'; endif; ?>>Draft</option>
                    <option value="published" <?php if(request('status') === 'published'): echo 'selected'; endif; ?>>Published</option>
                    <option value="ongoing" <?php if(request('status') === 'ongoing'): echo 'selected'; endif; ?>>Berlangsung</option>
                    <option value="completed" <?php if(request('status') === 'completed'): echo 'selected'; endif; ?>>Selesai</option>
                    <option value="cancelled" <?php if(request('status') === 'cancelled'): echo 'selected'; endif; ?>>Dibatalkan</option>
                </select>

                <button type="submit" class="admin-filter-button">
                    Filter
                </button>

                <?php if(request('q') || request('status')): ?>
                    <a href="<?php echo e(route('admin.kegiatan-sosial.index')); ?>" class="admin-reset-button">
                        Reset
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table admin-data-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Kader</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div class="admin-table-title">
                                    <?php echo e($item->judul); ?>

                                </div>

                                <div class="admin-table-subtitle">
                                    <?php echo e(\Illuminate\Support\Str::limit(strip_tags($item->deskripsi ?? '-'), 70)); ?>

                                </div>
                            </td>

                            <td>
                                <div class="admin-date-main">
                                    <?php echo e(optional($item->tanggal)->format('d M Y')); ?>

                                </div>

                                <div class="admin-date-sub">
                                    <?php if($item->jam_mulai): ?>
                                        <?php echo e(substr($item->jam_mulai, 0, 5)); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>

                                    <?php if($item->jam_selesai): ?>
                                        - <?php echo e(substr($item->jam_selesai, 0, 5)); ?>

                                    <?php endif; ?>
                                </div>
                            </td>

                            <td>
                                <div class="admin-location-text">
                                    <i class="bi bi-geo-alt"></i>
                                    <span><?php echo e($item->lokasi); ?></span>
                                </div>
                            </td>

                            <td>
                                <?php
                                    $status = $item->status ?? 'draft';

                                    $statusClass = match ($status) {
                                        'published' => 'published',
                                        'ongoing' => 'ongoing',
                                        'completed' => 'completed',
                                        'cancelled' => 'cancelled',
                                        default => 'draft',
                                    };

                                    $statusLabel = $item->status_label ?? match ($status) {
                                        'published' => 'Published',
                                        'ongoing' => 'Berlangsung',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                        default => 'Draft',
                                    };
                                ?>

                                <span class="admin-status-badge <?php echo e($statusClass); ?>">
                                    <?php echo e($statusLabel); ?>

                                </span>
                            </td>

                            <td>
                                <?php if(isset($item->kaders) && $item->kaders->count()): ?>
                                    <div class="admin-kader-stack">
                                        <?php $__currentLoopData = $item->kaders->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kader): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="admin-kader-pill">
                                                <?php echo e($kader->nama); ?>

                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php if($item->kaders->count() > 3): ?>
                                            <span class="admin-kader-more">
                                                +<?php echo e($item->kaders->count() - 3); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-muted small">Belum dipilih</span>
                                <?php endif; ?>
                            </td>

                            <td class="text-end">
                                <div class="admin-action-group">
                                    <a href="<?php echo e(route('admin.kegiatan-sosial.show', $item)); ?>" class="admin-action-button view">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="<?php echo e(route('admin.kegiatan-sosial.edit', $item)); ?>" class="admin-action-button edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form
                                        method="POST"
                                        action="<?php echo e(route('admin.kegiatan-sosial.destroy', $item)); ?>"
                                        class="d-inline js-confirm-delete"
                                        data-title="Hapus jadwal sosialisasi?"
                                        data-text="Jadwal ini akan dihapus dari dashboard admin dan kader."
                                        data-confirm="Ya, hapus"
                                    >
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button type="submit" class="admin-action-button delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6">
                                <div class="admin-empty-state">
                                    <div class="admin-empty-icon">
                                        <i class="bi bi-calendar-x"></i>
                                    </div>

                                    <h3>Belum ada kegiatan sosial.</h3>

                                    <p>
                                        Tambahkan jadwal sosialisasi pertama agar kader dapat melihat jadwal dan melakukan screening masyarakat.
                                    </p>

                                    <a href="<?php echo e(route('admin.kegiatan-sosial.create')); ?>" class="admin-primary-button">
                                        <i class="bi bi-plus-lg"></i>
                                        <span>Tambah Kegiatan</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if(method_exists($items, 'links')): ?>
            <div class="admin-table-footer">
                <div class="admin-pagination-info">
                    Menampilkan data jadwal sosialisasi.
                </div>

                <div>
                    <?php echo e($items->links()); ?>

                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/admin/kegiatan/index.blade.php ENDPATH**/ ?>