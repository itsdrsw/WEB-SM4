<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Prestasi;
use App\Models\ProgamKerja;
use Illuminate\Http\Request;

class MobileDashboardController extends Controller
{
    public function getCounts(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $user_id = $validatedData['user_id'];

        $prestasiCount = Prestasi::where('user_id', $user_id)->count();
        $prokerCount = ProgamKerja::where('user_id', $user_id)->count();
        $kegiatanCount = Kegiatan::where('user_id', $user_id)->count();

        return response()->json([
            'prestasi_count' => $prestasiCount,
            'proker_count' => $prokerCount,
            'kegiatan_count' => $kegiatanCount,
        ]);
    }
}
