
<section class="pk-stories">
    <div class="container-xl px-4 px-lg-5">

        <div class="d-flex align-items-end justify-content-between mb-5 flex-wrap gap-3">
            <div>
                <span class="section-tag">Dari Lapangan</span>
                <h2 class="pk-section-title mt-3">
                    Kisah <span class="pk-title-accent">Nyata</span>
                </h2>
            </div>
        </div>

        <div class="row g-4">
            <?php $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-md-6 col-lg-4">
                    
                    <a href="<?php echo e(route('artikel.show', $story['slug'])); ?>" class="pk-story-card text-decoration-none">
                        <div class="pk-story-img-wrap">
                            <img src="<?php echo e(asset($story['image'])); ?>" alt="<?php echo e($story['title']); ?>" class="pk-story-img">
                            <span class="pk-story-tag"><?php echo e($story['tag']); ?></span>
                        </div>
                        <div class="pk-story-body">
                            <div class="pk-story-location">
                                <i class="bi bi-geo-alt-fill"></i>
                                <?php echo e($story['location']); ?>

                            </div>
                            <h3 class="pk-story-title"><?php echo e($story['title']); ?></h3>
                            <p class="pk-story-excerpt"><?php echo e($story['excerpt']); ?></p>
                            <span class="pk-story-link">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
</section><?php /**PATH D:\Punya Aska\Kulyeah\SEMESTER 6\KP\Project-KP-kader-flow-refactored\Project-KP - Copy\resources\views/sections/program-komunitas/stories.blade.php ENDPATH**/ ?>