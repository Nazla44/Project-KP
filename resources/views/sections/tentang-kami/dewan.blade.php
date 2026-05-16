<section class="tk-dewan">
    <div class="container-xl px-4 px-lg-5 py-5">
        <div class="d-flex align-items-start justify-content-between mb-5">
            <div>
                <span class="section-tag">Sejawat</span>
                <h2 class="tk-dewan-title mb-0">DEWAN &amp; EKSEKUTIF</h2>
            </div>
            <a href="{{ route('board') }}" class="tk-btn btn-primary-red flex-shrink-0">
                Lebih Banyak <span class="tk-btn-icon"><i class="bi bi-arrow-up-right"></i></span>
            </a>
        </div>
        <div class="row g-4">
            @foreach ($members as $person)
                <div class="col-6 col-md-3">
                    <div class="tk-member-card">
                        <div class="tk-member-photo mb-3">
                            <img src="{{ asset($person['photo']) }}" alt="{{ $person['name'] }}">
                        </div>
                        <div class="tk-member-name">{{ $person['name'] }}</div>
                        <div class="tk-member-role">{{ $person['role'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
