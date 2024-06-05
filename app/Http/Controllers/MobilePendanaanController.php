<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MobilePendanaanController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the user_id from the request
        $user_id = $request->input('user_id');

        // Validate that user_id is provided
        if (!$user_id) {
            return response()->json(['error' => 'User ID is required'], 400);
        }

        // Fetch the funding data for the given user_id
        $pendanaan = DB::table('users as u')
            ->join('kegiatan as k', 'u.id', '=', 'k.user_id')
            ->join('pendanaan as p', 'p.user_id', '=', 'u.id')
            ->select(
                'u.name',
                'p.periode',
                'p.status_anggaran',
                DB::raw('GROUP_CONCAT(k.nama_kegiatan SEPARATOR ", ") as daftar_kegiatan'),
                'p.anggaran_tersedia',
                DB::raw('SUM(k.dana_cair) as total_dana'),
                DB::raw('(p.anggaran_tersedia - SUM(k.dana_cair)) as sisa_anggaran')
            )
            ->where('u.id', $user_id)
            ->groupBy('u.id', 'u.name', 'p.periode', 'p.status_anggaran', 'p.anggaran_tersedia')
            ->get();

        if ($pendanaan->isEmpty()) {
            return response()->json(['message' => 'No funding data found for the specified user ID'], 404);
        }

        return response()->json($pendanaan, 200);
    }
}
