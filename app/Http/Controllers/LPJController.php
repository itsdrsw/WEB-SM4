<?php

namespace App\Http\Controllers;

use App\Models\LPJ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class LPJController extends Controller
{
    //
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

    public function edit($idlpj)
    {
        // Menggunakan join dengan eloquent
        $lpj_ubah = LPJ::with(['progamKerja.user'])
            ->where('idlpj', $idlpj)
            ->firstOrFail();

        // Memastikan relasi terdefinisi dalam model LPJ
        // LPJ model harus memiliki relasi dengan ProgramKerja dan User
        return view('lpj.lpj-ubah', [
            'lpj_ubah' => $lpj_ubah,
        ]);
    }

    public function update(Request $request, $idproker)
    {
        $validated = $request->validate([
            // Validasi lainnya
            'file_lpj' => 'nullable|mimes:pdf|max:3000', // Hanya file PDF dengan ukuran maksimum 3MB yang diterima
            // 'status_proker' => 'required|in:disetujui,revisi,perbaikanrevisi', // Ubah menjadi lowercase sesuai inputan di blade
        ]);

        $proker = LPJ::findOrFail($idproker);

        // Proses file lampiran proker
        if ($request->hasFile('file_lpj')) {
            $file = $request->file('file_lpj');
            $fileName = $file->getClientOriginalName(); // Menggunakan nama asli file

            // Menyimpan file ke folder public/sertifikat
            $lampiranPath = $file->storeAs('file-lpj', $fileName, 'public');

            // Hapus file lama jika ada
            if ($proker->lampiran_proker) {
                Storage::delete('public/' . $proker->file_lpj);
            }

            $validated['file_lpj'] = $lampiranPath;

            // Secara otomatis mengatur status proker menjadi 'disetujui'
            $validated['status_lpj'] = 'revisi';
        } else {
            // Jika tidak ada file baru diunggah, gunakan status proker yang ada dalam request
            $validated['status_lpj'] = 'disetujui';
        }

        // Simpan perubahan dengan validasi yang sudah diatur sebelumnya
        $proker->update($validated);

        Alert::info('Success', 'Data LPJ berhasil disimpan !');
        return redirect('/lpj');
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
}
