<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HaloController extends Controller
{
    //
    public function index() {
        $nama = 'Dimas Dharman';
        return view('murid', ['nama' => $nama]);
    }

    public function profil() {
        $nama = 'Dimas Dharman';
        $matkul = ['Laravel', 'Pemrograman Web', 'Database'];
        return view('profilmurid', ['nama' => $nama, 'matkul' => $matkul]);
    }
}
