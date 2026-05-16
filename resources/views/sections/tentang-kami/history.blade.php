<section class="tk-history position-relative">
    <div class="tk-history-bg position-absolute top-0 start-0 w-100 h-100">
        <div class="tk-history-photos">
            @foreach ($historyPhotos as $photo)
                <div class="tk-history-photo" style="background-image: url('{{ asset($photo) }}')"></div>
            @endforeach
        </div>
    </div>
    <div class="tk-history-overlay position-absolute top-0 start-0 w-100 h-100"></div>
    <div class="container-xl px-lg-5 position-relative text-center">
        <span class="section-tag">Sejarah</span>
        <h2 class="tk-history-title">
            Dedikasi <span class="tk-history-accent fw-bold">Satu Dekade</span> Membangun<br>
            Kemitraan Strategis demi Indonesia Bebas TBC
        </h2>
        <a href="{{ route('history') }}" class="tk-history-btn btn-primary-red">
            Sejarah STPI <span class="tk-history-btn-icon"><i class="bi bi-arrow-up-right"></i></span>
        </a>
    </div>
</section>