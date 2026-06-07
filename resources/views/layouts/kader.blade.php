<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard Kader') - Stop TB Partnership Indonesia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/kader.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('kaderSidebarToggle');
        const layout = document.querySelector('.kader-admin-layout');

        if (!toggleButton || !layout) return;

        toggleButton.addEventListener('click', function () {
            layout.classList.toggle('kader-sidebar-collapsed');

            localStorage.setItem(
                'kaderSidebarCollapsed',
                layout.classList.contains('kader-sidebar-collapsed') ? '1' : '0'
            );
        });

        if (localStorage.getItem('kaderSidebarCollapsed') === '1') {
            layout.classList.add('kader-sidebar-collapsed');
        }
    });
</script>

@stack('scripts')

<body>
    @hasSection('auth_plain')
        @yield('content')
    @else
        <div class="kader-admin-layout">

            <aside class="kader-sidebar">
                <div class="kader-sidebar-logo">
                    <a href="{{ route('kader.dashboard') }}">
                        <img src="{{ asset('assets/image/image.png') }}" alt="Stop TB Partnership Indonesia">
                    </a>
                </div>

                <button type="button" class="kader-sidebar-menu-button" id="kaderSidebarToggle">
                    <i class="bi bi-list"></i>
                    <span>Menu</span>
                </button>

                <div class="kader-sidebar-section-title">
                    Main
                </div>

                <nav class="kader-sidebar-nav">
                    <a href="{{ route('kader.dashboard') }}"
                        class="kader-sidebar-link {{ request()->routeIs('kader.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('kader.jadwal.index') }}"
                        class="kader-sidebar-link {{ request()->routeIs('kader.jadwal.*') || request()->routeIs('kader.kegiatan.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-event-fill"></i>
                        <span>Jadwal Sosialisasi</span>
                    </a>

                    <a href="{{ route('kader.riwayat-jadwal.index') }}"
                        class="kader-sidebar-link {{ request()->routeIs('kader.riwayat-jadwal.*') ? 'active' : '' }}">
                        <i class="bi bi-clock-history"></i>
                        <span>Riwayat Jadwal</span>
                    </a>

                    <a href="{{ route('kader.riwayat-screening.index') }}"
                        class="kader-sidebar-link {{ request()->routeIs('kader.riwayat-screening.*') ? 'active' : '' }}">
                        <i class="bi bi-clipboard2-pulse-fill"></i>
                        <span>Riwayat Screening</span>
                    </a>
                </nav>

                <div class="kader-sidebar-footer">
                    <form method="POST" action="{{ route('kader.logout') }}" class="js-confirm-logout">
                        @csrf

                        <button type="submit" class="kader-sidebar-link kader-logout-button">
                            <i class="bi bi-box-arrow-left"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </aside>

            <div class="kader-main-area">
                <header class="kader-topbar">
                    <div>
                        <div class="kader-topbar-title">
                            @yield('page_title', 'Dashboard Kader')
                        </div>
                        <div class="kader-topbar-subtitle">
                            Stop TB Partnership Indonesia
                        </div>
                    </div>

                    @auth
                        <div class="kader-topbar-user">
                            <div class="kader-topbar-user-text">
                                <strong>{{ auth()->user()->name }}</strong>
                                <span>Kader</span>
                            </div>

                            <div class="kader-topbar-avatar">
                                {{ strtoupper(substr(auth()->user()->name ?? 'K', 0, 1)) }}
                            </div>
                        </div>
                    @endauth
                </header>

                <main class="kader-content">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        window.AppFlash = {
            success: @json(session('success') ?? session('status')),
            error: @json(session('error')),
            warning: @json(session('warning')),
            info: @json(session('info')),
            validationErrors: @json($errors->any() ? $errors->all() : []),
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app-alerts.js') }}"></script>

    @stack('scripts')
    </body>
    @stack('scripts')
</body>

</html>