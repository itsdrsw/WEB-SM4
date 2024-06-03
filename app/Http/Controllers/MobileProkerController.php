<?php

namespace App\Http\Controllers;

use App\Models\ProgamKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MobileProkerController extends Controller
{
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $user_id = $validatedData['user_id'];

        $proker = ProgamKerja::where('user_id', $user_id)->get();

        return response()->json($proker);
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'nama_proker' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'uraian_proker' => 'required|string',
            'periode' => 'required|string|max:50',
            'lampiran_proker' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Menyimpan file lampiran proker
        $lampiranPath = $request->file('lampiran_proker')->store('lampiranproker', 'public');

        // Membuat objek programkerja baru
        $programkerja = new ProgamKerja();
        $programkerja->user_id = $validatedData['user_id'];
        $programkerja->nama_proker = $validatedData['nama_proker'];
        $programkerja->penanggung_jawab = $validatedData['penanggung_jawab'];
        $programkerja->uraian_proker = $validatedData['uraian_proker'];
        $programkerja->periode = $validatedData['periode'];
        $programkerja->lampiran_proker = $lampiranPath;
        $programkerja->status_proker = $request->input('status_proker', 'terkirim');
        $programkerja->save();

        // Mengembalikan respon JSON
        return response()->json(['success' => true, 'message' => 'Data program kerja berhasil disimpan']);
    }

    public function updateLampiranProker(Request $request, $id)
    {
        $validatedData = $request->validate([
            'lampiran_proker' => 'required|file|mimes:pdf|max:2048', // Validasi untuk file PDF
        ]);

        try {
            $proker = ProgamKerja::findOrFail($id);

            // Hapus lampiran lama jika ada
            if ($proker->lampiran_proker) {
                Storage::disk('public')->delete($proker->lampiran_proker);
            }

            // Menyimpan file lampiran baru
            $lampiranProkerPath = $request->file('lampiran_proker')->store('lampiran', 'public');

            // Update lampiran_proker di database
            $proker->update([
                'lampiran_proker' => $lampiranProkerPath,
            ]);

            return response()->json(['success' => true, 'message' => 'Lampiran proker berhasil diperbarui']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
