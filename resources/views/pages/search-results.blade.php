@extends('layouts.app')

@section('title', 'Hasil Pencarian')

@section('content')

{{-- Hero / Header --}}
<section class="sr-hero">
    <div class="container-xl px-4 px-lg-5">
        <div class="sr-hero-inner">
            <div class="sr-breadcrumb">
                <a href="{{ route('home') }}">Beranda</a>
                <i class="bi bi-chevron-right"></i>
                <span>Hasil Pencarian</span>
            </div>

            <h1 class="sr-title">
                @if($q)
                    Hasil untuk <span class="sr-title-query">"{{ $q }}"</span>
                @else
                    Cari Klinik & Mitra
                @endif
            </h1>

            @if($q)
                <p class="sr-subtitle">
                    Ditemukan <strong>{{ $totalResults }} hasil</strong>
                    @if($totalResults > 0)
                        — klinik, mitra, dan layanan TBC
                    @endif
                </p>
            @endif

            {{-- Search bar di halaman hasil --}}
            <form action="{{ route('search') }}" method="GET" class="sr-form">
                <div class="sr-input-wrap">
                    <i class="bi bi-search sr-input-icon"></i>
                    <input
                        type="text"
                        name="q"
                        value="{{ $q }}"
                        placeholder="Cari klinik, mitra, atau layanan..."
                        class="sr-input"
                        autofocus>
                    <button type="submit" class="sr-submit">
                        Cari
                        <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </div>

                {{-- Filter chips --}}
                <div class="sr-chips">
                    <a href="{{ route('search', ['q' => $q, 'type' => 'all']) }}"
                       class="sr-chip {{ $type === 'all' ? 'active' : '' }}">
                        Semua ({{ $totalResults }})
                    </a>
                    <a href="{{ route('search', ['q' => $q, 'type' => 'klinik']) }}"
                       class="sr-chip {{ $type === 'klinik' ? 'active' : '' }}">
                        <i class="bi bi-hospital me-1"></i>Klinik TBC ({{ count($klinikResults) }})
                    </a>
                    <a href="{{ route('search', ['q' => $q, 'type' => 'mitra']) }}"
                       class="sr-chip {{ $type === 'mitra' ? 'active' : '' }}">
                        <i class="bi bi-people me-1"></i>Mitra ({{ count($mitraResults) }})
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>

