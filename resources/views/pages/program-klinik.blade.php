@extends('layouts.app')

@section('title', 'Program Klinik – Stop TB Partnership Indonesia')

@push('styles')
    <link href="{{ asset('css/program-klinik.css') }}" rel="stylesheet">
@endpush

@section('content')

    {{-- ═══════════════════════════════ HERO ═══════════════════════════════ --}}
    <section class="klinik-hero">
        <div class="container-xl px-4 px-lg-5">
        <nav class="pk-breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <i class="bi bi-chevron-right"></i>
            <span>Program Klinik</span>
        </nav>
            <div class="klinik-hero-inner">
                <div>
                    <span class="section-tag-pill">Program Klinik</span>
                    <h1 class="klinik-hero-title">
                        Temukan <span><i>Klinik TBC</i></span><br>
                        di Seluruh Indonesia
                    </h1>
                    <p class="klinik-hero-desc">
                        Jaringan fasilitas kesehatan mitra Stop TB Partnership Indonesia
                        yang siap melayani diagnosis dan pengobatan tuberkulosis.
                    </p>
                    
                    <div class="klinik-stats-box">
                        <div class="text-center">
                            <div class="klinik-stat-num">{{ $stats['total'] }}+</div>
                            <div class="klinik-stat-label">Klinik Mitra</div>
                        </div>
                        <div class="klinik-stat-divider"></div>
                        <div class="text-center">
                            <div class="klinik-stat-num">{{ $stats['kota'] }}</div>
                            <div class="klinik-stat-label">Kota / Kab.</div>
                        </div>
                        <div class="klinik-stat-divider"></div>
                        <div class="text-center">
                            <div class="klinik-stat-num">{{ $stats['provinsi'] }}</div>
                            <div class="klinik-stat-label">Provinsi</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════ MAIN ═══════════════════════════════ --}}
    <section class="py-5">
        <div class="container-xl px-4 px-lg-5">

            {{-- GPS Banner --}}
            <a href="{{ route('klinik-terdekat') }}" class="gps-banner text-decoration-none">
                <div class="gps-banner-icon">
                    <div class="gps-pulse"></div>
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="gps-banner-text">
                    <strong>Klinik Terdekat dari Lokasi Anda</strong>
                    <span>Aktifkan GPS untuk temukan klinik TBC paling dekat secara otomatis</span>
                </div>
                <div class="gps-banner-arrow">
                    <i class="bi bi-chevron-right"></i>
                </div>
            </a>

            {{-- Search bar --}}
            <div class="filter-search-wrap">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.35-4.35" />
                </svg>
                <input type="text" id="searchKlinik" placeholder="Cari nama klinik atau alamat...">
            </div>

            {{-- Filter chips --}}
            <div class="filter-chips">
                <button class="filter-chip active" data-tipe="Semua">Semua</button>
                <button class="filter-chip" data-tipe="Puskesmas">Puskesmas</button>
                <button class="filter-chip" data-tipe="RS Umum">RS Umum</button>
                <button class="filter-chip" data-tipe="Klinik">Klinik</button>
            </div>

            {{-- Result header --}}
            <div class="result-header">
                <h2 class="result-title" id="resultCount">{{ count($klinik) }} Klinik Ditemukan</h2>
            </div>
            <div id="emptyKlinik" class="empty-klinik" style="display: none;">
                <h5>Klinik tidak ditemukan</h5>
                <p>Coba gunakan kata kunci lain....</p>
            </div>

            {{-- Daftar klinik --}}
            <div class="klinik-list" id="klinikList">
                @foreach($klinik as $k)
                    @php
                        $layananStr = implode(',', $k['layanan']);
                        $mapsUrl = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($k['nama'] . ' ' . $k['alamat']);
                    @endphp
                    <div class="klinik-card" data-tipe="{{ $k['tipe'] }}" data-nama="{{ strtolower($k['nama']) }}"
                        data-alamat="{{ strtolower($k['alamat']) }}" data-kota="{{ strtolower($k['kota']) }}"
                        data-buka="{{ $k['jam_buka'] }}" data-tutup="{{ $k['jam_tutup'] }}">
                        <div class="klinik-card-body">
                            <div class="klinik-thumb">
                                @if($k['tipe'] === 'RS Umum') 🏨
                                @else 🏥
                                @endif
                            </div>
                            <div class="klinik-card-info">
                                <h5 class="klinik-card-nama">{{ $k['nama'] }}</h5>
                                <p class="klinik-card-tipe">{{ $k['tipe'] }} · {{ $k['kota'] }}</p>
                                <p class="klinik-card-alamat">{{ $k['alamat'] }}</p>
                                <div class="klinik-jam-row">
                                    <span class="jam-text">{{ $k['hari_buka'] }} ·
                                        {{ $k['jam_buka'] }}–{{ $k['jam_tutup'] }}</span>
                                    <span class="status-buka klinik-status" data-buka="{{ $k['jam_buka'] }}"
                                        data-tutup="{{ $k['jam_tutup'] }}"></span>
                                </div>
                                <div class="layanan-tags">
                                    @foreach($k['layanan'] as $l)
                                        <span class="layanan-tag">{{ $l }}</span>
                                    @endforeach
                                </div>
                                <div class="klinik-aksi">
                                    <a href="tel:{{ $k['telepon'] }}" class="btn-hubungi">
                                        <i class="bi bi-telephone-fill"></i> Hubungi
                                    </a>
                                    <a href="{{ $mapsUrl }}" target="_blank" rel="noopener" class="btn-maps">
                                        <i class="bi bi-map-fill"></i> Buka di Google Maps
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Empty state --}}
            <div id="emptyState" class="state-center" style="display:none;">
                <div style="font-size:44px">🔍</div>
                <h4>Tidak ada klinik ditemukan</h4>
                <p>Coba ubah kata kunci atau reset filter.</p>
                <button class="btn-hubungi px-4" onclick="resetFilter()">Reset Filter</button>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
    <script>
        // ── Cek status buka/tutup ─────────────────────────────────────────────────
        function cekBuka(jamBuka, jamTutup) {
            const now = new Date();
            const mnt = now.getHours() * 60 + now.getMinutes();
            const [bH, bM] = jamBuka.split(':').map(Number);
            const [tH, tM] = jamTutup.split(':').map(Number);
            return mnt >= bH * 60 + bM && mnt <= tH * 60 + tM;
        }

        // Set status buka/tutup semua kartu
        document.querySelectorAll('.klinik-status').forEach(el => {
            const buka = el.dataset.buka, tutup = el.dataset.tutup;
            if (cekBuka(buka, tutup)) {
                el.textContent = '● Buka';
                el.className = 'status-buka klinik-status';
            } else {
                el.textContent = '● Tutup';
                el.className = 'status-tutup klinik-status';
            }
        });

        // ── Filter logic ─────────────────────────────────────────────────────────
        let activeFilter = 'Semua';
        let activeSearch = '';
        let filterBuka = false;

        function applyFilter() {
            const cards = document.querySelectorAll('#klinikList .klinik-card');
            let visible = 0;
            cards.forEach(card => {
                const matchTipe = activeFilter === 'Semua' || card.dataset.tipe === activeFilter;
                const matchSearch = !activeSearch ||
                    card.dataset.nama.includes(activeSearch) ||
                    card.dataset.alamat.includes(activeSearch) ||
                    card.dataset.kota.includes(activeSearch);
                const matchBuka = !filterBuka || cekBuka(card.dataset.buka, card.dataset.tutup);
                const show = matchTipe && matchSearch && matchBuka;
                card.style.display = show ? '' : 'none';
                if (show) visible++;
            });
            document.getElementById('resultCount').textContent = visible + ' Klinik Ditemukan';
            document.getElementById('emptyState').style.display = visible === 0 ? 'flex' : 'none';
            document.getElementById('klinikList').style.display = visible === 0 ? 'none' : '';
        }

        // Filter chips
        document.querySelectorAll('.filter-chip[data-tipe]').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.filter-chip[data-tipe]').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                activeFilter = this.dataset.tipe;
                applyFilter();
            });
        });


        // Search
        document.getElementById('searchInput').addEventListener('input', function () {
            activeSearch = this.value.toLowerCase().trim();
            applyFilter();
        });

        function resetFilter() {
            activeFilter = 'Semua'; activeSearch = ''; filterBuka = false;
            document.getElementById('searchInput').value = '';
            document.querySelectorAll('.filter-chip[data-tipe]').forEach(b => b.classList.remove('active'));
            document.querySelector('.filter-chip[data-tipe="Semua"]').classList.add('active');
            btnBuka.classList.remove('active');
            applyFilter();
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchKlinik');
            const resultCount = document.getElementById('resultCount');
            const emptyKlinik = document.getElementById('emptyKlinik');
            const cards = document.querySelectorAll('.klinik-card');

            if (!searchInput) return;

            searchInput.addEventListener('input', function () {
                const keyword = this.value.toLowerCase().trim();
                let visibleCount = 0;

                cards.forEach(card => {
                    const text = card.textContent.toLowerCase();

                    if (text.includes(keyword)) {
                        card.style.display = '';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                resultCount.textContent = visibleCount + ' Klinik Ditemukan';

                if (visibleCount === 0) {
                    emptyKlinik.style.display = 'block';
                } else {
                    emptyKlinik.style.display = 'none';
                }
            });
        });
    </script>

@endpush