<?php $__env->startPush('styles'); ?>
    <style>
        .articles-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .articles-page-title span {
            display: block;
            margin-bottom: 6px;
            color: #64748b;
            font-size: 0.82rem;
            font-weight: 600;
        }

        .articles-page-title h1 {
            margin: 0;
            color: #111827;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .articles-page-title p {
            margin: 8px 0 0;
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .articles-create-button {
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

        .articles-alert {
            border-radius: 12px;
            padding: 14px 16px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 0.92rem;
            border: 1px solid transparent;
        }

        .articles-alert-success {
            background: #f0fdf4;
            color: #166534;
            border-color: #bbf7d0;
        }

        .articles-alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border-color: #fecaca;
        }

        .articles-table-card {
            background: #fff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 16px;
            overflow: hidden;
        }

        .articles-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 18px 20px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
            background: #fff;
        }

        .articles-table-header h2 {
            margin: 0;
            color: #111827;
            font-size: 1.05rem;
            font-weight: 700;
        }

        .articles-table-header p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 0.88rem;
        }

        .articles-search-box {
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

        .articles-search-box i {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .articles-search-box .form-control {
            border: 0;
            box-shadow: none;
            padding: 0;
            height: 40px;
            background: transparent;
            font-size: 0.92rem;
        }

        .articles-table {
            margin: 0 !important;
        }

        .articles-table thead th {
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

        .articles-table tbody td {
            padding: 15px 18px;
            vertical-align: middle;
            border-bottom: 1px solid rgba(15, 23, 42, 0.06);
        }

        .articles-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .articles-table tbody tr:hover {
            background: #fafafa;
        }

        .article-title-cell {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 280px;
        }

        .article-cover-thumb {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            object-fit: cover;
            border: 1px solid rgba(15, 23, 42, 0.10);
            background: #f8fafc;
            flex-shrink: 0;
        }

        .article-title-cell strong {
            display: block;
            color: #111827;
            font-size: 0.94rem;
            font-weight: 700;
            margin-bottom: 2px;
            line-height: 1.35;
        }

        .article-title-cell small {
            display: block;
            max-width: 360px;
            color: #64748b;
            font-size: 0.82rem;
            line-height: 1.35;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .article-topic-pill,
        .article-status-pill {
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

        .article-topic-pill {
            background: rgba(0, 51, 102, 0.08);
            color: #003366;
        }

        .article-status-pill {
            gap: 7px;
        }

        .article-status-pill span {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            flex-shrink: 0;
        }

        .article-status-pill.is-published {
            background: rgba(22, 163, 74, 0.1);
            color: #15803d;
        }

        .article-status-pill.is-published span {
            background: #16a34a;
        }

        .article-status-pill.is-draft {
            background: rgba(100, 116, 139, 0.12);
            color: #475569;
        }

        .article-status-pill.is-draft span {
            background: #64748b;
        }

        .article-muted-text,
        .article-date {
            color: #64748b;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .article-author {
            color: #334155;
            font-size: 0.88rem;
            white-space: nowrap;
        }

        .articles-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            white-space: nowrap;
        }

        .articles-icon-button {
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

        .articles-icon-button:hover {
            background: #f8fafc;
            color: var(--color-primary);
            border-color: rgba(213, 0, 0, 0.25);
        }

        .articles-icon-button-danger:hover {
            color: #dc2626;
            border-color: rgba(220, 38, 38, 0.25);
        }

        .article-modal .modal-content {
            border: 0;
            border-radius: 14px;
        }

        .article-modal .modal-header {
            padding: 22px 24px 14px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
        }

        .article-modal-title h5 {
            margin: 0;
            color: #111827;
            font-size: 1.12rem;
            font-weight: 700;
        }

        .article-modal-title p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 0.88rem;
        }

        .article-modal .modal-body {
            padding: 20px 24px;
        }

        .article-modal .modal-footer {
            padding: 16px 24px 22px;
            border-top: 1px solid rgba(15, 23, 42, 0.08);
            gap: 8px;
        }

        .article-form-group label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 0.86rem;
            font-weight: 600;
        }

        .article-form-group .form-control,
        .article-form-group .form-select {
            min-height: 42px;
            border-radius: 10px;
            border-color: rgba(15, 23, 42, 0.14);
            font-size: 0.92rem;
        }

        .article-form-group textarea.form-control {
            min-height: 260px;
            resize: vertical;
        }

        .article-form-group .form-control:focus,
        .article-form-group .form-select:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 0.18rem rgba(213, 0, 0, 0.12);
        }

        .article-form-help {
            margin-top: 6px;
            color: #94a3b8;
            font-size: 0.78rem;
        }

        .article-cover-preview {
            border: 1px solid rgba(15, 23, 42, 0.10);
            border-radius: 12px;
            padding: 12px;
            background: #f8fafc;
        }

        .article-cover-preview span {
            display: block;
            margin-bottom: 8px;
            color: #64748b;
            font-size: 0.82rem;
            font-weight: 600;
        }

        .article-cover-preview img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 10px;
            background: #fff;
        }

        .article-modal-button {
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
            .articles-page-header {
                align-items: stretch;
                flex-direction: column;
            }

            .articles-create-button {
                width: 100%;
            }

            .articles-table-header {
                align-items: stretch;
                flex-direction: column;
            }

            .articles-search-box {
                width: 100%;
            }

            .articles-table thead th,
            .articles-table tbody td {
                padding-left: 14px;
                padding-right: 14px;
            }

            .articles-actions {
                justify-content: flex-start;
            }

            .article-title-cell {
                min-width: 240px;
            }

            .article-title-cell small {
                max-width: 240px;
            }

            .article-modal .modal-header,
            .article-modal .modal-body,
            .article-modal .modal-footer {
                padding-left: 18px;
                padding-right: 18px;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="articles-page-header">
        <div class="articles-page-title">
            <span>Manajemen</span>
            <h1><?php echo e($pageTitle ?? 'Kelola Artikel'); ?></h1>
        </div>

        <button type="button" class="btn btn-danger articles-create-button" data-bs-toggle="modal"
            data-bs-target="#createArticleModal">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Artikel</span>
        </button>
    </section>

    <?php if(session('status')): ?>
        <div class="alert articles-alert articles-alert-success mb-0">
            <i class="bi bi-check-circle-fill"></i>
            <span><?php echo e(session('status')); ?></span>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert articles-alert articles-alert-danger mb-0">
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

    <section class="articles-table-card">
        <div class="articles-table-header">
            <div>
                <h2>Daftar Artikel</h2>
            </div>

            <div class="articles-search-box">
                <i class="bi bi-search"></i>
                <input type="text" id="articles-search" class="form-control" placeholder="Cari artikel...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table articles-table align-middle mb-0" id="articles-table">
                <thead>
                    <tr>
                        <th>Artikel</th>
                        <th>Topik</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $isPublished = $article->status === 'tayang';
                            $statusText = $isPublished ? 'Tayang' : 'Draft';
                        ?>

                        <tr>
                            <td>
                                <div class="article-title-cell">
                                    <img src="<?php echo e($article->cover_image_url); ?>" alt="<?php echo e($article->judul); ?>"
                                        class="article-cover-thumb">

                                    <div>
                                        <strong><?php echo e($article->judul); ?></strong>
                                        <small><?php echo e($article->slug); ?></small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="article-topic-pill">
                                    <?php echo e($article->topik); ?>

                                </span>
                            </td>

                            <td>
                                <span class="article-author">
                                    <?php echo e($article->penulis ?: '-'); ?>

                                </span>
                            </td>

                            <td data-order="<?php echo e(optional($article->tanggal)->timestamp); ?>">
                                <span class="article-date">
                                    <?php echo e(optional($article->tanggal)->format('d M Y') ?? '-'); ?>

                                </span>
                            </td>

                            <td data-search="<?php echo e($statusText); ?>" data-order="<?php echo e($statusText); ?>">
                                <span class="article-status-pill <?php echo e($isPublished ? 'is-published' : 'is-draft'); ?>">
                                    <span></span>
                                    <?php echo e($statusText); ?>

                                </span>
                            </td>

                            <td>
                                <div class="articles-actions">
                                    <a href="<?php echo e(route('artikel.show', $article->id)); ?>" class="articles-icon-button"
                                        title="Lihat artikel" target="_blank">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <button type="button" class="articles-icon-button" title="Edit artikel"
                                        data-bs-toggle="modal" data-bs-target="#editArticleModal-<?php echo e($article->id); ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <form method="POST" action="<?php echo e(route('admin.articles.destroy', $article)); ?>"
                                        onsubmit="return confirm('Hapus artikel ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button type="submit" class="articles-icon-button articles-icon-button-danger"
                                            title="Hapus artikel">
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

    
    <div class="modal fade article-modal" id="createArticleModal" tabindex="-1" aria-labelledby="createArticleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="article-modal-title">
                        <h5 id="createArticleModalLabel">Tambah Artikel</h5>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <form method="POST" action="<?php echo e(route('admin.articles.store')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="_modal" value="create">

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12 col-lg-8">
                                <div class="article-form-group mb-3">
                                    <label for="create-judul">Judul Artikel</label>
                                    <input type="text" id="create-judul" name="judul" class="form-control"
                                        value="<?php echo e(old('_modal') === 'create' ? old('judul') : ''); ?>"
                                        placeholder="Masukkan judul artikel" required>
                                </div>

                                <div class="article-form-group mb-3">
                                    <label for="create-topik">Topik</label>
                                    <input type="text" id="create-topik" name="topik" class="form-control"
                                        value="<?php echo e(old('_modal') === 'create' ? old('topik') : ''); ?>"
                                        placeholder="Contoh: Seputar TBC" required>
                                </div>

                                <div class="article-form-group mb-0">
                                    <label for="create-isi">Isi Artikel</label>
                                    <textarea id="create-isi" name="isi" rows="12" class="form-control" placeholder="Tulis isi artikel di sini..."
                                        required><?php echo e(old('_modal') === 'create' ? old('isi') : ''); ?></textarea>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="article-form-group mb-3">
                                    <label for="create-status">Status</label>
                                    <select id="create-status" name="status" class="form-select" required>
                                        <option value="draft" <?php if(old('_modal') === 'create' && old('status', 'draft') === 'draft'): echo 'selected'; endif; ?>>
                                            Draft
                                        </option>
                                        <option value="tayang" <?php if(old('_modal') === 'create' && old('status') === 'tayang'): echo 'selected'; endif; ?>>
                                            Tayang
                                        </option>
                                    </select>
                                </div>

                                <div class="article-form-group mb-0">
                                    <label for="create-cover-image">Cover Artikel</label>
                                    <input type="file" id="create-cover-image" name="cover_image"
                                        class="form-control" accept=".jpg,.jpeg,.png,.webp" required>

                                    <div class="article-form-help">
                                        Format JPG, JPEG, PNG, atau WEBP. Maksimal 3 MB.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light article-modal-button" data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-danger article-modal-button">
                            Simpan Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $isOldEditArticle = old('_modal') === 'edit' && (int) old('_article_id') === (int) $article->id;
            $selectedStatus = $isOldEditArticle ? old('status') : $article->status;
        ?>

        <div class="modal fade article-modal" id="editArticleModal-<?php echo e($article->id); ?>" tabindex="-1"
            aria-labelledby="editArticleModalLabel-<?php echo e($article->id); ?>" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="article-modal-title">
                            <h5 id="editArticleModalLabel-<?php echo e($article->id); ?>">Edit Artikel</h5>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <form method="POST" action="<?php echo e(route('admin.articles.update', $article)); ?>"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <input type="hidden" name="_modal" value="edit">
                        <input type="hidden" name="_article_id" value="<?php echo e($article->id); ?>">

                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-12 col-lg-8">
                                    <div class="article-form-group mb-3">
                                        <label for="edit-judul-<?php echo e($article->id); ?>">Judul Artikel</label>
                                        <input type="text" id="edit-judul-<?php echo e($article->id); ?>" name="judul"
                                            class="form-control"
                                            value="<?php echo e($isOldEditArticle ? old('judul') : $article->judul); ?>"
                                            placeholder="Masukkan judul artikel" required>
                                    </div>

                                    <div class="article-form-group mb-3">
                                        <label for="edit-topik-<?php echo e($article->id); ?>">Topik</label>
                                        <input type="text" id="edit-topik-<?php echo e($article->id); ?>" name="topik"
                                            class="form-control"
                                            value="<?php echo e($isOldEditArticle ? old('topik') : $article->topik); ?>"
                                            placeholder="Contoh: Seputar TBC" required>
                                    </div>

                                    <div class="article-form-group mb-0">
                                        <label for="edit-isi-<?php echo e($article->id); ?>">Isi Artikel</label>
                                        <textarea id="edit-isi-<?php echo e($article->id); ?>" name="isi" rows="12" class="form-control"
                                            placeholder="Tulis isi artikel di sini..." required><?php echo e($isOldEditArticle ? old('isi') : $article->isi); ?></textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="article-form-group mb-3">
                                        <label for="edit-status-<?php echo e($article->id); ?>">Status</label>
                                        <select id="edit-status-<?php echo e($article->id); ?>" name="status" class="form-select"
                                            required>
                                            <option value="draft" <?php if($selectedStatus === 'draft'): echo 'selected'; endif; ?>>
                                                Draft
                                            </option>
                                            <option value="tayang" <?php if($selectedStatus === 'tayang'): echo 'selected'; endif; ?>>
                                                Tayang
                                            </option>
                                        </select>
                                    </div>

                                    <div class="article-form-group mb-3">
                                        <label for="edit-cover-image-<?php echo e($article->id); ?>">Cover Artikel</label>
                                        <input type="file" id="edit-cover-image-<?php echo e($article->id); ?>"
                                            name="cover_image" class="form-control" accept=".jpg,.jpeg,.png,.webp">

                                        <div class="article-form-help">
                                            Kosongkan jika tidak ingin mengganti cover.
                                        </div>
                                    </div>

                                    <?php if($article->cover_image_url): ?>
                                        <div class="article-cover-preview">
                                            <span>Cover saat ini</span>
                                            <img src="<?php echo e($article->cover_image_url); ?>" alt="<?php echo e($article->judul); ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light article-modal-button" data-bs-dismiss="modal">
                                Batal
                            </button>

                            <button type="submit" class="btn btn-danger article-modal-button">
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
        initAdminDataTable('#articles-table', {
            pageLength: 10,
            searchInput: '#articles-search',
            actionColumn: 5
        });

        <?php if($errors->any() && old('_modal') === 'create'): ?>
            const createArticleModal = new bootstrap.Modal(document.getElementById('createArticleModal'));
            createArticleModal.show();
        <?php endif; ?>

        <?php if($errors->any() && old('_modal') === 'edit' && old('_article_id')): ?>
            const editArticleModal = new bootstrap.Modal(
                document.getElementById('editArticleModal-<?php echo e(old('_article_id')); ?>')
            );
            editArticleModal.show();
        <?php endif; ?>
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Punya Aska\Kulyeah\SEMESTER 6\KP\Project-KP-kader-flow-refactored\Project-KP - Copy\resources\views/admin/artikel/index.blade.php ENDPATH**/ ?>