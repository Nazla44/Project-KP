<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', 'Dashboard Kader'); ?> - Stop TB Partnership Indonesia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/kader.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="<?php if (! empty(trim($__env->yieldContent('auth_plain')))): ?>
kader-auth-body
<?php else: ?>
kader-dashboard-body
<?php endif; ?>">

    <?php if (! empty(trim($__env->yieldContent('auth_plain')))): ?>
        <?php echo $__env->yieldContent('content'); ?>
    <?php else: ?>
        <div class="kader-admin-layout" id="kaderApp">

            <aside class="kader-sidebar">
                <div class="kader-sidebar-logo">
                    <a href="<?php echo e(route('kader.dashboard')); ?>">
                        <img src="<?php echo e(asset('assets/image/image.png')); ?>" alt="Stop TB Partnership Indonesia">
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
                    <a href="<?php echo e(route('kader.dashboard')); ?>"
                        class="kader-sidebar-link <?php echo e(request()->routeIs('kader.dashboard') ? 'active' : ''); ?>">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="<?php echo e(route('kader.jadwal.index')); ?>"
                        class="kader-sidebar-link <?php echo e(request()->routeIs('kader.jadwal.*') || request()->routeIs('kader.kegiatan.*') ? 'active' : ''); ?>">
                        <i class="bi bi-calendar-event-fill"></i>
                        <span>Jadwal Sosialisasi</span>
                    </a>

                    <a href="<?php echo e(route('kader.rekap-sosialisasi.index')); ?>"
                        class="kader-sidebar-link <?php echo e(request()->routeIs('kader.rekap-sosialisasi.*') ? 'active' : ''); ?>">
                        <i class="bi bi-journal-check"></i>
                        <span>Rekap Sosialisasi</span>
                    </a>

                    <a href="<?php echo e(route('kader.riwayat-jadwal.index')); ?>"
                        class="kader-sidebar-link <?php echo e(request()->routeIs('kader.riwayat-jadwal.*') ? 'active' : ''); ?>">
                        <i class="bi bi-clock-history"></i>
                        <span>Riwayat Jadwal</span>
                    </a>

                    <a href="<?php echo e(route('kader.riwayat-screening.index')); ?>"
                        class="kader-sidebar-link <?php echo e(request()->routeIs('kader.riwayat-screening.*') ? 'active' : ''); ?>">
                        <i class="bi bi-clipboard2-pulse-fill"></i>
                        <span>Riwayat Screening</span>
                    </a>
                </nav>

                <div class="kader-sidebar-footer">
                    <form method="POST" action="<?php echo e(route('kader.logout')); ?>" class="js-confirm-logout">
                        <?php echo csrf_field(); ?>

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
                            <?php echo $__env->yieldContent('page_title', 'Dashboard Kader'); ?>
                        </div>
                        <div class="kader-topbar-subtitle">
                            Stop TB Partnership Indonesia
                        </div>
                    </div>

                    <?php if(auth()->guard()->check()): ?>
                        <div class="kader-topbar-user">
                            <div class="kader-topbar-user-text">
                                <strong><?php echo e(auth()->user()->name); ?></strong>
                                <span>Kader</span>
                            </div>

                            <div class="kader-topbar-avatar">
                                <?php echo e(strtoupper(substr(auth()->user()->name ?? 'K', 0, 1))); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                </header>

                <main class="kader-content">
                    <?php echo $__env->yieldContent('content'); ?>
                </main>
            </div>
        </div>
    <?php endif; ?>

    <script>
        window.AppFlash = {
            success: <?php echo json_encode(session('success') ?? session('status'), 15, 512) ?>,
            error: <?php echo json_encode(session('error'), 15, 512) ?>,
            warning: <?php echo json_encode(session('warning'), 15, 512) ?>,
            info: <?php echo json_encode(session('info'), 15, 512) ?>,
            validationErrors: <?php echo json_encode($errors->any() ? $errors->all() : [], 15, 512) ?>,
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo e(asset('js/app-alerts.js')); ?>"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('kaderSidebarToggle');
            const layout = document.getElementById('kaderApp');

            if (!toggleButton || !layout) return;

            if (localStorage.getItem('kaderSidebarCollapsed') === '1') {
                layout.classList.add('kader-sidebar-collapsed');
            }

            toggleButton.addEventListener('click', function() {
                layout.classList.toggle('kader-sidebar-collapsed');

                localStorage.setItem(
                    'kaderSidebarCollapsed',
                    layout.classList.contains('kader-sidebar-collapsed') ? '1' : '0'
                );
            });
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/layouts/kader.blade.php ENDPATH**/ ?>