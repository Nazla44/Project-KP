<aside class="admin-sidebar" id="adminSidebar">
    <div class="admin-sidebar-head">
        <button type="button" class="admin-sidebar-toggle" id="adminSidebarToggle" aria-label="Toggle sidebar">
            <i class="bi bi-list"></i>
            <span>Menu</span>
        </button>
    </div>

    <div class="admin-sidebar-scroll">
        <p class="admin-nav-label">Main</p>

        <nav class="admin-nav">
            <a href="<?php echo e(route('admin.dashboard')); ?>"
                class="admin-nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="<?php echo e(route('admin.users.index')); ?>"
                class="admin-nav-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
                <i class="bi bi-people-fill"></i>
                <span>Users</span>
            </a>

            <a href="<?php echo e(route('admin.kaders.index')); ?>"
                class="admin-nav-link <?php echo e(request()->routeIs('admin.kaders.*') ? 'active' : ''); ?>">
                <i class="bi bi-person-check-fill"></i>
                <span>Kader</span>
            </a>

            <a href="<?php echo e(route('admin.articles.index')); ?>"
                class="admin-nav-link <?php echo e(request()->routeIs('admin.articles.*') ? 'active' : ''); ?>">
                <i class="bi bi-newspaper"></i>
                <span>Artikel</span>
            </a>

            <a href="<?php echo e(route('admin.kliniks.index')); ?>"
                class="admin-nav-link <?php echo e(request()->routeIs('admin.kliniks.*') ? 'active' : ''); ?>">
                <i class="bi bi-hospital"></i>
                <span>Klinik</span>
            </a>

            <a href="<?php echo e(route('admin.kegiatan-sosial.index')); ?>"
                class="admin-nav-link <?php echo e(request()->routeIs('admin.kegiatan-sosial.*') ? 'active' : ''); ?>">
                <i class="bi bi-calendar-event-fill"></i>
                <span>Jadwal Sosialisasi</span>
            </a>
        </nav>
    </div>

    <div class="admin-sidebar-footer">
        <form method="POST" action="<?php echo e(route('admin.logout')); ?>" class="js-confirm-logout">
            <?php echo csrf_field(); ?>

            <button type="submit" class="admin-nav-link admin-logout-button">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/partials/admin/sidebar.blade.php ENDPATH**/ ?>