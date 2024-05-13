<?php

namespace App\Http\Controllers;

use App\Models\ProgamKerja;
use Illuminate\Http\Request;

class ProkerController extends Controller
{
    public function index()
    {
        $proker = ProgamKerja::join('users', 'progam_kerja.user_id', '=', 'users.id')
            ->select('progam_kerja.*', 'users.name')
            ->orderBy('progam_kerja.nama_proker', 'asc')
            ->get();

        return view('proker.proker', compact('proker'));

    }
}
