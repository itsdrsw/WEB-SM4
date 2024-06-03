<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MobilePrestasiController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'namalomba' => 'required|string|max:50',
            'kategorilomba' => 'required|in:individu,kelompok',
            'tanggallomba' => 'required|date',
            'juara' => 'required|string|in:Juara 1,Juara 2,Juara 3,Harapan 1,Harapan 2,lainnya',
            'penyelenggara' => 'required|string|max:30',
            'lingkup' => 'required|string|in:kabupaten,provinsi,nasional,lainnya',
            'sertifikat' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'dokumentasi' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $sertifikatPath = $request->file('sertifikat')->store('sertifikat', 'public');

        $dokumentasiPath = $request->file('dokumentasi')->store('dokumentasi', 'public');

        $prestasi = new Prestasi;
        $prestasi->user_id = $validatedData['user_id'];
        $prestasi->namalomba = $validatedData['namalomba'];
        $prestasi->kategorilomba = $validatedData['kategorilomba'];
        $prestasi->tanggallomba = $validatedData['tanggallomba'];
        $prestasi->juara = $validatedData['juara'];
        $prestasi->penyelenggara = $validatedData['penyelenggara'];
        $prestasi->lingkup = $validatedData['lingkup'];
        $prestasi->sertifikat = $sertifikatPath;
        $prestasi->dokumentasi = $dokumentasiPath;
        $prestasi->statusprestasi = $request->input('statusprestasi', 'belum disetujui');
        $prestasi->save();

        return response()->json(['success' => true, 'message' => 'Data prestasi berhasil disimpan']);
    }

    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $user_id = $validatedData['user_id'];

        $prestasi = Prestasi::where('user_id', $user_id)->get();

        return response()->json($prestasi);
    }

    public function updatePrestasi(Request $request, $idprestasi)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'namalomba' => 'required|string|max:50',
            'kategorilomba' => 'required|in:individu,kelompok',
            'tanggallomba' => 'required|date',
            'juara' => 'required|string|in:Juara 1,Juara 2,Juara 3,Harapan 1,Harapan 2,lainnya',
            'penyelenggara' => 'required|string|max:30',
            'lingkup' => 'required|string|in:kabupaten,provinsi,nasional,lainnya',
            'sertifikat' => 'image|mimes:jpg,jpeg,png|max:2048',
            'dokumentasi' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $prestasi = Prestasi::findOrFail($idprestasi);
        $prestasi->user_id = $validatedData['user_id'];
        $prestasi->namalomba = $validatedData['namalomba'];
        $prestasi->kategorilomba = $validatedData['kategorilomba'];
        $prestasi->tanggallomba = $validatedData['tanggallomba'];
        $prestasi->juara = $validatedData['juara'];
        $prestasi->penyelenggara = $validatedData['penyelenggara'];
        $prestasi->lingkup = $validatedData['lingkup'];
        $prestasi->statusprestasi = $request->input('statusprestasi', 'belum disetujui');

        if ($request->hasFile('sertifikat')) {
            Storage::disk('public')->delete($prestasi->sertifikat);
            $prestasi->sertifikat = $request->file('sertifikat')->store('sertifikat', 'public');
        }

        if ($request->hasFile('dokumentasi')) {
            Storage::disk('public')->delete($prestasi->dokumentasi);
            $prestasi->dokumentasi = $request->file('dokumentasi')->store('dokumentasi', 'public');
        }

        $prestasi->save();

        return response()->json(['success' => true, 'message' => 'Data prestasi berhasil diupdate']);
    }
}
