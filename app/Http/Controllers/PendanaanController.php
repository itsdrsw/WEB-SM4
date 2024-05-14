<?php

namespace App\Http\Controllers;

use App\Models\Pendanaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendanaanController extends Controller
{
    //
    public function index()
    {
        $pendanaan = DB::table('pendanaan')
        ->join('users', 'pendanaan.user_id', '=', 'users.id')
        ->join('kegiatan', 'pendanaan.kegiatan_id', '=', 'kegiatan.idkegiatan')
        ->select(
            'pendanaan.idpendanaan',
            'pendanaan.user_id',
            'pendanaan.kegiatan_id',
            'pendanaan.anggaran_tersedia',
            'pendanaan.periode',
            'pendanaan.status_anggaran',
            'users.name as user_name',
            'kegiatan.nama_kegiatan',
            DB::raw('SUM(kegiatan.dana_cair) as dana_terpakai'),
            DB::raw('pendanaan.anggaran_tersedia - SUM(kegiatan.dana_cair) as sisa_anggaran') // Hitung sisa anggaran
        )
        ->groupBy(
            'pendanaan.idpendanaan',
            'pendanaan.user_id',
            'pendanaan.kegiatan_id',
            'pendanaan.anggaran_tersedia',
            'pendanaan.periode',
            'pendanaan.status_anggaran',
            'users.name',
            'kegiatan.nama_kegiatan'
        )
        ->orderBy('pendanaan.idpendanaan', 'asc')
        ->get();

        return view('pendanaan.pendanaan', compact('pendanaan'));
    }
}
