<section class="kd-content">
    <div class="container-xl py-5">
        <div class="row g-5">
            <div class="col-lg-8">
                <span class="section-tag d-inline-block mb-4" style="color: var(--color-primary);">{{ $job['category'] }}</span>
                <h2 class="kd-title mt-2 mb-5">{{ $job['title'] }}</h2>

                <div class="d-flex flex-wrap gap-2 mb-5">
                    @foreach ($job['metas'] as $meta)
                        <span class="kd-meta-badge">{{ $meta }}</span>
                    @endforeach
                </div>

                <div class="kd-block mb-5">
                    <h3 class="kd-block-title">Deskripsi Pekerjaan</h3>
                    <p class="kd-block-text">{{ $job['fullDesc'] }}</p>
                </div>

                <div class="kd-block mb-5">
                    <h3 class="kd-block-title">Tanggung Jawab Utama</h3>
                    <ul class="kd-list">
                        @foreach ($job['responsibilities'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="kd-block mb-5">
                    <h3 class="kd-block-title">Kualifikasi yang Dibutuhkan</h3>
                    <ul class="kd-list">
                        @foreach ($job['requirements'] as $req)
                            <li>{{ $req }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="kd-apply-card">
                    <h3 class="kd-apply-card-title">Siap bergabung dengan STPI?</h3>
                    <a href="mailto:admin@stoptbindonesia.org" class="btn-primary-red d-block text-center">
                        Daftar <span class="btn-icon"><i class="bi bi-arrow-up-right"></i></span>
                    </a>
                    <a href="{{ route('careers') }}" class="d-block mt-3 text-center">Kembali ke Karir</a>
                </div>
            </div>
        </div>
    </div>
</section>
