<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginMobileController;
use App\Http\Controllers\MobileLoginController;
use App\Http\Controllers\MobilePrestasiController;
use App\Http\Controllers\MobileProkerController;
use App\Http\Controllers\PrestasiMobileController;
use App\Http\Controllers\ProkerMobileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [MobileLoginController::class, 'register']);

Route::post('/login', [MobileLoginController::class, 'loginApi']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user-data', [MobileLoginController::class, 'getUserData']);
});

Route::post('change-password', [MobileLoginController::class, 'changePassword']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('update-user', [MobileLoginController::class, 'update']);
});

Route::middleware('auth:sanctum')->post('validate-old-password', [MobileLoginController::class, 'validateOldPassword']);

Route::post('prestasi', [MobilePrestasiController::class, 'store']);
Route::get('prestasi', [MobilePrestasiController::class, 'index']);
Route::post('prestasi/{idprestasi}', [MobilePrestasiController::class, 'updatePrestasi']);

Route::get('proker', [MobileProkerController::class, 'index']);
Route::post('proker', [MobileProkerController::class, 'store']);
Route::post('proker/{id}', [MobileProkerController::class, 'updateLampiranProker']);
