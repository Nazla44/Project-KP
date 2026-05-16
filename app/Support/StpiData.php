<?php

namespace App\Support;

class StpiData
{

    public static function navItems(): array
    {
        return [
            [
                'label' => 'Tentang Kami',
                'children' => [
                    ['label' => 'Profil STPI', 'href' => '/tentang-kami'],
                    ['label' => 'Visi & Misi', 'href' => '/visi-misi'],
                    ['label' => 'Sejarah', 'href' => '/sejarah'],
                    ['label' => 'Dewan & Eksekutif', 'href' => '/dewan-eksekutif'],
                    ['label' => 'Akuntabilitas', 'href' => '/akuntabilitas'],
                ],
            ],
            [
                'label' => 'Program Kami',
                'children' => [
                    ['label' => 'Program Komunitas', 'href' => '/program-komunitas'],
                    ['label' => 'Program Klinik', 'href' => route('program-klinik')],
                    ['label' => 'Program Advokasi', 'href' => '#'],
                ],
            ],
            [
                'label' => 'Isu TBC',
                'children' => [
                    ['label' => 'Apa Itu TBC', 'href' => '#'],
                    ['label' => 'Pencegahan', 'href' => '#'],
                    ['label' => 'Pengobatan', 'href' => '#'],
                ],
            ],
            [
                'label' => 'Informasi TBC',
                'children' => [
                    ['label' => 'Berita', 'href' => route('berita')],
                    ['label' => 'Publikasi', 'href' => '#'],
                    ['label' => 'FAQ', 'href' => '#'],
                ],
            ],
            [
                'label' => 'TB Akses',
                'children' => [
                    ['label' => 'Mitra', 'href' => '#'],
                    ['label' => 'Kolaborasi', 'href' => '#'],
                ],
            ],
        ];
    }

    public static function homeCards(): array
    {
        return [
            ['title' => 'Satu Kolaborasi, Berjuta Harapan Sehat', 'image' => 'assets/image/hero-card-1.png'],
            ['title' => 'Lindungi Keluarga, Putus Rantai Penularan TBC', 'image' => 'assets/image/hero-card-2.png'],
            ['title' => 'Indonesia Bebas TBC, Mulai Dari Kita.', 'image' => 'assets/image/hero-card-3.png'],
        ];
    }

    public static function impactData(): array
    {
        return [
            ['number' => '158', 'suffix' => '', 'description' => 'Daerah Intervensi', 'img' => 'assets/image/stats-1.png'],
            ['number' => '2,3jt', 'suffix' => '+', 'description' => 'Orang Terjangkau', 'img' => 'assets/image/stats-2.png'],
            ['number' => '104', 'suffix' => '', 'description' => 'Kegiatan Terimplementasi', 'img' => 'assets/image/stats-3.png'],
            ['number' => '18', 'suffix' => '', 'description' => 'Mitra', 'img' => 'assets/image/stats-4.png'],
        ];
    }

    // ── UPDATE: tambah 'slug' agar card bisa di-klik ke detail ───────────────
    public static function articles(): array
    {
        return [
            [
                'slug' => 'penyelamatan-nyawa-desa-kantong-tb',
                'img' => 'assets/image/news-1.png',
                'category' => 'Seputar TBC',
                'date' => '15 Jan 2025',
                'title' => 'Penyelamatan Nyawa di Desa "Kantong TB": X-Ray Di Kaki Gunung, Di Derasnya Hujan',
                'excerpt' => 'Hujan di kaki gunung Bogor sering turun tanpa aba-aba. Jalanan menjadi licin, udara menggigil, dan rumah-rumah berdiri berjauhan mengikuti kontur perbukitan. Namun b...',
            ],
            [
                'slug' => 'rekrutmen-data-inputter-stpi',
                'img' => 'assets/image/news-2.png',
                'category' => 'Karir',
                'date' => '10 Feb 2025',
                'title' => 'Rekrutmen Data Inputter Life-saving Facility and Community-based Service Delivery',
                'excerpt' => 'Wilayah kerja Data Inputter dapat meliputi satu atau lebih Puskesmas dan akan bertanggung jawab kepada Koordinator Distrik, selain itu koordinasi dengan Wasor T...',
            ],
            [
                'slug' => 'kemenkes-bedah-1000-rumah-pasien-tb',
                'img' => 'assets/image/news-1.png',
                'category' => 'Seputar TBC',
                'date' => '24 Mar 2025',
                'title' => 'Kemenkes Usulkan Program Bedah 1.000 Rumah Pasien TB',
                'excerpt' => 'Pemerintah berencana melakukan perbaikan terhadap 1.000 rumah milik pasien tuberkulosis (TB) dari kalangan Masyarakat Berpenghasilan Rendah (MBR). Program ini...',
            ],
        ];
    }

    // ── UPDATE: 'link' pakai route(), tambah 'slug' ───────────────────────────
    public static function komunitasStories(): array
    {
        return [
            [
                'slug' => 'kader-bogor-menembus-hujan',
                'image' => 'assets/Home/news-1.png',
                'tag' => 'Kisah Kader',
                'location' => 'Bogor, Jawa Barat',
                'title' => 'Mendaki Lereng Gunung Demi Satu Pasien yang Hampir Menyerah',
                'excerpt' => 'Di desa-desa terpencil kaki gunung Bogor, kader komunitas STPI rela menembus hujan dan jalanan berlumpur untuk memastikan pasien TBC tak putus pengobatan.',
                'link' => route('artikel.show', 'kader-bogor-menembus-hujan'),
            ],
            [
                'slug' => 'kisah-budi-pasien-tbc-ro',
                'image' => 'assets/Home/news-2.png',
                'tag' => 'Testimoni Pasien',
                'location' => 'Surabaya, Jawa Timur',
                'title' => '"Dulu Aku Malu Punya TBC. Sekarang Aku Jadi Kadernya"',
                'excerpt' => 'Budi, mantan pasien TBC-RO, kini menjadi Patient Supporter aktif yang mendampingi puluhan pasien baru di wilayahnya setiap bulan.',
                'link' => route('artikel.show', 'kisah-budi-pasien-tbc-ro'),
            ],
            [
                'slug' => 'investigasi-kontak-6-kasus-makassar',
                'image' => 'assets/Home/news-3.png',
                'tag' => 'Dampak Program',
                'location' => 'Makassar, Sulawesi Selatan',
                'title' => 'Dari 1 Keluarga, Ditemukan 6 Kasus TBC Baru di RT yang Sama',
                'excerpt' => 'Investigasi kontak yang dilakukan kader komunitas berhasil mengungkap klaster penularan TBC yang selama ini tidak terdeteksi di sebuah permukiman padat.',
                'link' => route('artikel.show', 'investigasi-kontak-6-kasus-makassar'),
            ],
        ];
    }

