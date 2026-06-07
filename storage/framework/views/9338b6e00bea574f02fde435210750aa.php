<?php $__env->startSection('title', 'Buat Password Kader – Stop TB Partnership Indonesia'); ?>

<?php $__env->startSection('content'); ?>
    <section class="py-5" style="background:#f8fafc; min-height:70vh;">
        <div class="container-xl px-4 px-lg-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-7 col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4 p-lg-5">
                            <div class="text-center mb-4">
                                <div class="mb-3">
                                    <i class="bi bi-shield-lock-fill" style="font-size: 42px; color:#c31513;"></i>
                                </div>
                                <h1 class="h4 fw-bold mb-2">Buat Password Kader</h1>
                                <p class="text-muted mb-0">
                                    Masukkan password baru untuk mengaktifkan akun kader Anda.
                                </p>
                            </div>

                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger">
                                    <strong>Gagal membuat password.</strong>
                                    <ul class="mb-0 mt-2">
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="<?php echo e(route('kader.password.update')); ?>">
                                <?php echo csrf_field(); ?>

                                <input type="hidden" name="token" value="<?php echo e($token); ?>">

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <input type="email" id="email" name="email"
                                        class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        value="<?php echo e(old('email', $email)); ?>" required autocomplete="email">
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">Password Baru</label>
                                    <input type="password" id="password" name="password"
                                        class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required
                                        autocomplete="new-password">
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <div class="form-text">
                                        Minimal 8 karakter.
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi
                                        Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" required autocomplete="new-password">
                                </div>

                                <button type="submit" class="btn w-100 text-white fw-semibold" style="background:#c31513;">
                                    Simpan Password
                                </button>
                            </form>

                            <p class="text-muted small text-center mt-4 mb-0">
                                Link ini hanya dapat digunakan satu kali.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/auth/kader-set-password.blade.php ENDPATH**/ ?>