<section class="sj-section py-5">
    <div class="container-xl px-4 px-lg-5">

        <div class="text-center mb-5">
            <span class="sj-tag">Sejarah</span>

            <h2 class="sj-title">
                Perjalanan <span class="sj-accent">STPI</span>
            </h2>
        </div>

        <div class="sj-timeline-wrapper mb-5">
            <div class="sj-bar">
                <div class="sj-bar-fill" id="timelineFill"></div>
            </div>

            <div class="sj-years">
                @foreach ($timeline as $item)
                    <button type="button" class="sj-point" data-index="{{ $loop->index }}">
                        <span class="sj-dot"></span>
                        <span class="sj-year-label">
                            {{ $item['year'] }}
                        </span>
                    </button>
                @endforeach
            </div>
        </div>

        @php($current = $timeline[1] ?? $timeline[0])

        <div class="row g-4 g-lg-5 align-items-center" id="timelineContent" data-timeline='@json($timeline)'
            data-asset-url="{{ asset('') }}">
            <div class="col-lg-6">
                <div class="sj-photo-frame">
                    <img src="{{ asset($current['image']) }}" alt="{{ $current['title'] }}" id="timelineImage">
                </div>
            </div>

            <div class="col-lg-6">
                <span class="sj-year-badge mb-3" id="timelineYear">
                    {{ $current['year'] }}
                </span>

                <h3 class="sj-event-title mb-3" id="timelineTitle">
                    {{ $current['title'] }}
                </h3>

                <p class="sj-event-desc mb-0" id="timelineDesc">
                    {{ $current['desc'] }}
                </p>

                <div class="sj-nav mt-5">
                    <button type="button" class="btn-nav" id="timelinePrev" aria-label="Sebelumnya">
                        <i class="bi bi-arrow-left"></i>
                    </button>

                    <button type="button" class="btn-nav" id="timelineNext" aria-label="Berikutnya">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>
</section>