<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Support\StpiData;
use Illuminate\Http\Request;

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
            'articles' => StpiData::articles(),
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
        $klinik = $this->getKlinikData();
        return view('pages.klinik-terdekat', compact('klinik'));
    }

    private function getKlinikData(): array
    {
        $path = public_path('data/klinik.json');
        if (!file_exists($path))
            return [];
        $data = json_decode(file_get_contents($path), true);
        if (!is_array($data))
            return [];
        return array_values(array_filter(
            $data,
            fn($k) =>
            isset($k['nama'], $k['lat'], $k['lng']) && is_numeric($k['lat']) && is_numeric($k['lng'])
        ));
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
        $documents = StpiData::documents();
        return view('pages.akuntabilitas', [
            'pageTitle' => 'Akuntabilitas',
            'laporanPage' => $this->paginateArray($documents, $request, 12, 'laporan_page'),
            'dokumenPage' => $this->paginateArray($documents, $request, 12, 'dokumen_page'),
        ]);
    }

    public function berita(Request $request)
    {
        $all = $this->allPublishedArticles();
        return view('pages.berita', [
            'pageTitle' => 'Berita & Kegiatan',
            'beritaPage' => $this->paginateArray($all, $request, 6, 'page'),
        ]);
    }

    public function beritaDetail(string $slug)
    {
        $article = collect($this->allPublishedArticles())->firstWhere('slug', $slug);
        if (!$article)
            abort(404);
        $related = collect($this->allPublishedArticles())
            ->whereIn('slug', $article['related'] ?? [])
            ->values()->toArray();
        return view('pages.berita-detail', [
            'pageTitle' => $article['title'],
            'article' => $article,
            'related' => $related,
        ]);
    }

    public function artikelDetail(string $identifier)
    {
        $semua = $this->allPublishedArticles();
        $artikel = null;

        if (ctype_digit($identifier)) {
            $articleModel = Artikel::query()
                ->when(!auth()->check(), fn ($query) => $query->where('status', 'tayang'))
                ->find((int) $identifier);

            if ($articleModel) {
                $artikel = $articleModel->toPublicArticleArray();
                $artikel['id'] = $articleModel->id;
            }
        }

        if (!$artikel) {
            $artikel = collect($semua)->firstWhere('slug', $identifier);
        }

        if (!$artikel) {
            abort(404);
        }

        // Artikel terkait berdasarkan daftar slug di field 'related'
        $related = collect($semua)
            ->whereIn('slug', $artikel['related'] ?? [])
            ->values()
            ->toArray();

        // Tentukan URL "Kembali" berdasarkan asal artikel
        $backUrl = match (true) {
            ctype_digit($identifier) && auth()->check() => route('admin.articles.index'),
            ($artikel['source'] ?? 'berita') === 'komunitas' => route('program-komunitas'),
            default => route('berita'),
        };
        $backLabel = match (true) {
            ctype_digit($identifier) && auth()->check() => 'Kembali ke Kelola Artikel',
            ($artikel['source'] ?? 'berita') === 'komunitas' => 'Kembali ke Program Komunitas',
            default => 'Kembali ke Berita & Kegiatan',
        };

        return view('pages.artikel-detail', [
            'pageTitle' => $artikel['title'],
            'artikel' => $artikel,
            'related' => $related,
            'backUrl' => $backUrl,
            'backLabel' => $backLabel,
        ]);
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

    private function allPublishedArticles(): array
    {
        $databaseArticles = Artikel::query()
            ->where('status', 'tayang')
            ->whereNotNull('slug')
            ->latest('tanggal')
            ->get()
            ->map(fn (Artikel $artikel) => $artikel->toPublicArticleArray())
            ->all();

        return array_values(array_merge($databaseArticles, StpiData::allArtikel()));
    }
}
