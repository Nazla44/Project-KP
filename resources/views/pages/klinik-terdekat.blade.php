@extends('layouts.app')

@section('title', 'Klinik TBC Terdekat – Stop TB Partnership Indonesia')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="{{ asset('css/klinik-terdekat.css') }}">
@endpush

@section('content')

    {{-- HERO --}}
    <section class="klinik-hero">
        <div class="container-xl px-4 px-lg-5">

            <nav class="pk-breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <i class="bi bi-chevron-right"></i>
                <span>Klinik Terdekat</span>
            </nav>

            <div class="klinik-hero-inner">
                <div class="klinik-hero-content">

                    <span class="section-tag-pill">Klinik Terdekat</span>

                    <h1 class="klinik-hero-title">
                        Klinik TBC<br>
                        <span>Terdekat dari Anda</span>
                    </h1>

                    <p class="klinik-hero-desc">
                        Aktifkan GPS untuk menemukan fasilitas kesehatan TBC yang paling dekat
                        dari posisi Anda saat ini secara real-time.
                    </p>

                    <button class="btn-aktif-gps" id="btnAktifGPS" type="button">
                        <div class="gps-icon-btn">
                            <div class="gps-btn-pulse"></div>
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <span id="btnGPSText">Deteksi Lokasi Saya</span>
                    </button>

                    <div class="lokasi-aktif" id="lokasiAktif" style="display:none;">
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

    {{-- MAIN --}}
    <section class="klinik-nearby-section py-5">
        <div class="container-xl px-4 px-lg-5">

            <div id="gpsError" class="alert-err" style="display:none;">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span id="gpsErrorMsg"></span>
            </div>

            <div id="stateAwal" class="state-center">
                <div class="state-icon">📍</div>
                <h4>Aktifkan GPS terlebih dahulu</h4>
                <p>Klik tombol "Deteksi Lokasi Saya" untuk menemukan klinik terdekat dari posisi Anda.</p>
            </div>

            <div id="stateLoading" class="state-center" style="display:none;">
                <div class="spinner-red"></div>
                <p>Mendeteksi lokasi dan mencari klinik terdekat...</p>
            </div>

            <div id="hasilGPS" style="display:none;">

                <div class="map-wrapper">
                    <div id="klinikMap"></div>
                </div>

                <div class="result-header">
                    <h2 class="result-title" id="nearbyCount">— Klinik Ditemukan</h2>
                    <span class="result-badge">Diurutkan berdasarkan jarak</span>
                </div>

                <div class="sort-chips">
                    <button class="sort-chip active" id="sortJarak" type="button">Jarak Terdekat</button>
                    <button class="sort-chip" id="sortBuka" type="button">Buka Sekarang</button>
                </div>

                <div class="klinik-list" id="nearbyList"></div>

                <button class="btn-nav-maps" id="btnNavMaps" type="button">
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

            if (!btnAktif) return;

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
                if (!jamBuka || !jamTutup) return false;

                const now = new Date();
                const menitSekarang = now.getHours() * 60 + now.getMinutes();

                const [bukaJam, bukaMenit] = jamBuka.split(':').map(Number);
                const [tutupJam, tutupMenit] = jamTutup.split(':').map(Number);

                return menitSekarang >= (bukaJam * 60 + bukaMenit)
                    && menitSekarang <= (tutupJam * 60 + tutupMenit);
            }

            function showError(message) {
                if (!gpsError || !gpsErrorMsg) return;

                gpsError.style.display = 'flex';
                gpsErrorMsg.textContent = message;
            }

            function googleMapsUrl(klinik) {
                const query = encodeURIComponent(`${klinik.nama}, ${klinik.alamat}, ${klinik.kota}`);
                return `https://www.google.com/maps/search/?api=1&query=${query}`;
            }

            function googleMapsDirectionUrl(klinik) {
                const destination = encodeURIComponent(`${klinik.nama}, ${klinik.alamat}, ${klinik.kota}`);
                return `https://www.google.com/maps/dir/?api=1&destination=${destination}&travelmode=driving`;
            }

            btnAktif.addEventListener('click', function () {
                if (!navigator.geolocation) {
                    showError('Browser tidak mendukung fitur GPS.');
                    return;
                }

                if (stateAwal) stateAwal.style.display = 'none';
                if (stateLoad) stateLoad.style.display = 'flex';
                if (hasilGPS) hasilGPS.style.display = 'none';
                if (gpsError) gpsError.style.display = 'none';

                btnAktif.disabled = true;

                if (btnGPSText) {
                    btnGPSText.textContent = 'Mendeteksi...';
                }

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

            function onGPSSuccess(position) {
                userLat = Number(position.coords.latitude);
                userLng = Number(position.coords.longitude);

                klinikSorted = KLINIK_DATA
                    .map(function (klinik) {
                        const lat = Number(klinik.lat);
                        const lng = Number(klinik.lng);

                        if (!Number.isFinite(lat) || !Number.isFinite(lng)) {
                            return null;
                        }

                        const jarak = hitungJarak(userLat, userLng, lat, lng);

                        return {
                            ...klinik,
                            lat: lat,
                            lng: lng,
                            jarak: jarak,
                            eta: estimasiMenit(jarak),
                            buka: cekBuka(klinik.jam_buka, klinik.jam_tutup)
                        };
                    })
                    .filter(Boolean)
                    .sort(function (a, b) {
                        return a.jarak - b.jarak;
                    });

                if (lokasiAktif) {
                    lokasiAktif.style.display = 'inline-flex';
                }

                if (lokasiNama) {
                    lokasiNama.textContent = `${userLat.toFixed(4)}, ${userLng.toFixed(4)}`;
                }

                if (btnGPSText) {
                    btnGPSText.textContent = 'Perbarui Lokasi';
                }

                btnAktif.disabled = false;

                renderKlinikList(klinikSorted);

                if (btnNavMaps) {
                    btnNavMaps.onclick = function () {
                        const klinikTerdekat = klinikSorted[0];

                        if (!klinikTerdekat) {
                            showError('Tidak ada klinik yang tersedia untuk dinavigasi.');
                            return;
                        }

                        window.open(googleMapsDirectionUrl(klinikTerdekat), '_blank');
                    };
                }

                if (stateLoad) stateLoad.style.display = 'none';
                if (hasilGPS) hasilGPS.style.display = 'block';

                setTimeout(initMap, 200);
            }

            function onGPSError(error) {
                if (stateLoad) stateLoad.style.display = 'none';
                if (stateAwal) stateAwal.style.display = 'flex';

                btnAktif.disabled = false;

                if (btnGPSText) {
                    btnGPSText.textContent = 'Deteksi Lokasi Saya';
                }

                if (error.code === 1) {
                    showError('Akses lokasi ditolak. Klik ikon lokasi di address bar browser, lalu izinkan akses lokasi.');
                } else if (error.code === 2) {
                    showError('Lokasi tidak tersedia. Pastikan GPS atau layanan lokasi aktif.');
                } else if (error.code === 3) {
                    showError('Waktu deteksi lokasi habis. Coba ulangi beberapa saat lagi.');
                } else {
                    showError('Gagal mendapatkan lokasi. Pastikan GPS aktif.');
                }
            }

            function renderKlinikList(list) {
                const filteredList = sortBukaOnly ? list.filter(k => k.buka) : list;

                if (nearbyCount) {
                    nearbyCount.textContent = `${filteredList.length} Klinik Ditemukan`;
                }

                if (!nearbyList) return;

                nearbyList.innerHTML = '';

                if (filteredList.length === 0) {
                    nearbyList.innerHTML = `
                        <div class="state-center">
                            <div class="state-icon">🔍</div>
                            <h4>Belum ada klinik yang tersedia</h4>
                            <p>Tidak ada klinik yang buka saat ini atau data klinik belum tersedia.</p>
                        </div>
                    `;
                    return;
                }

                filteredList.forEach(function (klinik, index) {
                    const mapsUrl = googleMapsUrl(klinik);

                    const card = document.createElement('div');
                    card.className = `klinik-card ${index === 0 ? 'nearest' : ''}`;

                    card.innerHTML = `
                        ${index === 0 ? '<div class="nearest-pill">⚡ Terdekat</div>' : ''}

                        <div class="klinik-card-body">
                            <div class="rank-badge ${index === 0 ? 'rank-1' : 'rank-n'}">
                                ${index + 1}
                            </div>

                            <div class="klinik-thumb">
                                ${klinik.tipe === 'RS Umum' ? '🏨' : '🏥'}
                            </div>

                            <div class="klinik-card-info">
                                <h5 class="klinik-card-nama">${klinik.nama}</h5>

                                <p class="klinik-card-tipe">${klinik.tipe} · ${klinik.kota}</p>

                                <p class="klinik-card-alamat">${klinik.alamat}</p>

                                <div class="klinik-jam-row">
                                    <span class="jam-text">
                                        ${klinik.hari_buka} · ${klinik.jam_buka}–${klinik.jam_tutup}
                                    </span>

                                    <span class="${klinik.buka ? 'status-buka' : 'status-tutup'}">
                                        ● ${klinik.buka ? 'Buka' : 'Tutup'}
                                    </span>
                                </div>

                                <div class="layanan-tags">
                                    ${(klinik.layanan || []).map(function (layanan) {
                                        return `<span class="layanan-tag">${layanan}</span>`;
                                    }).join('')}
                                </div>

                                <div class="klinik-aksi">
                                    <a href="tel:${klinik.telepon}" class="btn-hubungi">
                                        <i class="bi bi-telephone-fill"></i>
                                        Hubungi
                                    </a>

                                    <a href="${mapsUrl}" target="_blank" rel="noopener noreferrer" class="btn-maps">
                                        <i class="bi bi-map-fill"></i>
                                        Google Maps
                                    </a>
                                </div>
                            </div>

                            <div class="jarak-box">
                                <div class="jarak-angka ${index === 0 ? 'dekat' : 'jauh'}">
                                    ${klinik.jarak.toFixed(1)}
                                </div>
                                <div class="jarak-satuan">km</div>
                                <div class="jarak-eta">~${klinik.eta} menit</div>
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

                const mapElement = document.getElementById('klinikMap');

                if (!mapElement) return;

                if (map) {
                    map.remove();
                    map = null;
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
                            border:3px solid #ffffff;
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
                    fillOpacity: 0.05,
                    weight: 1.5,
                    dashArray: '5,5',
                    radius: 2000
                }).addTo(map);

                const clinicIcon = L.divIcon({
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

                klinikSorted.forEach(function (klinik) {
                    bounds.push([klinik.lat, klinik.lng]);

                    L.marker([klinik.lat, klinik.lng], { icon: clinicIcon })
                        .addTo(map)
                        .bindPopup(`
                            <b>${klinik.nama}</b><br>
                            <span style="font-size:11px;color:#666;">
                                ${klinik.tipe} · ${klinik.jarak.toFixed(1)} km
                            </span><br>
                            <a href="${googleMapsDirectionUrl(klinik)}"
                               target="_blank"
                               rel="noopener noreferrer"
                               style="font-size:11px;color:#d50000;font-weight:600;">
                                Navigasi →
                            </a>
                        `);
                });

                function fixMapSize() {
                    map.invalidateSize(true);

                    if (bounds.length > 1) {
                        map.fitBounds(bounds, {
                            padding: [40, 40]
                        });
                    }
                }

                fixMapSize();
                setTimeout(fixMapSize, 100);
                setTimeout(fixMapSize, 300);
                setTimeout(fixMapSize, 600);
            }

            if (sortJarak) {
                sortJarak.addEventListener('click', function () {
                    sortBukaOnly = false;

                    sortJarak.classList.add('active');

                    if (sortBuka) {
                        sortBuka.classList.remove('active');
                    }

                    renderKlinikList(klinikSorted);
                });
            }

            if (sortBuka) {
                sortBuka.addEventListener('click', function () {
                    sortBukaOnly = !sortBukaOnly;

                    sortBuka.classList.toggle('active', sortBukaOnly);

                    if (sortJarak) {
                        sortJarak.classList.toggle('active', !sortBukaOnly);
                    }

                    renderKlinikList(klinikSorted);
                });
            }
        });
    </script>
@endpush