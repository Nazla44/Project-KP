<header class="admin-topbar">
    <div class="admin-topbar-brand">
        <a href="{{ route('admin.dashboard') }}" class="admin-topbar-logo">
            <img src="{{ asset('assets/image/image.png') }}" alt="Stop TB Partnership Indonesia">
        </a>
    </div>

    @auth
        <div class="admin-topbar-user">
            <div class="admin-topbar-user-text">
                <strong>{{ auth()->user()->name }}</strong>
                <span>{{ auth()->user()->roleLabel() }}</span>
            </div>

            <span class="admin-topbar-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </span>
        </div>
    @endauth
</header>
