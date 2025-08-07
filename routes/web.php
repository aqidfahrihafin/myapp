<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SantriSearchController;

Route::get('/', function () {
    return view('welcome');
});

// Route pencarian santri (lebih spesifik) harus di atas
Route::get('/santri/search', [SantriSearchController::class, 'index'])->name('santri.index');
Route::post('/santri/search', [SantriSearchController::class, 'search'])->name('santri.search.post');

// Route detail santri (harus di bawah agar tidak mengganggu /search)
Route::get('/santri/{nis}', [SantriSearchController::class, 'show'])->name('santri.show');

Route::get('/cek-saldo', function () {
    return view('pages.cek_saldo');
})->name('cek.saldo');
