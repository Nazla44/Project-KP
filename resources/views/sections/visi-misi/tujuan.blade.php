<div class="tujuan-header">
    <div class="container-xl px-4 px-lg-5 py-5 mb-5">
        <div class="row align-items-end mb-5">
            <div class="col-lg-6">
                <span class="section-tag">Objektif</span>
                <h2 class="tujuan-title">Tujuan STPI</h2>
            </div>
            <div class="col-lg-6 text-lg-end">
                <p class="tujuan-desc">
                    Menjamin transparansi dan efektivitas dalam setiap langkah organisasi
                    sebagai bentuk dedikasi kami untuk memberikan dampak nyata bagi
                    masyarakat melalui pengelolaan sumber daya yang akuntabel.
                </p>
            </div>
        </div>

        <div class="d-flex gap-3 tujuan-cards" data-tujuan-cards>
            @foreach ($tujuanCards as $item)
                <div class="tujuan-card-custom {{ $loop->first ? 'active' : '' }}" data-tujuan-card>
                    <span class="tujuan-card-number">{{ $loop->iteration }}</span>
                    <img src="{{ asset($item['image']) }}" class="tujuan-card-img" alt="{{ $item['title'] }}">
                    <div class="tujuan-overlay"></div>
                    <div class="tujuan-card-body">
                        <div class="tujuan-card-content">
                            <h5 class="tujuan-card-title">{{ $item['title'] }}</h5>
                            <p class="tujuan-card-text">{{ $item['text'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
