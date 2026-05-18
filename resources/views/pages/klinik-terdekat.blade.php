@extends('layouts.guest')

@section('title', 'Klinik TBC Terdekat – Stop TB Partnership Indonesia')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

@endpush

@section('content')

    {{-- ═══════════════════ HERO GPS ═══════════════════ --}}
    <section class="gps-hero-section">
        <div class="container-xl px-4 px-lg-5">
            <div class="d-flex justify-content-between align-items-center gap-4">
                <div>
                    <h1 class="gps-hero-title">
                        Klinik TBC<br>
                        <span>Terdekat dari Anda</span>
                    </h1>
                    <p class="gps-hero-desc">
                        Aktifkan GPS untuk menemukan fasilitas kesehatan TBC yang paling dekat
                        dari posisi Anda saat ini secara real-time.
                    </p>

                    {{-- Tombol aktifkan GPS --}}
                    <button class="btn-aktif-gps" id="btnAktifGPS">
                        <div class="gps-icon-btn">
                            <div class="gps-btn-pulse"></div>
                            <i class="bi bi-geo-alt-fill text-white"></i>
                        </div>
                        <span id="btnGPSText">Deteksi Lokasi Saya</span>
                    </button>

                    {{-- Lokasi aktif (tersembunyi dulu) --}}
                    <div class="lokasi-aktif mt-3" id="lokasiAktif" style="display:none!important;">
                        <div class="lokasi-dot"></div>
                        <div>
                            <div class="lokasi-nama" id="lokasiNama">Mendeteksi...</div>
                            <div class="lokasi-sub">GPS aktif · Real-time</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════ CONTENT ═══════════════════ --}}
    <section class="py-5">
        <div class="container-xl px-4 px-lg-5">

            {{-- Error GPS --}}
            <div id="gpsError" class="alert-err mb-4" style="display:none;">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span id="gpsErrorMsg"></span>
            </div>

            {{-- State awal: belum aktifkan GPS --}}
            <div id="stateAwal" class="state-center">
                <div style="font-size:56px">📍</div>
                <h4>Aktifkan GPS terlebih dahulu</h4>
                <p>Klik tombol "Deteksi Lokasi Saya" di atas untuk menemukan klinik terdekat dari posisi Anda.</p>
            </div>

            {{-- Loading --}}
            <div id="stateLoading" class="state-center" style="display:none;">
                <div class="spinner-red"></div>
                <p>Mendeteksi lokasi dan mencari klinik terdekat...</p>
            </div>

            {{-- Hasil GPS --}}
            <div id="hasilGPS" style="display:none;">

                {{-- Peta Leaflet --}}
                <div class="map-wrapper">
                    <div id="klinikMap"></div>
                </div>

                {{-- Header hasil --}}
                <div class="result-header">
                    <h2 class="result-title" id="nearbyCount">— Klinik Ditemukan</h2>
                    <span class="result-badge">Diurutkan berdasarkan jarak</span>
                </div>

                {{-- Sort chips --}}
                <div class="sort-chips mb-4">
                    <button class="sort-chip active" id="sortJarak">Jarak Terdekat</button>
                    <button class="sort-chip" id="sortBuka">Buka Sekarang</button>
                </div>

                {{-- Daftar klinik terdekat --}}
                <div class="klinik-list" id="nearbyList"></div>

                {{-- Tombol navigasi --}}
                <button class="btn-nav-maps" id="btnNavMaps">
                    <i class="bi bi-send-fill"></i>
                    Navigasi ke Klinik Terdekat via Google Maps
                </button>

            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const KLINIK_DATA = @json($klinik ?? []);

            let userLat = null;
            let userLng = null;
            let klinikSorted = [];
            let map = null;
            let sortBukaOnly = false;

            const btnAktif = document.getElementById('btnAktifGPS');
            const btnGPSText = document.getElementById('btnGPSText');
            const lokasiAktif = document.getElementById('lokasiAktif');
            const lokasiNama = document.getElementById('lokasiNama');
            const stateAwal = document.getElementById('stateAwal');
            const stateLoad = document.getElementById('stateLoading');
            const hasilGPS = document.getElementById('hasilGPS');
            const gpsError = document.getElementById('gpsError');
            const gpsErrorMsg = document.getElementById('gpsErrorMsg');
            const nearbyList = document.getElementById('nearbyList');
            const nearbyCount = document.getElementById('nearbyCount');
            const btnNavMaps = document.getElementById('btnNavMaps');
            const sortJarak = document.getElementById('sortJarak');
            const sortBuka = document.getElementById('sortBuka');

            if (!btnAktif) {
                console.error('Tombol #btnAktifGPS tidak ditemukan.');
                return;
            }

            console.log('Script klinik terdekat aktif.');
            console.table(KLINIK_DATA);

            function hitungJarak(lat1, lng1, lat2, lng2) {
                const R = 6371;
                const dLat = (lat2 - lat1) * Math.PI / 180;
                const dLng = (lng2 - lng1) * Math.PI / 180;

                const a =
                    Math.sin(dLat / 2) ** 2 +
                    Math.cos(lat1 * Math.PI / 180) *
                    Math.cos(lat2 * Math.PI / 180) *
                    Math.sin(dLng / 2) ** 2;

                return parseFloat((R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a))).toFixed(2));
            }

            function estimasiMenit(km) {
                return Math.ceil((km / 20) * 60);
            }

            function cekBuka(jamBuka, jamTutup) {
                if (!jamBuka || !jamTutup) {
                    return false;
                }

                const sekarang = new Date();
                const menitSekarang = sekarang.getHours() * 60 + sekarang.getMinutes();

                const [bukaJam, bukaMenit] = jamBuka.split(':').map(Number);
                const [tutupJam, tutupMenit] = jamTutup.split(':').map(Number);

                return menitSekarang >= bukaJam * 60 + bukaMenit &&
                    menitSekarang <= tutupJam * 60 + tutupMenit;
            }

            function showError(msg) {
                if (gpsError && gpsErrorMsg) {
                    gpsError.style.display = 'flex';
                    gpsErrorMsg.textContent = msg;
                }

                console.error(msg);
            }

            /*
    * Untuk tombol "Google Maps" di setiap card.
    * Membuka lokasi klinik berdasarkan nama + alamat agar lebih akurat.
    */
            function googleMapsUrl(k) {
                const query = encodeURIComponent(`${k.nama}, ${k.alamat}, ${k.kota}`);
                return `https://www.google.com/maps/search/?api=1&query=${query}`;
            }

            /*
             * Untuk tombol "Navigasi".
             * Google Maps akan mencari tujuan berdasarkan nama + alamat klinik.
             */
            function googleMapsDirectionUrl(k) {
                const destination = encodeURIComponent(`${k.nama}, ${k.alamat}, ${k.kota}`);
                return `https://www.google.com/maps/dir/?api=1&destination=${destination}&travelmode=driving`;
            }
            btnAktif.addEventListener('click', function () {
                console.log('Tombol GPS diklik.');

                if (!navigator.geolocation) {
                    showError('Browser tidak mendukung GPS.');
                    return;
                }

                if (stateAwal) stateAwal.style.display = 'none';
                if (stateLoad) stateLoad.style.display = 'flex';
                if (hasilGPS) hasilGPS.style.display = 'none';
                if (gpsError) gpsError.style.display = 'none';

                if (btnGPSText) btnGPSText.textContent = 'Mendeteksi...';
                btnAktif.disabled = true;

                navigator.geolocation.getCurrentPosition(
                    onGPSSuccess,
                    onGPSError,
                    {
                        enableHighAccuracy: true,
                        timeout: 20000,
                        maximumAge: 0
                    }
                );
            });

            function onGPSSuccess(pos) {
                console.log('GPS berhasil:', pos.coords);

                userLat = Number(pos.coords.latitude);
                userLng = Number(pos.coords.longitude);

                klinikSorted = KLINIK_DATA
                    .map(k => {
                        const lat = Number(k.lat);
                        const lng = Number(k.lng);

                        if (!Number.isFinite(lat) || !Number.isFinite(lng)) {
                            console.warn('Koordinat klinik tidak valid:', k);
                            return null;
                        }

                        const jarak = hitungJarak(userLat, userLng, lat, lng);

                        return {
                            ...k,
                            lat,
                            lng,
                            jarak,
                            eta: estimasiMenit(jarak),
                            buka: cekBuka(k.jam_buka, k.jam_tutup)
                        };
                    })
                    .filter(Boolean)
                    .sort((a, b) => a.jarak - b.jarak);

                if (lokasiAktif) lokasiAktif.style.display = 'inline-flex';
                if (lokasiNama) lokasiNama.textContent = `${userLat.toFixed(4)}, ${userLng.toFixed(4)}`;

                if (btnGPSText) btnGPSText.textContent = 'Perbarui Lokasi';
                btnAktif.disabled = false;

                renderKlinikList(klinikSorted);

                if (btnNavMaps) {
                    btnNavMaps.onclick = function () {
                        const k = klinikSorted[0];

                        if (!k) {
                            showError('Tidak ada klinik yang tersedia untuk dinavigasi.');
                            return;
                        }

                        window.open(googleMapsDirectionUrl(k), '_blank');
                    };
                }

                if (stateLoad) stateLoad.style.display = 'none';
                if (hasilGPS) hasilGPS.style.display = 'block';

                setTimeout(initMap, 200);
            }

            function onGPSError(err) {
                console.error('GPS error:', err);

                if (stateLoad) stateLoad.style.display = 'none';
                if (stateAwal) stateAwal.style.display = 'flex';

                btnAktif.disabled = false;
                if (btnGPSText) btnGPSText.textContent = 'Deteksi Lokasi Saya';

                if (err.code === 1) {
                    showError('Akses lokasi ditolak. Klik ikon lokasi di address bar browser, lalu izinkan akses lokasi.');
                } else if (err.code === 2) {
                    showError('Lokasi tidak tersedia. Pastikan GPS atau layanan lokasi aktif.');
                } else if (err.code === 3) {
                    showError('Waktu deteksi lokasi habis. Coba ulangi beberapa saat lagi.');
                } else {
                    showError('Gagal mendapatkan lokasi. Pastikan GPS aktif.');
                }
            }

            function renderKlinikList(list) {
                const filtered = sortBukaOnly ? list.filter(k => k.buka) : list;

                if (nearbyCount) {
                    nearbyCount.textContent = `${filtered.length} Klinik Ditemukan`;
                }

                if (!nearbyList) return;

                nearbyList.innerHTML = '';

                if (filtered.length === 0) {
                    nearbyList.innerHTML = `
                                <div class="state-center">
                                    <div style="font-size:40px">🔍</div>
                                    <p>Tidak ada klinik yang buka saat ini.</p>
                                </div>
                            `;
                    return;
                }

                filtered.forEach((k, i) => {
                    const mapsUrl = googleMapsUrl(k);

                    const card = document.createElement('div');
                    card.className = `klinik-card ${i === 0 ? 'nearest' : ''} mb-0`;

                    card.innerHTML = `
                                ${i === 0 ? '<div class="nearest-pill">⚡ Terdekat</div>' : ''}

                                <div class="klinik-card-body">
                                    <div class="rank-badge ${i === 0 ? 'rank-1' : 'rank-n'}">${i + 1}</div>

                                    <div class="klinik-thumb">
                                        ${k.tipe === 'RS Umum' ? '🏨' : '🏥'}
                                    </div>

                                    <div class="klinik-card-info">
                                        <h5 class="klinik-card-nama">${k.nama}</h5>
                                        <p class="klinik-card-tipe">${k.tipe} · ${k.kota}</p>
                                        <p class="klinik-card-alamat">${k.alamat}</p>

                                        <div class="klinik-jam-row">
                                            <span class="jam-text">${k.hari_buka} · ${k.jam_buka}–${k.jam_tutup}</span>
                                            <span class="${k.buka ? 'status-buka' : 'status-tutup'}">
                                                ● ${k.buka ? 'Buka' : 'Tutup'}
                                            </span>
                                        </div>

                                        <div class="layanan-tags">
                                            ${(k.layanan || []).map(l => `<span class="layanan-tag">${l}</span>`).join('')}
                                        </div>

                                        <div class="klinik-aksi">
                                            <a href="tel:${k.telepon}" class="btn-hubungi">
                                                <i class="bi bi-telephone-fill"></i> Hubungi
                                            </a>

                                            <a href="${mapsUrl}" target="_blank" rel="noopener noreferrer" class="btn-maps">
                                                <i class="bi bi-map-fill"></i> Google Maps
                                            </a>
                                        </div>
                                    </div>

                                    <div class="jarak-box">
                                        <div class="jarak-angka ${i === 0 ? 'dekat' : 'jauh'}">${k.jarak.toFixed(1)}</div>
                                        <div class="jarak-satuan">km</div>
                                        <div class="jarak-eta">~${k.eta} menit</div>
                                    </div>
                                </div>
                            `;

                    nearbyList.appendChild(card);
                });
            }

            function initMap() {
                if (typeof L === 'undefined') {
                    showError('Leaflet gagal dimuat. Periksa koneksi internet atau CDN Leaflet.');
                    return;
                }

                if (map) {
                    map.remove();
                    map = null;
                }

                const el = document.getElementById('klinikMap');

                if (!el) {
                    console.error('Element #klinikMap tidak ditemukan.');
                    return;
                }

                map = L.map('klinikMap', {
                    zoomControl: true,
                    fadeAnimation: false,
                    markerZoomAnimation: false
                }).setView([userLat, userLng], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap',
                    maxZoom: 18
                }).addTo(map);

                const userIcon = L.divIcon({
                    className: '',
                    iconSize: [16, 16],
                    iconAnchor: [8, 8],
                    html: `
                                <div style="
                                    width:16px;
                                    height:16px;
                                    background:#4285F4;
                                    border:3px solid #fff;
                                    border-radius:50%;
                                    box-shadow:0 0 0 5px rgba(66,133,244,.25);
                                "></div>
                            `
                });

                L.marker([userLat, userLng], { icon: userIcon })
                    .addTo(map)
                    .bindPopup('<b>📍 Lokasi Anda</b>');

                L.circle([userLat, userLng], {
                    color: '#4285F4',
                    fillColor: '#4285F4',
                    fillOpacity: .05,
                    weight: 1.5,
                    dashArray: '5,5',
                    radius: 2000
                }).addTo(map);

                const pin = L.divIcon({
                    className: '',
                    iconSize: [28, 36],
                    iconAnchor: [14, 36],
                    popupAnchor: [0, -36],
                    html: `
                                <div style="
                                    background:#d50000;
                                    width:28px;
                                    height:28px;
                                    border-radius:50% 50% 50% 0;
                                    transform:rotate(-45deg);
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    box-shadow:0 2px 8px rgba(0,0,0,.3);
                                ">
                                    <span style="transform:rotate(45deg);font-size:13px;">🏥</span>
                                </div>
                            `
                });

                const bounds = [[userLat, userLng]];

                klinikSorted.forEach(k => {
                    bounds.push([k.lat, k.lng]);

                    L.marker([k.lat, k.lng], { icon: pin })
                        .addTo(map)
                        .bindPopup(`
                                    <b>${k.nama}</b><br>
                                    <span style="font-size:11px;color:#666">
                                        ${k.tipe} · ${k.jarak.toFixed(1)} km
                                    </span><br>
                                    <a href="${googleMapsDirectionUrl(k)}" target="_blank" rel="noopener noreferrer" style="font-size:11px;color:#d50000;font-weight:600;">
                                        Navigasi →
                                    </a>
                                `);
                });

                const fixSize = () => {
                    map.invalidateSize(true);

                    if (bounds.length > 1) {
                        map.fitBounds(bounds, {
                            padding: [40, 40]
                        });
                    }
                };

                fixSize();
                setTimeout(fixSize, 100);
                setTimeout(fixSize, 300);
                setTimeout(fixSize, 600);
                setTimeout(fixSize, 1000);
            }

            if (sortJarak) {
                sortJarak.addEventListener('click', function () {
                    sortBukaOnly = false;

                    this.classList.add('active');
                    if (sortBuka) sortBuka.classList.remove('active');

                    renderKlinikList(klinikSorted);
                });
            }

            if (sortBuka) {
                sortBuka.addEventListener('click', function () {
                    sortBukaOnly = !sortBukaOnly;

                    this.classList.toggle('active', sortBukaOnly);
                    if (sortJarak) sortJarak.classList.toggle('active', !sortBukaOnly);

                    renderKlinikList(klinikSorted);
                });
            }
        });
    </script>
@endpush