    // =========================================================================
    // BARU: allArtikel()
    // Satu sumber data untuk SEMUA artikel dari semua halaman.
    // Field wajib: slug, img, category, date, author, title, excerpt,
    //              content (array blok), tags, related, source
    //
    // source: 'komunitas' = dari Program Komunitas
    //         'berita'    = dari Beranda / Berita umum
    //
    // Tipe blok content:
    //   paragraph → { type: 'paragraph', text: '...' }
    //   heading   → { type: 'heading',   text: '...' }
    //   quote     → { type: 'quote',     text: '...', author: '...' }
    //   list      → { type: 'list',      items: [...] }
    // =========================================================================
    public static function allArtikel(): array
    {
        return [

            // ─────────────────────────────────────────────────
            // ARTIKEL 1 — Kisah Kader (source: komunitas)
            // ─────────────────────────────────────────────────
            [
                'slug' => 'kader-bogor-menembus-hujan',
                'img' => 'assets/image/news-1.png',
                'category' => 'Kisah Kader',
                'date' => '15 Januari 2025',
                'author' => 'Tim Lapangan STPI',
                'source' => 'komunitas',
                'title' => 'Mendaki Lereng Gunung Demi Satu Pasien yang Hampir Menyerah',
                'excerpt' => 'Di desa-desa terpencil kaki gunung Bogor, kader komunitas STPI rela menembus hujan dan jalanan berlumpur untuk memastikan pasien TBC tak putus pengobatan.',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'text' => 'Hujan di kaki gunung Bogor sering turun tanpa aba-aba. Jalanan menjadi licin, udara menggigil, dan rumah-rumah berdiri berjauhan mengikuti kontur perbukitan. Namun bagi Ibu Sari, kader komunitas STPI di Kecamatan Cisarua, cuaca bukan alasan untuk melewatkan kunjungan rutin ke pasien binaannya.',
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => '"Pak Asep sudah tiga hari tidak minum obat. Katanya pusing, katanya mual. Tapi saya tahu itu bukan alasan sesungguhnya — dia hampir menyerah," cerita Ibu Sari. Hari itu, ia mendaki lereng selama 40 menit untuk sampai ke rumah Pak Asep yang berada di ketinggian 1.200 mdpl.',
                    ],
                    [
                        'type' => 'heading',
                        'text' => 'Kunjungan yang Menyelamatkan',
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => 'Ketika tiba, Ibu Sari tidak langsung bicara soal obat. Ia duduk, minum teh, dan mendengarkan keluhan Pak Asep tentang rasa lelah dan malu yang ia rasakan selama sakit. Baru setelah satu jam berbincang, ia mengajak Pak Asep minum obat bersama.',
                    ],
                    [
                        'type' => 'quote',
                        'text' => 'Pasien TBC tidak butuh ceramah. Mereka butuh teman yang mau duduk dan mendengarkan. Obat bisa diberikan kapan saja, tapi kepercayaan dibangun pelan-pelan.',
                        'author' => 'Ibu Sari, Kader Komunitas STPI — Cisarua, Bogor',
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => 'Pak Asep akhirnya melanjutkan pengobatannya hingga tuntas. Delapan bulan kemudian, ia dinyatakan sembuh oleh dokter di puskesmas terdekat. Kini, Pak Asep sendiri menjadi relawan yang membantu Ibu Sari menjangkau pasien lain di wilayah yang sama.',
                    ],
                    [
                        'type' => 'heading',
                        'text' => 'Ribuan Kader Seperti Ibu Sari di Seluruh Indonesia',
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => 'Kisah Ibu Sari bukan pengecualian. Di 30 provinsi dan 190+ kabupaten/kota, lebih dari 5.000 kader seperti Ibu Sari melakukan hal yang sama setiap hari — mendatangi pasien yang hampir menyerah, memastikan pengobatan tidak terputus, dan membuktikan bahwa TBC bisa disembuhkan.',
                    ],
                    [
                        'type' => 'list',
                        'items' => [
                            'Rata-rata setiap kader mendampingi 5–10 pasien aktif sekaligus',
                            'Kunjungan rutin dilakukan minimal 3x seminggu per pasien',
                            'Tingkat keberhasilan pengobatan pasien yang didampingi kader: 89%',
                            'Program kader aktif di 190+ kabupaten/kota Indonesia',
                        ],
                    ],
                ],
                'tags' => ['Kader Komunitas', 'Kisah Nyata', 'Bogor', 'Patient Supporter'],
                'related' => ['kisah-budi-pasien-tbc-ro', 'investigasi-kontak-6-kasus-makassar'],
            ],

