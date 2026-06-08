<?php $__env->startSection('title', 'Login Kader'); ?>

<?php $__env->startSection('auth_plain', true); ?>

<?php $__env->startSection('content'); ?>
    <div class="kader-auth-page">
        <div class="kader-auth-wrapper">

            <div class="brand-wrap">
                <img src="<?php echo e(asset('assets/image/image.png')); ?>" alt="Stop TB Partnership Indonesia" class="brand-logo">
            </div>

            <div class="kader-auth-card">
                <h1 class="kader-auth-title">Selamat Datang</h1>

                <p class="kader-auth-subtitle">
                    Mohon masukkan detail Anda untuk masuk
                </p>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger mb-4">
                        <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('kader.login.submit')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="mb-4">
                        <label class="kader-auth-label">Email Address</label>

                        <input
                            type="text"
                            name="login"
                            value="<?php echo e(old('login')); ?>"
                            class="kader-auth-input"
                            placeholder="name@example.com"
                            required
                            autofocus
                        >
                    </div>

                    <div class="mb-0">
                        <label class="kader-auth-label">Password</label>

                        <input
                            type="password"
                            name="password"
                            class="kader-auth-input"
                            placeholder="Enter your password"
                            required
                        >
                    </div>

                    <label class="kader-auth-check">
                        <input type="checkbox" name="remember" value="1">
                        <span>Ingat saya</span>
                    </label>

                    <button type="submit" class="kader-auth-button">
                        Masuk ke Dashboard
                    </button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.kader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/kader/auth/login.blade.php ENDPATH**/ ?>