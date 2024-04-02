<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function home() {
        return view('admin/home');
    }

    public function tentang() {
        return view('admin.tentang');
    }

    public function kontak(){
        return view('admin.kontak');
    }
}
