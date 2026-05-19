<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Klinik;
use App\Support\StpiData;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Laporan;

class PageController extends Controller
{
    // =========================================================================
    // Semua method lama tetap sama persis — hanya tambah artikelDetail() di bawah
    // =========================================================================

    public function home()
    {
        return view('pages.home', [
            'pageTitle' => 'Home',
            'homeCards' => StpiData::homeCards(),
            'impactData' => StpiData::impactData(),
            'articles' => $this->getHomeArticles(),
        ]);
    }

    public function tentangKami()
    {
        return view('pages.tentang-kami', [
            'pageTitle' => 'Tentang Kami',
            'stats' => StpiData::tentangStats(),
            'members' => StpiData::dewanRingkas(),
            'historyPhotos' => StpiData::historyPhotos(),
        ]);
    }

    public function visiMisi()
    {
        return view('pages.visi-misi', [
            'pageTitle' => 'Visi & Misi',
            'tujuanCards' => StpiData::tujuanCards(),
        ]);
    }

    public function sejarah()
    {
        return view('pages.sejarah', [
            'pageTitle' => 'Sejarah',
            'timeline' => StpiData::timeline(),
        ]);
    }

    public function dewanEksekutif(Request $request)
    {
        $tabs = StpiData::dewanTabs();
        $activeTab = $request->query('tab', $tabs[0]);

        if (!in_array($activeTab, $tabs, true)) {
            $activeTab = $tabs[0];
        }

        $members = array_values(array_filter(
            StpiData::dewanMembers(),
            fn($m) => $m['category'] === $activeTab
        ));

        return view('pages.dewan-eksekutif', [
            'pageTitle' => 'Dewan & Eksekutif',
            'tabs' => $tabs,
            'activeTab' => $activeTab,
            'members' => $members,
        ]);
    }

    public function programKomunitas()
    {
        return view('pages.program-komunitas', [
            'pageTitle' => 'Program Komunitas',
            'stats' => StpiData::komunitasStats(),
            'pilars' => StpiData::komunitasPilars(),
            'stories' => StpiData::komunitasStories(),
            'faqs' => StpiData::komunitasFaqs(),
            'mitra' => StpiData::komunitasMitra(),
        ]);
    }

    public function programKlinik()
    {
        $klinik = $this->getKlinikData();
        $stats = [
            'total' => count($klinik),
            'provinsi' => count(array_unique(array_column($klinik, 'provinsi'))),
            'kota' => count(array_unique(array_column($klinik, 'kota'))),
        ];
        return view('pages.program-klinik', compact('klinik', 'stats'));
    }

    public function klinikTerdekat()
    {
        $klinik = $this->getKlinikData(true);
        return view('pages.klinik-terdekat', compact('klinik'));
    }

    private function getKlinikData(bool $onlyWithCoordinate = false): array
    {
        try {
            $query = Klinik::where('status', 'aktif')->orderBy('nama');

            if ($onlyWithCoordinate) {
                $query->whereNotNull('lat')->whereNotNull('lng');
            }

            $data = $query->get()
                ->map(function (Klinik $klinik) {
                    return [
                        'id' => $klinik->id,
                        'nama' => $klinik->nama,
                        'tipe' => $klinik->tipe ?? 'Klinik',
                        'kota' => $klinik->kota ?? '-',
                        'provinsi' => $klinik->provinsi ?? '-',
                        'alamat' => $klinik->alamat,
                        'telepon' => $klinik->telepon ?? '-',
                        'lat' => $klinik->lat,
                        'lng' => $klinik->lng,
                        'jam_buka' => $klinik->jam_buka ?? '08:00',
                        'jam_tutup' => $klinik->jam_tutup ?? '16:00',
                        'hari_buka' => $klinik->hari_buka ?? 'Senin – Jumat',
                        'layanan' => $klinik->layanan ?: ['Diagnosis TBC', 'Pengobatan OAT'],
                    ];
                })
                ->filter(function ($k) use ($onlyWithCoordinate) {
                    if (empty($k['nama'])) {
                        return false;
                    }

                    if ($onlyWithCoordinate) {
                        return is_numeric($k['lat']) && is_numeric($k['lng']);
                    }

                    return true;
                })
                ->values()
                ->toArray();

            if (!empty($data)) {
                return $data;
            }
        } catch (\Throwable $e) {
            // Fallback ke JSON ketika tabel klinik belum dimigrate.
        }

        $path = public_path('data/klinik.json');

        if (!file_exists($path)) {
            return [];
        }

        $data = json_decode(file_get_contents($path), true);

        if (!is_array($data)) {
            return [];
        }

        return array_values(array_filter($data, function ($k) use ($onlyWithCoordinate) {
            if (empty($k['nama'])) {
                return false;
            }

            if ($onlyWithCoordinate) {
                return isset($k['lat'], $k['lng']) && is_numeric($k['lat']) && is_numeric($k['lng']);
            }

            return true;
        }));
    }

    public function karir(Request $request)
    {
        return view('pages.karir', [
            'pageTitle' => 'Karir',
            'reasons' => StpiData::careerReasons(),
            'jobsPage' => $this->paginateArray(StpiData::jobs(), $request, 6, 'page'),
        ]);
    }

