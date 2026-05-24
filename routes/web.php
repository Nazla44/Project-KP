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

Route::get('/daftar-kader', [KaderRegistrationController::class, 'create'])->name('kader.form');
Route::post('/daftar-kader', [KaderRegistrationController::class, 'store'])->name('kader.submit');
Route::get('/daftar-kader/sukses', [KaderRegistrationController::class, 'success'])->name('kader.sukses');

Route::get('/kader/set-password/{token}', [KaderPasswordController::class, 'edit'])->name('kader.password.edit');
Route::post('/kader/set-password', [KaderPasswordController::class, 'update'])->name('kader.password.update');
Route::get('/kader/password-created', [KaderPasswordController::class, 'created'])->name('kader.password.created');