@extends('layouts.admin')

@push('styles')
    <style>
        .dashboard-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .dashboard-page-title span {
            display: block;
            margin-bottom: 6px;
            color: #64748b;
            font-size: 0.82rem;
            font-weight: 600;
        }

        .dashboard-page-title h1 {
            margin: 0;
            color: #111827;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .dashboard-page-title p {
            margin: 8px 0 0;
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .dashboard-stat-card {
            background: #fff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 16px;
            padding: 18px;
        }

        .dashboard-stat-card .icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(213, 0, 0, 0.08);
            color: var(--color-primary);
            margin-bottom: 14px;
        }

        .dashboard-stat-card span {
            display: block;
            color: #64748b;
            font-size: 0.84rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .dashboard-stat-card strong {
            display: block;
            color: #111827;
            font-size: 1.8rem;
            font-weight: 700;
            line-height: 1;
        }

        .dashboard-section-card {
            background: #fff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 16px;
            overflow: hidden;
        }

        .dashboard-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 18px 20px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
        }

        .dashboard-section-header h2 {
            margin: 0;
            color: #111827;
            font-size: 1.05rem;
            font-weight: 700;
        }

        .dashboard-section-header p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 0.88rem;
        }

        .dashboard-section-link {
            color: var(--color-primary);
            font-size: 0.86rem;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
        }

        .dashboard-section-link:hover {
            text-decoration: underline;
        }

        .dashboard-actions-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            padding: 18px 20px;
        }

        .dashboard-action-card {
            min-height: 92px;
            padding: 16px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 14px;
            text-decoration: none;
            color: #111827;
            background: #fff;
        }

        .dashboard-action-card:hover {
            background: #f8fafc;
            color: var(--color-primary);
            border-color: rgba(213, 0, 0, 0.2);
        }

        .dashboard-action-card i {
            display: block;
            margin-bottom: 10px;
            color: var(--color-primary);
            font-size: 1.25rem;
        }

        .dashboard-action-card strong {
            display: block;
            font-size: 0.94rem;
            font-weight: 700;
        }

        .dashboard-action-card span {
            display: block;
            margin-top: 4px;
            color: #64748b;
            font-size: 0.8rem;
            line-height: 1.4;
        }

        .dashboard-list {
            display: grid;
        }

        .dashboard-list-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 15px 20px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.06);
        }

        .dashboard-list-item:last-child {
            border-bottom: 0;
        }

        .dashboard-list-main strong {
            display: block;
            color: #111827;
            font-size: 0.92rem;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .dashboard-list-main small {
            display: block;
            color: #64748b;
            font-size: 0.82rem;
        }

        .dashboard-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 26px;
            padding: 0 10px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .dashboard-badge-success {
            background: rgba(22, 163, 74, 0.10);
            color: #15803d;
        }

        .dashboard-badge-muted {
            background: rgba(100, 116, 139, 0.12);
            color: #475569;
        }

        .dashboard-badge-danger {
            background: rgba(213, 0, 0, 0.08);
            color: var(--color-primary);
        }

        .dashboard-two-column {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 16px;
        }

        @media (max-width: 1199.98px) {

            .dashboard-grid,
            .dashboard-actions-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .dashboard-two-column {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 767.98px) {
            .dashboard-page-header {
                align-items: stretch;
                flex-direction: column;
            }

            .dashboard-grid,
            .dashboard-actions-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-section-header,
            .dashboard-list-item {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
@endpush

@section('content')
    <section class="dashboard-page-header">
        <div class="dashboard-page-title">
            <span>Overview</span>
            <h1>Dashboard</h1>
        </div>
    </section>

    <section class="dashboard-grid">
        <article class="dashboard-stat-card">
            <div class="icon">
                <i class="bi bi-people"></i>
            </div>
            <span>Total User</span>
            <strong>{{ $stats['total_users'] ?? 0 }}</strong>
        </article>

        <article class="dashboard-stat-card">
            <div class="icon">
                <i class="bi bi-hospital"></i>
            </div>
            <span>Klinik Aktif</span>
            <strong>{{ $stats['active_kliniks'] ?? 0 }}</strong>
        </article>

        <article class="dashboard-stat-card">
            <div class="icon">
                <i class="bi bi-newspaper"></i>
            </div>
            <span>Artikel Publish</span>
            <strong>{{ $stats['published_articles'] ?? 0 }}</strong>
        </article>

        <article class="dashboard-stat-card">
            <div class="icon">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <span>Draft Artikel</span>
            <strong>{{ $stats['draft_articles'] ?? 0 }}</strong>
        </article>
    </section>

    <section class="dashboard-section-card">
        <div class="dashboard-section-header">
            <div>
                <h2>Aksi Cepat</h2>
                <p>Akses cepat ke modul yang paling sering digunakan.</p>
            </div>
        </div>

        <div class="dashboard-actions-grid">
            <a href="{{ route('admin.users.index') }}" class="dashboard-action-card">
                <i class="bi bi-people"></i>
                <strong>Kelola Users</strong>
                <span>Tambah dan ubah akun admin atau kader.</span>
            </a>

            <a href="{{ route('admin.articles.index') }}" class="dashboard-action-card">
                <i class="bi bi-newspaper"></i>
                <strong>Kelola Artikel</strong>
                <span>Kelola konten berita dan publikasi.</span>
            </a>

            <a href="{{ route('admin.kliniks.index') }}" class="dashboard-action-card">
                <i class="bi bi-hospital"></i>
                <strong>Kelola Klinik</strong>
                <span>Ubah data klinik dan fasilitas layanan.</span>
            </a>

            <a href="{{ route('admin.kliniks.index') }}" class="dashboard-action-card">
                <i class="bi bi-upload"></i>
                <strong>Import Klinik</strong>
                <span>Unggah CSV dan preview data klinik.</span>
            </a>
        </div>
    </section>

    <section class="dashboard-two-column">
        <div class="dashboard-section-card">
            <div class="dashboard-section-header">
                <div>
                    <h2>Artikel Terbaru</h2>
                </div>

                <a href="{{ route('admin.articles.index') }}" class="dashboard-section-link">
                    Lihat semua
                </a>
            </div>

            <div class="dashboard-list">
                @forelse ($recentArticles as $article)
                    <div class="dashboard-list-item">
                        <div class="dashboard-list-main">
                            <strong>{{ $article->judul }}</strong>
                            <small>
                                {{ $article->topik }} · {{ optional($article->tanggal)->format('d M Y') ?? '-' }}
                            </small>
                        </div>

                        <span
                            class="dashboard-badge {{ $article->status === 'tayang' ? 'dashboard-badge-success' : 'dashboard-badge-muted' }}">
                            {{ $article->status === 'tayang' ? 'Tayang' : 'Draft' }}
                        </span>
                    </div>
                @empty
                    <div class="dashboard-list-item">
                        <div class="dashboard-list-main">
                            <strong>Belum ada artikel</strong>
                            <small>Artikel terbaru akan tampil di sini.</small>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="dashboard-section-card">
            <div class="dashboard-section-header">
                <div>
                    <h2>Klinik Terbaru</h2>
                </div>

                <a href="{{ route('admin.kliniks.index') }}" class="dashboard-section-link">
                    Lihat semua
                </a>
            </div>

            <div class="dashboard-list">
                @forelse ($recentKliniks as $klinik)
                    <div class="dashboard-list-item">
                        <div class="dashboard-list-main">
                            <strong>{{ $klinik->nama }}</strong>
                            <small>{{ $klinik->kota }}, {{ $klinik->provinsi }}</small>
                        </div>

                        <span
                            class="dashboard-badge {{ $klinik->status === 'aktif' ? 'dashboard-badge-success' : 'dashboard-badge-muted' }}">
                            {{ $klinik->status === 'aktif' ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                @empty
                    <div class="dashboard-list-item">
                        <div class="dashboard-list-main">
                            <strong>Belum ada klinik</strong>
                            <small>Data klinik terbaru akan tampil di sini.</small>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="dashboard-two-column">
        <div class="dashboard-section-card">
            <div class="dashboard-section-header">
                <div>
                    <h2>User Terbaru</h2>
                </div>

                <a href="{{ route('admin.users.index') }}" class="dashboard-section-link">
                    Lihat semua
                </a>
            </div>

            <div class="dashboard-list">
                @forelse ($recentUsers as $user)
                    <div class="dashboard-list-item">
                        <div class="dashboard-list-main">
                            <strong>{{ $user->name }}</strong>
                            <small>{{ $user->email }}</small>
                        </div>

                        <span
                            class="dashboard-badge {{ $user->is_active ? 'dashboard-badge-success' : 'dashboard-badge-muted' }}">
                            {{ $user->roleLabel() }}
                        </span>
                    </div>
                @empty
                    <div class="dashboard-list-item">
                        <div class="dashboard-list-main">
                            <strong>Belum ada user</strong>
                            <small>User terbaru akan tampil di sini.</small>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="dashboard-section-card">
            <div class="dashboard-section-header">
                <div>
                    <h2>Import Klinik Terbaru</h2>
                </div>

                <a href="{{ route('admin.kliniks.index') }}" class="dashboard-section-link">
                    Kelola import
                </a>
            </div>

            <div class="dashboard-list">
                @forelse ($recentImports as $import)
                    <div class="dashboard-list-item">
                        <div class="dashboard-list-main">
                            <strong>{{ $import->original_filename }}</strong>
                            <small>
                                {{ $import->valid_rows }}/{{ $import->total_rows }} valid ·
                                {{ optional($import->created_at)->format('d M Y H:i') }}
                            </small>
                        </div>

                        <span
                            class="dashboard-badge {{ $import->status === 'imported' ? 'dashboard-badge-success' : 'dashboard-badge-muted' }}">
                            {{ ucfirst($import->status) }}
                        </span>
                    </div>
                @empty
                    <div class="dashboard-list-item">
                        <div class="dashboard-list-main">
                            <strong>Belum ada import</strong>
                            <small>Riwayat import CSV akan tampil di sini.</small>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
