
<section class="pk-pilars" id="pilar-program">
    <div class="container-xl px-4 px-lg-5">

        <div class="text-center mb-5 pk-reveal">
            <span class="section-tag">Cara Kerja Kami</span>

            <h2 class="pk-section-title mt-3">
                Program <span class="pk-title-accent">Implementasi TBC</span>
            </h2>

            <p class="pk-section-subtitle mx-auto mt-3">
                Pengembangan program berbasis kolaborasi lintas sektor, layanan klinik,
                edukasi digital, pendampingan pasien, dukungan psikososial, dan pelibatan
                relawan muda untuk memperkuat penanggulangan TBC.
            </p>
        </div>

        <div class="pk-program-list">

            <?php $__currentLoopData = $pilars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pilar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="pk-program-item pk-reveal <?php echo e($pilar['color_class'] ?? 'pilar-red'); ?>">

                    <div class="pk-program-marker">
                        <span class="pk-program-number">
                            <?php echo e($pilar['number']); ?>

                        </span>

                        <div class="pk-program-icon">
                            <i class="bi <?php echo e($pilar['icon']); ?>"></i>
                        </div>
                    </div>

                    <div class="pk-program-content">

                        <span class="pk-pilar-tag">
                            Program <?php echo e($pilar['number']); ?>

                        </span>

                        <h3 class="pk-program-title">
                            <?php echo e($pilar['title']); ?>

                        </h3>

                        <p class="pk-program-desc">
                            <?php echo e($pilar['description']); ?>

                        </p>

                        <div class="pk-program-block">
                            <h4>Fokus Implementasi</h4>

                            <ul class="pk-program-list-points">
                                <?php $__currentLoopData = $pilar['activities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <i class="bi bi-check-circle-fill pk-check-icon"></i>
                                        <span><?php echo e($activity); ?></span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>

                    </div>

                </article>

                <?php if(!$loop->last): ?>
                    <hr class="pk-program-divider">
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </div>
</section><?php /**PATH D:\Punya Aska\Kulyeah\SEMESTER 6\KP\Project-KP-kader-flow-refactored\Project-KP - Copy\resources\views/sections/program-komunitas/pilars.blade.php ENDPATH**/ ?>