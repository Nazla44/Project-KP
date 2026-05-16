<article class="ad-wrapper">
    <div class="container-xl px-4 px-lg-5 py-5">
        <div class="row g-5">

            {{-- ══ KOLOM KIRI ══════════════════════════════════════════════ --}}
            <div class="col-12 col-lg-8">

                {{-- Breadcrumb --}}
                <nav class="ad-breadcrumb mb-4" aria-label="breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <i class="bi bi-chevron-right mx-2"></i>
                    <a href="{{ $backUrl }}">{{ $backLabel }}</a>
                    <i class="bi bi-chevron-right mx-2"></i>
                    <span>{{ Str::limit($artikel['title'], 45) }}</span>
                </nav>

                {{-- Kategori + Tanggal + Penulis --}}
                <div class="ad-meta mb-4">
                    <span class="ad-category">{{ $artikel['category'] }}</span>
                    <span class="ad-meta-sep">·</span>
                    <span class="ad-date">
                        <i class="bi bi-calendar3 me-1"></i>{{ $artikel['date'] }}
                    </span>
                    <span class="ad-meta-sep">·</span>
                    <span class="ad-author">
                        <i class="bi bi-person me-1"></i>{{ $artikel['author'] }}
                    </span>
                </div>

                {{-- Judul --}}
                <h1 class="ad-title">{{ $artikel['title'] }}</h1>

                {{-- Hero Image --}}
                <div class="ad-hero-wrap mb-5">
                    <img src="{{ asset($artikel['img']) }}" alt="{{ $artikel['title'] }}" class="ad-hero-img">
                </div>

                {{-- ── BODY KONTEN ─────────────────────────────────────── --}}
                <div class="ad-body">
                    @foreach ($artikel['content'] as $blok)

                        @if ($blok['type'] === 'paragraph')
                            <p class="ad-paragraph">{{ $blok['text'] }}</p>

                        @elseif ($blok['type'] === 'heading')
                            <h2 class="ad-heading">{{ $blok['text'] }}</h2>

                        @elseif ($blok['type'] === 'quote')
                            <blockquote class="ad-quote">
                                <p class="ad-quote-text">"{{ $blok['text'] }}"</p>
                                @if (!empty($blok['author']))
                                    <cite class="ad-quote-author">— {{ $blok['author'] }}</cite>
                                @endif
                            </blockquote>

                        @elseif ($blok['type'] === 'list')
                            <ul class="ad-list">
                                @foreach ($blok['items'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>

                        @endif

                    @endforeach
                </div>
                {{-- ── END BODY KONTEN ────────────────────────────────── --}}

                {{-- Tags --}}
                @if (!empty($artikel['tags']))
                    <div class="ad-tags">
                        <span class="ad-tags-label">Topik:</span>
                        @foreach ($artikel['tags'] as $tag)
                            <span class="ad-tag">#{{ $tag }}</span>
                        @endforeach
                    </div>
                @endif

                {{-- Share Buttons --}}
                <div class="ad-share">
                    <span class="ad-share-label">Bagikan:</span>
                    <a href="https://wa.me/?text={{ urlencode($artikel['title'] . ' ' . url()->current()) }}"
                        target="_blank" class="ad-share-btn ad-share-wa" title="WhatsApp">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                        target="_blank" class="ad-share-btn ad-share-fb" title="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($artikel['title']) }}&url={{ urlencode(url()->current()) }}"
                        target="_blank" class="ad-share-btn ad-share-tw" title="X / Twitter">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    <button class="ad-share-btn ad-share-copy"
                        onclick="navigator.clipboard.writeText('{{ url()->current() }}');this.innerHTML='<i class=\'bi bi-check-lg\'></i>'"
                        title="Salin tautan">
                        <i class="bi bi-link-45deg"></i>
                    </button>
                </div>

                {{-- Tombol Kembali --}}
                <a href="{{ $backUrl }}" class="ad-back-btn mt-5 d-inline-flex align-items-center">
                    <i class="bi bi-arrow-left me-2"></i>{{ $backLabel }}
                </a>

            </div>
            {{-- ══ END KOLOM KIRI ══════════════════════════════════════════ --}}

            {{-- ══ KOLOM KANAN: SIDEBAR ════════════════════════════════════ --}}
            <div class="col-12 col-lg-4">
                <div class="ad-sidebar">

                    {{-- Artikel Terkait --}}
                    @if (!empty($related))
                        <div class="ad-sidebar-block mb-4">
                            <h3 class="ad-sidebar-title">
                                <i class="bi bi-newspaper me-2"></i>Artikel Terkait
                            </h3>
                            @foreach ($related as $rel)
                                <a href="{{ route('artikel.show', $rel['slug']) }}"
                                    class="ad-related-card text-decoration-none d-flex gap-3">
                                    <div class="ad-related-img-wrap flex-shrink-0">
                                        <img src="{{ asset($rel['img']) }}" alt="{{ $rel['title'] }}" class="ad-related-img">
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="ad-related-cat">{{ $rel['category'] }}</span>
                                        <p class="ad-related-title">{{ $rel['title'] }}</p>
                                        <span class="ad-related-date">
                                            <i class="bi bi-calendar3 me-1"></i>{{ $rel['date'] }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif

                    {{-- CTA: Bergabung
                    <div class="ad-sidebar-cta">
                        <div class="ad-cta-icon">
                            <i class="bi bi-heart-pulse-fill"></i>
                        </div>
                        <h3 class="ad-cta-title">Ingin Berkontribusi?</h3>
                        <p class="ad-cta-desc">
                            Bergabunglah sebagai kader komunitas dan bantu pasien TBC di wilayahmu menyelesaikan
                            pengobatan hingga tuntas.
                        </p>
                        <a href="{{ route('program-komunitas') }}#daftar-kader"
                            class="btn-primary-red d-block text-center mb-3">
                            Jadi Kader
                            <span class="btn-icon"><i class="bi bi-arrow-up-right"></i></span>
                        </a>
                        <a href="{{ route('klinik-terdekat') }}" class="ad-cta-link d-block text-center">
                            <i class="bi bi-geo-alt-fill me-1"></i>
                            Temukan Klinik TBC Terdekat
                        </a>
                    </div>
                    --}}
                </div>
            </div>
            {{-- ══ END KOLOM KANAN ═════════════════════════════════════════ --}}

        </div>
    </div>
</article>