    public function karirDetail(?int $id = 1)
    {
        $job = collect(StpiData::jobs())->firstWhere('id', $id);
        if (!$job)
            abort(404);

        $job['metas'] = [
            $job['type'],
            'Permanent Contract',
            $job['location'] === 'Jakarta' ? 'Hybrid' : $job['location'],
        ];

        return view('pages.karir-detail', [
            'pageTitle' => $job['title'],
            'job' => $job,
        ]);
    }

    public function akuntabilitas(Request $request)
    {
        $documents = Laporan::where('status', 'tayang')
            ->latest()
            ->get()
            ->map(function ($laporan) {
                return [
                    'nama' => $laporan->nama,
                    'tanggal' => \Carbon\Carbon::parse($laporan->tanggal)->translatedFormat('d F Y'),
                    'link' => asset('storage/' . $laporan->file),
                ];
            })
            ->toArray();

        return view('pages.akuntabilitas', [
            'pageTitle' => 'Akuntabilitas',
            'laporanPage' => $this->paginateArray($documents, $request, 12, 'laporan_page'),
            'dokumenPage' => $this->paginateArray($documents, $request, 12, 'dokumen_page'),
        ]);
    }

    public function berita(Request $request)
    {
        $all = $this->getAllPublicArticles();

        return view('pages.berita', [
            'pageTitle' => 'Berita & Kegiatan',
            'beritaPage' => $this->paginateArray($all, $request, 6, 'page'),
        ]);
    }

    public function beritaDetail(string $slug)
    {
        return $this->showPublicArticle($slug, 'berita');
    }

    public function artikelDetail(string $slug)
    {
        return $this->showPublicArticle($slug, 'artikel');
    }

    private function showPublicArticle(string $slug, string $source = 'artikel')
    {
        $semua = $this->getAllPublicArticles();
        $artikel = collect($semua)->firstWhere('slug', $slug);

        if (!$artikel) {
            abort(404);
        }

        $related = collect($semua)
            ->where('slug', '!=', $artikel['slug'])
            ->take(3)
            ->values()
            ->toArray();

        $backUrl = route('berita');
        $backLabel = 'Kembali ke Berita & Kegiatan';

        return view('pages.artikel-detail', [
            'pageTitle' => $artikel['title'],
            'artikel' => $artikel,
            'related' => $related,
            'backUrl' => $backUrl,
            'backLabel' => $backLabel,
        ]);
    }

    private function getHomeArticles(): array
    {
        $artikelDb = $this->getDatabaseArticles()->take(3)->values()->toArray();

        if (!empty($artikelDb)) {
            return $artikelDb;
        }

        return StpiData::articles();
    }

    private function getAllPublicArticles(): array
    {
        $artikelDb = $this->getDatabaseArticles()->values()->toArray();
        $artikelStatic = StpiData::allArtikel();

        return array_values(array_merge($artikelDb, $artikelStatic));
    }

    private function getDatabaseArticles()
    {
        try {
            return Artikel::where('status', 'tayang')
                ->latest('tanggal')
                ->get()
                ->map(fn (Artikel $artikel) => $this->mapArtikelForPublic($artikel));
        } catch (\Throwable $e) {
            return collect();
        }
    }

    private function mapArtikelForPublic(Artikel $artikel): array
    {
        $paragraphs = collect(preg_split('/\n\s*\n/', trim($artikel->isi)))
            ->filter()
            ->map(fn ($text) => [
                'type' => 'paragraph',
                'text' => trim($text),
            ])
            ->values()
            ->toArray();

        if (empty($paragraphs)) {
            $paragraphs = [[
                'type' => 'paragraph',
                'text' => $artikel->isi,
            ]];
        }

        $slug = Str::slug($artikel->judul) . '-' . $artikel->id;

        return [
            'id' => $artikel->id,
            'title' => $artikel->judul,
            'slug' => $slug,
            'category' => $artikel->kategori,
            'author' => $artikel->penulis,
            'date' => optional($artikel->tanggal)->format('d M Y') ?? '-',
            'excerpt' => Str::limit(strip_tags($artikel->isi), 140),
            'img' => 'assets/image/news-1.png',
            'content' => $paragraphs,
            'tags' => [$artikel->kategori],
            'source' => 'berita',
            'related' => [],
            'link' => route('artikel.show', $slug),
        ];
    }

