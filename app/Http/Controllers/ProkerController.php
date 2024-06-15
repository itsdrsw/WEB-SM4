<?php

namespace App\Http\Controllers;

use App\Models\ProgamKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProkerController extends Controller
{
    public function index()
    {
        $proker = ProgamKerja::join('users', 'progam_kerja.user_id', '=', 'users.id')
            ->select('progam_kerja.*', 'users.name')
            ->orderBy('progam_kerja.nama_proker', 'desc')
            ->get();

        return view('proker.proker', compact('proker'));
    }

    public function edit($idproker)
    {
        $proker_ubah = ProgamKerja::join('users', 'progam_kerja.user_id', '=', 'users.id')
            ->select('progam_kerja.*', 'users.name')
            ->where('progam_kerja.idproker', $idproker)
            ->firstOrFail();

        return view('proker.proker-ubah', [
            'proker_ubah' => $proker_ubah,
        ]);
    }

    public function update(Request $request, $idproker)
    {
        $validated = $request->validate([
            // Validasi lainnya
            'lampiran_proker' => 'nullable|mimes:pdf|max:3000', // Hanya file PDF dengan ukuran maksimum 3MB yang diterima
            'status_proker' => 'required|in:disetujui,revisi,perbaikanrevisi', // Ubah menjadi lowercase sesuai inputan di blade
        ]);

        $proker = ProgamKerja::findOrFail($idproker);

        // Proses file lampiran proker
        if ($request->hasFile('lampiran_proker')) {
            $file = $request->file('lampiran_proker');
            $fileName = $file->getClientOriginalName(); // Menggunakan nama asli file

            // Menyimpan file ke folder public/sertifikat
            $lampiranPath = $file->storeAs('lampiran-proker', $fileName, 'public');

            // Hapus file lama jika ada
            if ($proker->lampiran_proker) {
                Storage::delete('public/' . $proker->lampiran_proker);
            }

            $validated['lampiran_proker'] = $lampiranPath;

            // Secara otomatis mengatur status proker menjadi 'disetujui'
            $validated['status_proker'] = 'revisi';
        } else {
            // Jika tidak ada file baru diunggah, gunakan status proker yang ada dalam request
            $validated['status_proker'] = 'disetujui';
        }

        // Simpan perubahan dengan validasi yang sudah diatur sebelumnya
        $proker->update($validated);

        Alert::info('Success', 'Data Progam Kerja berhasil disimpan !');
        return redirect('/proker');
    }
}
