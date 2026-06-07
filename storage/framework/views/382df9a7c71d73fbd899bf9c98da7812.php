<?php $__env->startSection('title', 'Password Berhasil Dibuat – Stop TB Partnership Indonesia'); ?>

<?php $__env->startSection('content'); ?>
    <section class="py-5" style="background:#f8fafc; min-height:70vh;">
        <div class="container-xl px-4 px-lg-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-7 col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4 p-lg-5 text-center">
                            <div class="mb-4">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                                    style="width:72px;height:72px;background:#dcfce7;color:#15803d;">
                                    <i class="bi bi-check-lg" style="font-size: 42px;"></i>
                                </div>
                            </div>

                            <h1 class="h4 fw-bold mb-3">
                                Password Berhasil Dibuat
                            </h1>

                            <p class="text-muted mb-3">
                                Akun kader Anda sudah aktif dan password baru berhasil disimpan.
                            </p>

                            <?php if($email): ?>
                                <div class="alert alert-light border rounded-3 text-start">
                                    <div class="small text-muted mb-1">Email akun kader</div>
                                    <div class="fw-semibold"><?php echo e($email); ?></div>
                                </div>
                            <?php endif; ?>

                            <p class="text-muted mb-4">
                                Silakan gunakan email dan password tersebut untuk login ke aplikasi kader.
                            </p>

                            <a href="<?php echo e(route('home')); ?>" class="btn text-white fw-semibold px-4"
                                style="background:#c31513;">
                                Kembali ke Beranda
                            </a>

                            <p class="text-muted small mt-4 mb-0">
                                Halaman ini hanya ditampilkan satu kali setelah proses pembuatan password berhasil.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/auth/kader-password-created.blade.php ENDPATH**/ ?>