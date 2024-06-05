<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\ProgamKerja;
use Illuminate\Http\Request;

class MobileDashboardController extends Controller
{
    public function getCounts(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $user_id = $validatedData['user_id'];

        // Hitung jumlah prestasi dan program kerja
        $prestasiCount = Prestasi::where('user_id', $user_id)->count();
        $prokerCount = ProgamKerja::where('user_id', $user_id)->count();

        // Kembalikan hasil dalam format JSON
        return response()->json([
            'prestasi_count' => $prestasiCount,
            'proker_count' => $prokerCount,
        ]);
    }
}
