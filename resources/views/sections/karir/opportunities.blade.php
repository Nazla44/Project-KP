<section class="kr-jobs">
    <div class="container-xl py-5">
        <div class="text-center mb-5">
            <span class="section-tag">Kesempatan</span>
            <h2 class="section-title mt-3">Kesempatan <span class="section-title-accent">Karir</span></h2>
        </div>

        <div class="row g-4">
            @foreach ($jobsPage['items'] as $job)
                <div class="col-lg-4 col-md-6">
                    <div class="kr-job-card">
                        <div class="kr-job-category">{{ $job['category'] }}</div>
                        <h3 class="kr-job-title">{{ $job['title'] }}</h3>
                        <p class="kr-job-desc">{{ $job['desc'] }}</p>
                        <a class="btn-primary-red mt-auto" href="{{ route('careers.show', $job['id']) }}">
                            Lihat Detil <span class="btn-icon"><i class="bi bi-arrow-up-right"></i></span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @include('sections.common.pagination', ['page' => $jobsPage])
    </div>
</section>
