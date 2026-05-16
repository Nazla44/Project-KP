<section class="stats-section mb-5">
    <div class="container-xl px-4 px-lg-5 pt-5 pb-5 text-center">
        <span class="section-tag mb-4">Dampak</span>
        <h2 class="stats-title">
            Kami telah berhasil menjangkau <span class="stats-highlight">2,3jt++</span> orang di seluruh Indonesia
        </h2>
    </div>

    <div class="row g-0">
        @foreach ($impactData as $item)
            <div class="col-12 col-md-3 stats-item" style="background-image: url('{{ asset($item['img']) }}')">
                <div class="stats-overlay">
                    <div class="stats-content">
                        <div class="d-flex align-items-baseline justify-content-center">
                            <span class="stat-number">{{ $item['number'] }}</span>
                            @if (!empty($item['suffix']))
                                <span class="stat-suffix">{{ $item['suffix'] }}</span>
                            @endif
                        </div>
                        <p class="stat-desc">{{ $item['description'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
