<section class="stats-section mb-5">
    <div class="container-xl px-4 px-lg-5 pt-5 pb-5 text-center">
        <span class="section-tag mb-4">Dampak</span>
        <h2 class="stats-title">
            Kami telah berhasil menjangkau <span class="stats-highlight">2,3jt++</span> orang di seluruh Indonesia
        </h2>
    </div>

    <div class="row g-0">
        <?php $__currentLoopData = $impactData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12 col-md-3 stats-item" style="background-image: url('<?php echo e(asset($item['img'])); ?>')">
                <div class="stats-overlay">
                    <div class="stats-content">
                        <div class="d-flex align-items-baseline justify-content-center">
                            <span class="stat-number"><?php echo e($item['number']); ?></span>
                            <?php if(!empty($item['suffix'])): ?>
                                <span class="stat-suffix"><?php echo e($item['suffix']); ?></span>
                            <?php endif; ?>
                        </div>
                        <p class="stat-desc"><?php echo e($item['description']); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php /**PATH D:\Kuliah\SMT 6\KP\Project-KP\resources\views/sections/home/stats.blade.php ENDPATH**/ ?>