            // ─────────────────────────────────────────────────
            // ARTIKEL 2 — Testimoni Pasien (source: komunitas)
            // ─────────────────────────────────────────────────
            [
                'slug' => 'kisah-budi-pasien-tbc-ro',
                'img' => 'assets/image/news-2.png',
                'category' => 'Testimoni Pasien',
                'date' => '10 Februari 2025',
                'author' => 'Tim Komunikasi STPI',
                'source' => 'komunitas',
                'title' => '"Dulu Aku Malu Punya TBC. Sekarang Aku Jadi Kadernya"',
                'excerpt' => 'Budi, mantan pasien TBC-RO, kini menjadi Patient Supporter aktif yang mendampingi puluhan pasien baru di wilayahnya setiap bulan.',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'text' => 'Dua tahun lalu, Budi (32) hampir menyembunyikan diagnosisnya dari keluarga. TBC Resisten Obat — tiga kata yang terasa seperti hukuman. "Saya pikir hidup saya selesai. Saya takut dikucilkan, takut tidak bisa bekerja lagi," ujarnya pelan.',
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => 'Budi didiagnosis TBC-RO di Puskesmas Tambaksari, Surabaya pada Maret 2023. Pengobatan TBC-RO berlangsung 18–24 bulan, dengan efek samping yang jauh lebih berat dibanding TBC biasa. Mual, pusing, dan gangguan pendengaran menjadi teman sehari-harinya.',
                    ],
                    [
                        'type' => 'heading',
                        'text' => 'Titik Balik: Seorang Kader yang Tidak Menyerah',
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => 'Bulan ketiga pengobatan, Budi sempat berhenti minum obat selama dua minggu. Ia merasa lelah dan tidak yakin pengobatan ini akan berhasil. Sampai datang seorang perempuan bernama Mbak Ratna — kader Patient Supporter dari program komunitas STPI.',
                    ],
                    [
                        'type' => 'quote',
                        'text' => 'Mbak Ratna tidak menggurui saya. Dia cerita bahwa suaminya juga pernah TBC dan sembuh. Dia duduk di sini, ngobrol biasa. Dan entah kenapa, setelah dia pergi, saya langsung minum obat lagi.',
                        'author' => 'Budi, Penyintas TBC-RO & Kader Komunitas — Surabaya',
                    ],
                    [
                        'type' => 'heading',
                        'text' => 'Sembuh, Lalu Memilih Kembali',
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => 'Oktober 2024, Budi dinyatakan sembuh. Dokter menyebutnya "kesembuhan yang luar biasa" mengingat sempat ada periode mangkir. Tiga bulan setelah dinyatakan negatif, Budi mendaftar sebagai kader Patient Supporter.',
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => 'Kini setiap Selasa dan Kamis, Budi mengunjungi delapan pasien TBC-RO di wilayah Tambaksari. Ia membawa obat, membawa cerita, dan yang paling penting — membawa bukti nyata bahwa TBC bisa dikalahkan.',
                    ],
                    [
                        'type' => 'list',
                        'items' => [
                            'TBC-RO memerlukan pengobatan 18–24 bulan (lebih panjang dari TBC biasa)',
                            'Tingkat keberhasilan pengobatan TBC-RO meningkat dengan dukungan kader',
                            'Penyintas TBC adalah kader paling efektif — memiliki empati dari pengalaman langsung',
                            'Program komunitas STPI merekrut dan melatih penyintas sebagai Patient Supporter',
                        ],
                    ],
                ],
                'tags' => ['Testimoni Pasien', 'TBC-RO', 'Penyintas', 'Surabaya', 'Kader Komunitas'],
                'related' => ['kader-bogor-menembus-hujan', 'investigasi-kontak-6-kasus-makassar'],
            ],

            // ─────────────────────────────────────────────────
            // ARTIKEL 3 — Dampak Program (source: komunitas)
            // ─────────────────────────────────────────────────
            [
                'slug' => 'investigasi-kontak-6-kasus-makassar',
                'img' => 'assets/image/news-1.png',
                'category' => 'Dampak Program',
                'date' => '5 Maret 2025',
                'author' => 'Tim Program STPI',
                'source' => 'komunitas',
                'title' => 'Dari 1 Keluarga, Ditemukan 6 Kasus TBC Baru di RT yang Sama',
                'excerpt' => 'Investigasi kontak yang dilakukan kader komunitas berhasil mengungkap klaster penularan TBC yang selama ini tidak terdeteksi di sebuah permukiman padat.',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'text' => 'Awal Februari 2025, seorang kader komunitas STPI di Kelurahan Rappokalling, Makassar menerima informasi bahwa satu keluarga di RT 04 memiliki anggota yang baru didiagnosis TBC. Prosedur standar kemudian dijalankan: investigasi kontak serumah dan tetangga terdekat.',
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => 'Hasilnya mengejutkan. Dari 28 orang yang diperiksa dalam radius satu RT, 6 orang dinyatakan positif TBC — termasuk dua anak di bawah usia 12 tahun dan satu ibu hamil. Seluruhnya sebelumnya tidak menyadari bahwa mereka terinfeksi.',
                    ],
                    [
                        'type' => 'heading',
                        'text' => 'Mengapa Investigasi Kontak Sangat Penting?',
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => 'TBC menyebar melalui udara. Satu pasien TBC yang tidak diobati dapat menularkan bakteri kepada 10–15 orang per tahun. Di permukiman padat seperti di Rappokalling, penularan berlangsung diam-diam karena banyak warga tidak menyadari gejala awal TBC.',
                    ],
                    [
                        'type' => 'list',
                        'items' => [
                            'Satu pasien TBC aktif bisa menularkan ke 10–15 orang per tahun',
                            'Gejala awal TBC (batuk, keringat malam, penurunan berat badan) sering diabaikan',
                            'Investigasi kontak serumah berhasil menemukan rata-rata 1,8 kasus baru per indeks kasus',
                            'Biaya pengobatan lebih murah jika terdeteksi sejak dini',
                        ],
                    ],
                    [
                        'type' => 'quote',
                        'text' => 'Kalau kami tidak datang ke RT itu, ke-6 orang tersebut mungkin baru ketahuan setahun kemudian — setelah menularkan ke lebih banyak orang lagi. Investigasi kontak adalah cara tercepat memutus rantai penularan.',
                        'author' => 'Ahmad, Koordinator Kader Komunitas STPI — Makassar',
                    ],
                    [
                        'type' => 'heading',
                        'text' => 'Semua 6 Kasus Kini Dalam Pengobatan',
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => 'Dua minggu setelah ditemukan, seluruh 6 kasus baru tersebut telah memulai pengobatan di Puskesmas Rappokalling. Kader STPI bertugas mendampingi masing-masing pasien dan memastikan keluarga mereka juga mendapat pemeriksaan lanjutan.',
                    ],
                ],
                'tags' => ['Investigasi Kontak', 'Makassar', 'Deteksi Dini', 'Pencegahan TBC'],
                'related' => ['kader-bogor-menembus-hujan', 'kisah-budi-pasien-tbc-ro'],
            ],

            // ─────────────────────────────────────────────────
            // ARTIKEL 4 — Seputar TBC (source: berita)
            // ─────────────────────────────────────────────────
            [
                'slug' => 'penyelamatan-nyawa-desa-kantong-tb',
                'img' => 'assets/image/news-1.png',
                'category' => 'Seputar TBC',
                'date' => '15 Januari 2025',
                'author' => 'Tim Komunikasi STPI',
                'source' => 'berita',
                'title' => 'Penyelamatan Nyawa di Desa "Kantong TB": X-Ray di Kaki Gunung, di Derasnya Hujan',
                'excerpt' => 'Hujan di kaki gunung Bogor sering turun tanpa aba-aba. Jalanan menjadi licin, udara menggigil, dan rumah-rumah berdiri berjauhan mengikuti kontur perbukitan.',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'text' => 'Desa Cihideung Udik di kaki Gunung Salak, Bogor, selama bertahun-tahun dikenal sebagai "kantong TB" — wilayah dengan angka prevalensi TBC jauh di atas rata-rata nasional. Faktor utamanya adalah kepadatan hunian, ventilasi rumah yang buruk, dan minimnya akses layanan kesehatan.',
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => 'Pada November 2024, program komunitas STPI bersama Puskesmas Tamansari menggelar skrining X-Ray massal di balai desa. Tim medis dan kader komunitas berangkat pagi-pagi, membawa peralatan X-Ray portabel melewati jalan berlumpur yang membelah kebun teh.',
                    ],
                    [
                        'type' => 'heading',
                        'text' => 'Hasilnya Mengejutkan',
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => 'Dari 186 warga yang diperiksa, 23 orang menunjukkan gambaran paru-paru yang mencurigakan. Setelah pemeriksaan dahak lanjutan, 14 di antaranya dikonfirmasi positif TBC — angka yang sangat tinggi untuk satu desa kecil.',
                    ],
                    [
                        'type' => 'quote',
                        'text' => 'Mereka tidak tahu mereka sakit. Beberapa sudah batuk berbulan-bulan tapi dianggap "angin-anginan" biasa. Kalau tidak ada skrining ini, mereka akan terus menularkan ke keluarga dan tetangga.',
                        'author' => 'dr. Hendra, Dokter Puskesmas Tamansari',
                    ],
                    [
                        'type' => 'heading',
                        'text' => 'Apa Itu Desa "Kantong TB"?',
                    ],
                    [
                        'type' => 'list',
                        'items' => [
                            'Wilayah dengan angka penemuan kasus TBC lebih dari 2x rata-rata nasional',
                            'Biasanya terjadi di permukiman padat, daerah terpencil, atau kawasan rawan kemiskinan',
                            'Faktor risiko: ventilasi buruk, gizi kurang, akses layanan terbatas',
                            'Program komunitas STPI menargetkan desa-desa kantong TB sebagai prioritas intervensi',
                        ],
                    ],
                ],
                'tags' => ['Skrining TBC', 'Desa Kantong TB', 'Bogor', 'Deteksi Dini'],
                'related' => ['kemenkes-bedah-1000-rumah-pasien-tb', 'investigasi-kontak-6-kasus-makassar'],
            ],

            // ─────────────────────────────────────────────────
            // ARTIKEL 5 — Karir (source: berita)
            // ─────────────────────────────────────────────────
            [
                'slug' => 'rekrutmen-data-inputter-stpi',
                'img' => 'assets/image/news-2.png',
                'category' => 'Karir',
                'date' => '10 Februari 2025',
                'author' => 'Tim HR STPI',
                'source' => 'berita',
                'title' => 'Rekrutmen Data Inputter: Life-saving Facility and Community-based Service Delivery',
                'excerpt' => 'Wilayah kerja Data Inputter dapat meliputi satu atau lebih Puskesmas dan akan bertanggung jawab kepada Koordinator Distrik.',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'text' => 'Stop TB Partnership Indonesia (STPI) membuka rekrutmen untuk posisi Data Inputter dalam program Life-saving Facility and Community-based Service Delivery. Posisi ini merupakan bagian dari upaya memperkuat sistem pencatatan dan pelaporan data TBC di tingkat fasilitas kesehatan dan komunitas.',
                    ],
                    [
                        'type' => 'heading',
                        'text' => 'Deskripsi Pekerjaan',
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => 'Data Inputter bertugas memasukkan, memvalidasi, dan memantau data layanan TBC dari fasilitas kesehatan dan komunitas ke dalam sistem informasi yang telah ditentukan. Wilayah kerja dapat meliputi satu atau lebih Puskesmas sesuai kebutuhan program.',
                    ],
                    [
                        'type' => 'heading',
                        'text' => 'Tanggung Jawab Utama',
                    ],
                    [
                        'type' => 'list',
                        'items' => [
                            'Memasukkan data pasien TBC dari rekam medis ke dalam sistem digital',
                            'Berkoordinasi dengan Wasor TBC Puskesmas dan Koordinator Distrik',
                            'Memastikan akurasi dan kelengkapan data laporan bulanan',
                            'Mendukung monitoring & evaluasi program di tingkat kabupaten/kota',
                        ],
                    ],
                    [
                        'type' => 'heading',
                        'text' => 'Kualifikasi',
                    ],
                    [
                        'type' => 'list',
                        'items' => [
                            'Minimal D3/S1 semua jurusan (diutamakan Kesehatan Masyarakat atau Rekam Medis)',
                            'Mampu mengoperasikan Microsoft Excel dan Google Spreadsheet',
                            'Teliti, detail, dan dapat bekerja dengan tenggat waktu',
                            'Bersedia ditempatkan di wilayah program (di luar Jakarta)',
                        ],
                    ],
                    [
                        'type' => 'quote',
                        'text' => 'Data yang akurat adalah fondasi program TBC yang efektif. Setiap data yang diinput dengan benar membantu kami memastikan tidak ada pasien yang terlewat.',
                        'author' => 'Tim Program STPI',
                    ],
                ],
                'tags' => ['Lowongan Kerja', 'Data Inputter', 'Rekrutmen', 'STPI'],
                'related' => ['penyelamatan-nyawa-desa-kantong-tb', 'kemenkes-bedah-1000-rumah-pasien-tb'],
            ],

            // ─────────────────────────────────────────────────
            // ARTIKEL 6 — Seputar TBC (source: berita)
            // ─────────────────────────────────────────────────
            [
                'slug' => 'kemenkes-bedah-1000-rumah-pasien-tb',
                'img' => 'assets/image/news-1.png',
                'category' => 'Seputar TBC',
                'date' => '24 Maret 2025',
                'author' => 'Tim Komunikasi STPI',
                'source' => 'berita',
                'title' => 'Kemenkes Usulkan Program Bedah 1.000 Rumah Pasien TB',
                'excerpt' => 'Pemerintah berencana melakukan perbaikan terhadap 1.000 rumah milik pasien tuberkulosis (TB) dari kalangan Masyarakat Berpenghasilan Rendah (MBR).',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'text' => 'Kementerian Kesehatan RI mengusulkan program renovasi 1.000 rumah milik pasien Tuberkulosis dari kalangan Masyarakat Berpenghasilan Rendah (MBR) sebagai bagian dari strategi eliminasi TBC 2030. Program ini menyasar faktor risiko lingkungan — salah satu penyebab utama penularan TBC yang sering diabaikan.',
                    ],
                    [
                        'type' => 'heading',
                        'text' => 'Hubungan Rumah Tidak Layak dengan TBC',
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => 'Bakteri Mycobacterium tuberculosis bertahan lebih lama di ruangan yang lembab, gelap, dan tidak berventilasi. Rumah dengan kondisi seperti ini menjadi "inkubator" penularan TBC — bahkan setelah pasien sembuh, risiko infeksi ulang tetap tinggi jika kondisi rumah tidak diperbaiki.',
                    ],
                    [
                        'type' => 'list',
                        'items' => [
                            'Rumah lembab dan gelap meningkatkan risiko TBC hingga 3x lipat',
                            'Ventilasi buruk membuat bakteri TBC bertahan di udara lebih lama',
                            'Kepadatan hunian mempercepat penularan antar anggota keluarga',
                            'Perbaikan ventilasi dan pencahayaan terbukti menurunkan risiko penularan TBC',
                        ],
                    ],
                    [
                        'type' => 'quote',
                        'text' => 'Mengobati pasiennya saja tidak cukup. Kalau kondisi rumahnya tidak diperbaiki, pasien yang sudah sembuh bisa kembali terinfeksi. Program bedah rumah ini adalah investasi jangka panjang untuk eliminasi TBC.',
                        'author' => 'dr. Imran Pambudi, Direktur P2PM Kementerian Kesehatan RI',
                    ],
                    [
                        'type' => 'heading',
                        'text' => 'Mekanisme Program',
                    ],
                    [
                        'type' => 'paragraph',
                        'text' => 'Program bedah 1.000 rumah ini akan dilaksanakan secara bertahap mulai 2025, dengan prioritas di wilayah dengan beban TBC tinggi seperti Papua, Jawa Barat, dan Sulawesi Selatan. Setiap rumah akan mendapat perbaikan ventilasi, pencahayaan alami, dan penanganan kelembaban.',
                    ],
                ],
                'tags' => ['Kebijakan', 'Kemenkes', 'Faktor Risiko TBC', 'Program Pemerintah'],
                'related' => ['penyelamatan-nyawa-desa-kantong-tb', 'investigasi-kontak-6-kasus-makassar'],
            ],

        ];
    }

    // =========================================================================
    // Semua method lain tetap sama persis
    // =========================================================================

    public static function tentangStats(): array
    {
        return [
            ['number' => '158', 'label' => 'Daerah Intervensi', 'image' => 'assets/image/stats-1.png'],
            ['number' => '2,3jt+', 'label' => 'Orang Terjangkau', 'image' => 'assets/image/stats-2.png'],
            ['number' => '104', 'label' => 'Kegiatan Terimplementasi', 'image' => 'assets/image/stats-3.png'],
            ['number' => '18', 'label' => 'Mitra', 'image' => 'assets/image/stats-4.png'],
        ];
    }

    public static function dewanRingkas(): array
    {
        return [
            ['name' => 'Alm. Ir. Arifin Panigoro', 'role' => 'Pendiri STPI', 'photo' => 'assets/image/dewan-arifin.png'],
            ['name' => 'Yaser Raimi Panigoro, MBA', 'role' => 'Ketua Dewan Pembina', 'photo' => 'assets/image/dewan-yaser.png'],
            ['name' => 'Ir. Yani Panigoro M.M', 'role' => 'Dewan Pembina', 'photo' => 'assets/image/dewan-yani.png'],
            ['name' => 'dr. Donald Pardede, MPPM', 'role' => 'Dewan Pengawas', 'photo' => 'assets/image/dewan-donald.png'],
        ];
    }

    public static function dewanTabs(): array
    {
        return ['Pimpinan', 'Duta TBC STPI', 'Pembina', 'Pengawas', 'Penasihat', 'Pengurus', 'Eksekutif', 'Communications', 'HR', 'Finance'];
    }

    public static function dewanMembers(): array
    {
        return [
            ['name' => 'Alm. Ir. Arifin Panigoro', 'role' => 'Pendiri STPI', 'category' => 'Pimpinan', 'photo' => 'assets/image/dewan-arifin.png'],
            ['name' => 'Yaser Raimi Panigoro, MBA', 'role' => 'Ketua Dewan Pembina', 'category' => 'Pimpinan', 'photo' => 'assets/image/dewan-yaser.png'],
            ['name' => 'Ir. Yani Panigoro M.M', 'role' => 'Dewan Pembina', 'category' => 'Pimpinan', 'photo' => 'assets/image/dewan-yani.png'],
            ['name' => 'dr. Donald Pardede, MPPM', 'role' => 'Dewan Pengawas', 'category' => 'Pimpinan', 'photo' => 'assets/image/dewan-donald.png'],
            ['name' => 'Yaser Raimi Panigoro, MBA', 'role' => 'Ketua Dewan Pembina', 'category' => 'Pembina', 'photo' => 'assets/image/dewan-yaser.png'],
            ['name' => 'Ir. Yani Panigoro M.M', 'role' => 'Anggota Pembina', 'category' => 'Pembina', 'photo' => 'assets/image/dewan-yani.png'],
            ['name' => 'dr. Donald Pardede, MPPM', 'role' => 'Dewan Pengawas', 'category' => 'Pengawas', 'photo' => 'assets/image/dewan-donald.png'],
        ];
    }

    public static function historyPhotos(): array
    {
        return [
            'assets/image/history-1.png',
            'assets/image/history-2.png',
            'assets/image/history-3.png',
            'assets/image/history-4.png',
            'assets/image/history-5.png',
        ];
    }

    public static function timeline(): array
    {
        return [
            [
                'year' => '2013',
                'title' => 'Forum Stop TB Partnership',
                'desc' => 'Forum Stop TB Partnership Indonesia (FSTPI) diresmikan oleh Prof. dr. Ali Ghufron Mukti, M.Sc, Ph.D selaku Wakil Menteri Kesehatan RI 2011-2017. FSTPI diusulkan pertama kalinya pada pertemuan Forum Stop TB Partnership se-Asia di Korea Selatan yang kemudian diketuai oleh Alm. Ir. Arifin Panigor',
                'image' => 'assets/image/journey.png',
            ],
            [
                'year' => '2015',
                'title' => 'Forum Stop TB Partnership',
                'desc' => 'Diadakan kembali 2nd Forum of National Stop TB Partnership in South-East Asia, Western Pacific and East Mediterranean Regions tanggal 3-4 Maret di Jakarta. Sepanjang tahun 2014-2016 FSTPI mewadahi koordinasi dan kolaborasi multipihak dan lintas sektor.',
                'image' => 'assets/image/journey.png',
            ],
            [
                'year' => '2018',
                'title' => 'Ekspansi Program',
                'desc' => 'Pada 23 Mei Alm. Ir. Arifin Panigoro FSTPI resmi menjadi Yayasan Kemitraan Strategis Tuberkulosis (STPI) yang bertujuan agar bisa mengelola donor dan melakukan kegiatan yang mendukung eliminasi TBC. STPI juga berkolaborasi dengan pemerintah RI untuk 2 side events UNHLM TB.',
                'image' => 'assets/image/journey.png',
            ],
            [
                'year' => '2020',
                'title' => 'Kemitraan Strategis',
                'desc' => 'STPI membuat Gerakan Bersama Eliminasi TBC 2030 di Cimahi bersama Presiden RI Joko Widodo serta mengajukan diri untuk menjadi PR Konsorsium Penabulu-STPI dalam mengelola dana hibah Global Fund.',
                'image' => 'assets/image/journey.png',
            ],
            [
                'year' => '2022',
                'title' => 'Inovasi Digital',
                'desc' => 'Terminasi pendampingan STPI di Lombok Barat dan Sumenep untuk diberikan kepada pemerintah desa setempat. Selain itu, STPI menjadi co-host pada Side Event Tuberculosis G20 di Yogyakarta.',
                'image' => 'assets/image/journey.png',
            ],
            [
                'year' => '2023',
                'title' => 'Adaptasi Era Pandemi',
                'desc' => 'Advokasi nasional untuk mendukung Public Private Mix (PPM) penanggulangan TBC. Selain itu, STPI bergabung di dalam Konsorsium BEBAS TB. ',
                'image' => 'assets/image/journey.png',
            ],
        ];
    }
    public static function careerReasons(): array
    {
        return [
            ['title' => 'Kontribusi Sosial yang Bermakna', 'desc' => 'Menjadi bagian dari solusi nasional dalam menyelamatkan nyawa dan menciptakan masa depan Indonesia yang lebih sehat serta produktif melalui eliminasi TBC.'],
            ['title' => 'Jejaring Profesional Luas', 'desc' => 'Bekerja dalam lingkungan dinamis yang menghubungkan Anda dengan para pakar kesehatan, instansi pemerintah, dan mitra internasional dalam jaringan global.'],
            ['title' => 'Peluang Pertumbuhan Profesional', 'desc' => 'Dapatkan kesempatan untuk terus berkembang melalui tantangan strategis, inovasi program, dan akses terhadap riset terkini di bidang kesehatan publik.'],
        ];
    }

    public static function jobs(): array
    {
        return [
            ['id' => 1, 'category' => 'Kemitraan & Strategi', 'title' => 'Partnership & Advocacy Officer', 'desc' => 'Membangun dan memelihara hubungan strategis...', 'fullDesc' => 'Bertanggung jawab dalam membangun hubungan strategis lintas sektor.', 'responsibilities' => ['Manajemen Kemitraan', 'Advokasi Kebijakan', 'Representasi Organisasi', 'Mobilisasi Sumber Daya'], 'requirements' => ['S1 Kesehatan Masyarakat / HI', 'Min. 3 tahun pengalaman', 'Komunikasi Bahasa Inggris', 'Jaringan kebijakan kesehatan'], 'type' => 'Full-time', 'location' => 'Jakarta', 'deadline' => '31 Maret 2026'],
            ['id' => 2, 'category' => 'Program & Operasional', 'title' => 'Project Coordinator (Lintas Sektor)', 'desc' => 'Mengelola implementasi program TBC...', 'fullDesc' => 'Mengelola program TBC di berbagai daerah.', 'responsibilities' => ['Manajemen Kemitraan', 'Advokasi Kebijakan', 'Representasi', 'Mobilisasi'], 'requirements' => ['S1 terkait', 'Min. 3 tahun', 'Komunikasi', 'Jaringan'], 'type' => 'Full-time', 'location' => 'Jakarta', 'deadline' => '15 April 2026'],
            ['id' => 3, 'category' => 'Data & Riset', 'title' => 'Monitoring & Evaluation (M&E) Specialist', 'desc' => 'Mengelola sistem pengumpulan data...', 'fullDesc' => 'Mengelola sistem M&E program TBC.', 'responsibilities' => ['Sistem M&E', 'Analisis Data', 'Pelaporan', 'Koordinasi'], 'requirements' => ['S1 Statistik/Kesmas', '3 thn M&E', 'Analitik', 'Software data'], 'type' => 'Full-time', 'location' => 'Jakarta', 'deadline' => '20 April 2026'],
            ['id' => 4, 'category' => 'Komunikasi & Kreatif', 'title' => 'Digital Campaign Strategist', 'desc' => 'Merancang kampanye digital TBC...', 'fullDesc' => 'Kampanye digital untuk penanggulangan TBC.', 'responsibilities' => ['Strategi Konten', 'Sosmed', 'Analisis', 'Kreatif'], 'requirements' => ['S1 Komunikasi', '3 thn digital', 'Portfolio', 'Tools digital'], 'type' => 'Full-time', 'location' => 'Jakarta', 'deadline' => '30 April 2026'],
            ['id' => 5, 'category' => 'Kesehatan Publik', 'title' => 'Technical Officer Layanan Kesehatan', 'desc' => 'Dukungan teknis standar pelayanan TBC...', 'fullDesc' => 'Dukungan teknis layanan TBC berkualitas.', 'responsibilities' => ['Dukungan Faskes', 'Pelatihan', 'Monitoring', 'Koordinasi'], 'requirements' => ['S1/S2 Kesmas', 'Pengalaman TBC', 'Fasilitasi', 'Dinas luar'], 'type' => 'Full-time', 'location' => 'Jakarta / Daerah', 'deadline' => '5 Mei 2026'],
            ['id' => 6, 'category' => 'Administrasi & Keuangan', 'title' => 'Senior Finance & Grant Admin', 'desc' => 'Administrasi keuangan program hibah...', 'fullDesc' => 'Administrasi keuangan dan transparansi dana hibah.', 'responsibilities' => ['Keuangan Grant', 'Pelaporan', 'Compliance', 'Audit'], 'requirements' => ['S1 Akuntansi', '5 thn NGO', 'Grant management', 'Detail oriented'], 'type' => 'Full-time', 'location' => 'Jakarta', 'deadline' => '10 Mei 2026'],
            ['id' => 7, 'category' => 'Program & Operasional', 'title' => 'Community Health Facilitator', 'desc' => 'Fasilitasi program komunitas TBC...', 'fullDesc' => 'Fasilitasi program komunitas akar rumput.', 'responsibilities' => ['Fasilitasi', 'Koordinasi Kader', 'Monitoring', 'Lapangan'], 'requirements' => ['S1 Kesmas', 'Komunitas', 'Komunikasi lokal', 'Dinas daerah'], 'type' => 'Full-time', 'location' => 'Daerah', 'deadline' => '15 Mei 2026'],
            ['id' => 8, 'category' => 'Data & Riset', 'title' => 'Research & Knowledge Management Officer', 'desc' => 'Riset operasional dan manajemen pengetahuan...', 'fullDesc' => 'Riset dan diseminasi pengetahuan.', 'responsibilities' => ['Riset', 'Knowledge Sharing', 'Publikasi', 'Database'], 'requirements' => ['S2 diutamakan', 'Pengalaman riset', 'Menulis ilmiah', 'Bahasa Inggris'], 'type' => 'Full-time', 'location' => 'Jakarta', 'deadline' => '20 Mei 2026'],
            ['id' => 9, 'category' => 'Komunikasi & Kreatif', 'title' => 'Content Creator & Copywriter', 'desc' => 'Konten kreatif awareness TBC...', 'fullDesc' => 'Produksi konten digital TBC.', 'responsibilities' => ['Produksi Konten', 'Copywriting', 'Visual', 'Kolaborasi'], 'requirements' => ['S1 Komunikasi/DKV', 'Portfolio', 'Kreativitas', 'Deadline'], 'type' => 'Full-time', 'location' => 'Jakarta', 'deadline' => '25 Mei 2026'],
        ];
    }

    public static function tujuanCards(): array
    {
        return [
            ['title' => 'Advokasi', 'text' => 'Mendorong pengembangan dan implementasi kebijakan terkait TBC melalui advokasi kepada pemangku kepentingan.', 'image' => 'assets/image/tujuan.png'],
            ['title' => 'Tata Kelola', 'text' => 'Mendorong penguatan tata kelola program TBC lintas sektor.', 'image' => 'assets/image/tujuan.png'],
            ['title' => 'Kesadaran', 'text' => 'Meningkatkan kesadaran masyarakat terhadap TBC untuk mencari layanan kesehatan secara proaktif.', 'image' => 'assets/image/tujuan.png'],
            ['title' => 'Akses', 'text' => 'Mendorong ketersediaan dan akses layanan TBC berkualitas, berbasis hak dan berpusat pada pasien.', 'image' => 'assets/image/tujuan.png'],
            ['title' => 'Mobilisasi', 'text' => 'Meningkatkan mobilisasi dan pemanfaatan sumber daya penanggulangan TBC secara efektif dan efisien.', 'image' => 'assets/image/tujuan.png'],
        ];
    }

    public static function documents(): array
    {
        $docs = [];
        for ($i = 0; $i < 36; $i++) {
            $docs[] = [
                'nama' => 'Laporan Dampak ' . (2025 - intdiv($i, 3)),
                'tanggal' => '20 Januari ' . (2026 - $i),
                'link' => '#',
            ];
        }
        return $docs;
    }

    public static function komunitasStats(): array
    {
        return [
            ['number' => '2,3jt+', 'label' => 'Orang Terjangkau', 'description' => 'Penerima manfaat langsung program komunitas di seluruh Indonesia', 'icon' => 'bi-people-fill'],
            ['number' => '30', 'label' => 'Provinsi', 'description' => 'Wilayah kerja aktif Konsorsium Penabulu-STPI', 'icon' => 'bi-geo-alt-fill'],
            ['number' => '190+', 'label' => 'Kab / Kota', 'description' => 'Kabupaten dan kota dengan program komunitas berjalan', 'icon' => 'bi-pin-map-fill'],
            ['number' => '5.000+', 'label' => 'Kader Terlatih', 'description' => 'Relawan komunitas aktif mendampingi pasien TBC', 'icon' => 'bi-heart-pulse-fill'],
        ];
    }

    public static function komunitasPilars(): array
    {
        return [
            [
                'number' => '01',
                'icon' => 'bi-hospital',
                'title' => 'Klinik Mitra TBC',
                'description' => 'Program ini menjadikan klinik sebagai mitra aktif dalam penanggulangan TBC. Klinik tidak hanya menjadi tempat pasien berobat, tetapi juga menjadi titik edukasi, skrining awal, rujukan, dan pendampingan pasien.',
                'activities' => [
                    'Skrining gejala TBC untuk pasien yang datang ke klinik',
                    'Pembuatan alur rujukan ke puskesmas atau rumah sakit',
                    'Penyediaan poster, leaflet, QR code, dan media edukasi TBC',
                    'Pelatihan tenaga klinik tentang gejala, rujukan, dan anti-stigma',
                    'Kolaborasi klinik dengan kader atau relawan pendamping pasien',
                ],
                'outputs' => [
                    'Jumlah klinik yang menjadi mitra TBC',
                    'Jumlah pasien yang diskrining di klinik',
                    'Jumlah pasien terduga TBC yang dirujuk',
                    'Jumlah tenaga klinik yang mendapatkan pelatihan',
                ],
                'color_class' => 'pilar-red',
            ],
            [
                'number' => '02',
                'icon' => 'bi-diagram-3',
                'title' => 'Program TBC Lintas Sektor',
                'description' => 'Program ini membangun kerja sama antara pemerintah, fasilitas kesehatan, klinik, puskesmas, desa, sekolah, pesantren, kampus, organisasi masyarakat, dan komunitas untuk memperkuat penanggulangan TBC.
                            Pondok Pesantren (ponpes) merupakan salah satu tempat intervensi STPI yang berpotensi menjadi tempat penularan TBC karena interaksi yang cukup intens antar santriwan/i. STPI bersama ponpes membentuk Pesantren Siaga TBC 
                            sebagai pos kesehatan pesantren (poskestren) dengan kader terlatih dalam pengelolaan poskestren dan melakukan skrining gejala TBC yang telah menjangkau 10.033 santri.
                            Selain intervensi di pesantren, STPI berupaya untuk audiensi dengan Pemerintah Daerah Kab. Sumenep dan lintas sektor dalam memperkuat sistem pelayanan kesehatan di daerah.',
                'activities' => [
                    'Pembentukan forum koordinasi TBC lintas sektor',
                    'Kolaborasi antara dinas kesehatan, puskesmas, klinik, dan komunitas',
                    'Penyusunan SOP rujukan dan pendampingan pasien',
                    'Pelaksanaan skrining TBC di wilayah prioritas',
                    'Advokasi kebijakan dan dukungan anggaran lokal',
                ],
                'outputs' => [
                    'Forum lintas sektor terbentuk',
                    'Jumlah mitra yang terlibat',
                    'Jumlah kegiatan skrining komunitas',
                    'Dokumen SOP atau rencana aksi lokal tersedia',
                ],
                'color_class' => 'pilar-orange',
            ],
            [
                'number' => '03',
                'icon' => 'bi-phone',
                'title' => 'Kampanye Digital dan Edukasi Digital',
                'description' => 'Program ini bertujuan meningkatkan kesadaran masyarakat tentang TBC melalui media sosial, chatbot, konten edukasi, fitur cek gejala, dan akses informasi layanan kesehatan.
                                Kegiatan ini diharapkan dapat meningkatkan perilaku mencari layanan kesehatan pada orang dengan gejala TBC.
                                141CekTBC adalah kampanye digital yang bertujuan untuk meningkatkan kepedulian masyarakat agar mengakses layanan kesehatan jika mengalami batuk lebih dari 14 hari. Ingat 141CekTBC, jika 14 hari batuk tak reda? 1 solusi, Cek dokter segera!',
                'activities' => [
                    'Pembuatan konten edukasi TBC untuk Instagram, TikTok, dan YouTube Shorts',
                    'Pengembangan fitur cek gejala TBC di website',
                    'Penyediaan chatbot edukasi dan informasi rujukan layanan',
                    'Pembuatan QR code menuju informasi dan layanan TBC',
                    'Kampanye digital seperti “Batuk 2 Minggu? Segera Cek”',
                ],
                'outputs' => [
                    'Jumlah konten edukasi yang dipublikasikan',
                    'Jumlah jangkauan media sosial',
                    'Jumlah pengguna fitur cek gejala',
                    'Jumlah klik menuju layanan kesehatan',
                ],
                'color_class' => 'pilar-green',
            ],
            [
                'number' => '04',
                'icon' => 'bi-person-heart',
                'title' => 'Pendampingan Pasien TBC',
                'description' => 'Program ini membantu pasien TBC menjalani pengobatan sampai selesai melalui dukungan kader, relawan, keluarga, tenaga kesehatan, dan sistem pengingat pengobatan.',
                'activities' => [
                    'Penugasan kader atau relawan sebagai pendamping pasien',
                    'Reminder minum obat melalui WhatsApp atau SMS',
                    'Follow-up pasien secara berkala',
                    'Edukasi keluarga agar mendukung pasien selama pengobatan',
                    'Navigasi pasien untuk kontrol, pengambilan obat, dan rujukan layanan',
                ],
                'outputs' => [
                    'Jumlah pasien TBC yang didampingi',
                    'Jumlah pasien yang menyelesaikan pengobatan',
                    'Jumlah follow-up atau kunjungan pendampingan',
                    'Penurunan risiko pasien putus obat',
                ],
                'color_class' => 'pilar-blue',
            ],
            [
                'number' => '05',
                'icon' => 'bi-chat-heart',
                'title' => 'Dukungan Psikososial',
                'description' => 'Program ini memberikan dukungan emosional, sosial, dan anti-stigma bagi pasien TBC serta keluarga agar pasien tidak merasa sendiri dan tetap semangat menjalani pengobatan.
                            STPI memanfaatkan intervensi psikososial yang berbasis hak dan berpusat pada orang (people-centered care) untuk mendukung orang terdampak TBC dalam mengatasi keadaan emosi negatif dan kognisi selama perawatan TBC.
                            Program ini dimplementasikan di Kab. Sumenep, Jawa Timur. Program yang didukung oleh "Global Impact" dengan total grant Rp. 1.449.785.000 yang dimplementasikan selama periode November 2021-November 2022.',
                'activities' => [
                    'Pembentukan support group pasien dan penyintas TBC',
                    'Pelatihan penyintas sebagai pendamping sebaya',
                    'Sesi berbagi pengalaman antar pasien',
                    'Edukasi anti-stigma untuk keluarga dan masyarakat',
                    'Rujukan pasien ke bantuan sosial atau layanan psikologis jika diperlukan',
                ],
                'outputs' => [
                    'Jumlah sesi support group',
                    'Jumlah pasien yang mengikuti dukungan psikososial',
                    'Jumlah penyintas yang menjadi pendamping sebaya',
                    'Jumlah materi anti-stigma yang disebarkan',
                ],
                'color_class' => 'pilar-purple',
            ],
            [
                'number' => '06',
                'icon' => 'bi-people',
                'title' => 'Kaderisasi dan Relawan Muda TBC',
                'description' => 'Program ini melibatkan anak muda sebagai relawan, edukator, pembuat konten, penggerak kampanye, dan pendamping komunitas dalam upaya penanggulangan TBC.
                            Caraka TB Institute (CTI) merupakan program promosi dan pencegahan TBC yang melibatkan anak muda usia 18-25 tahun. Mereka adalah 20 pemuda terpilih dari berbagai daerah di seluruh Indonesia (Medan, Sintang, Pekanbaru, Bali, Gowa, Jember, Tangsel, Palu, Mempawah, Malang, Biringkanaya, Bengkulu, Unhas, Padang, Makassar, Kubu Raya, Cirebon, Depok, Aceh). 
                            Kehadiran mereka diharapkan dapat berkontribusi pada penanggulangan Tuberkulosis di negara ini. Namun, sebelum menangani skala yang lebih besar, para peserta Caraka menjalani pelatihan di sebuah desa bernama Oharanesia',
                'activities' => [
                    'Rekrutmen relawan muda dari kampus, sekolah, dan komunitas',
                    'Pelatihan dasar tentang TBC, komunikasi publik, dan anti-stigma',
                    'Pelibatan relawan dalam kampanye digital dan kegiatan lapangan',
                    'Sertifikasi relawan sebagai TB Youth Volunteer atau Sahabat TBC',
                    'Pembentukan jaringan alumni relawan TBC',
                ],
                'outputs' => [
                    'Jumlah relawan muda yang bergabung',
                    'Jumlah relawan yang mengikuti pelatihan',
                    'Jumlah kegiatan edukasi yang dilakukan relawan',
                    'Jumlah masyarakat yang dijangkau',
                ],
                'color_class' => 'pilar-red',
            ],
        ];
    }

    public static function komunitasFaqs(): array
    {
        return [
            ['question' => 'Apa perbedaan Program Komunitas dengan Program Klinik STPI?', 'answer' => 'Program Klinik berfokus pada fasilitas kesehatan sebagai titik layanan. Program Komunitas bergerak langsung ke rumah-rumah warga untuk menemukan pasien yang belum terdeteksi.'],
            ['question' => 'Siapa yang bisa menjadi Kader atau Patient Supporter (PS)?', 'answer' => 'Siapa saja yang peduli bisa mendaftar. Prioritas diberikan kepada penyintas TBC, anggota PKK, dan tokoh masyarakat.'],
            ['question' => 'Di mana saja wilayah kerja Program Komunitas ini?', 'answer' => 'Program beroperasi di 30 provinsi dan 190+ kabupaten/kota Indonesia pada periode 2024-2026.'],
            ['question' => 'Bagaimana cara melaporkan kasus dugaan TBC di komunitas saya?', 'answer' => 'Hubungi puskesmas terdekat atau gunakan fitur Klinik Terdekat di website ini.'],
            ['question' => 'Apakah pengobatan TBC benar-benar gratis?', 'answer' => 'Ya. Seluruh obat TBC tersedia gratis di fasilitas kesehatan pemerintah. Program komunitas STPI membantu pasien mengakses layanan ini.'],
        ];
    }

    public static function komunitasMitra(): array
    {
        return [
            ['name' => 'DWB Indonesia', 'logo' => 'assets/Home/logo-DWB.png'],
            ['name' => 'Habitat for Humanity', 'logo' => 'assets/Home/logo-habitat-for-humanity.png'],
            ['name' => 'Johnson & Johnson', 'logo' => 'assets/Home/logo-johnson.png'],
            ['name' => 'The Nature Conservancy', 'logo' => 'assets/Home/logo-nature-conservancy.png'],
            ['name' => 'Oxfam', 'logo' => 'assets/Home/logo-oxfam.png'],
            ['name' => 'Pfizer', 'logo' => 'assets/Home/logo-pfizer.png'],
            ['name' => 'UNICEF', 'logo' => 'assets/Home/logo-unicef.png'],
            ['name' => 'Toys for Tots', 'logo' => 'assets/Home/logo-toys-for-tots.png'],
        ];
    }
}
