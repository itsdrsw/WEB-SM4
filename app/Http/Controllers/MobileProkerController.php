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
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'nama_proker' => 'required|string|max:50',
            'penanggung_jawab' => 'required|string|max:50',
            'uraian_proker' => 'required|string|max:150',
            'periode' => 'required|integer',
            'lampiran_proker' => 'required|file|mimes:pdf|max:2048', // Validasi untuk file PDF
        ]);

        try {
            $user_id = $validatedData['user_id'];

            // Menyimpan file lampiran jika ada
            $lampiranProkerPath = null;
            if ($request->hasFile('lampiran_proker')) {
                $lampiranProkerPath = $request->file('lampiran_proker')->store('lampiran', 'public');
            }

            $proker = ProgamKerja::create([
                'user_id' => $user_id,
                'nama_proker' => $validatedData['nama_proker'],
                'penanggung_jawab' => $validatedData['penanggung_jawab'],
                'uraian_proker' => $validatedData['uraian_proker'],
                'periode' => $validatedData['periode'],
                'lampiran_proker' => $lampiranProkerPath,
            ]);

            return response()->json(['success' => true, 'message' => 'Data proker berhasil disimpan']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function updateLampiranProker(Request $request, $id)
    {
        $validatedData = $request->validate([
            'lampiran_proker' => 'required|file|mimes:pdf|max:2048',
        ]);

        try {
            $proker = ProgamKerja::findOrFail($id);

            // Hapus lampiran lama jika ada
            if ($proker->lampiran_proker) {
                Storage::disk('public')->delete($proker->lampiran_proker);
            }

            // Menentukan status_proker baru berdasarkan kondisi
            if ($proker->status_proker == 'revisi') {
                $proker->status_proker = 'perbaikanrevisi';
            } else if ($proker->status_proker == 'terkirim') {
                $proker->status_proker = 'terkirim';
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
