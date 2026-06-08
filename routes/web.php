<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\KaderRegistrationController;
use App\Http\Controllers\KaderPasswordController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\KlinikController;
use App\Http\Controllers\Admin\KaderController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\KegiatanSosialController;
use App\Http\Controllers\Admin\KegiatanSosialController as AdminKegiatanSosialController;
use App\Http\Controllers\Kader\AuthController as KaderAuthController;
use App\Http\Controllers\Kader\DashboardController as KaderDashboardController;
use App\Http\Controllers\Kader\ScreeningController as KaderScreeningController;
use App\Http\Controllers\Kader\RiwayatScreeningController;
use App\Http\Controllers\Kader\RekapSosialisasiController;
use App\Http\Controllers\Admin\ReportController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.submit');

    Route::middleware(['role:super_admin'])->group(function () {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/kaders', [KaderController::class, 'index'])->name('kaders.index');
        Route::get('/kaders/{kader}', [KaderController::class, 'show'])->name('kaders.show');
        Route::post('/kaders/{kader}/approve', [KaderController::class, 'approve'])->name('kaders.approve');
        Route::post('/kaders/{kader}/reject', [KaderController::class, 'reject'])->name('kaders.reject');

        Route::get('/kliniks', [KlinikController::class, 'index'])->name('kliniks.index');
        Route::get('/kliniks/imports', [KlinikController::class, 'importHistory'])->name('kliniks.imports');
        Route::get('/kliniks/{klinik}', [KlinikController::class, 'show'])->name('kliniks.show');
        Route::post('/kliniks', [KlinikController::class, 'store'])->name('kliniks.store');
        Route::put('/kliniks/{klinik}', [KlinikController::class, 'update'])->name('kliniks.update');
        Route::delete('/kliniks/{klinik}', [KlinikController::class, 'destroy'])->name('kliniks.destroy');
        Route::post('/kliniks/import/preview', [KlinikController::class, 'previewImport'])->name('kliniks.import.preview');
        Route::post('/kliniks/import/commit', [KlinikController::class, 'commitImport'])->name('kliniks.import.commit');

        Route::get('/articles', [ArtikelController::class, 'index'])->name('articles.index');
        Route::post('/articles', [ArtikelController::class, 'store'])->name('articles.store');
        Route::put('/articles/{artikel}', [ArtikelController::class, 'update'])->name('articles.update');
        Route::delete('/articles/{artikel}', [ArtikelController::class, 'destroy'])->name('articles.destroy');

        Route::get('/kegiatan-sosial', [AdminKegiatanSosialController::class, 'index'])->name('kegiatan-sosial.index');
        Route::get('/kegiatan-sosial/create', [AdminKegiatanSosialController::class, 'create'])->name('kegiatan-sosial.create');
        Route::post('/kegiatan-sosial', [AdminKegiatanSosialController::class, 'store'])->name('kegiatan-sosial.store');
        Route::get('/kegiatan-sosial/{kegiatan}', [AdminKegiatanSosialController::class, 'show'])->name('kegiatan-sosial.show');
        Route::get('/kegiatan-sosial/{kegiatan}/edit', [AdminKegiatanSosialController::class, 'edit'])->name('kegiatan-sosial.edit');
        Route::put('/kegiatan-sosial/{kegiatan}', [AdminKegiatanSosialController::class, 'update'])->name('kegiatan-sosial.update');
        Route::delete('/kegiatan-sosial/{kegiatan}', [AdminKegiatanSosialController::class, 'destroy'])->name('kegiatan-sosial.destroy');
        Route::patch('/kegiatan-sosial/{kegiatan}/status', [AdminKegiatanSosialController::class, 'updateStatus'])->name('kegiatan-sosial.update-status');

        Route::post('/kegiatan-sosial/{kegiatan}/ringkasan', [AdminKegiatanSosialController::class, 'simpanRingkasan'])->name('kegiatan-sosial.ringkasan');
        Route::post('/kegiatan-sosial/{kegiatan}/dokumentasi', [AdminKegiatanSosialController::class, 'uploadDokumentasi'])->name('kegiatan-sosial.upload-dokumentasi');
        Route::delete('/kegiatan-sosial/dokumentasi/{dokumentasi}', [AdminKegiatanSosialController::class, 'deleteDokumentasi'])->name('kegiatan-sosial.delete-dokumentasi');

        Route::get('/reports', [ReportController::class, 'overview'])
            ->name('reports.overview');

        Route::get('/reports/export', [ReportController::class, 'exportOverview'])
            ->name('reports.overview.export');

        Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    });
});

