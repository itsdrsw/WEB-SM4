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
}
