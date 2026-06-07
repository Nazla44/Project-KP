<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($pageTitle ?? 'STPI'); ?> - Stop TB Partnership Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet">
    <style>
        body.blank-layout {
            min-height: 100vh;
            background: #f5f5f5;
            color: var(--color-text);
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="blank-layout">
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH /Users/aureliadwiwi/Desktop/KP/STPI/Project-KP/resources/views/layouts/blank.blade.php ENDPATH**/ ?>