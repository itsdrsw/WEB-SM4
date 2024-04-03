<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HaloController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Auth\Events\Login;
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

// Route::get('/', [BlogController::class, 'home']);
Route::get('tentang', [BlogController::class, 'tentang']);
Route::get('kontak', [BlogController::class, 'kontak']);

//Route untuk login
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');


//Route untuk Register
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');
