<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($pageTitle ?? 'Admin STPI'); ?> - Stop TB Partnership Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/admin.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="admin-layout">
    <div class="admin-shell" id="adminApp">
        <?php echo $__env->make('partials.admin.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="admin-body">
            <?php echo $__env->make('partials.admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="admin-content">
                <main class="admin-main">
                    <?php echo $__env->yieldContent('content'); ?>
                </main>
            </div>
        </div>

        <div class="admin-sidebar-backdrop" id="adminSidebarBackdrop"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    <script>
        const adminApp = document.getElementById('adminApp');
        const sidebarToggle = document.getElementById('adminSidebarToggle');
        const sidebarBackdrop = document.getElementById('adminSidebarBackdrop');

        function isMobileAdmin() {
            return window.innerWidth < 992;
        }

        function closeSidebar() {
            adminApp?.classList.remove('sidebar-open');
        }

        function toggleSidebar() {
            if (!adminApp) return;

            if (isMobileAdmin()) {
                adminApp.classList.toggle('sidebar-open');
            } else {
                adminApp.classList.toggle('sidebar-collapsed');

                localStorage.setItem(
                    'adminSidebarCollapsed',
                    adminApp.classList.contains('sidebar-collapsed') ? '1' : '0'
                );
            }
        }

        if (adminApp && localStorage.getItem('adminSidebarCollapsed') === '1' && !isMobileAdmin()) {
            adminApp.classList.add('sidebar-collapsed');
        }

        sidebarToggle?.addEventListener('click', toggleSidebar);
        sidebarBackdrop?.addEventListener('click', closeSidebar);

        window.addEventListener('resize', function() {
            if (!adminApp) return;

            if (isMobileAdmin()) {
                adminApp.classList.remove('sidebar-collapsed');
            } else {
                closeSidebar();

                if (localStorage.getItem('adminSidebarCollapsed') === '1') {
                    adminApp.classList.add('sidebar-collapsed');
                }
            }
        });

        function initAdminDataTable(tableSelector, config = {}) {
            if (!window.jQuery || !$.fn.DataTable) {
                console.warn('DataTables belum tersedia. Cek apakah jQuery dan DataTables sudah dipanggil.');
                return null;
            }

            const $table = $(tableSelector);

            if (!$table.length) {
                console.warn('Table tidak ditemukan:', tableSelector);
                return null;
            }

            if ($.fn.DataTable.isDataTable(tableSelector)) {
                $table.DataTable().destroy();
            }

            const dt = $table.DataTable({
                pageLength: config.pageLength || 10,
                lengthChange: false,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: false,
                language: {
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                    infoEmpty: 'Tidak ada data',
                    infoFiltered: '(difilter dari _MAX_ total data)',
                    zeroRecords: 'Data tidak ditemukan',
                    emptyTable: 'Belum ada data',
                    paginate: {
                        first: 'Pertama',
                        previous: 'Sebelumnya',
                        next: 'Selanjutnya',
                        last: 'Terakhir'
                    }
                },
                columnDefs: [{
                    targets: config.actionColumn ?? -1,
                    orderable: false,
                    searchable: false
                }]
            });

            if (config.searchInput) {
                $(config.searchInput).on('keyup input', function() {
                    dt.search(this.value).draw();
                });
            }

            if (config.lengthSelect) {
                $(config.lengthSelect).on('change', function() {
                    dt.page.len(Number(this.value)).draw();
                });
            }

            if (Array.isArray(config.columnFilters)) {
                config.columnFilters.forEach(function(filter) {
                    $(filter.selector).on('change', function() {
                        dt.column(filter.column).search(this.value).draw();
                    });
                });
            }

            return dt;
        }
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>
<?php /**PATH D:\Punya Aska\Kulyeah\SEMESTER 6\KP\Project-KP-kader-flow-refactored\Project-KP - Copy\resources\views/layouts/admin.blade.php ENDPATH**/ ?>