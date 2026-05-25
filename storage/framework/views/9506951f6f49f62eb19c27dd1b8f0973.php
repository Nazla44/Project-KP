<?php $__env->startPush('styles'); ?>
    <style>
        .kader-detail-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .kader-detail-title span {
            display: block;
            margin-bottom: 6px;
            color: #64748b;
            font-size: 0.82rem;
            font-weight: 600;
        }

        .kader-detail-title h1 {
            margin: 0;
            color: #111827;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .kader-detail-title p {
            margin: 8px 0 0;
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .kader-back-button,
        .kader-action-button {
            min-height: 42px;
            border-radius: 10px;
            padding: 0 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.92rem;
            font-weight: 600;
            text-decoration: none;
        }

        .kader-alert {
            border-radius: 12px;
            padding: 14px 16px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 0.92rem;
            border: 1px solid transparent;
        }

        .kader-alert-success {
            background: #f0fdf4;
            color: #166534;
            border-color: #bbf7d0;
        }

        .kader-alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border-color: #fecaca;
        }

        .kader-detail-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 360px;
            gap: 18px;
            align-items: start;
        }

        .kader-card {
            background: #fff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 16px;
            overflow: hidden;
        }

        .kader-card-header {
            padding: 18px 20px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
            background: #fff;
        }

        .kader-card-header h2 {
            margin: 0;
            color: #111827;
            font-size: 1.05rem;
            font-weight: 700;
        }

        .kader-card-header p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 0.88rem;
        }

        .kader-card-body {
            padding: 20px;
        }

        .kader-profile-summary {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .kader-avatar-lg {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            background: rgba(213, 0, 0, 0.08);
            color: var(--color-primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            font-weight: 800;
            flex-shrink: 0;
        }

        .kader-profile-summary strong {
            display: block;
            color: #111827;
            font-size: 1.08rem;
            font-weight: 800;
            margin-bottom: 3px;
        }

        .kader-profile-summary small {
            color: #64748b;
            font-size: 0.88rem;
        }

        .kader-status-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 30px;
            padding: 0 11px;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 700;
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

        .kader-info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .kader-info-item {
            min-height: 74px;
            padding: 14px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 14px;
            background: #fff;
        }

        .kader-info-item.is-wide {
            grid-column: 1 / -1;
        }

        .kader-info-item span {
            display: block;
            margin-bottom: 6px;
            color: #64748b;
            font-size: .78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .kader-info-item strong {
            display: block;
            color: #111827;
            font-size: .94rem;
            font-weight: 700;
            line-height: 1.45;
            word-break: break-word;
        }

        .kader-info-item p {
            margin: 0;
            color: #334155;
            font-size: .92rem;
            line-height: 1.55;
        }

        .kader-action-stack {
            display: grid;
            gap: 10px;
        }

        .kader-action-note {
            color: #64748b;
            font-size: .88rem;
            line-height: 1.55;
            margin: 0;
        }

        .kader-modal .modal-content {
            border: 0;
            border-radius: 14px;
        }

        .kader-modal .modal-header {
            padding: 22px 24px 14px;
            border-bottom: 1px solid rgba(15, 23, 42, .08);
        }

        .kader-modal-title h5 {
            margin: 0;
            color: #111827;
            font-size: 1.12rem;
            font-weight: 700;
        }

        .kader-modal-title p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: .88rem;
        }

        .kader-modal .modal-body {
            padding: 20px 24px;
        }

        .kader-modal .modal-footer {
            padding: 16px 24px 22px;
            border-top: 1px solid rgba(15, 23, 42, .08);
            gap: 8px;
        }

        .kader-form-group label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: .86rem;
            font-weight: 600;
        }

        .kader-form-group .form-control {
            min-height: 42px;
            border-radius: 10px;
            border-color: rgba(15, 23, 42, .14);
            font-size: .92rem;
        }

        .kader-form-group .form-control:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 .18rem rgba(213, 0, 0, .12);
        }

        .kader-modal-button {
            min-height: 40px;
            border-radius: 10px;
            padding: 0 16px;
            font-weight: 600;
        }

        @media (max-width: 991.98px) {
            .kader-detail-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767.98px) {
            .kader-detail-header {
                align-items: stretch;
                flex-direction: column;
            }

            .kader-info-grid {
                grid-template-columns: 1fr;
            }

            .kader-card-body {
                padding: 16px;
            }

            .kader-modal .modal-header,
            .kader-modal .modal-body,
            .kader-modal .modal-footer {
                padding-left: 18px;
                padding-right: 18px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $initial = strtoupper(substr($kader->nama ?? 'K', 0, 1));
        $statusClass = match ($kader->status) {
            \App\Models\Kader::STATUS_AKTIF => 'is-active',
            \App\Models\Kader::STATUS_DITOLAK => 'is-rejected',
            \App\Models\Kader::STATUS_SUSPEND => 'is-suspend',
            default => 'is-pending',
        };
    ?>

    <section class="kader-detail-header">
        <div class="kader-detail-title">
            <span>Manajemen Kader</span>
            <h1>Detail Pendaftaran</h1>
            <p>Review data kader sebelum menyetujui atau menolak pendaftaran.</p>
        </div>

        <a href="<?php echo e(route('admin.kaders.index')); ?>" class="btn btn-outline-secondary kader-back-button">
            <i class="bi bi-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </section>

    <?php if(session('status')): ?>
        <div class="alert kader-alert kader-alert-success mb-3">
            <i class="bi bi-check-circle-fill"></i>
            <span><?php echo e(session('status')); ?></span>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert kader-alert kader-alert-danger mb-3">
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

    <div class="kader-detail-grid">
        <section class="kader-card">
            <div class="kader-card-header">
                <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
                    <div class="kader-profile-summary">
                        <span class="kader-avatar-lg"><?php echo e($initial); ?></span>
                        <div>
                            <strong><?php echo e($kader->nama); ?></strong>
                            <small><?php echo e($kader->email); ?> · <?php echo e($kader->hp); ?></small>
                        </div>
                    </div>

                    <span class="kader-status-pill <?php echo e($statusClass); ?>">
                        <span></span><?php echo e($kader->statusLabel()); ?>

                    </span>
                </div>
            </div>

            <div class="kader-card-body">
                <div class="kader-info-grid">
                    <div class="kader-info-item">
                        <span>NIK</span>
                        <strong><?php echo e($kader->nik ?? '-'); ?></strong>
                    </div>
                    <div class="kader-info-item">
                        <span>Jenis Kelamin</span>
                        <strong><?php echo e($kader->jenis_kelamin === 'L' ? 'Laki-laki' : ($kader->jenis_kelamin === 'P' ? 'Perempuan' : '-')); ?></strong>
                    </div>
                    <div class="kader-info-item">
                        <span>Tempat/Tanggal Lahir</span>
                        <strong><?php echo e($kader->tempat_lahir ?? '-'); ?><?php echo e($kader->tanggal_lahir ? ', ' . $kader->tanggal_lahir->format('d M Y') : ''); ?></strong>
                    </div>
                    <div class="kader-info-item">
                        <span>Pendidikan</span>
                        <strong><?php echo e($kader->pendidikan ?? '-'); ?></strong>
                    </div>
                    <div class="kader-info-item">
                        <span>Pekerjaan</span>
                        <strong><?php echo e($kader->pekerjaan ?? '-'); ?></strong>
                    </div>
                    <div class="kader-info-item">
                        <span>Ketersediaan</span>
                        <strong><?php echo e(str_replace('_', ' ', $kader->ketersediaan ?? '-')); ?></strong>
                    </div>
                    <div class="kader-info-item">
                        <span>Pengalaman TB</span>
                        <strong><?php echo e(str_replace('_', ' ', $kader->pengalaman_tb ?? '-')); ?></strong>
                    </div>
                    <div class="kader-info-item">
                        <span>Tanggal Daftar</span>
                        <strong><?php echo e(optional($kader->created_at)->format('d M Y H:i') ?? '-'); ?></strong>
                    </div>
                    <div class="kader-info-item is-wide">
                        <span>Alamat</span>
                        <p><?php echo e($kader->alamat ?? '-'); ?></p>
                        <p class="mt-1 text-muted"><?php echo e($kader->kecamatan ?? '-'); ?>, <?php echo e($kader->kab_kota ?? '-'); ?>,
                            <?php echo e($kader->provinsi ?? '-'); ?></p>
                    </div>
                    <div class="kader-info-item is-wide">
                        <span>Motivasi</span>
                        <p><?php echo e($kader->motivasi ?? '-'); ?></p>
                    </div>

                    <?php if($kader->isRejected()): ?>
                        <div class="kader-info-item is-wide">
                            <span>Alasan Penolakan</span>
                            <p><?php echo e($kader->rejection_reason ?? '-'); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <aside class="kader-card">
            <div class="kader-card-header">
                <h2>Aksi Verifikasi</h2>
            </div>
            <div class="kader-card-body">
                <?php if($kader->isPending()): ?>
                    <div class="kader-action-stack">

                        <form method="POST" action="<?php echo e(route('admin.kaders.approve', $kader)); ?>"
                            onsubmit="return confirm('Setujui pendaftaran kader ini?')">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-success w-100 kader-action-button">
                                <i class="bi bi-check2-circle"></i>
                                <span>Approve Kader</span>
                            </button>
                        </form>

                        <button type="button" class="btn btn-danger w-100 kader-action-button" data-bs-toggle="modal"
                            data-bs-target="#rejectKaderModal">
                            <i class="bi bi-x-circle"></i>
                            <span>Reject Kader</span>
                        </button>
                    </div>
                <?php else: ?>
                    <div class="kader-action-stack">

                        <?php if($kader->isActive()): ?>
                            <div class="kader-info-item">
                                <span>Disetujui Pada</span>
                                <strong><?php echo e(optional($kader->approved_at)->format('d M Y H:i') ?? '-'); ?></strong>
                            </div>
                            <div class="kader-info-item">
                                <span>Akun User</span>
                                <strong><?php echo e($kader->user?->email ?? '-'); ?></strong>
                            </div>
                        <?php endif; ?>

                        <?php if($kader->isRejected()): ?>
                            <div class="kader-info-item">
                                <span>Ditolak Pada</span>
                                <strong><?php echo e(optional($kader->rejected_at)->format('d M Y H:i') ?? '-'); ?></strong>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </aside>
    </div>

    <?php if($kader->isPending()): ?>
        <div class="modal fade kader-modal" id="rejectKaderModal" tabindex="-1" aria-labelledby="rejectKaderModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="POST" action="<?php echo e(route('admin.kaders.reject', $kader)); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="modal-header">
                            <div class="kader-modal-title">
                                <h5 id="rejectKaderModalLabel">Reject Pendaftaran</h5>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>

                        <div class="modal-body">
                            <div class="kader-form-group">
                                <label>Alasan Penolakan</label>
                                <textarea name="rejection_reason" rows="5" class="form-control" required maxlength="1000"
                                    placeholder="Contoh: Data NIK belum sesuai atau wilayah domisili belum masuk cakupan program."><?php echo e(old('rejection_reason')); ?></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary kader-modal-button"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger kader-modal-button">Kirim Reject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Punya Aska\Kulyeah\SEMESTER 6\KP\Project-KP\resources\views/admin/kaders/show.blade.php ENDPATH**/ ?>