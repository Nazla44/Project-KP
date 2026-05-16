{{-- SECTION: FAQ --}}
<section class="pk-faq">
    <div class="container-xl px-4 px-lg-5">
        <div class="row g-5 align-items-start">

            <div class="col-12 col-lg-4">
                <span class="section-tag">FAQ</span>
                <h2 class="pk-section-title mt-3">
                    Pertanyaan <span class="pk-title-accent">Umum</span>
                </h2>
                <p class="pk-tentang-text mt-3">
                    Tidak menemukan jawaban yang dicari? Hubungi kami langsung.
                </p>
                <a href="mailto:info@stoptbindonesia.org" class="btn-primary-red d-inline-flex mt-3">
                    Hubungi Kami
                    <span class="btn-icon"><i class="bi bi-arrow-up-right"></i></span>
                </a>
            </div>

            <div class="col-12 col-lg-8">
                <div class="accordion pk-accordion" id="faqAccordion">
                    @foreach ($faqs as $i => $faq)
                        <div class="accordion-item pk-accordion-item">
                            <h3 class="accordion-header">
                                <button class="accordion-button pk-accordion-btn {{ $i !== 0 ? 'collapsed' : '' }}"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#faq-{{ $i }}"
                                    aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                                    {{ $faq['question'] }}
                                </button>
                            </h3>
                            <div id="faq-{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body pk-accordion-body">
                                    {{ $faq['answer'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>