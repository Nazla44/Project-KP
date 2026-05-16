<section class="kr-why">
    <div class="container-xl py-5">
        <div class="kr-why-header d-flex align-items-center justify-content-between mb-4">
            <div>
                <span class="section-tag mt-4 d-inline-block">Karir</span>
                <h2 class="section-title mb-3">Mengapa Join <span class="section-title-accent">STPI?</span></h2>
            </div>
            <a href="#" class="btn-primary-red flex-shrink-0">Team STPI <span class="btn-icon"><i class="bi bi-arrow-up-right"></i></span></a>
        </div>

        <hr class="kr-divider mb-3">
        <div class="row g-4">
            @foreach ($reasons as $reason)
                <div class="col-lg-4">
                    <div class="kr-reason-card">
                        <h3 class="kr-reason-title">{{ $reason['title'] }}</h3>
                        <p class="kr-reason-desc">{{ $reason['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
