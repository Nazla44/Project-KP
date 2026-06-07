

<?php $__env->startSection('title', 'Kegiatan Sosial TBC'); ?>

<?php $__env->startSection('content'); ?>

    
    <section class="bg-gradient-to-br from-red-700 to-red-900 text-white py-16">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <span
                class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4 uppercase tracking-wide">
                Sosialisasi TBC
            </span>
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Kegiatan Sosial</h1>
            <p class="text-red-100 max-w-xl mx-auto text-base">
                Program sosialisasi TBC langsung ke masyarakat — edukasi, pencegahan, dan pemeriksaan dini.
            </p>

            
            <div class="mt-10 grid grid-cols-3 gap-4 max-w-sm mx-auto">
                <div class="bg-white/10 rounded-xl py-4">
                    <div class="text-2xl font-bold"><?php echo e($stats['total']); ?></div>
                    <div class="text-red-200 text-xs mt-1">Total Kegiatan</div>
                </div>
                <div class="bg-white/10 rounded-xl py-4">
                    <div class="text-2xl font-bold"><?php echo e($stats['completed']); ?></div>
                    <div class="text-red-200 text-xs mt-1">Selesai</div>
                </div>
                <div class="bg-white/10 rounded-xl py-4">
                    <div class="text-2xl font-bold"><?php echo e($stats['upcoming']); ?></div>
                    <div class="text-red-200 text-xs mt-1">Akan Datang</div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">
        <div class="max-w-6xl mx-auto px-4 py-3">
            <form method="GET" action="<?php echo e(route('kegiatan-sosial.index')); ?>"
                class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">

                
                <div class="relative flex-1">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                        placeholder="Cari kegiatan atau lokasi..."
                        class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent bg-white">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                
                <select name="status"
                    class="text-sm border border-gray-300 rounded-lg py-2 px-3 bg-white focus:ring-2 focus:ring-red-500">
                    <option value="">Semua Status</option>
                    <option value="published" <?php if(request('status') === 'published'): echo 'selected'; endif; ?>>Akan Datang</option>
                    <option value="ongoing" <?php if(request('status') === 'ongoing'): echo 'selected'; endif; ?>>Berlangsung</option>
                    <option value="completed" <?php if(request('status') === 'completed'): echo 'selected'; endif; ?>>Selesai</option>
                </select>

                <button type="submit"
                    class="bg-red-700 text-white text-sm px-4 py-2 rounded-lg hover:bg-red-800 transition">
                    Cari
                </button>

                <?php if(request()->hasAny(['search', 'status'])): ?>
                    <a href="<?php echo e(route('kegiatan-sosial.index')); ?>" class="text-sm text-gray-500 hover:text-gray-700">Reset</a>
                <?php endif; ?>
            </form>
        </div>
    </section>

    
    <section class="py-12">
        <div class="max-w-6xl mx-auto px-4">

            <?php if($kegiatan->isEmpty()): ?>
                <div class="text-center py-20 text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-lg">Belum ada kegiatan ditemukan</p>
                    <p class="text-sm mt-1">Coba ubah filter pencarian Anda</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $kegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <article
                                    class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition group">

                                    
                                    <div class="aspect-video overflow-hidden bg-gray-100 relative">
                                        <img src="<?php echo e($item->banner_url); ?>" alt="<?php echo e($item->judul); ?>"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

                                        
                                        <div class="absolute top-3 left-3">
                                            <?php
                                                $colorMap = [
                                                    'published' => 'bg-blue-500',
                                                    'ongoing' => 'bg-green-500',
                                                    'completed' => 'bg-purple-500',
                                                ];
                                            ?>
                         <span
                                                class="<?php echo e($colorMap[$item->status] ?? 'bg-gray-500'); ?> text-white text-xs font-medium px-2 py-0.5 rounded-full">
                                                <?php echo e($item->status_label); ?>

                                            </span>
                                        </div>
                                    </div>

                                    
                                    <div class="p-5">
                                        
                                        <div class="flex items-center gap-3 text-xs text-gray-500 mb-3">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <?php echo e($item->tanggal->translatedFormat('d M Y')); ?>

                                            </span>
                                            <span class="flex items-center gap-1 truncate">
                                                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                <?php echo e(Str::limit($item->lokasi, 30)); ?>

                                            </span>
                                        </div>

                                        
                                        <h2
                                            class="font-semibold text-gray-800 leading-snug mb-2 line-clamp-2 group-hover:text-red-700 transition">
                                            <?php echo e($item->judul); ?>

                                        </h2>

                                        
                                        <p class="text-sm text-gray-500 line-clamp-2 mb-4">
                                            <?php echo e(Str::limit(strip_tags($item->deskripsi), 100)); ?>

                                        </p>

                                        
                                        <?php if($item->ringkasan): ?>
                                            <div class="flex gap-3 text-xs text-gray-500 mb-4 bg-gray-50 rounded-lg px-3 py-2">
                                                <span>👥 <?php echo e($item->ringkasan->jumlah_peserta); ?> peserta</span>
                                                <span>·</span>
                                                <span>🧑‍⚕️ <?php echo e($item->ringkasan->jumlah_kader); ?> kader</span>
                                            </div>
                                        <?php endif; ?>

                                        
                                        <a href="<?php echo e(route('kegiatan-sosial.show', $item->slug)); ?>"
                                            class="block text-center text-sm font-medium text-red-700 border border-red-700 rounded-lg py-2 hover:bg-red-700 hover:text-white transition">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div class="mt-10">
                    <?php echo e($kegiatan->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Kuliah\SMT 6\KP\Project-KP\resources\views/pages/kegiatan-sosial.blade.php ENDPATH**/ ?>