<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LPJController extends Controller
{
    //
    public function index()
    {
        $lpj = DB::table('lpj')
            ->select(
                'users.name as user_name',
                'progam_kerja.nama_proker',
                'progam_kerja.penanggung_jawab',
                'progam_kerja.uraian_proker',
                'progam_kerja.periode',
                'lpj.file_lpj',
                'lpj.status_lpj',
                'lpj.idlpj'
            )
            ->join('progam_kerja', 'lpj.proker_id', '=', 'progam_kerja.idproker')
            ->join('users', 'progam_kerja.user_id', '=', 'users.id')
            ->get();

        return view('lpj.lpj', compact('lpj'));
    }

    public function getlpj($user_id)
    {
        $lpj = DB::table('lpj')
            ->select(
                'users.name as user_name',
                'progam_kerja.nama_proker',
                'progam_kerja.penanggung_jawab',
                'progam_kerja.uraian_proker',
                'progam_kerja.periode',
                'lpj.file_lpj',
                'lpj.status_lpj',
                'lpj.idlpj'
            )
            ->join('progam_kerja', 'lpj.proker_id', '=', 'progam_kerja.idproker')
            ->join('users', 'progam_kerja.user_id', '=', 'users.id')
            ->where('users.id', $user_id)
            ->get();

        return response()->json($lpj);
    }
}
