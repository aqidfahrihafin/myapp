<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SantriSearchController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/santri/search', [SantriSearchController::class, 'index'])->name('santri.index');
Route::post('/santri/search', [SantriSearchController::class, 'search'])->name('santri.search.post');

Route::get('/cek-saldo', function () {
    return view('pages.cek_saldo'); // Sesuaikan dengan lokasi file
})->name('cek.saldo');


// wali

Route::get('/', function () {  return view('auth.login');});
Route::get('/dashboard-wali', function () {return view('front.wali.index');});
Route::get('/data-santri', function () {return view('front.wali.datasantri');});
Route::get('/transaksi', function () {return view('front.wali.transaksi');});
