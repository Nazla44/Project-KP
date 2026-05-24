<?php $__env->startPush('styles'); ?>
    <style>
        body {
            font-family: var(--font-main);
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .login-stack {
            width: 100%;
            max-width: 400px;
        }

        .brand-wrap {
            text-align: center;
            margin-bottom: 60px;
        }

        .brand-logo {
            width: 132px;
            max-width: 100%;
            display: inline-block;
        }

        .login-card {
            background: var(--color-white);
            border: 0;
            border-radius: 20px;
            box-shadow: 0 22px 50px rgba(15, 23, 42, 0.10);
            padding: 30px 26px 26px;
        }

        .login-title {
            margin: 0 0 6px;
            text-align: center;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--color-text);
        }

        .login-subtitle {
            margin: 0 0 22px;
            text-align: center;
            color: var(--color-text-light);
            font-size: 0.95rem;
        }

        .alert-simple {
            border: 0;
            border-radius: 14px;
            background: var(--color-primary-light);
            color: var(--color-primary);
            padding: 12px 14px;
            margin-bottom: 18px;
            font-size: 0.95rem;
        }

        .form-label-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .form-label {
            margin-bottom: 0;
            font-size: 0.98rem;
            font-weight: 600;
            color: var(--color-text-light);
        }

        .form-control {
            height: 50px;
            border-radius: 12px;
            border: 1px solid var(--color-border);
            padding: 0 16px;
            font-size: 0.96rem;
            color: var(--color-text);
            box-shadow: none;
        }

        .form-control::placeholder {
            color: #9aa7b5;
        }

        .form-control:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 0.18rem var(--color-primary-light);
        }

        .btn-login {
            height: 48px;
            border: 0;
            border-radius: 14px;
            background: var(--color-primary);
            font-size: 0.98rem;
            font-weight: 700;
            color: var(--color-white);
            box-shadow: none;
        }

        .btn-login:hover,
        .btn-login:focus {
            background: var(--color-primary-hover);
            color: var(--color-white);
        }

        .remember-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }

        .remember-wrap .form-check-input {
            width: 18px;
            height: 18px;
            margin-top: 0;
            border-color: var(--color-border);
        }

        .remember-wrap .form-check-input:checked {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
        }

        .remember-wrap .form-check-input:focus {
            box-shadow: 0 0 0 0.18rem var(--color-primary-light);
        }

        .remember-wrap .form-check-label {
            color: var(--color-text-light);
            font-size: 0.94rem;
        }

        .login-note {
            margin-top: 18px;
            text-align: center;
            color: var(--color-text-light);
            font-size: 0.92rem;
        }

        @media (max-width: 575.98px) {
            .brand-wrap {
                margin-bottom: 26px;
            }

            .login-card {
                padding: 26px 20px 22px;
                border-radius: 18px;
            }

            .login-title {
                font-size: 1.55rem;
            }
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <main class="login-page">
        <div class="login-stack">
            <div class="brand-wrap">
                <img src="<?php echo e(asset('assets/image/image.png')); ?>" alt="Stop TB Partnership Indonesia" class="brand-logo">
            </div>

            <section class="login-card">
                <h1 class="login-title">Selamat Datang</h1>
                <p class="login-subtitle">Mohon masukkan detail Anda untuk masuk</p>

                <?php if($errors->any()): ?>
                    <div class="alert-simple">
                        <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>

                <form class="mb-4" method="POST" action="<?php echo e(route('admin.login.submit')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="mb-4">
                        <label for="email" class="form-label mb-2">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo e(old('email')); ?>"
                            placeholder="name@example.com" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label mb-2">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter your password" required>
                    </div>

                    <div class="form-check remember-wrap">
                        <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
                    </div>

                    <button type="submit" class="btn btn-login w-100">Masuk ke Dashboard</button>
                </form>
            </section>
        </div>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.blank', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Punya Aska\Kulyeah\SEMESTER 6\KP\Project-KP-kader-flow-refactored\Project-KP - Copy\resources\views/admin/login.blade.php ENDPATH**/ ?>