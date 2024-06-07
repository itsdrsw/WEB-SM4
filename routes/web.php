<?php

use App\Http\Controllers\BemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LPJController;
use App\Http\Controllers\PendanaanController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProkerController;
use App\Models\Kegiatan;
use App\Models\Pendanaan;
use App\Models\ProgamKerja;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'duel']);
Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'duel']);

//route profil
Route::resource('/profil', ProfilController::class)->middleware(['auth', 'solo']);

//route prestasi
Route::resource('/prestasi', PrestasiController::class)->middleware(['auth', 'solo']);

//route proker
Route::resource('/proker', ProkerController::class)->middleware(['auth', 'solo']);

//route kegiatan
Route::resource('/kegiatan', KegiatanController::class)->middleware(['auth', 'duel']);

//route pendanaan
Route::middleware(['auth', 'solo'])->group(function () {
    Route::resource('/pendanaan', PendanaanController::class);
    // Rute untuk formulir penambahan pendanaan
    Route::get('/pendanaan/create', [PendanaanController::class, 'createPendanaanForm'])->name('pendanaan.create');
    // Rute untuk menyimpan data pendanaan
    Route::post('/pendanaan', [PendanaanController::class, 'tambahPendanaan'])->name('pendanaan.tambah');
});


//route LPJ
Route::resource('/lpj', LPJController::class)->middleware(['auth', 'solo']);

// blokir akses
Route::get('/blank/blokir-akses', [DashboardController::class, 'BlokirAksesView'])->name('blank.blokirAksesView');
Route::get('/blank/blokir-akses-bem', [DashboardController::class, 'BlokirAksesBem'])->name('blank.blokirAksesBem');
