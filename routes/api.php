<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SantriController;
use App\Http\Controllers\Api\AlumniController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\JenisTagihanController;
use App\Http\Controllers\Api\KamarController;
use App\Http\Controllers\Api\LembagaController;
use App\Http\Controllers\Api\PeriodeController;
use App\Http\Controllers\Api\PersentaseTagihanController;
use App\Http\Controllers\Api\RayonController;
use App\Http\Controllers\Api\TagihanController;
use App\Http\Controllers\Api\UserController;

Route::apiResource('santri', SantriController::class);
Route::apiResource('alumni', AlumniController::class);
Route::apiResource('dashboard', DashboardController::class);
Route::apiResource('jenis-tagihan', JenisTagihanController::class);
Route::apiResource('kamar', KamarController::class);
Route::apiResource('lembaga', LembagaController::class);
Route::apiResource('periode', PeriodeController::class);
Route::apiResource('persentase-tagihan', PersentaseTagihanController::class);
Route::apiResource('rayon', RayonController::class);
Route::apiResource('tagihan', TagihanController::class);
Route::apiResource('user', UserController::class);


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
