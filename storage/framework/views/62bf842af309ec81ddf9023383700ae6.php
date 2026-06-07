<section class="news-section">
    <div class="container-xl px-4 px-lg-5 py-5">
        <div class="d-flex align-items-start justify-content-between mb-4">
            <div>
                <span class="section-tag mb-3">Berita</span>
                <h2 class="section-title mb-0">Berita TBC Terkini</h2>
            </div>
            <a href="#" class="btn-news btn-primary-red d-inline-flex align-items-center rounded-pill px-6 py-6 flex-shrink-0 align-self-end">
                Lebih Banyak <span class="btn-news-icon d-flex align-items-center justify-content-center rounded-circle"><i class="bi bi-arrow-up-right"></i></span>
            </a>
        </div>

        <div class="row g-4">
            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="news-card">
                        <div class="news-img-wrap overflow-hidden rounded-3 mb-3">
                            <img src="<?php echo e(asset($article['img'])); ?>" alt="<?php echo e($article['title']); ?>" class="news-img w-100">
                        </div>
                        <span class="news-cat" style="color: var(--color-primary);"><?php echo e($article['category']); ?></span>
                        <h3 class="news-card-title mt-3 mb-2"><?php echo e($article['title']); ?></h3>
                        <p class="news-card-desc mb-0"><?php echo e($article['excerpt']); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH D:\Kuliah\SMT 6\KP\Project-KP\resources\views/sections/home/news.blade.php ENDPATH**/ ?>