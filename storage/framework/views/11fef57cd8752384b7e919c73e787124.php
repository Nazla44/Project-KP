<?php $__env->startPush('styles'); ?>
    <style>
        .kaders-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .kaders-page-title span {
            display: block;
            margin-bottom: 6px;
            color: #64748b;
            font-size: 0.82rem;
            font-weight: 600;
        }

        .kaders-page-title h1 {
            margin: 0;
            color: #111827;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .kaders-page-title p {
            margin: 8px 0 0;
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .kaders-alert {
            border-radius: 12px;
            padding: 14px 16px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 0.92rem;
            border: 1px solid transparent;
        }

        .kaders-alert-success {
            background: #f0fdf4;
            color: #166534;
            border-color: #bbf7d0;
        }

        .kaders-alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border-color: #fecaca;
        }

        .kaders-filter-card,
        .kaders-table-card {
            background: #fff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 16px;
            overflow: hidden;
        }

        .kaders-filter-card {
            padding: 16px 18px;
            margin-bottom: 18px;
        }

        .kaders-filter-list {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .kaders-filter-pill {
            min-height: 36px;
            border-radius: 999px;
            padding: 0 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 1px solid rgba(15, 23, 42, 0.12);
            color: #475569;
            background: #fff;
            text-decoration: none;
            font-size: 0.84rem;
            font-weight: 600;
        }

        .kaders-filter-pill:hover {
            color: var(--color-primary);
            border-color: rgba(213, 0, 0, 0.25);
            background: rgba(213, 0, 0, 0.03);
        }

        .kaders-filter-pill.is-active {
            color: #fff;
            border-color: var(--color-primary);
            background: var(--color-primary);
        }

        .kaders-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 18px 20px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
            background: #fff;
        }

        .kaders-table-header h2 {
            margin: 0;
            color: #111827;
            font-size: 1.05rem;
            font-weight: 700;
        }

        .kaders-table-header p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 0.88rem;
        }

        .kaders-search-box {
            width: min(320px, 100%);
            height: 42px;
            padding: 0 12px;
            border: 1px solid rgba(15, 23, 42, 0.12);
            border-radius: 10px;
            background: #fff;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .kaders-search-box i {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .kaders-search-box .form-control {
            border: 0;
            box-shadow: none;
            padding: 0;
            height: 40px;
            background: transparent;
            font-size: 0.92rem;
        }

        .kaders-table {
            margin: 0 !important;
        }

        .kaders-table thead th {
            background: #f8fafc;
            color: #64748b;
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            white-space: nowrap;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
            padding: 13px 18px;
        }

        .kaders-table tbody td {
            padding: 15px 18px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(15, 23, 42, 0.06);
        }

        .kaders-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .kaders-table tbody tr:hover {
            background: #fafafa;
        }

        .kader-profile-cell {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 240px;
        }

        .kader-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(213, 0, 0, 0.08);
            color: var(--color-primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
        }

        .kader-profile-cell strong {
            display: block;
            color: #111827;
            font-size: 0.94rem;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .kader-profile-cell small,
        .kader-muted-text,
        .kader-date {
            color: #64748b;
            font-size: 0.85rem;
        }

        .kader-location-cell {
            min-width: 210px;
        }

        .kader-location-cell strong {
            display: block;
            color: #334155;
            font-size: 0.88rem;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .kader-location-cell small {
            display: block;
            color: #64748b;
            font-size: 0.82rem;
        }

        .kader-status-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 28px;
            padding: 0 10px;
            border-radius: 999px;
            font-size: 0.76rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .kader-status-pill span {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            flex-shrink: 0;
        }

        .kader-status-pill.is-pending {
            background: rgba(245, 158, 11, 0.12);
            color: #92400e;
        }

        .kader-status-pill.is-pending span {
            background: #f59e0b;
        }

        .kader-status-pill.is-active {
            background: rgba(22, 163, 74, 0.1);
            color: #15803d;
        }

        .kader-status-pill.is-active span {
            background: #16a34a;
        }

        .kader-status-pill.is-rejected {
            background: rgba(220, 38, 38, 0.1);
            color: #b91c1c;
        }

        .kader-status-pill.is-rejected span {
            background: #dc2626;
        }

        .kader-status-pill.is-suspend {
            background: rgba(100, 116, 139, 0.12);
            color: #475569;
        }

        .kader-status-pill.is-suspend span {
            background: #64748b;
        }

        .kaders-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            white-space: nowrap;
        }

        .kaders-icon-button {
            width: 36px;
            height: 36px;
            border: 1px solid rgba(15, 23, 42, 0.12);
            border-radius: 10px;
            background: #fff;
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .kaders-icon-button:hover {
            background: #f8fafc;
            color: var(--color-primary);
            border-color: rgba(213, 0, 0, .25);
        }

        .dataTables_wrapper .row:first-child {
            display: none;
        }

        .dataTables_wrapper .row:last-child {
            align-items: center;
            padding: 14px 18px;
            border-top: 1px solid rgba(15, 23, 42, .08);
            background: #fff;
        }

        .dataTables_info {
            color: #64748b !important;
            font-size: .86rem;
            padding-top: 0 !important;
        }

        .dataTables_paginate {
            padding-top: 0 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            border: 0 !important;
            margin: 0 2px;
            padding: .38rem .65rem !important;
            color: #475569 !important;
            font-weight: 600;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: var(--color-primary) !important;
            color: #fff !important;
        }

        @media (max-width: 767.98px) {

            .kaders-page-header,
            .kaders-table-header {
                align-items: stretch;
                flex-direction: column;
            }

            .kaders-search-box {
                width: 100%;
            }

            .kaders-table thead th,
            .kaders-table tbody td {
                padding-left: 14px;
                padding-right: 14px;
            }

            .kaders-actions {
                justify-content: flex-start;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="kaders-page-header">
        <div class="kaders-page-title">
            <span>Manajemen</span>
            <h1>Approval Kader</h1>
        </div>
    </section>

    <?php if(session('status')): ?>
        <div class="alert kaders-alert kaders-alert-success mb-3">
            <i class="bi bi-check-circle-fill"></i>
            <span><?php echo e(session('status')); ?></span>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert kaders-alert kaders-alert-danger mb-3">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <div>
                <strong>Proses belum bisa dilanjutkan.</strong>
                <ul class="mb-0 mt-2">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <section class="kaders-filter-card">
        <div class="kaders-filter-list">
            <a href="<?php echo e(route('admin.kaders.index')); ?>"
                class="kaders-filter-pill <?php echo e(blank($activeStatus) ? 'is-active' : ''); ?>">
                Semua <strong><?php echo e($kaders->count()); ?></strong>
            </a>
            <?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('admin.kaders.index', ['status' => $value])); ?>"
                    class="kaders-filter-pill <?php echo e($activeStatus === $value ? 'is-active' : ''); ?>">
                    <?php echo e($label); ?> <strong><?php echo e($statusCounts[$value] ?? 0); ?></strong>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    <section class="kaders-table-card">
        <div class="kaders-table-header">
            <div>
                <h2>Daftar Kader</h2>
                <p>Total data pada filter ini: <?php echo e($kaders->count()); ?></p>
            </div>

            <div class="kaders-search-box">
                <i class="bi bi-search"></i>
                <input type="text" id="kaders-search" class="form-control" placeholder="Cari kader...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table kaders-table align-middle mb-0" id="kaders-table">
                <thead>
                    <tr>
                        <th>Kader</th>
                        <th>Kontak</th>
                        <th>Domisili</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $kaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kader): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $initial = strtoupper(substr($kader->nama ?? 'K', 0, 1));
                            $statusClass = match ($kader->status) {
                                \App\Models\Kader::STATUS_AKTIF => 'is-active',
                                \App\Models\Kader::STATUS_DITOLAK => 'is-rejected',
                                \App\Models\Kader::STATUS_SUSPEND => 'is-suspend',
                                default => 'is-pending',
                            };
                        ?>
                        <tr>
                            <td>
                                <div class="kader-profile-cell">
                                    <span class="kader-avatar"><?php echo e($initial); ?></span>
                                    <div>
                                        <strong><?php echo e($kader->nama); ?></strong>
                                        <small>NIK: <?php echo e($kader->nik ?? '-'); ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="kader-muted-text"><?php echo e($kader->email ?? '-'); ?></div>
                                <div class="kader-muted-text"><?php echo e($kader->hp ?? '-'); ?></div>
                            </td>
                            <td>
                                <div class="kader-location-cell">
                                    <strong><?php echo e($kader->kab_kota ?? '-'); ?></strong>
                                    <small><?php echo e($kader->kecamatan ?? '-'); ?><?php echo e($kader->provinsi ? ', ' . $kader->provinsi : ''); ?></small>
                                </div>
                            </td>
                            <td data-search="<?php echo e($kader->statusLabel()); ?>" data-order="<?php echo e($kader->statusLabel()); ?>">
                                <span class="kader-status-pill <?php echo e($statusClass); ?>">
                                    <span></span><?php echo e($kader->statusLabel()); ?>

                                </span>
                            </td>
                            <td data-order="<?php echo e(optional($kader->created_at)->timestamp); ?>">
                                <span class="kader-date"><?php echo e(optional($kader->created_at)->format('d M Y') ?? '-'); ?></span>
                            </td>
                            <td>
                                <div class="kaders-actions">
                                    <a href="<?php echo e(route('admin.kaders.show', $kader)); ?>" class="kaders-icon-button"
                                        title="Lihat detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initAdminDataTable('#kaders-table', {
                searchInput: '#kaders-search',
                actionColumn: 5
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/admin/kaders/index.blade.php ENDPATH**/ ?>