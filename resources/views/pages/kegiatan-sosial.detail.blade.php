{{-- resources/views/pages/kegiatan-sosial-detail.blade.php --}}
@extends('layouts.guest')

@section('title', $kegiatan->judul . ' — Kegiatan Sosial TBC')

@section('content')

{{-- ======================================================
1. HEADER KEGIATAN
====================================================== --}}
<div class="relative bg-gray-900 overflow-hidden">
    {{-- Banner --}}
    <img src="{{ $kegiatan->banner_url }}" alt="{{ $kegiatan->judul }}"
        class="absolute inset-0 w-full h-full object-cover opacity-40">

    <div class="relative max-w-4xl mx-auto px-4 py-16 text-white">

        {{-- Badge status --}}
        @php
            $statusColor = [
                'published' => 'bg-blue-500',
                'ongoing' => 'bg-green-500',
                'completed' => 'bg-purple-500',
            ][$kegiatan->status] ?? 'bg-gray-500';
        @endphp
        <span class="{{ $statusColor }} text-white text-xs font-semibold px-3 py-1 rounded-full">
            {{ $kegiatan->status_label }}
        </span>

        <h1 class="text-2xl md:text-4xl font-bold mt-4 mb-5 leading-tight">
            {{ $kegiatan->judul }}
        </h1>

        <div class="flex flex-wrap gap-5 text-sm text-gray-200">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ $kegiatan->tanggal->translatedFormat('l, d F Y') }}
                @if($kegiatan->jam_mulai)
                    · {{ substr($kegiatan->jam_mulai, 0, 5) }}
                    @if($kegiatan->jam_selesai) – {{ substr($kegiatan->jam_selesai, 0, 5) }} @endif
                    WIB
                @endif
            </span>
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ $kegiatan->lokasi }}
            </span>
        </div>
    </div>
</div>

