{{-- SECTION: Program Implementasi TBC — Timeline/List Layout --}}
<section class="pk-pilars" id="pilar-program">
    <div class="container-xl px-4 px-lg-5">

        <div class="text-center mb-5 pk-reveal">
            <span class="section-tag">Cara Kerja Kami</span>

            <h2 class="pk-section-title mt-3">
                Program <span class="pk-title-accent">Implementasi TBC</span>
            </h2>

            <p class="pk-section-subtitle mx-auto mt-3">
                Pengembangan program berbasis kolaborasi lintas sektor, layanan klinik,
                edukasi digital, pendampingan pasien, dukungan psikososial, dan pelibatan
                relawan muda untuk memperkuat penanggulangan TBC.
            </p>
        </div>

        <div class="pk-program-list">

            @foreach ($pilars as $pilar)
                <article class="pk-program-item pk-reveal {{ $pilar['color_class'] ?? 'pilar-red' }}">

                    <div class="pk-program-marker">
                        <span class="pk-program-number">
                            {{ $pilar['number'] }}
                        </span>

                        <div class="pk-program-icon">
                            <i class="bi {{ $pilar['icon'] }}"></i>
                        </div>
                    </div>

                    <div class="pk-program-content">

                        <span class="pk-pilar-tag">
                            Program {{ $pilar['number'] }}
                        </span>

                        <h3 class="pk-program-title">
                            {{ $pilar['title'] }}
                        </h3>

                        <p class="pk-program-desc">
                            {{ $pilar['description'] }}
                        </p>

                        <div class="pk-program-block">
                            <h4>Fokus Implementasi</h4>

                            <ul class="pk-program-list-points">
                                @foreach ($pilar['activities'] as $activity)
                                    <li>
                                        <i class="bi bi-check-circle-fill pk-check-icon"></i>
                                        <span>{{ $activity }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                </article>

                @if (!$loop->last)
                    <hr class="pk-program-divider">
                @endif
            @endforeach

        </div>

    </div>
</section>