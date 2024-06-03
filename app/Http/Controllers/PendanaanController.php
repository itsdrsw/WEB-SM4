<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendanaanController extends Controller
{
    //
    public function index()
    {
        $pendanaan = DB::table('users as u')
            ->join('kegiatan as k', 'u.id', '=', 'k.user_id')
            ->join('pendanaan as p', 'p.user_id', '=', 'u.id')
            ->select(
                'u.name',
                'p.periode', 'p.status_anggaran',
                DB::raw('GROUP_CONCAT(k.nama_kegiatan SEPARATOR ", ") as daftar_kegiatan'),
                'p.anggaran_tersedia',
                DB::raw('SUM(k.dana_cair) as total_dana'),
                DB::raw('(p.anggaran_tersedia - SUM(k.dana_cair)) as sisa_anggaran')
            )
            ->groupBy('u.id',  'u.name', 'p.periode', 'p.status_anggaran', 'p.anggaran_tersedia')
            ->get();

        return view('pendanaan.pendanaan', compact('pendanaan'));
    }
}
