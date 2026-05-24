<?php $__env->startSection('title', 'Program Komunitas – Stop TB Partnership Indonesia'); ?>

<?php $__env->startPush('styles'); ?>
    <link href="<?php echo e(asset('css/program-komunitas.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('sections.program-komunitas.hero', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('sections.program-komunitas.tentang', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('sections.program-komunitas.pilars', ['pilars' => $pilars], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('sections.program-komunitas.mitra', ['mitra' => $mitra], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('sections.program-komunitas.stories', ['stories' => $stories], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('sections.program-komunitas.faq', ['faqs' => $faqs], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        // Scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('pk-visible');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.pk-reveal').forEach(el => observer.observe(el));
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Punya Aska\Kulyeah\SEMESTER 6\KP\Project-KP-kader-flow-refactored\Project-KP - Copy\resources\views/pages/program-komunitas.blade.php ENDPATH**/ ?>