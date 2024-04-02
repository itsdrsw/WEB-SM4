<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HaloController;
use App\Http\Controllers\LoginController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('blog', function () {
    return view('blog');
});

Route::get('murid', [HaloController::class, 'index']);

Route::get('profil', [HaloController::class, 'profil']);

Route::get('murid/{nama}', [HaloController::class, 'getNama']);

Route::get('pendaftaran', [HaloController::class, 'pendaftaran']);
Route::post('pendaftaran/proses', [HaloController::class, 'proses']);

Route::get('belajar', [LoginController::class, 'index']);

Route::get('/', [BlogController::class, 'home']);
Route::get('tentang', [BlogController::class, 'tentang']);
Route::get('kontak', [BlogController::class, 'kontak']);
