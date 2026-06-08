<?php $__env->startPush('styles'); ?>
    <style>
        .users-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .users-page-title span {
            display: block;
            margin-bottom: 6px;
            color: #64748b;
            font-size: 0.82rem;
            font-weight: 600;
        }

        .users-page-title h1 {
            margin: 0;
            color: #111827;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .users-page-title p {
            margin: 8px 0 0;
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .users-create-button {
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

        .users-alert {
            border-radius: 12px;
            padding: 14px 16px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 0.92rem;
            border: 1px solid transparent;
        }

        .users-alert-success {
            background: #f0fdf4;
            color: #166534;
            border-color: #bbf7d0;
        }

        .users-alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border-color: #fecaca;
        }

        .users-table-card {
            background: #fff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 16px;
            overflow: hidden;
        }

        .users-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 18px 20px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
            background: #fff;
        }

        .users-table-header h2 {
            margin: 0;
            color: #111827;
            font-size: 1.05rem;
            font-weight: 700;
        }

        .users-table-header p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 0.88rem;
        }

        .users-search-box {
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

        .users-search-box i {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .users-search-box .form-control {
            border: 0;
            box-shadow: none;
            padding: 0;
            height: 40px;
            background: transparent;
            font-size: 0.92rem;
        }

        .users-table {
            margin: 0 !important;
        }

        .users-table thead th {
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

        .users-table tbody td {
            padding: 15px 18px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(15, 23, 42, 0.06);
        }

        .users-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .users-table tbody tr:hover {
            background: #fafafa;
        }

        .users-profile-cell {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 230px;
        }

        .users-avatar {
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

        .users-profile-cell strong {
            display: block;
            color: #111827;
            font-size: 0.94rem;
            font-weight: 700;
            margin-bottom: 2px;
        }

        .users-profile-cell small,
        .users-muted-text,
        .users-date {
            color: #64748b;
            font-size: 0.85rem;
        }

        .users-role-pill,
        .users-status-pill {
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

        .users-role-pill.is-admin {
            background: rgba(213, 0, 0, 0.08);
            color: var(--color-primary);
        }

        .users-role-pill.is-kader {
            background: rgba(0, 51, 102, 0.08);
            color: #003366;
        }

        .users-status-pill {
            gap: 7px;
        }

        .users-status-pill span {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            flex-shrink: 0;
        }

        .users-status-pill.is-active {
            background: rgba(22, 163, 74, 0.1);
            color: #15803d;
        }

        .users-status-pill.is-active span {
            background: #16a34a;
        }

        .users-status-pill.is-inactive {
            background: rgba(100, 116, 139, 0.12);
            color: #475569;
        }

        .users-status-pill.is-inactive span {
            background: #64748b;
        }

        .users-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            white-space: nowrap;
        }

        .users-icon-button {
            width: 36px;
            height: 36px;
            border: 1px solid rgba(15, 23, 42, 0.12);
            border-radius: 10px;
            background: #fff;
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .users-icon-button:hover {
            background: #f8fafc;
            color: var(--color-primary);
            border-color: rgba(213, 0, 0, 0.25);
        }

        .users-icon-button-danger:hover {
            color: #dc2626;
            border-color: rgba(220, 38, 38, 0.25);
        }

        .users-modal .modal-content {
            border: 0;
            border-radius: 14px;
        }

        .users-modal .modal-header {
            padding: 22px 24px 14px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
        }

        .users-modal-title h5 {
            margin: 0;
            color: #111827;
            font-size: 1.12rem;
            font-weight: 700;
        }

        .users-modal-title p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 0.88rem;
        }

        .users-modal .modal-body {
            padding: 20px 24px;
        }

        .users-modal .modal-footer {
            padding: 16px 24px 22px;
            border-top: 1px solid rgba(15, 23, 42, 0.08);
            gap: 8px;
        }

        .users-form-group label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 0.86rem;
            font-weight: 600;
        }

        .users-form-group .form-control,
        .users-form-group .form-select {
            min-height: 42px;
            border-radius: 10px;
            border-color: rgba(15, 23, 42, 0.14);
            font-size: 0.92rem;
        }

        .users-form-group .form-control:focus,
        .users-form-group .form-select:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 0.18rem rgba(213, 0, 0, 0.12);
        }

        .users-form-help {
            margin-top: 6px;
            color: #94a3b8;
            font-size: 0.78rem;
        }

        .users-form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 42px;
            padding: 0;
            border: 0;
            background: transparent;
        }

        .users-form-check .form-check-input {
            width: 18px;
            height: 18px;
            margin: 0;
            flex-shrink: 0;
            cursor: pointer;
        }

        .users-form-check .form-check-label {
            margin: 0;
            color: #334155;
            font-size: 0.92rem;
            font-weight: 600;
            cursor: pointer;
        }

        .users-modal-button {
            min-height: 40px;
            border-radius: 10px;
            padding: 0 16px;
            font-weight: 600;
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

        @media (max-width: 767.98px) {
            .users-page-header {
                align-items: stretch;
                flex-direction: column;
            }

            .users-create-button {
                width: 100%;
            }

            .users-table-header {
                align-items: stretch;
                flex-direction: column;
            }

            .users-search-box {
                width: 100%;
            }

            .users-table thead th,
            .users-table tbody td {
                padding-left: 14px;
                padding-right: 14px;
            }

            .users-actions {
                justify-content: flex-start;
            }

            .users-modal .modal-header,
            .users-modal .modal-body,
            .users-modal .modal-footer {
                padding-left: 18px;
                padding-right: 18px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="users-page-header">
        <div class="users-page-title">
            <span>Manajemen</span>
            <h1>Kelola Users</h1>
        </div>

        <button type="button" class="btn btn-danger users-create-button" data-bs-toggle="modal"
            data-bs-target="#createUserModal">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah User</span>
        </button>
    </section>

    <?php if(session('status')): ?>
        <div class="alert users-alert users-alert-success mb-0">
            <i class="bi bi-check-circle-fill"></i>
            <span><?php echo e(session('status')); ?></span>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert users-alert users-alert-danger mb-0">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <div>
                <strong>Data belum bisa disimpan.</strong>
                <ul class="mb-0 mt-2">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>

    <section class="users-table-card">
        <div class="users-table-header">
            <div>
                <h2>Daftar User</h2>
            </div>

            <div class="users-search-box">
                <i class="bi bi-search"></i>
                <input type="text" id="users-search" class="form-control" placeholder="Cari user...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table users-table align-middle mb-0" id="users-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Kontak</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $roleLabel = str_replace('_', ' ', $user->role);
                            $roleText = $user->roleLabel();
                            $statusText = $user->is_active ? 'Aktif' : 'Nonaktif';
                            $initial = strtoupper(substr($user->name, 0, 1));
                        ?>

                        <tr>
                            <td>
                                <div class="users-profile-cell">
                                    <span class="users-avatar"><?php echo e($initial); ?></span>
                                    <div>
                                        <strong><?php echo e($user->name); ?></strong>
                                        <small><?php echo e($user->email); ?></small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="users-muted-text">
                                    <?php echo e($user->phone_number ?: 'Belum diisi'); ?>

                                </span>
                            </td>

                            <td data-search="<?php echo e($roleText); ?>" data-order="<?php echo e($roleText); ?>">
                                <span class="users-role-pill <?php echo e($user->isSuperAdmin() ? 'is-admin' : 'is-kader'); ?>">
                                    <?php echo e($roleLabel); ?>

                                </span>
                            </td>

                            <td data-search="<?php echo e($statusText); ?>" data-order="<?php echo e($statusText); ?>">
                                <span class="users-status-pill <?php echo e($user->is_active ? 'is-active' : 'is-inactive'); ?>">
                                    <span></span>
                                    <?php echo e($statusText); ?>

                                </span>
                            </td>

                            <td data-order="<?php echo e(optional($user->created_at)->timestamp); ?>">
                                <span class="users-date">
                                    <?php echo e(optional($user->created_at)->format('d M Y') ?? '-'); ?>

                                </span>
                            </td>

                            <td>
                                <div class="users-actions">
                                    <button type="button" class="users-icon-button" title="Edit user"
                                        data-bs-toggle="modal" data-bs-target="#editUserModal-<?php echo e($user->id); ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <form method="POST" action="<?php echo e(route('admin.users.destroy', $user)); ?>"
                                        onsubmit="return confirm('Hapus user ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button type="submit" class="users-icon-button users-icon-button-danger"
                                            title="Hapus user">
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

    
    <div class="modal fade users-modal" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="users-modal-title">
                        <h5 id="createUserModalLabel">Tambah User</h5>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <form method="POST" action="<?php echo e(route('admin.users.store')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="users-form-group">
                                    <label>Nama</label>
                                    <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>"
                                        placeholder="Masukkan nama user" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="users-form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>"
                                        placeholder="nama@email.com" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="users-form-group">
                                    <label>Nomor HP</label>
                                    <input type="text" name="phone_number" class="form-control"
                                        value="<?php echo e(old('phone_number')); ?>" placeholder="Contoh: 081234567890">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="users-form-group">
                                    <label>Role</label>
                                    <select name="role" class="form-select" required>
                                        <option value="<?php echo e(\App\Models\User::ROLE_KADER); ?>">Kader</option>
                                        <option value="<?php echo e(\App\Models\User::ROLE_SUPER_ADMIN); ?>">Super Admin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="users-form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Masukkan password" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="users-form-group">
                                    <label>Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Ulangi password" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check users-form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="create-is-active"
                                        name="is_active" checked>

                                    <label class="form-check-label" for="create-is-active">
                                        User aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light users-modal-button" data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-danger users-modal-button">
                            Simpan User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade users-modal" id="editUserModal-<?php echo e($user->id); ?>" tabindex="-1"
            aria-labelledby="editUserModalLabel-<?php echo e($user->id); ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="users-modal-title">
                            <h5 id="editUserModalLabel-<?php echo e($user->id); ?>">Edit User</h5>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <form method="POST" action="<?php echo e(route('admin.users.update', $user)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="users-form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" class="form-control"
                                            value="<?php echo e($user->name); ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="users-form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="<?php echo e($user->email); ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="users-form-group">
                                        <label>Nomor HP</label>
                                        <input type="text" name="phone_number" class="form-control"
                                            value="<?php echo e($user->phone_number); ?>" placeholder="Belum diisi">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="users-form-group">
                                        <label>Role</label>
                                        <select name="role" class="form-select" required>
                                            <option value="<?php echo e(\App\Models\User::ROLE_KADER); ?>"
                                                <?php if($user->role === \App\Models\User::ROLE_KADER): echo 'selected'; endif; ?>>
                                                Kader
                                            </option>
                                            <option value="<?php echo e(\App\Models\User::ROLE_SUPER_ADMIN); ?>"
                                                <?php if($user->role === \App\Models\User::ROLE_SUPER_ADMIN): echo 'selected'; endif; ?>>
                                                Super Admin
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="users-form-group">
                                        <label>Password Baru</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Kosongkan jika tidak diganti">
                                        <div class="users-form-help">
                                            Isi hanya jika ingin mengganti password.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="users-form-group">
                                        <label>Konfirmasi Password Baru</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Ulangi password baru">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check users-form-check">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            id="edit-is-active-<?php echo e($user->id); ?>" name="is_active"
                                            <?php if($user->is_active): echo 'checked'; endif; ?>>

                                        <label class="form-check-label" for="edit-is-active-<?php echo e($user->id); ?>">
                                            User aktif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light users-modal-button" data-bs-dismiss="modal">
                                Batal
                            </button>

                            <button type="submit" class="btn btn-danger users-modal-button">
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
        initAdminDataTable('#users-table', {
            pageLength: 10,
            searchInput: '#users-search',
            actionColumn: 5
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/admin/users/index.blade.php ENDPATH**/ ?>