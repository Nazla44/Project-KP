@php
    $items = $page['items'] ?? [];
@endphp

<section class="py-5 bg-white">
    <div class="container-xl">
        @include('sections.common.page-hero', [
            'title' => 'Berita & Kegiatan',
            'description' => 'Ikuti kabar terbaru, cerita lapangan, dan artikel edukasi yang dipublikasikan oleh tim STPI.',
            'breadcrumbs' => [
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Berita & Kegiatan'],
            ],
        ])
    </div>
</section>

<section class="py-5">
    <div class="container-xl">
        <div class="row g-4">
            @forelse ($items as $article)
                <div class="col-12 col-md-6 col-xl-4">
                    <article class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <img src="{{ asset($article['img']) }}" alt="{{ $article['title'] }}" class="w-100" style="height: 220px; object-fit: cover;">

                        <div class="card-body d-flex flex-column p-4">
                            <div class="d-flex flex-wrap gap-2 align-items-center mb-3 small text-muted">
                                <span class="badge text-bg-light border">{{ $article['category'] }}</span>
                                <span>{{ $article['date'] }}</span>
                                <span>{{ $article['author'] ?? 'STPI' }}</span>
                            </div>

                            <h3 class="h5 mb-3">{{ $article['title'] }}</h3>
                            <p class="text-muted mb-4">{{ $article['excerpt'] }}</p>

                            <a href="{{ route('berita.show', $article['slug']) }}" class="btn btn-outline-danger mt-auto align-self-start">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5 text-muted border rounded-4 bg-white">
                        Belum ada artikel yang tayang.
                    </div>
                </div>
            @endforelse
        </div>

        @include('sections.common.pagination', ['page' => $page])
    </div>
</section>
