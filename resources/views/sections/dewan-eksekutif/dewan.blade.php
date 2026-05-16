<section class="de-members">
    <div class="container-xl px-4 px-lg-5 py-5 mb-5">
        <div class="text-center mb-4">
            <span class="section-tag">Dewan &amp; Eksekutif</span>
            <h2 class="section-title">Sinergi <span class="de-accent">Pemimpin</span> &amp; <span class="de-accent">Pakar</span></h2>
        </div>

        <div class="de-tabs-wrap mb-5">
            <div class="de-tabs">
                @foreach ($tabs as $tab)
                    <a href="{{ route('board', ['tab' => $tab]) }}" class="de-tab {{ $activeTab === $tab ? 'active' : '' }}">{{ $tab }}</a>
                @endforeach
            </div>
        </div>

        <div class="row g-4">
            @forelse ($members as $member)
                <div class="col-6 col-md-3 col-lg-3">
                    <div class="de-card">
                        <div class="de-card-photo mb-3">
                            <img src="{{ asset($member['photo']) }}" alt="{{ $member['name'] }}">
                        </div>
                        <div class="de-card-info">
                            <div class="de-card-name">{{ $member['name'] }}</div>
                            <div class="de-card-role">{{ $member['role'] }}</div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">Belum ada data anggota untuk kategori ini.</div>
            @endforelse
        </div>
    </div>
</section>
