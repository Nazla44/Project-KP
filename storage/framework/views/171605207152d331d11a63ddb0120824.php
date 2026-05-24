<header class="admin-topbar">
    <div class="admin-topbar-brand">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="admin-topbar-logo">
            <img src="<?php echo e(asset('assets/image/image.png')); ?>" alt="Stop TB Partnership Indonesia">
        </a>
    </div>

    <?php if(auth()->guard()->check()): ?>
        <div class="admin-topbar-user">
            <div class="admin-topbar-user-text">
                <strong><?php echo e(auth()->user()->name); ?></strong>
                <span><?php echo e(auth()->user()->roleLabel()); ?></span>
            </div>

            <span class="admin-topbar-avatar">
                <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

            </span>
        </div>
    <?php endif; ?>
</header>
<?php /**PATH D:\Punya Aska\Kulyeah\SEMESTER 6\KP\Project-KP-kader-flow-refactored\Project-KP - Copy\resources\views/partials/admin/topbar.blade.php ENDPATH**/ ?>