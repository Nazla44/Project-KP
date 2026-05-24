<?php ($navItems = \App\Support\StpiData::navItems()); ?>

<nav class="navbar navbar-expand-lg sticky-top" id="mainNavbar">
    <div class="container-xl px-1 px-lg-6">
        <a class="navbar-brand p-0 flex-shrink-0" href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset('assets/image/image.png')); ?>" alt="Stop TB Partnership Indonesia" class="logo-img">
        </a>

        <button class="navbar-toggler border-0 shadow-none ms-auto" type="button" id="navbarToggler"
            aria-label="Toggle navigation">
            <span class="toggler-bar"></span>
            <span class="toggler-bar"></span>
            <span class="toggler-bar"></span>
        </button>

        <div class="navbar-collapse collapse" id="mainNavbarCollapse">
            <ul class="navbar-nav mx-auto gap-3 mb-2 mb-lg-0">
                <?php $__currentLoopData = $navItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item position-relative nav-dropdown">
                        <?php if(!empty($item['children'])): ?>
                            <a class="nav-link d-flex align-items-center gap-1 dropdown-toggle-custom" href="#"
                                data-dropdown-target="nav-drop-<?php echo e($loop->index); ?>">
                                <?php echo e($item['label']); ?>

                                <svg class="chevron" width="12" height="12" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5">
                                    <polyline points="18 15 12 9 6 15"></polyline>
                                </svg>
                            </a>
                            <ul class="dropdown-menu" id="nav-drop-<?php echo e($loop->index); ?>">
                                <?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a class="dropdown-item" href="<?php echo e($child['href']); ?>"><?php echo e($child['label']); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <a class="nav-link" href="<?php echo e($item['href'] ?? '#'); ?>"><?php echo e($item['label']); ?></a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <div class="nav-right d-flex align-items-center gap-2 flex-shrink-0">

                
                <div class="sb-wrap position-relative" id="searchWrap">
                    <div class="search-box" id="searchBox">
                        <input type="text" placeholder="Cari Mitra / Klinik" id="searchInput" autocomplete="off"
                            aria-label="Cari Mitra atau Klinik" aria-expanded="false" aria-controls="searchDropdown">
                        <button class="search-icon-btn" id="searchButton" aria-label="Cari">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                        </button>
                    </div>

                    
                    <div class="sb-dropdown" id="searchDropdown" role="listbox" hidden>

                        
                        <div class="sb-loading" id="sbLoading" hidden>
                            <div class="sb-spinner"></div>
                            <span>Mencari...</span>
                        </div>

                        
                        <div class="sb-empty" id="sbEmpty" hidden>
                            <i class="bi bi-search sb-empty-icon"></i>
                            <p class="sb-empty-title">Tidak ditemukan</p>
                            <p class="sb-empty-sub">Coba kata kunci lain atau cari berdasarkan kota</p>
                        </div>

                        
                        <ul class="sb-results" id="sbResults" role="group"></ul>

                        
                        <div class="sb-footer" id="sbFooter" hidden>
                            <a href="#" id="sbSeeAll" class="sb-see-all">
                                <span id="sbSeeAllText">Lihat semua hasil</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>

                    </div>
                </div>

                
                <div class="position-relative lang-switcher">
                    <button class="btn btn-light border d-flex align-items-center gap-2 rounded-pill px-3"
                        id="langButton" type="button"
                        style="height:48px; border-color: rgba(0,0,0,0.1) !important; border-width: 1.5px !important;">
                        <img src="https://flagcdn.com/w40/id.png" alt="id" class="flag-img" id="activeFlag">
                        <svg class="chevron-icon" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#666"
                            stroke-width="2.5">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow p-2" id="langDropdown"
                        style="border-radius:12px;min-width:150px;">
                        <li>
                            <button
                                class="dropdown-item d-flex align-items-center gap-2 rounded-2 px-3 py-2 lang-option"
                                data-lang="id" style="font-size:13px;font-weight:500;">
                                <img src="https://flagcdn.com/w40/id.png" alt="Indonesia" class="flag-img">
                                <span class="flex-grow-1">Indonesia</span>
                            </button>
                        </li>
                        <li>
                            <button
                                class="dropdown-item d-flex align-items-center gap-2 rounded-2 px-3 py-2 lang-option"
                                data-lang="en" style="font-size:13px;font-weight:500;">
                                <img src="https://flagcdn.com/w40/gb.png" alt="English" class="flag-img">
                                <span class="flex-grow-1">English</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav><?php /**PATH D:\Punya Aska\Kulyeah\SEMESTER 6\KP\Project-KP-kader-flow-refactored\Project-KP - Copy\resources\views/partials/navbar.blade.php ENDPATH**/ ?>