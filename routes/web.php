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

Route::get('/', function () {
    return view('welcome');

});
Route::get('/santri/search', [SantriSearchController::class, 'index'])->name('santri.index');
Route::post('/santri/search', [SantriSearchController::class, 'search'])->name('santri.search.post');

Route::get('/cek-saldo', function () {
    return view('pages.cek_saldo'); // Sesuaikan dengan lokasi file
})->name('cek.saldo');