<div class="container-xl px-4 px-lg-5 sr-body">

    @if(!$q)
    {{-- Empty / initial state --}}
    <div class="sr-empty-state">
        <div class="sr-empty-icon-wrap">
            <i class="bi bi-search"></i>
        </div>
        <h2 class="sr-empty-title">Cari Klinik atau Mitra TBC</h2>
        <p class="sr-empty-desc">
            Ketik nama klinik, kota, provinsi, jenis layanan, atau nama mitra
            untuk menemukan informasi yang Anda butuhkan.
        </p>
        <div class="sr-suggestions">
            <p class="sr-sugg-label">Coba cari:</p>
            <div class="sr-sugg-chips">
                @foreach(['Puskesmas', 'Jakarta', 'TCM', 'Pengobatan OAT', 'RSUD', 'Bandung'] as $s)
                <a href="{{ route('search', ['q' => $s]) }}" class="sr-sugg-chip">{{ $s }}</a>
                @endforeach
            </div>
        </div>
    </div>

    @elseif($totalResults === 0)
    {{-- No results --}}
    <div class="sr-empty-state">
        <div class="sr-empty-icon-wrap sr-empty-icon-wrap--notfound">
            <i class="bi bi-emoji-frown"></i>
        </div>
        <h2 class="sr-empty-title">Tidak ada hasil untuk "{{ $q }}"</h2>
        <p class="sr-empty-desc">Coba periksa ejaan, atau gunakan kata kunci yang lebih umum seperti nama kota atau jenis layanan.</p>
        <div class="sr-suggestions">
            <p class="sr-sugg-label">Saran pencarian:</p>
            <div class="sr-sugg-chips">
                @foreach(['Puskesmas', 'Jakarta', 'TCM', 'RS Umum', 'Klinik'] as $s)
                <a href="{{ route('search', ['q' => $s]) }}" class="sr-sugg-chip">{{ $s }}</a>
                @endforeach
            </div>
        </div>
    </div>

    @else
    <div class="row g-5">
        <div class="col-12 col-lg-8">

            {{-- KLINIK RESULTS --}}
            @if(count($klinikResults) > 0 && in_array($type, ['all', 'klinik']))
            <div class="sr-section mb-5">
                <div class="sr-section-header">
                    <div class="sr-section-icon"><i class="bi bi-hospital-fill"></i></div>
                    <div>
                        <h2 class="sr-section-title">Klinik & Fasilitas TBC</h2>
                        <p class="sr-section-count">{{ count($klinikResults) }} hasil ditemukan</p>
                    </div>
                </div>

                <div class="sr-klinik-list">
                    @foreach($klinikResults as $k)
                    <div class="sr-klinik-card">
                        <div class="sr-klinik-top">
                            <div class="sr-klinik-icon-wrap">
                                @switch($k['tipe'])
                                    @case('RS Umum') <i class="bi bi-building-fill-cross"></i> @break
                                    @case('Klinik')  <i class="bi bi-heart-pulse-fill"></i>    @break
                                    @default         <i class="bi bi-house-heart-fill"></i>
                                @endswitch
                            </div>
                            <div class="sr-klinik-info">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                    <span class="sr-klinik-tipe">{{ $k['tipe'] }}</span>
                                    <span class="sr-status {{ $k['is_open'] ? 'sr-status--open' : 'sr-status--closed' }}">
                                        <span class="sr-status-dot"></span>
                                        {{ $k['is_open'] ? 'Buka' : 'Tutup' }}
                                        · {{ $k['jam_buka'] }}–{{ $k['jam_tutup'] }}
                                    </span>
                                </div>
                                <h3 class="sr-klinik-nama">{{ $k['nama'] }}</h3>
                                <p class="sr-klinik-alamat">
                                    <i class="bi bi-geo-alt me-1"></i>{{ $k['alamat'] }}
                                </p>
                            </div>
                        </div>

                        <div class="sr-klinik-meta">
                            <div class="sr-klinik-meta-item">
                                <i class="bi bi-clock"></i>
                                <span>{{ $k['hari_buka'] }}, {{ $k['jam_buka'] }}–{{ $k['jam_tutup'] }}</span>
                            </div>
                            <div class="sr-klinik-meta-item">
                                <i class="bi bi-telephone"></i>
                                <a href="tel:{{ $k['telepon'] }}">{{ $k['telepon'] }}</a>
                            </div>
                        </div>

                        <div class="sr-klinik-footer">
                            <div class="sr-layanan-wrap">
                                @foreach($k['layanan'] as $l)
                                <span class="sr-layanan-tag">{{ $l }}</span>
                                @endforeach
                            </div>
                            <div class="sr-klinik-actions">
                                <a href="tel:{{ $k['telepon'] }}" class="sr-btn-call">
                                    <i class="bi bi-telephone-fill"></i> Hubungi
                                </a>
                                <a href="https://maps.google.com/?q={{ urlencode($k['alamat']) }}"
                                   target="_blank" rel="noopener" class="sr-btn-maps">
                                    <i class="bi bi-map-fill"></i> Peta
                                </a>
                                <a href="{{ route('klinik-terdekat') }}?focus={{ $k['id'] }}"
                                   class="sr-btn-detail">
                                    Detail <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- MITRA RESULTS --}}
            @if(count($mitraResults) > 0 && in_array($type, ['all', 'mitra']))
            <div class="sr-section">
                <div class="sr-section-header">
                    <div class="sr-section-icon sr-section-icon--mitra">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <h2 class="sr-section-title">Mitra Program</h2>
                        <p class="sr-section-count">{{ count($mitraResults) }} hasil ditemukan</p>
                    </div>
                </div>
                <div class="row g-3">
                    @foreach($mitraResults as $m)
                    <div class="col-6 col-md-4">
                        <a href="{{ route('program-komunitas') }}" class="sr-mitra-card">
                            <img src="{{ asset($m['logo']) }}" alt="{{ $m['name'] }}" class="sr-mitra-logo">
                            <span class="sr-mitra-name">{{ $m['name'] }}</span>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        {{-- SIDEBAR --}}
        <div class="col-12 col-lg-4">
            <div class="sr-sidebar">

                <div class="sr-sidebar-card">
                    <h4 class="sr-sidebar-title">
                        <i class="bi bi-geo-alt-fill me-2"></i>Cari Klinik Terdekat
                    </h4>
                    <p class="sr-sidebar-desc">
                        Gunakan GPS untuk menemukan klinik TBC terdekat dari lokasi Anda saat ini.
                    </p>
                    <a href="{{ route('klinik-terdekat') }}" class="btn-primary-red w-100 justify-content-center">
                        Aktifkan Lokasi
                        <span class="btn-icon"><i class="bi bi-geo-alt-fill"></i></span>
                    </a>
                </div>

                <div class="sr-sidebar-card mt-3">
                    <h4 class="sr-sidebar-title">
                        <i class="bi bi-telephone-fill me-2"></i>Butuh Bantuan?
                    </h4>
                    <p class="sr-sidebar-desc">
                        Tim kami siap membantu mengarahkan Anda ke fasilitas TBC yang tepat.
                    </p>
                    <a href="mailto:info@stoptbindonesia.org" class="sr-btn-contact">
                        <i class="bi bi-envelope-fill me-2"></i>Hubungi Kami
                    </a>
                </div>

                <div class="sr-sidebar-card mt-3">
                    <h4 class="sr-sidebar-title">Pencarian Populer</h4>
                    <div class="sr-sugg-chips mt-2">
                        @foreach(['TCM', 'Jakarta', 'Puskesmas', 'OAT', 'RSUD', 'Bandung', 'Klinik DOTS', 'Surabaya'] as $s)
                        <a href="{{ route('search', ['q' => $s]) }}" class="sr-sugg-chip">{{ $s }}</a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endif

</div>
@endsection
