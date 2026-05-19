<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard - STPI')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --primary-red: #e30613;
            --dark-red: #b8000b;
            --soft-bg: #f5f6fa;
            --text-dark: #202124;
            --text-muted: #6c757d;
            --border-color: #e9ecef;
        }

        body {
            background: var(--soft-bg);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--text-dark);
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #e30613 0%, #99000a 100%);
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            padding: 24px 18px;
            z-index: 1000;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px;
        }

        .sidebar-logo {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #fff;
            color: var(--primary-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
        }

        .sidebar-brand h5 {
            margin: 0;
            font-weight: 700;
            line-height: 1.2;
        }

        .sidebar-brand small {
            opacity: .8;
            font-size: 12px;
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, .85);
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 14px;
            font-weight: 500;
            transition: .2s;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: rgba(255, 255, 255, .18);
            color: #fff;
        }

        .sidebar-link i {
            font-size: 18px;
        }

        .sidebar-footer {
            position: absolute;
            left: 18px;
            right: 18px;
            bottom: 20px;
        }

        .admin-main {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
        }

        .admin-topbar {
            height: 76px;
            background: #fff;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .topbar-title h4 {
            margin: 0;
            font-weight: 700;
        }

        .topbar-title p {
            margin: 2px 0 0;
            color: var(--text-muted);
            font-size: 14px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .notification-btn {
            position: relative;
            border: 1px solid var(--border-color);
            background: #fff;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-dot {
            position: absolute;
            top: 8px;
            right: 9px;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--primary-red);
            border: 2px solid #fff;
        }

        .admin-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #ffe3e5;
            color: var(--primary-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .admin-content {
            padding: 32px;
        }

        .stat-card {
            border: 0;
            border-radius: 22px;
            box-shadow: 0 10px 30px rgba(20, 20, 20, .06);
        }

        .stat-icon {
            width: 54px;
            height: 54px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .bg-soft-red {
            background: #ffe3e5;
            color: var(--primary-red);
        }

        .bg-soft-blue {
            background: #e7f0ff;
            color: #0d6efd;
        }

        .bg-soft-green {
            background: #e8f7ef;
            color: #198754;
        }

        .content-card {
            border: 0;
            border-radius: 22px;
            box-shadow: 0 10px 30px rgba(20, 20, 20, .06);
        }

        @media (max-width: 991px) {
            .admin-sidebar {
                position: static;
                width: 100%;
                min-height: auto;
                border-radius: 0 0 24px 24px;
            }

            .admin-wrapper {
                display: block;
            }

            .admin-main {
                margin-left: 0;
                width: 100%;
            }

            .sidebar-footer {
                position: static;
                margin-top: 24px;
            }

            .admin-topbar {
                padding: 0 18px;
            }

            .admin-content {
                padding: 22px;
            }
        }
        .placeholder-soft::placeholder {
                color: #adb5bd;
                opacity: 0.65;
                font-weight: 400;
            }
    </style>

    @stack('styles')
</head>

<body>

    <div class="admin-wrapper">

        {{-- Sidebar --}}
        <aside class="admin-sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-logo">ST</div>
                <div>
                    <h5>STPI Admin</h5>
                    <small>Management Panel</small>
                </div>
            </div>

            <nav class="sidebar-menu">
                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('artikel.index') }}"
                   class="sidebar-link {{ request()->routeIs('artikel.*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper"></i>
                    <span>Artikel</span>
                </a>

                @if (Route::has('klinik.index'))
                    <a href="{{ route('klinik.index') }}"
                       class="sidebar-link {{ request()->routeIs('klinik.*') ? 'active' : '' }}">
                        <i class="bi bi-hospital-fill"></i>
                        <span>Klinik</span>
                    </a>
                @endif

                <a href="{{ route('kader.index') }}"
                   class="sidebar-link {{ request()->routeIs('kader.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Kader</span>
                </a>

                <a href="{{ route('laporan.index') }}"
                class="sidebar-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                    <i class="bi bi-file-earmark-arrow-up-fill"></i>
                    <span>Laporan</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('admin.logout') }}" class="form-logout">
                    @csrf
                    <button type="submit" class="btn btn-light w-100">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main --}}
        <main class="admin-main">

            {{-- Topbar --}}
            <header class="admin-topbar">
                <div class="topbar-title">
                    <h4>@yield('page-title', 'Dashboard')</h4>
                    <p>@yield('page-subtitle', 'Kelola data website STPI')</p>
                </div>

                <div class="topbar-actions">
                    <div class="dropdown">
                        <button class="notification-btn" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span class="notification-dot"></span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end shadow border-0 p-3" style="width: 280px;">
                            <h6 class="fw-bold mb-2">Notifikasi</h6>
                            <p class="small text-muted mb-0">
                                Selamat datang di dashboard admin STPI.
                            </p>
                        </div>
                    </div>

                    <div class="admin-avatar">
                        {{ strtoupper(substr(auth('admin')->user()->name ?? 'A', 0, 1)) }}
                    </div>
                </div>
            </header>

            <section class="admin-content">
                @yield('content')
            </section>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Popup sukses --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: @json(session('success')),
                timer: 2200,
                showConfirmButton: false
            });
        </script>
    @endif

    {{-- Popup error --}}
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: @json(session('error')),
            });
        </script>
    @endif

    {{-- Popup konfirmasi hapus --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.form-delete').forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Hapus data?',
                        text: 'Data yang dihapus tidak dapat dikembalikan.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e30613',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.form-logout').forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Logout dari dashboard?',
                        text: 'Anda akan keluar dari halaman admin.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#e30613',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, logout',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.form-confirm').forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    if (!form.checkValidity()) {
                        form.reportValidity();
                        return;
                    }

                    const title = form.dataset.title || 'Yakin ingin menyimpan data?';
                    const text = form.dataset.text || 'Pastikan data yang dimasukkan sudah benar.';
                    const confirmText = form.dataset.confirm || 'Ya, simpan';

                    Swal.fire({
                        title: title,
                        text: text,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#e30613',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: confirmText,
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>