{{-- ======================================================
KONTEN UTAMA + SIDEBAR
====================================================== --}}
<div class="max-w-5xl mx-auto px-4 py-10">
    <div class="flex flex-col lg:flex-row gap-10">

        {{-- ------------------------------------------------
        KIRI: Konten utama
        ------------------------------------------------ --}}
        <div class="flex-1 min-w-0 space-y-12">

            {{-- 2. DESKRIPSI --}}
            <section>
                <h2 class="text-lg font-semibold text-gray-800 mb-3 pb-2 border-b border-gray-200">
                    Tentang Kegiatan
                </h2>
                <div class="prose prose-sm max-w-none text-gray-600 leading-relaxed">
                    {!! nl2br(e($kegiatan->deskripsi)) !!}
                </div>
            </section>

            {{-- 3. MATERI EDUKASI TBC --}}
            @if($kegiatan->materi->isNotEmpty())
                <section>
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                        Materi Edukasi
                    </h2>
                    <div class="space-y-3">
                        @foreach($kegiatan->materi as $materi)
                            <details class="group border border-gray-200 rounded-xl overflow-hidden">
                                <summary
                                    class="flex items-center justify-between px-5 py-4 cursor-pointer bg-white hover:bg-red-50 transition list-none">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="w-7 h-7 flex items-center justify-center bg-red-100 text-red-700 text-xs font-bold rounded-full flex-shrink-0">
                                            {{ $loop->iteration }}
                                        </span>
                                        <span class="font-medium text-gray-800 text-sm">{{ $materi->judul }}</span>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400 group-open:rotate-180 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </summary>
                                @if($materi->konten)
                                    <div class="px-5 pb-5 pt-3 bg-white border-t border-gray-100">
                                        <div class="text-sm text-gray-600 leading-relaxed">
                                            {!! nl2br(e($materi->konten)) !!}
                                        </div>
                                    </div>
                                @endif
                            </details>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- 4. KADER PELAKSANA --}}
            @if($kegiatan->kaders->isNotEmpty())
            <section>
                <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                    Kader Pelaksana
                </h2>
                <div class="flex flex-wrap gap-3">
                    @foreach($kegiatan->kaders as $kader)
                    <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                        <div
                            class="w-9 h-9 rounded-full bg-red-100 flex items-center justify-center text-red-700 font-semibold text-sm flex-shrink-0">
                            @php($namaKader = $kader->user?->name ?? $kader->nama ?? 'Kader')
                            {{ strtoupper(substr($namaKader, 0, 1)) }}
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-800">{{ $namaKader }}</div>
                            <div class="text-xs text-gray-500 capitalize">{{ $kader->pivot->peran }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- 5. DOKUMENTASI --}}
            @if($kegiatan->dokumentasi->isNotEmpty())
                <section>
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                        Dokumentasi
                    </h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach($kegiatan->dokumentasi as $foto)
                            <div class="group relative aspect-square overflow-hidden rounded-xl bg-gray-100 cursor-pointer"
                                onclick="openLightbox('{{ $foto->url }}', '{{ $foto->caption }}')">
                                <img src="{{ $foto->url }}" alt="{{ $foto->caption }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @if($foto->caption)
                                    <div
                                        class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-end p-2">
                                        <p class="text-white text-xs">{{ $foto->caption }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- 6. RINGKASAN HASIL (hanya statistik publik) --}}
            @if($kegiatan->ringkasan)
                <section>
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                        Ringkasan Hasil Kegiatan
                    </h2>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center bg-red-50 rounded-xl py-5">
                            <div class="text-3xl font-bold text-red-700">
                                {{ $kegiatan->ringkasan->jumlah_peserta }}
                            </div>
                            <div class="text-xs text-gray-500 mt-1">Peserta Hadir</div>
                        </div>
                        <div class="text-center bg-blue-50 rounded-xl py-5">
                            <div class="text-3xl font-bold text-blue-700">
                                {{ $kegiatan->ringkasan->jumlah_kader }}
                            </div>
                            <div class="text-xs text-gray-500 mt-1">Kader Terlibat</div>
                        </div>
                        <div class="text-center bg-green-50 rounded-xl py-5">
                            <div class="text-3xl font-bold text-green-700">
                                {{ $kegiatan->ringkasan->jumlah_materi }}
                            </div>
                            <div class="text-xs text-gray-500 mt-1">Materi Disampaikan</div>
                        </div>
                    </div>
                </section>
            @endif

        </div>{{-- /kiri --}}

        {{-- ------------------------------------------------
        KANAN: Sidebar
        ------------------------------------------------ --}}
        <aside class="lg:w-72 space-y-6">

            {{-- 7. LOKASI KEGIATAN --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h3 class="font-semibold text-gray-800 text-sm">Lokasi Kegiatan</h3>
                </div>
                <div class="px-5 py-4">
                    <p class="text-sm text-gray-600 mb-3">{{ $kegiatan->lokasi }}</p>

                    @if($kegiatan->latitude && $kegiatan->longitude)
                        <div class="rounded-xl overflow-hidden bg-gray-100 aspect-video">
                            <iframe
                                src="https://maps.google.com/maps?q={{ $kegiatan->latitude }},{{ $kegiatan->longitude }}&hl=id&z=15&output=embed"
                                class="w-full h-full border-0" allowfullscreen loading="lazy">
                            </iframe>
                        </div>
                        <a href="https://maps.google.com/maps?q={{ $kegiatan->latitude }},{{ $kegiatan->longitude }}"
                            target="_blank" class="mt-2 block text-center text-xs text-blue-600 hover:underline">
                            Buka di Google Maps ↗
                        </a>
                    @endif
                </div>
            </div>

            {{-- 8. CALL TO ACTION --}}
            <div class="bg-red-700 text-white rounded-2xl p-5">
                <div class="text-base font-semibold mb-2">Ingin Periksa TBC?</div>
                <p class="text-red-100 text-xs mb-4 leading-relaxed">
                    Temukan fasilitas kesehatan terdekat yang menyediakan layanan pemeriksaan dan pengobatan TBC.
                </p>
                <a href="{{ route('klinik-terdekat') }}"
                    class="block text-center bg-white text-red-700 font-semibold text-sm rounded-xl py-2.5 hover:bg-red-50 transition">
                    Lihat Fasilitas Kesehatan TBC
                </a>
            </div>

            {{-- Pendaftaran kader --}}
            <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5 text-center">
                <p class="text-sm text-gray-600 mb-3">
                    Tertarik menjadi kader TBC di komunitas Anda?
                </p>
                <a href="{{ route('kader.form') }}"
                    class="inline-block text-sm font-medium text-red-700 border border-red-700 rounded-xl px-4 py-2 hover:bg-red-700 hover:text-white transition">
                    Daftar Jadi Kader
                </a>
            </div>

        </aside>
    </div>
</div>

{{-- ======================================================
LIGHTBOX (Dokumentasi)
====================================================== --}}
<div id="lightbox" class="fixed inset-0 bg-black/80 z-50 hidden items-center justify-center p-4"
    onclick="closeLightbox()">
    <div class="max-w-3xl w-full" onclick="event.stopPropagation()">
        <img id="lightbox-img" src="" alt="" class="w-full rounded-xl max-h-[80vh] object-contain">
        <p id="lightbox-caption" class="text-white text-sm text-center mt-3"></p>
        <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-2xl">&times;</button>
    </div>
</div>

@push('scripts')
    <script>
        function openLightbox(url, caption) {
            document.getElementById('lightbox-img').src = url;
            document.getElementById('lightbox-caption').textContent = caption || '';
            document.getElementById('lightbox').classList.remove('hidden');
            document.getElementById('lightbox').classList.add('flex');
        }
        function closeLightbox() {
            document.getElementById('lightbox').classList.add('hidden');
            document.getElementById('lightbox').classList.remove('flex');
        }
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
    </script>
@endpush

@endsection