    public function searchApi(Request $request): \Illuminate\Http\JsonResponse
    {
        $q = trim(strtolower($request->query('q', '')));
        $type = $request->query('type', 'all');

        if (strlen($q) < 2) {
            return response()->json(['results' => [], 'total' => 0]);
        }

        $results = [];

        if (in_array($type, ['all', 'klinik'])) {
            foreach ($this->getKlinikData() as $k) {
                $haystack = strtolower(($k['nama'] ?? '') . ' ' . ($k['kota'] ?? '') . ' ' . ($k['provinsi'] ?? ''));
                if (str_contains($haystack, $q)) {
                    $now = now()->format('H:i');
                    $isOpen = isset($k['jam_buka'], $k['jam_tutup']) && $now >= $k['jam_buka'] && $now <= $k['jam_tutup'];
                    $results[] = [
                        'type' => 'klinik',
                        'type_label' => $k['tipe'],
                        'id' => $k['id'],
                        'nama' => $k['nama'],
                        'kota' => $k['kota'] . ', ' . $k['provinsi'],
                        'alamat' => $k['alamat'],
                        'status' => $isOpen ? 'Buka' : 'Tutup',
                        'status_open' => $isOpen,
                        'layanan' => array_slice($k['layanan'] ?? [], 0, 2),
                        'url' => route('program-klinik') . '?q=' . urlencode($k['nama']),
                    ];
                }
            }
        }

        if (in_array($type, ['all', 'mitra'])) {
            foreach (StpiData::komunitasMitra() as $m) {
                if (str_contains(strtolower($m['name']), $q)) {
                    $results[] = [
                        'type' => 'mitra',
                        'type_label' => 'Mitra',
                        'nama' => $m['name'],
                        'kota' => 'Mitra Program Komunitas',
                        'url' => route('program-komunitas'),
                    ];
                }
            }
        }

        return response()->json([
            'results' => array_slice($results, 0, 8),
            'total' => count($results),
            'query' => $q,
        ]);
    }

    public function searchPage(Request $request)
    {
        $q = trim($request->query('q', ''));
        $type = $request->query('type', 'all');
        $klinikResults = [];
        $mitraResults = [];

        if (strlen($q) >= 2) {
            $qLow = strtolower($q);
            if (in_array($type, ['all', 'klinik'])) {
                foreach ($this->getKlinikData() as $k) {
                    $haystack = strtolower(($k['nama'] ?? '') . ' ' . ($k['kota'] ?? '') . ' ' . ($k['provinsi'] ?? ''));
                    if (str_contains($haystack, $qLow)) {
                        $now = now()->format('H:i');
                        $klinikResults[] = array_merge($k, [
                            'is_open' => isset($k['jam_buka'], $k['jam_tutup']) && $now >= $k['jam_buka'] && $now <= $k['jam_tutup'],
                        ]);
                    }
                }
            }
            if (in_array($type, ['all', 'mitra'])) {
                foreach (StpiData::komunitasMitra() as $m) {
                    if (str_contains(strtolower($m['name']), $qLow))
                        $mitraResults[] = $m;
                }
            }
        }

        $totalResults = count($klinikResults) + count($mitraResults);

        return view('pages.search-results', compact(
            'q',
            'type',
            'klinikResults',
            'mitraResults',
            'totalResults'
        ));
    }
    public function daftarKader()
    {
        return view('pages.daftar-kader', [
            'pageTitle' => 'Daftar Jadi Kader',
        ]);
    }

    public function daftarKaderSubmit(Request $request)
    {
        // Validasi semua field form
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'nik' => 'required|digits:16',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp' => 'required|string|min:10|max:15',
            'email' => 'required|email|max:150',
            'alamat' => 'required|string|max:300',
            'provinsi' => 'required|string|max:100',
            'kab_kota' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'pekerjaan' => 'required|string|max:100',
            'pendidikan' => 'required|in:SD,SMP,SMA,D3,S1,S2,S3',
            'motivasi' => 'required|string|max:1000',
            'pengalaman_tb' => 'required|in:penyintas,keluarga,relawan,belum',
            'ketersediaan' => 'required|in:penuh,paruh,akhir_pekan',
            'setuju' => 'required|accepted',
        ], [
            // Pesan error dalam Bahasa Indonesia
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus 16 digit angka.',
            'tanggal_lahir.before' => 'Tanggal lahir tidak valid.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
            'motivasi.required' => 'Mohon tuliskan motivasi Anda.',
            'motivasi.max' => 'Motivasi maksimal 1000 karakter.',
            'setuju.accepted' => 'Anda harus menyetujui syarat & ketentuan.',
        ]);

        // Simpan data ke session untuk ditampilkan di halaman sukses
        session([
            'kader_nama' => $validated['nama_lengkap'],
            'kader_email' => $validated['email'],
            'kader_hp' => $validated['no_hp'],
        ]);



        return redirect()->route('kader.sukses');
    }

    public function daftarKaderSukses()
    {
        // Cegah akses langsung tanpa submit form
        if (!session('kader_nama')) {
            return redirect()->route('kader.form');
        }

        return view('pages.kader-sukses', [
            'pageTitle' => 'Pendaftaran Berhasil',
            'nama' => session('kader_nama'),
            'email' => session('kader_email'),
            'hp' => session('kader_hp'),
        ]);
    }

    private function paginateArray(array $items, Request $request, int $perPage, string $param): array
    {
        $total = count($items);
        $totalPages = max(1, (int) ceil($total / $perPage));
        $currentPage = max(1, min((int) $request->query($param, 1), $totalPages));
        $offset = ($currentPage - 1) * $perPage;
        return [
            'items' => array_slice($items, $offset, $perPage),
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'param' => $param,
        ];
    }
}