/*
|--------------------------------------------------------------------------
| Kader Web Dashboard Routes
|--------------------------------------------------------------------------
*/

Route::prefix('kader')->name('kader.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('kader.login');
    })->name('index');

    Route::get('/login', [KaderAuthController::class, 'create'])->name('login');
    Route::post('/login', [KaderAuthController::class, 'store'])->name('login.submit');

    Route::post('/logout', [KaderAuthController::class, 'destroy'])
        ->middleware('role:kader')
        ->name('logout');

    Route::middleware(['role:kader'])->group(function () {
        Route::get('/dashboard', [KaderDashboardController::class, 'index'])->name('dashboard');

        Route::get('/jadwal', [KaderDashboardController::class, 'jadwal'])->name('jadwal.index');
        Route::get('/riwayat-jadwal', [RiwayatScreeningController::class, 'riwayatJadwal'])->name('riwayat-jadwal.index');

        Route::get('/riwayat-screening', [RiwayatScreeningController::class, 'index'])->name('riwayat-screening.index');
        Route::get('/riwayat-screening/{kegiatan}', [RiwayatScreeningController::class, 'show'])->name('riwayat-screening.show');

        Route::get('/kegiatan/{kegiatan}', [KaderDashboardController::class, 'showKegiatan'])->name('kegiatan.show');

        Route::get('/kegiatan/{kegiatan}/screening', [KaderScreeningController::class, 'create'])->name('screening.create');
        Route::post('/kegiatan/{kegiatan}/screening', [KaderScreeningController::class, 'store'])->name('screening.store');

        Route::post('/screening-session/{session}/close', [KaderScreeningController::class, 'closeSession'])->name('screening.close');

        Route::get('/rekap-sosialisasi', [RekapSosialisasiController::class, 'index'])
            ->name('rekap-sosialisasi.index');

        Route::get('/rekap-sosialisasi/{kegiatan}/edit', [RekapSosialisasiController::class, 'edit'])
            ->name('rekap-sosialisasi.edit');

        Route::put('/rekap-sosialisasi/{kegiatan}', [RekapSosialisasiController::class, 'update'])
            ->name('rekap-sosialisasi.update');
    });
});

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang-kami', [PageController::class, 'tentangKami'])->name('about');
Route::get('/visi-misi', [PageController::class, 'visiMisi'])->name('vision');
Route::get('/sejarah', [PageController::class, 'sejarah'])->name('history');
Route::get('/dewan-eksekutif', [PageController::class, 'dewanEksekutif'])->name('board');
Route::get('/karir', [PageController::class, 'karir'])->name('careers');
Route::get('/karir/detail/{id?}', [PageController::class, 'karirDetail'])->name('careers.show');
Route::get('/akuntabilitas', [PageController::class, 'akuntabilitas'])->name('accountability');
Route::get('/program-klinik', [PageController::class, 'programKlinik'])->name('program-klinik');
Route::get('/klinik-terdekat', [PageController::class, 'klinikTerdekat'])->name('klinik-terdekat');
Route::get('/program-komunitas', [PageController::class, 'programKomunitas'])->name('program-komunitas');
Route::prefix('kegiatan-sosial')->name('kegiatan-sosial.')->group(function () {
    Route::get('/', [KegiatanSosialController::class, 'index'])->name('index');
    Route::get('/{slug}', [KegiatanSosialController::class, 'show'])->name('show');
});

Route::get('/berita', [PageController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [PageController::class, 'beritaDetail'])->name('berita.show');
Route::get('/api/search', [PageController::class, 'searchApi'])->name('api.search');
Route::get('/cari', [PageController::class, 'searchPage'])->name('search');
Route::get('/artikel/{slug}', [PageController::class, 'artikelDetail'])->name('artikel.show');

Route::get('/daftar-kader', [KaderRegistrationController::class, 'create'])->name('kader.form');
Route::post('/daftar-kader', [KaderRegistrationController::class, 'store'])->name('kader.submit');
Route::get('/daftar-kader/sukses', [KaderRegistrationController::class, 'success'])->name('kader.sukses');

Route::get('/kader/set-password/{token}', [KaderPasswordController::class, 'edit'])->name('kader.password.edit');
Route::post('/kader/set-password', [KaderPasswordController::class, 'update'])->name('kader.password.update');
Route::get('/kader/password-created', [KaderPasswordController::class, 'created'])->name('kader.password.created');