@extends('layouts.admin')

@push('styles')
    <style>
        .article-cover-thumb {
            width: 72px;
            height: 72px;
            object-fit: cover;
            border-radius: 14px;
            border: 1px solid rgba(15, 23, 42, 0.08);
        }
    </style>
@endpush

@section('content')
    <section class="users-page-header">
        <div class="users-page-title">
            <span>Konten</span>
            <h1>{{ $pageTitle }}</h1>
            <p>Kelola artikel yang akan tampil pada halaman berita untuk pengunjung website.</p>
        </div>

        <a href="{{ route('admin.articles.create') }}" class="btn btn-danger users-create-button">
            <i class="bi bi-plus-circle"></i>
            <span>Tambah Artikel</span>
        </a>
    </section>

    @if (session('status'))
        <div class="alert users-alert users-alert-success mb-4">
            <i class="bi bi-check-circle-fill"></i>
            <div>{{ session('status') }}</div>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert users-alert users-alert-danger mb-4">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <div>{{ $errors->first() }}</div>
        </div>
    @endif

    <section class="users-table-card">
        <div class="users-table-header">
            <div>
                <h2>Daftar Artikel</h2>
                <p>Gunakan pencarian dan sortir untuk mengelola artikel dengan cepat.</p>
            </div>

            <div class="users-search-box">
                <i class="bi bi-search"></i>
                <input type="text" id="articles-search" class="form-control" placeholder="Cari artikel...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table users-table align-middle mb-0" id="articles-table">
                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Judul</th>
                        <th>Topik</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td>
                                <img src="{{ $article->cover_image_url }}" alt="{{ $article->judul }}" class="article-cover-thumb">
                            </td>
                            <td>
                                <div class="users-profile-cell">
                                    <div>
                                        <strong>{{ $article->judul }}</strong>
                                        <small>{{ $article->slug }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="users-role-pill is-kader">{{ $article->topik }}</span>
                            </td>
                            <td>{{ $article->penulis ?: '-' }}</td>
                            <td class="users-date">{{ optional($article->tanggal)->format('d M Y') }}</td>
                            <td>
                                <span class="users-status-pill {{ $article->status === 'tayang' ? 'is-active' : 'is-inactive' }}">
                                    <span></span>{{ $article->status === 'tayang' ? 'Tayang' : 'Draft' }}
                                </span>
                            </td>
                            <td>
                                <div class="users-actions">
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="users-icon-button" title="Edit artikel">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form method="POST" action="{{ route('admin.articles.destroy', $article) }}"
                                        onsubmit="return confirm('Hapus artikel ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="users-icon-button users-icon-button-danger" title="Hapus artikel">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        initAdminDataTable('#articles-table', {
            actionColumn: 6,
            searchInput: '#articles-search',
        });
    </script>
@endpush
