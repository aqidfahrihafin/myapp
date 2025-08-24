<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SantriSearchController;

Route::get('/', function () {
    return view('welcome');
});

// Form pencarian santri
Route::get('/santri/search', [SantriSearchController::class, 'index'])->name('santri.index');
Route::post('/santri/search', [SantriSearchController::class, 'search'])->name('santri.search.post');

Route::get('/santri/{nis}', [SantriSearchController::class, 'show'])->name('santri.show');
Route::get('/cek-saldo/{nis}', [SantriSearchController::class, 'cekSaldo'])->name('cek.saldo');

