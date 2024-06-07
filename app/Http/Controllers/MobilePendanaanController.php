<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pendanaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MobilePendanaanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil user_id dari request atau dari pengguna yang terautentikasi
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $user_id = $validatedData['user_id'];

        // Ambil data Pendanaan berdasarkan user_id
        $pendanaan = Pendanaan::join('users', 'pendanaan.user_id', '=', 'users.id')
            ->select('pendanaan.*', 'users.name')
            ->where('pendanaan.user_id', $user_id) // Filter berdasarkan user_id
            ->orderBy('pendanaan.periode', 'asc')
            ->get();

        foreach ($pendanaan as $item) {
            // Menghitung total anggaran terpakai berdasarkan user_id dan periode yang sama
            $totalAnggaranTerpakai = Kegiatan::where('user_id', $item->user_id)
                ->where('periode', $item->periode)
                ->sum('dana_cair');

            // Mendapatkan anggaran tersedia dari pendanaan
            $anggaranTersedia = $item->anggaran_tersedia;

            // Menghitung sisa anggaran
            $item->total_anggaran_terpakai = $totalAnggaranTerpakai;
            $item->sisa_anggaran = $anggaranTersedia - $totalAnggaranTerpakai;
        }

        return response()->json($pendanaan, 200);
    }
}
