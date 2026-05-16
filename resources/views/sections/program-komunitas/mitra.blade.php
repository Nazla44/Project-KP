{{-- ═══════════════════════════ CTA ══════════════════════════════ --}}
<section class="pk-cta" id="daftar-kader">
    <div class="container-xl px-4 px-lg-5" style="position:relative;z-index:2;">
        <div class="row justify-content-center text-center">
            <div class="col-12 col-lg-8">

                <div class="pk-pill-dark mb-4 d-inline-flex">
                    <i class="bi bi-people-fill me-2"></i> Bergabung Sekarang
                </div>

                <h2 class="pk-cta-title">
                    Jadilah Bagian dari Gerakan<br>
                    <span class="pk-cta-accent">Indonesia Bebas TBC 2030</span>
                </h2>

                <p class="pk-cta-desc">
                    Ada banyak cara untuk berkontribusi — mulai dari menjadi
                    kader sukarela, mendukung program secara finansial,
                    hingga menyebarkan informasi TBC di komunitas Anda.
                </p>

                <div class="d-flex flex-wrap justify-content-center gap-3">
                    {{-- PERUBAHAN: href dari mailto → route('kader.form') --}}
                    <a href="{{ route('kader.form') }}" class="btn-primary-red">
                        Daftar Jadi Kader
                        <span class="btn-icon"><i class="bi bi-arrow-up-right"></i></span>
                    </a>
                    <a href="{{ route('klinik-terdekat') }}" class="pk-btn-outline-white">
                        <i class="bi bi-geo-alt-fill me-2"></i>Temukan Klinik TBC
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>