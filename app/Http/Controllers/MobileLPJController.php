<?php

namespace App\Http\Controllers;

use App\Models\LPJ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MobileLPJController extends Controller
{
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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'proker_id' => 'required|exists:progam_kerja,idproker',
            'file_lpj' => 'nullable|file|mimes:pdf|max:2048', // Validasi untuk file PDF
            'status_lpj' => 'nullable|in:terkirim,revisi,perbaikan revisi,disetujui',
        ]);

        try {
            $user_id = $validatedData['user_id'];

            $filePath = null;
            if ($request->hasFile('file_lpj')) {
                // Menyimpan file lpj
                $filePath = $request->file('file_lpj')->store('file-lpj', 'public');
            }

            // Membuat lpj baru
            $lpj = LPJ::create([
                'user_id' => $user_id,
                'proker_id' => $validatedData['proker_id'],
                'file_lpj' => $filePath,
                'status_lpj' => 'terkirim', // Status default
            ]);

            return response()->json(['success' => true, 'message' => 'LPJ berhasil ditambahkan', 'lpj' => $lpj]);
        } catch (\Exception $e) {
            return response()->json(['failed' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateLampiranPJ(Request $request, $id)
    {
        $validatedData = $request->validate([
            'file_lpj' => 'required|file|mimes:pdf|max:2048',
        ]);

        try {
            $lpj = lpj::findOrFail($id);

            // Hapus lampiran lama jika ada
            if ($lpj->file_lpj) {
                Storage::disk('public')->delete($lpj->file_lpj);
            }

            // Menentukan status_proker baru berdasarkan kondisi
            if ($lpj->status_lpj == 'revisi') {
                $lpj->status_lpj = 'perbaikan revisi';
            } else if ($lpj->status_lpj == 'terkirim') {
                $lpj->status_lpj = 'terkirim';
            }

            // Menyimpan file lampiran baru
            $lampiranPJPath = $request->file('file_lpj')->store('file-lpj', 'public');

            // Update lampiran_kegiatan di database
            $lpj->update([
                'file_lpj' => $lampiranPJPath,
            ]);

            return response()->json(['success' => true, 'message' => 'File LPJ berhasil diperbarui']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
