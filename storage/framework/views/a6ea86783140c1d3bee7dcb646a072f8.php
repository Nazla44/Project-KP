<?php $__env->startSection('title', 'Pendaftaran Berhasil – Stop TB Partnership Indonesia'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/form-kader.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="fk-sukses-wrapper">
        <div class="container-xl px-4 px-lg-5 py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6 text-center">

                    <div class="fk-sukses-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>

                    <h1 class="fk-sukses-title">Pendaftaran Berhasil!</h1>

                    <p class="fk-sukses-desc">
                        Terima kasih, <strong><?php echo e($nama); ?></strong>! Pendaftaran Anda sebagai kader komunitas TBC
                        telah kami
                        terima.
                        Data Anda sudah masuk ke sistem dan sedang menunggu proses verifikasi admin.
                        Hasil approval atau penolakan akan dikirim ke email <strong><?php echo e($email); ?></strong>.
                        Jika disetujui, Anda akan menerima link untuk membuat password akun kader.
                    </p>

                    <div class="fk-sukses-steps">
                        <div class="fk-step">
                            <div class="fk-step-num">1</div>
                            <div class="fk-step-text">Data Anda diverifikasi oleh tim STPI</div>
                        </div>
                        <div class="fk-step-arrow"><i class="bi bi-chevron-right"></i></div>
                        <div class="fk-step">
                            <div class="fk-step-num">2</div>
                            <div class="fk-step-text">Anda dihubungi untuk wawancara singkat</div>
                        </div>
                        <div class="fk-step-arrow"><i class="bi bi-chevron-right"></i></div>
                        <div class="fk-step">
                            <div class="fk-step-num">3</div>
                            <div class="fk-step-text">Pelatihan kader komunitas TBC</div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center gap-3 mt-5">
                        <a href="<?php echo e(route('home')); ?>" class="btn-primary-red">
                            Kembali ke Beranda
                            <span class="btn-icon"><i class="bi bi-arrow-up-right"></i></span>
                        </a>
                        <a href="<?php echo e(route('program-komunitas')); ?>" class="pk-btn-outline">
                            Program Komunitas
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Punya Aska\Kulyeah\SEMESTER 6\KP\Project-KP-kader-flow-refactored\Project-KP - Copy\resources\views/pages/kader-sukses.blade.php ENDPATH**/ ?>