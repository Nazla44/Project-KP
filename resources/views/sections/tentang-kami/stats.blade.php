<section class="tk-stats">
    <div class="container-xl px-4 px-lg-5 pb-5">
        <div class="row g-3">
            @foreach ($stats as $stat)
                <div class="col-6 col-md-3">
                    <div class="tk-stat-card rounded-4 overflow-hidden position-relative">
                        <img src="{{ asset($stat['image']) }}" alt="{{ $stat['label'] }}" class="tk-stat-img">
                        <div class="tk-stat-overlay position-absolute top-0 start-0 w-100 h-100"></div>
                        <div class="tk-stat-content position-absolute bottom-0 start-0 p-3 w-100">
                            <div class="tk-stat-number">{{ $stat['number'] }}</div>
                            <div class="tk-stat-label">{{ $stat['label'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
