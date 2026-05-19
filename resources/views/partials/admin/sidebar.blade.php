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
            <a href="{{ route('admin.dashboard') }}"
                class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Overview</span>
            </a>

            <a href="{{ route('admin.users.index') }}"
                class="admin-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Users</span>
            </a>

            <a href="{{ route('admin.articles.index') }}"
                class="admin-nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                <i class="bi bi-newspaper"></i>
                <span>Artikel</span>
            </a>
        </nav>
    </div>

    <div class="admin-sidebar-footer">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="admin-nav-link admin-logout-button">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
