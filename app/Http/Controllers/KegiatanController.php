<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    //
    public function index()
    {
        $kegiatan = Kegiatan::join('users', 'kegiatan.user_id', '=', 'users.id')
        ->join('progam_kerja', 'kegiatan.proker_id', '=', 'progam_kerja.idproker')
        ->select('kegiatan.*', 'users.name as user_name', 'progam_kerja.nama_proker', 'progam_kerja.penanggung_jawab as proker_penanggung_jawab')
        ->orderBy('kegiatan.nama_kegiatan', 'asc')
        ->get();

        return view('kegiatan.kegiatan', compact('kegiatan'));
    }
}
