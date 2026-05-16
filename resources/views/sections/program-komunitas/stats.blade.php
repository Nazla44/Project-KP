{{-- SECTION: Statistik Dampak --}}
<section class="pk-stats">
    <div class="container-xl px-4 px-lg-5">

        <div class="text-center mb-5">
            <span class="pk-tag-dark">Dampak Program</span>
            <h2 class="pk-section-title-white mt-2">
                Angka yang <span class="pk-title-accent-red">Berbicara</span>
            </h2>
        </div>

        <div class="row g-4">
            @foreach ($stats as $stat)
                <div class="col-6 col-lg-3">
                    <div class="pk-stat-card">
                        <div class="pk-stat-icon-wrap">
                            <i class="bi {{ $stat['icon'] }}"></i>
                        </div>
                        <div class="pk-stat-number">{{ $stat['number'] }}</div>
                        <div class="pk-stat-label">{{ $stat['label'] }}</div>
                        <p class="pk-stat-desc">{{ $stat['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>