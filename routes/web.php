<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\KaderController;
use App\Http\Controllers\ArtikelController;

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
Route::get('/berita', [PageController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [PageController::class, 'beritaDetail'])->name('berita.show');
Route::get('/api/search', [PageController::class, 'searchApi'])->name('api.search');
Route::get('/cari', [PageController::class, 'searchPage'])->name('search');
Route::get('/artikel/{slug}', [PageController::class, 'artikelDetail'])->name('artikel.show');
Route::get('/daftar-kader', [PageController::class, 'daftarKader'])->name('kader.form');
Route::post('/daftar-kader', [PageController::class, 'daftarKaderSubmit'])->name('kader.submit');
Route::get('/daftar-kader/sukses', [PageController::class, 'daftarKaderSukses'])->name('kader.sukses');

Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('kader', KaderController::class);
    Route::resource('artikel', ArtikelController::class);
});