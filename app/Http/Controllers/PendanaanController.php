<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pendanaan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class PendanaanController extends Controller
{
    //
    public function index()
    {
        $pendanaan = Pendanaan::join('users', 'pendanaan.user_id', '=', 'users.id')
            ->select('pendanaan.*', 'users.name')
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

            // Debug perhitungan
            if ($item->sisa_anggaran < 0) {
                // Log untuk memeriksa mengapa sisa anggaran negatif
                Log::warning("Sisa anggaran negatif untuk user_id: {$item->user_id}, periode: {$item->periode}, anggaran_tersedia: {$anggaranTersedia}, total_anggaran_terpakai: {$totalAnggaranTerpakai}");
            }
        }

        return view('pendanaan.pendanaan', compact('pendanaan'));
    }

    public function createPendanaanForm()
    {
        // Ambil semua user dari tabel users
        $users = User::where('role', 'ukm')->get();
        // Kirim data users ke view
        return view('pendanaan.pendanaan-tambah', compact('users'));
    }

    public function tambahPendanaan(Request $request)
    {
        $currentYear = date('Y');

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'anggaran_tersedia' => 'required|numeric',
            'periode' => 'required|date_format:Y'
        ]);

        // Check if the user already has funding for the current year
        $existingPendanaan = Pendanaan::where('user_id', $request->user_id)
            ->whereYear('periode', $currentYear)
            ->first();

        if ($existingPendanaan) {
            Alert::warning('Peringatan', 'UKM ini telah memiliki anggaran di periode ini');
            return redirect()->back()->withErrors(['user_id' => 'User ini sudah memiliki pendanaan untuk tahun ini.'])->withInput();
        }

        // Set the periode to the current year
        $validated['periode'] = $currentYear;

        $pendanaan = Pendanaan::create($validated);

        Alert::success('Success', 'Tambah data pendanaan sukses!');
        return redirect('/pendanaan');
    }
}
