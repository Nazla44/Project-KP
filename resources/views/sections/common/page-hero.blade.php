<section class="page-hero">
    <div class="page-hero-bg"></div>
    <div class="container-xl page-hero-inner">
        <nav class="page-hero-breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
                @if (!$loop->first)
                    <span class="mx-2">/</span>
                @endif

                @if (!empty($breadcrumb['url']))
                    <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                @else
                    <span class="active">{{ $breadcrumb['label'] }}</span>
                @endif
            @endforeach
        </nav>
        <div class="page-hero-bottom row align-items-end gy-3">
            <div class="col-12 col-lg-5">
                <h1 class="page-hero-title">{{ $title }}</h1>
            </div>
            <div class="col-12 col-lg-5 offset-lg-2 mb-4">
                <p class="page-hero-desc">{{ $description }}</p>
            </div>
        </div>
    </div>
</section>
