<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MobileKegiatanController extends Controller
{
    public function getKegiatan($user_id)
    {
        $kegiatan = Kegiatan::where('user_id', $user_id)->get();
        return response()->json($kegiatan);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'proker_id' => 'required|exists:progam_kerja,idproker',
            'nama_kegiatan' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'pengajuan_dana' => 'required|integer',
            'periode' => 'required|integer|digits:4',
            'proposal_kegiatan' => 'nullable|file|mimes:pdf|max:2048', // Validasi untuk file PDF
        ]);

        try {
            $user_id = $validatedData['user_id'];

            $proposalPath = null;
            if ($request->hasFile('proposal_kegiatan')) {
                $proposalPath = $request->file('proposal_kegiatan')->store('proposal-kegiatan', 'public');
            }

            // Membuat kegiatan baru
            $kegiatan = Kegiatan::create([
                'user_id' => $user_id,
                'proker_id' => $validatedData['proker_id'],
                'nama_kegiatan' => $validatedData['nama_kegiatan'],
                'penanggung_jawab' => $validatedData['penanggung_jawab'],
                'pengajuan_dana' => $validatedData['pengajuan_dana'],
                'periode' => $validatedData['periode'],
                'proposal_kegiatan' => $proposalPath,
                'status_kegiatan' => 'terkirim', // Status default
            ]);

            return response()->json(['success' => true, 'message' => 'Kegiatan berhasil ditambahkan', 'kegiatan' => $kegiatan]);
        } catch (\Exception $e) {
            return response()->json(['failed' => true, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateProposalKegiatan(Request $request, $id)
    {
        $validatedData = $request->validate([
            'proposal_kegiatan' => 'required|file|mimes:pdf|max:2048',
        ]);

        try {
            $kegiatan = Kegiatan::findOrFail($id);

            // Hapus lampiran lama jika ada
            if ($kegiatan->proposal_kegiatan) {
                Storage::disk('public')->delete($kegiatan->proposal_kegiatan);
            }

            // Menentukan status_proker baru berdasarkan kondisi
            switch ($kegiatan->status_kegiatan) {
                case 'terkirim':
                    $kegiatan->status_kegiatan = 'terkirim';
                    break;
                case 'revisibem':
                    $kegiatan->status_kegiatan = 'revisiukmbem';
                    break;
                case 'revisikemahasiswaan':
                    $kegiatan->status_kegiatan = 'revisiukmkemahasiswaan';
                    break;
                default:
                    // Jika status_kegiatan tidak sesuai dengan kondisi yang diharapkan, kembalikan pesan error
                    return response()->json(['success' => false, 'message' => 'Status kegiatan tidak valid'], 400);
            }

            // Menyimpan file lampiran baru
            $proposalkegiatanPath = $request->file('proposal_kegiatan')->store('proposal-kegiatan', 'public');

            // Update lampiran_kegiatan di database
            $kegiatan->update([
                'proposal_kegiatan' => $proposalkegiatanPath,
            ]);

            return response()->json(['success' => true, 'message' => 'Proposal kegiatan berhasil diperbarui']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateStatusKegiatan(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status_kegiatan' => 'required|string|in:pencairan,selesai',
        ]);

        try {
            $kegiatan = Kegiatan::findOrFail($id);
            $kegiatan->status_kegiatan = $validatedData['status_kegiatan'];
            $kegiatan->save();

            return response()->json(['success' => true, 'message' => 'Status Kegiatan berhasil diperbarui']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
