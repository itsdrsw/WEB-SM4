<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LPJController;
use App\Http\Controllers\PendanaanController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProkerController;
use Illuminate\Support\Facades\Route;

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
Route::fallback(function () {
    return view('notfound', ['title' => 'PAGE NOT FOUND',]);
});

//route login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/register', [LoginController::class, 'register']);
Route::post('/register', [LoginController::class, 'process']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// route dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

//route profil
Route::resource('/profil', ProfilController::class)->middleware('auth');

//route prestasi
Route::resource('/prestasi', PrestasiController::class)->middleware('auth');

//route proker
Route::resource('/proker', ProkerController::class)->middleware('auth');

//route kegiatan
Route::resource('/kegiatan', KegiatanController::class)->middleware('auth');

//route pendanaan
Route::resource('/pendanaan', PendanaanController::class)->middleware('auth');

//route LPJ
Route::resource('/lpj', LPJController::class)->middleware('auth');
