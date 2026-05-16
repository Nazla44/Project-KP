{{-- SECTION: Kisah Nyata dari Lapangan — UPDATED: link aktif ke detail artikel --}}
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
            @foreach ($stories as $story)
                <div class="col-12 col-md-6 col-lg-4">
                    {{-- Link ke detail artikel menggunakan slug --}}
                    <a href="{{ route('artikel.show', $story['slug']) }}" class="pk-story-card text-decoration-none">
                        <div class="pk-story-img-wrap">
                            <img src="{{ asset($story['image']) }}" alt="{{ $story['title'] }}" class="pk-story-img">
                            <span class="pk-story-tag">{{ $story['tag'] }}</span>
                        </div>
                        <div class="pk-story-body">
                            <div class="pk-story-location">
                                <i class="bi bi-geo-alt-fill"></i>
                                {{ $story['location'] }}
                            </div>
                            <h3 class="pk-story-title">{{ $story['title'] }}</h3>
                            <p class="pk-story-excerpt">{{ $story['excerpt'] }}</p>
                            <span class="pk-story-link">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</section>