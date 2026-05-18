<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:web')->group(function () {
        Route::get('/login', [LoginController::class, 'create'])->name('login');
        Route::post('/login', [LoginController::class, 'store'])->name('login.submit');
    });

    Route::middleware(['auth:web', 'role:super_admin'])->group(function () {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/articles', [ArtikelController::class, 'index'])->name('articles.index');
        Route::get('/articles/create', [ArtikelController::class, 'create'])->name('articles.create');
        Route::post('/articles', [ArtikelController::class, 'store'])->name('articles.store');
        Route::get('/articles/{artikel}/edit', [ArtikelController::class, 'edit'])->name('articles.edit');
        Route::put('/articles/{artikel}', [ArtikelController::class, 'update'])->name('articles.update');
        Route::delete('/articles/{artikel}', [ArtikelController::class, 'destroy'])->name('articles.destroy');
        Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
    });
});

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
