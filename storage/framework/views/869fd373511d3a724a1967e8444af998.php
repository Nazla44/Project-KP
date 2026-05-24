<?php $__env->startPush('styles'); ?>
    <style>
        .clinics-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .clinics-page-title span {
            display: block;
            margin-bottom: 6px;
            color: #64748b;
            font-size: 0.82rem;
            font-weight: 600;
        }

        .clinics-page-title h1 {
            margin: 0;
            color: #111827;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .clinics-page-title p {
            margin: 8px 0 0;
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .clinics-page-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .clinics-action-button {
            min-height: 42px;
            border-radius: 10px;
            padding: 0 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.92rem;
            font-weight: 600;
        }

        .clinics-alert {
            border-radius: 12px;
            padding: 14px 16px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 0.92rem;
            border: 1px solid transparent;
        }

        .clinics-alert-success {
            background: #f0fdf4;
            color: #166534;
            border-color: #bbf7d0;
        }

        .clinics-alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border-color: #fecaca;
        }

        .clinics-preview-card,
        .clinics-table-card {
            background: #fff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 16px;
            overflow: hidden;
        }

        .clinics-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 18px 20px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
            background: #fff;
        }

        .clinics-table-header h2 {
            margin: 0;
            color: #111827;
            font-size: 1.05rem;
            font-weight: 700;
        }

        .clinics-table-header p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 0.88rem;
        }

        .clinics-search-box {
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

        .clinics-search-box i {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .clinics-search-box .form-control {
            border: 0;
            box-shadow: none;
            padding: 0;
            height: 40px;
            background: transparent;
            font-size: 0.92rem;
        }

        .clinics-table {
            margin: 0 !important;
        }

        .clinics-table thead th {
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

        .clinics-table tbody td {
            padding: 15px 18px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(15, 23, 42, 0.06);
        }

        .clinics-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .clinics-table tbody tr:hover {
            background: #fafafa;
        }

        .clinic-main-cell {
            min-width: 260px;
        }

        .clinic-main-cell strong {
            display: block;
            color: #111827;
            font-size: 0.94rem;
            font-weight: 700;
            margin-bottom: 2px;
            line-height: 1.35;
        }

        .clinic-main-cell small {
            display: block;
            color: #64748b;
            font-size: 0.82rem;
            line-height: 1.35;
        }

        .clinic-location-cell {
            min-width: 240px;
        }

        .clinic-location-cell strong {
            display: block;
            color: #334155;
            font-size: 0.88rem;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .clinic-location-cell small {
            display: block;
            color: #64748b;
            font-size: 0.82rem;
            max-width: 340px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .clinic-muted-text,
        .clinic-operation-text {
            color: #64748b;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .clinic-operation-text strong {
            color: #334155;
            font-weight: 600;
        }

        .clinic-type-pill,
        .clinic-status-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 28px;
            padding: 0 10px;
            border-radius: 999px;
            font-size: 0.76rem;
            font-weight: 600;
            text-transform: capitalize;
            white-space: nowrap;
        }

        .clinic-type-pill {
            background: rgba(0, 51, 102, 0.08);
            color: #003366;
        }

        .clinic-status-pill {
            gap: 7px;
        }

        .clinic-status-pill span {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            flex-shrink: 0;
        }

        .clinic-status-pill.is-active {
            background: rgba(22, 163, 74, 0.1);
            color: #15803d;
        }

        .clinic-status-pill.is-active span {
            background: #16a34a;
        }

        .clinic-status-pill.is-inactive {
            background: rgba(100, 116, 139, 0.12);
            color: #475569;
        }

        .clinic-status-pill.is-inactive span {
            background: #64748b;
        }

        .clinics-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            white-space: nowrap;
        }

        .clinics-icon-button {
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

        .clinics-icon-button:hover {
            background: #f8fafc;
            color: var(--color-primary);
            border-color: rgba(213, 0, 0, 0.25);
        }

        .clinics-icon-button-danger:hover {
            color: #dc2626;
            border-color: rgba(220, 38, 38, 0.25);
        }

        .clinic-modal .modal-content {
            border: 0;
            border-radius: 14px;
        }

        .clinic-modal .modal-header {
            padding: 22px 24px 14px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
        }

        .clinic-modal-title h5 {
            margin: 0;
            color: #111827;
            font-size: 1.12rem;
            font-weight: 700;
        }

        .clinic-modal-title p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 0.88rem;
        }

        .clinic-modal .modal-body {
            padding: 20px 24px;
        }

        .clinic-modal .modal-footer {
            padding: 16px 24px 22px;
            border-top: 1px solid rgba(15, 23, 42, 0.08);
            gap: 8px;
        }

        .clinic-form-group label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 0.86rem;
            font-weight: 600;
        }

        .clinic-form-group .form-control,
        .clinic-form-group .form-select {
            min-height: 42px;
            border-radius: 10px;
            border-color: rgba(15, 23, 42, 0.14);
            font-size: 0.92rem;
        }

        .clinic-form-group textarea.form-control {
            resize: vertical;
        }

        .clinic-form-group .form-control:focus,
        .clinic-form-group .form-select:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 0.18rem rgba(213, 0, 0, 0.12);
        }

        .clinic-form-help {
            margin-top: 6px;
            color: #94a3b8;
            font-size: 0.78rem;
        }

        .clinic-modal-button {
            min-height: 40px;
            border-radius: 10px;
            padding: 0 16px;
            font-weight: 600;
        }

        .clinic-preview-summary {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin-top: 14px;
        }

        .clinic-preview-item {
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 12px;
            padding: 14px;
            background: #fff;
        }

        .clinic-preview-item span {
            display: block;
            color: #64748b;
            font-size: 0.8rem;
            margin-bottom: 4px;
        }

        .clinic-preview-item strong {
            display: block;
            color: #111827;
            font-size: 1.3rem;
            font-weight: 700;
        }

        .clinic-import-history {
            margin-top: 20px;
        }

        .dataTables_wrapper .row:first-child {
            display: none;
        }

        .dataTables_wrapper .row:last-child {
            align-items: center;
            padding: 14px 18px;
            border-top: 1px solid rgba(15, 23, 42, 0.08);
            background: #fff;
        }

        .dataTables_info {
            color: #64748b !important;
            font-size: 0.86rem;
            padding-top: 0 !important;
        }

        .dataTables_paginate {
            padding-top: 0 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px !important;
            border: 0 !important;
            margin: 0 2px;
            padding: 0.38rem 0.65rem !important;
            color: #475569 !important;
            font-weight: 600;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: var(--color-primary) !important;
            color: #fff !important;
        }

        @media (max-width: 991.98px) {
            .clinic-preview-summary {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 767.98px) {
            .clinics-page-header {
                align-items: stretch;
                flex-direction: column;
            }

            .clinics-page-actions {
                width: 100%;
            }

            .clinics-action-button {
                width: 100%;
            }

            .clinics-table-header {
                align-items: stretch;
                flex-direction: column;
            }

            .clinics-search-box {
                width: 100%;
            }

            .clinics-table thead th,
            .clinics-table tbody td {
                padding-left: 14px;
                padding-right: 14px;
            }

            .clinics-actions {
                justify-content: flex-start;
            }

            .clinic-preview-summary {
                grid-template-columns: 1fr;
            }

            .clinic-modal .modal-header,
            .clinic-modal .modal-body,
            .clinic-modal .modal-footer {
                padding-left: 18px;
                padding-right: 18px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $preview = session('import_preview');
    ?>

    <section class="clinics-page-header">
        <div class="clinics-page-title">
            <span>Manajemen</span>
            <h1><?php echo e($pageTitle ?? 'Kelola Klinik'); ?></h1>
        </div>

        <div class="clinics-page-actions">
            <button type="button" class="btn btn-light clinics-action-button" data-bs-toggle="modal"
                data-bs-target="#importKlinikModal">
                <i class="bi bi-upload"></i>
                <span>Import CSV</span>
            </button>

            <button type="button" class="btn btn-danger clinics-action-button" data-bs-toggle="modal"
                data-bs-target="#createKlinikModal">
                <i class="bi bi-plus-lg"></i>
                <span>Tambah Klinik</span>
            </button>
        </div>
    </section>

    <?php if(session('status')): ?>
        <div class="alert clinics-alert clinics-alert-success mb-0">
            <i class="bi bi-check-circle-fill"></i>
            <span><?php echo e(session('status')); ?></span>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert clinics-alert clinics-alert-danger mb-0">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <div>
                <strong>Proses belum berhasil.</strong>
                <ul class="mb-0 mt-2">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <?php if($preview): ?>
        <section class="clinics-preview-card">
            <div class="clinics-table-header">
                <div>
                    <h2>Preview Import CSV</h2>
                    <p><?php echo e($preview['filename'] ?? 'File CSV'); ?></p>
                </div>

                <span class="clinic-status-pill <?php echo e(($preview['invalid_rows'] ?? 0) > 0 ? 'is-inactive' : 'is-active'); ?>">
                    <span></span>
                    <?php echo e(($preview['invalid_rows'] ?? 0) > 0 ? 'Perlu Perbaikan' : 'Siap Import'); ?>

                </span>
            </div>

            <div class="p-3 p-md-4">
                <div class="clinic-preview-summary">
                    <div class="clinic-preview-item">
                        <span>Total Baris</span>
                        <strong><?php echo e($preview['total_rows'] ?? 0); ?></strong>
                    </div>

                    <div class="clinic-preview-item">
                        <span>Valid</span>
                        <strong><?php echo e($preview['valid_rows'] ?? 0); ?></strong>
                    </div>

                    <div class="clinic-preview-item">
                        <span>Invalid</span>
                        <strong><?php echo e($preview['invalid_rows'] ?? 0); ?></strong>
                    </div>

                    <div class="clinic-preview-item">
                        <span>Import ID</span>
                        <strong><?php echo e($preview['import_id'] ?? '-'); ?></strong>
                    </div>
                </div>

                <?php if(!empty($preview['invalid_items'])): ?>
                    <div class="table-responsive mt-3">
                        <table class="table table-sm align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Baris</th>
                                    <th>Error</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $preview['invalid_items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($item['row_number']); ?></td>
                                        <td><?php echo e(implode(' | ', $item['errors'] ?? [])); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

                <?php if(($preview['invalid_rows'] ?? 0) === 0 && !empty($preview['import_id'])): ?>
                    <form method="POST" action="<?php echo e(route('admin.kliniks.import.commit')); ?>" class="mt-3">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="import_id" value="<?php echo e($preview['import_id']); ?>">

                        <button type="submit" class="btn btn-success clinics-action-button">
                            <i class="bi bi-database-check"></i>
                            <span>Commit Import</span>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <section class="clinics-table-card">
        <div class="clinics-table-header">
            <div>
                <h2>Daftar Klinik</h2>
            </div>

            <div class="clinics-search-box">
                <i class="bi bi-search"></i>
                <input type="text" id="kliniks-search" class="form-control" placeholder="Cari klinik...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table clinics-table align-middle mb-0" id="kliniks-table">
                <thead>
                    <tr>
                        <th>Klinik</th>
                        <th>Lokasi</th>
                        <th>Kontak</th>
                        <th>Operasional</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $kliniks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $klinik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $isActive = $klinik->status === 'aktif';
                            $statusText = $isActive ? 'Aktif' : 'Nonaktif';
                            $layananText = implode(', ', $klinik->layanan ?? []);
                            $operasionalJam = trim(($klinik->jam_buka ?: '-') . ' - ' . ($klinik->jam_tutup ?: '-'));
                            $operasionalHari = trim(
                                ($klinik->hari_buka ?: '-') . ' / Tutup: ' . ($klinik->hari_tutup ?: '-'),
                            );
                        ?>

                        <tr>
                            <td>
                                <div class="clinic-main-cell">
                                    <strong><?php echo e($klinik->nama); ?></strong>
                                    <small><?php echo e($klinik->tipe); ?></small>

                                    <?php if($layananText): ?>
                                        <small class="mt-1"><?php echo e($layananText); ?></small>
                                    <?php endif; ?>
                                </div>
                            </td>

                            <td>
                                <div class="clinic-location-cell">
                                    <strong><?php echo e($klinik->kota); ?>, <?php echo e($klinik->provinsi); ?></strong>
                                    <small><?php echo e($klinik->alamat); ?></small>
                                    <small><?php echo e($klinik->latitude); ?>, <?php echo e($klinik->longitude); ?></small>
                                </div>
                            </td>

                            <td>
                                <span class="clinic-muted-text">
                                    <?php echo e($klinik->telepon ?: '-'); ?>

                                </span>
                            </td>

                            <td>
                                <div class="clinic-operation-text">
                                    <strong><?php echo e($operasionalJam); ?></strong>
                                </div>
                                <div class="clinic-operation-text">
                                    <?php echo e($operasionalHari); ?>

                                </div>
                            </td>

                            <td data-search="<?php echo e($statusText); ?>" data-order="<?php echo e($statusText); ?>">
                                <span class="clinic-status-pill <?php echo e($isActive ? 'is-active' : 'is-inactive'); ?>">
                                    <span></span>
                                    <?php echo e($statusText); ?>

                                </span>
                            </td>

                            <td>
                                <div class="clinics-actions">
                                    <button type="button" class="clinics-icon-button" title="Edit klinik"
                                        data-bs-toggle="modal" data-bs-target="#editKlinikModal-<?php echo e($klinik->id); ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <form method="POST" action="<?php echo e(route('admin.kliniks.destroy', $klinik)); ?>"
                                        onsubmit="return confirm('Hapus klinik ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button type="submit" class="clinics-icon-button clinics-icon-button-danger"
                                            title="Hapus klinik">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="clinics-table-card clinic-import-history">
        <div class="clinics-table-header">
            <div>
                <h2>Riwayat Import Terbaru</h2>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table clinics-table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>File</th>
                        <th>Status</th>
                        <th>Ringkasan</th>
                        <th>Pengunggah</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $recentImports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $import): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <span class="clinic-muted-text">
                                    <?php echo e(optional($import->created_at)->format('d M Y H:i')); ?>

                                </span>
                            </td>
                            <td>
                                <strong><?php echo e($import->original_filename); ?></strong>
                            </td>
                            <td>
                                <span
                                    class="clinic-status-pill <?php echo e($import->status === 'imported' ? 'is-active' : 'is-inactive'); ?>">
                                    <span></span>
                                    <?php echo e(ucfirst($import->status)); ?>

                                </span>
                            </td>
                            <td>
                                <span class="clinic-muted-text">
                                    <?php echo e($import->valid_rows); ?>/<?php echo e($import->total_rows); ?> valid
                                </span>
                            </td>
                            <td>
                                <span class="clinic-muted-text">
                                    <?php echo e($import->user?->name ?: '-'); ?>

                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-muted">
                                Belum ada riwayat import.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    
    <div class="modal fade clinic-modal" id="createKlinikModal" tabindex="-1" aria-labelledby="createKlinikModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="clinic-modal-title">
                        <h5 id="createKlinikModalLabel">Tambah Klinik</h5>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <form method="POST" action="<?php echo e(route('admin.kliniks.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="_modal" value="create">

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="clinic-form-group">
                                    <label for="create-nama">Nama Klinik</label>
                                    <input type="text" id="create-nama" name="nama" class="form-control"
                                        value="<?php echo e(old('_modal') === 'create' ? old('nama') : ''); ?>"
                                        placeholder="Masukkan nama klinik" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="clinic-form-group">
                                    <label for="create-tipe">Tipe</label>
                                    <input type="text" id="create-tipe" name="tipe" class="form-control"
                                        value="<?php echo e(old('_modal') === 'create' ? old('tipe') : ''); ?>"
                                        placeholder="Contoh: Klinik, Puskesmas" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="clinic-form-group">
                                    <label for="create-kota">Kota</label>
                                    <input type="text" id="create-kota" name="kota" class="form-control"
                                        value="<?php echo e(old('_modal') === 'create' ? old('kota') : ''); ?>" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="clinic-form-group">
                                    <label for="create-provinsi">Provinsi</label>
                                    <input type="text" id="create-provinsi" name="provinsi" class="form-control"
                                        value="<?php echo e(old('_modal') === 'create' ? old('provinsi') : ''); ?>" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="clinic-form-group">
                                    <label for="create-alamat">Alamat</label>
                                    <textarea id="create-alamat" name="alamat" class="form-control" rows="2"
                                        placeholder="Masukkan alamat lengkap klinik" required><?php echo e(old('_modal') === 'create' ? old('alamat') : ''); ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="clinic-form-group">
                                    <label for="create-telepon">Telepon</label>
                                    <input type="text" id="create-telepon" name="telepon" class="form-control"
                                        value="<?php echo e(old('_modal') === 'create' ? old('telepon') : ''); ?>"
                                        placeholder="Opsional">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="clinic-form-group">
                                    <label for="create-latitude">Latitude</label>
                                    <input type="number" step="0.0000001" id="create-latitude" name="latitude"
                                        class="form-control"
                                        value="<?php echo e(old('_modal') === 'create' ? old('latitude') : ''); ?>" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="clinic-form-group">
                                    <label for="create-longitude">Longitude</label>
                                    <input type="number" step="0.0000001" id="create-longitude" name="longitude"
                                        class="form-control"
                                        value="<?php echo e(old('_modal') === 'create' ? old('longitude') : ''); ?>" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="clinic-form-group">
                                    <label for="create-jam-buka">Jam Buka</label>
                                    <input type="time" id="create-jam-buka" name="jam_buka" class="form-control"
                                        value="<?php echo e(old('_modal') === 'create' ? old('jam_buka') : ''); ?>">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="clinic-form-group">
                                    <label for="create-jam-tutup">Jam Tutup</label>
                                    <input type="time" id="create-jam-tutup" name="jam_tutup" class="form-control"
                                        value="<?php echo e(old('_modal') === 'create' ? old('jam_tutup') : ''); ?>">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="clinic-form-group">
                                    <label for="create-hari-buka">Hari Buka</label>
                                    <input type="text" id="create-hari-buka" name="hari_buka" class="form-control"
                                        value="<?php echo e(old('_modal') === 'create' ? old('hari_buka') : ''); ?>"
                                        placeholder="Senin - Jumat">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="clinic-form-group">
                                    <label for="create-hari-tutup">Hari Tutup</label>
                                    <input type="text" id="create-hari-tutup" name="hari_tutup" class="form-control"
                                        value="<?php echo e(old('_modal') === 'create' ? old('hari_tutup') : ''); ?>"
                                        placeholder="Sabtu, Minggu">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="clinic-form-group">
                                    <label for="create-layanan">Layanan</label>
                                    <textarea id="create-layanan" name="layanan" class="form-control" rows="2"
                                        placeholder="Pisahkan dengan koma atau baris baru"><?php echo e(old('_modal') === 'create' ? old('layanan') : ''); ?></textarea>
                                    <div class="clinic-form-help">
                                        Contoh: Skrining TBC, Konsultasi, Pemeriksaan Dahak
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="clinic-form-group">
                                    <label for="create-status">Status</label>
                                    <select id="create-status" name="status" class="form-select" required>
                                        <option value="aktif" <?php if(old('_modal') !== 'create' || old('status', 'aktif') === 'aktif'): echo 'selected'; endif; ?>>
                                            Aktif
                                        </option>
                                        <option value="nonaktif" <?php if(old('_modal') === 'create' && old('status') === 'nonaktif'): echo 'selected'; endif; ?>>
                                            Nonaktif
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light clinic-modal-button" data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-danger clinic-modal-button">
                            Simpan Klinik
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal fade clinic-modal" id="importKlinikModal" tabindex="-1" aria-labelledby="importKlinikModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="clinic-modal-title">
                        <h5 id="importKlinikModalLabel">Import Klinik CSV</h5>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <form method="POST" action="<?php echo e(route('admin.kliniks.import.preview')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="_modal" value="import">

                    <div class="modal-body">
                        <div class="clinic-form-group">
                            <label for="clinic-import-file">File CSV</label>
                            <input type="file" id="clinic-import-file" name="file" class="form-control"
                                accept=".csv,.txt" required>

                            <div class="clinic-form-help">
                                Header wajib: nama, tipe, alamat, kota, provinsi, telepon, latitude, longitude,
                                jam_buka, jam_tutup, hari_buka, hari_tutup, layanan, status.
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light clinic-modal-button" data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-danger clinic-modal-button">
                            Preview Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <?php $__currentLoopData = $kliniks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $klinik): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $isOldEditKlinik = old('_modal') === 'edit' && (int) old('_klinik_id') === (int) $klinik->id;
            $layananValue = $isOldEditKlinik ? old('layanan') : implode(', ', $klinik->layanan ?? []);
            $selectedStatus = $isOldEditKlinik ? old('status') : $klinik->status;
        ?>

        <div class="modal fade clinic-modal" id="editKlinikModal-<?php echo e($klinik->id); ?>" tabindex="-1"
            aria-labelledby="editKlinikModalLabel-<?php echo e($klinik->id); ?>" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="clinic-modal-title">
                            <h5 id="editKlinikModalLabel-<?php echo e($klinik->id); ?>">Edit Klinik</h5>
                            <p><?php echo e($klinik->nama); ?></p>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <form method="POST" action="<?php echo e(route('admin.kliniks.update', $klinik)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <input type="hidden" name="_modal" value="edit">
                        <input type="hidden" name="_klinik_id" value="<?php echo e($klinik->id); ?>">

                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="clinic-form-group">
                                        <label for="edit-nama-<?php echo e($klinik->id); ?>">Nama Klinik</label>
                                        <input type="text" id="edit-nama-<?php echo e($klinik->id); ?>" name="nama"
                                            class="form-control"
                                            value="<?php echo e($isOldEditKlinik ? old('nama') : $klinik->nama); ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="clinic-form-group">
                                        <label for="edit-tipe-<?php echo e($klinik->id); ?>">Tipe</label>
                                        <input type="text" id="edit-tipe-<?php echo e($klinik->id); ?>" name="tipe"
                                            class="form-control"
                                            value="<?php echo e($isOldEditKlinik ? old('tipe') : $klinik->tipe); ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="clinic-form-group">
                                        <label for="edit-kota-<?php echo e($klinik->id); ?>">Kota</label>
                                        <input type="text" id="edit-kota-<?php echo e($klinik->id); ?>" name="kota"
                                            class="form-control"
                                            value="<?php echo e($isOldEditKlinik ? old('kota') : $klinik->kota); ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="clinic-form-group">
                                        <label for="edit-provinsi-<?php echo e($klinik->id); ?>">Provinsi</label>
                                        <input type="text" id="edit-provinsi-<?php echo e($klinik->id); ?>" name="provinsi"
                                            class="form-control"
                                            value="<?php echo e($isOldEditKlinik ? old('provinsi') : $klinik->provinsi); ?>" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="clinic-form-group">
                                        <label for="edit-alamat-<?php echo e($klinik->id); ?>">Alamat</label>
                                        <textarea id="edit-alamat-<?php echo e($klinik->id); ?>" name="alamat" class="form-control" rows="2" required><?php echo e($isOldEditKlinik ? old('alamat') : $klinik->alamat); ?></textarea>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="clinic-form-group">
                                        <label for="edit-telepon-<?php echo e($klinik->id); ?>">Telepon</label>
                                        <input type="text" id="edit-telepon-<?php echo e($klinik->id); ?>" name="telepon"
                                            class="form-control"
                                            value="<?php echo e($isOldEditKlinik ? old('telepon') : $klinik->telepon); ?>"
                                            placeholder="Opsional">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="clinic-form-group">
                                        <label for="edit-latitude-<?php echo e($klinik->id); ?>">Latitude</label>
                                        <input type="number" step="0.0000001" id="edit-latitude-<?php echo e($klinik->id); ?>"
                                            name="latitude" class="form-control"
                                            value="<?php echo e($isOldEditKlinik ? old('latitude') : $klinik->latitude); ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="clinic-form-group">
                                        <label for="edit-longitude-<?php echo e($klinik->id); ?>">Longitude</label>
                                        <input type="number" step="0.0000001" id="edit-longitude-<?php echo e($klinik->id); ?>"
                                            name="longitude" class="form-control"
                                            value="<?php echo e($isOldEditKlinik ? old('longitude') : $klinik->longitude); ?>"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="clinic-form-group">
                                        <label for="edit-jam-buka-<?php echo e($klinik->id); ?>">Jam Buka</label>
                                        <input type="time" id="edit-jam-buka-<?php echo e($klinik->id); ?>" name="jam_buka"
                                            class="form-control"
                                            value="<?php echo e($isOldEditKlinik ? old('jam_buka') : $klinik->jam_buka); ?>">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="clinic-form-group">
                                        <label for="edit-jam-tutup-<?php echo e($klinik->id); ?>">Jam Tutup</label>
                                        <input type="time" id="edit-jam-tutup-<?php echo e($klinik->id); ?>" name="jam_tutup"
                                            class="form-control"
                                            value="<?php echo e($isOldEditKlinik ? old('jam_tutup') : $klinik->jam_tutup); ?>">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="clinic-form-group">
                                        <label for="edit-hari-buka-<?php echo e($klinik->id); ?>">Hari Buka</label>
                                        <input type="text" id="edit-hari-buka-<?php echo e($klinik->id); ?>" name="hari_buka"
                                            class="form-control"
                                            value="<?php echo e($isOldEditKlinik ? old('hari_buka') : $klinik->hari_buka); ?>"
                                            placeholder="Senin - Jumat">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="clinic-form-group">
                                        <label for="edit-hari-tutup-<?php echo e($klinik->id); ?>">Hari Tutup</label>
                                        <input type="text" id="edit-hari-tutup-<?php echo e($klinik->id); ?>" name="hari_tutup"
                                            class="form-control"
                                            value="<?php echo e($isOldEditKlinik ? old('hari_tutup') : $klinik->hari_tutup); ?>"
                                            placeholder="Sabtu, Minggu">
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="clinic-form-group">
                                        <label for="edit-layanan-<?php echo e($klinik->id); ?>">Layanan</label>
                                        <textarea id="edit-layanan-<?php echo e($klinik->id); ?>" name="layanan" class="form-control" rows="2"
                                            placeholder="Pisahkan dengan koma atau baris baru"><?php echo e($layananValue); ?></textarea>
                                        <div class="clinic-form-help">
                                            Contoh: Skrining TBC, Konsultasi, Pemeriksaan Dahak
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="clinic-form-group">
                                        <label for="edit-status-<?php echo e($klinik->id); ?>">Status</label>
                                        <select id="edit-status-<?php echo e($klinik->id); ?>" name="status" class="form-select"
                                            required>
                                            <option value="aktif" <?php if($selectedStatus === 'aktif'): echo 'selected'; endif; ?>>
                                                Aktif
                                            </option>
                                            <option value="nonaktif" <?php if($selectedStatus === 'nonaktif'): echo 'selected'; endif; ?>>
                                                Nonaktif
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light clinic-modal-button" data-bs-dismiss="modal">
                                Batal
                            </button>

                            <button type="submit" class="btn btn-danger clinic-modal-button">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        initAdminDataTable('#kliniks-table', {
            pageLength: 10,
            searchInput: '#kliniks-search',
            actionColumn: 5
        });

        <?php if($errors->any() && old('_modal') === 'create'): ?>
            new bootstrap.Modal(document.getElementById('createKlinikModal')).show();
        <?php endif; ?>

        <?php if($errors->any() && old('_modal') === 'import'): ?>
            new bootstrap.Modal(document.getElementById('importKlinikModal')).show();
        <?php endif; ?>

        <?php if($errors->any() && old('_modal') === 'edit' && old('_klinik_id')): ?>
            new bootstrap.Modal(
                document.getElementById('editKlinikModal-<?php echo e(old('_klinik_id')); ?>')
            ).show();
        <?php endif; ?>
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Punya Aska\Kulyeah\SEMESTER 6\KP\Project-KP-kader-flow-refactored\Project-KP - Copy\resources\views/admin/kliniks/index.blade.php ENDPATH**/ ?>