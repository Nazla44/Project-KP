<section class="hero-section">
    <div class="hero-main position-relative d-flex align-items-end">
        <div class="hero-bg position-absolute top-0 start-0 w-100 h-100"></div>
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100"></div>

        <div class="position-relative w-100">
            <div class="container-xl">
                <div class="row">
                    <div class="col-12 col-lg-9">
                        <h1 class="hero-title text-white mt-5">Melangkah Bersama<br>Menuju Indonesia Bebas TBC 2030</h1>
                        <p class="hero-subtitle">Menggerakkan kolaborasi lintas sektor untuk mengakhiri eliminasi tuberkulosis di seluruh pelosok negeri.</p>
                        <a href="#" class="btn btn-hero d-inline-flex align-items-center gap-2 rounded-pill px-4 py-2">
                            Gabung Gerakan
                            <span class="btn-hero-icon d-flex align-items-center justify-content-center rounded-circle"><i class="bi bi-arrow-up-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5 px-0">
        <div class="row g-3 mx-0">
            <?php $__currentLoopData = $homeCards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-md-4">
                    <div class="hero-card rounded-4 overflow-hidden position-relative">
                        <img src="<?php echo e(asset($card['image'])); ?>" alt="<?php echo e($card['title']); ?>" class="hero-card-img">
                        <div class="hero-card-dark position-absolute top-0 start-0 w-100 h-100"></div>
                        <div class="hero-card-overlay position-absolute top-0 start-0 w-100 h-100"></div>
                        <div class="position-absolute bottom-0 start-0 p-4 w-100" style="z-index:3;">
                            <h3 class="hero-card-title text-white mb-3"><?php echo e($card['title']); ?></h3>
                            <a href="#" class="btn btn-card d-inline-flex align-items-center gap-2 rounded-pill px-4 py-2">
                                Gabung Gerakan
                                <span class="btn-card-icon d-flex align-items-center justify-content-center rounded-circle"><i class="bi bi-arrow-up-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH D:\Punya Aska\Kulyeah\SEMESTER 6\KP\Project-KP\resources\views/sections/home/hero.blade.php ENDPATH**/ ?>