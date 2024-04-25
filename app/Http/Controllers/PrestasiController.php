<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    public function index()
    {
        $user = User::orderBy('name', 'asc')->get();

        return view('prestasi.prestasi', [
            'user' => $user
        ]);
    }
}
