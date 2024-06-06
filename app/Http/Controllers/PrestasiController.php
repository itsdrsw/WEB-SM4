<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasi = Prestasi::join('users', 'prestasi.user_id', '=', 'users.id')
            ->select('prestasi.*', 'users.name')
            ->orderBy('prestasi.namalomba', 'asc')
            ->get();

        return view('prestasi.prestasi', compact('prestasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($idprestasi)
    {
        $prestasi_ubah = Prestasi::join('users', 'prestasi.user_id', '=', 'users.id')
            ->select('prestasi.*', 'users.name')
            ->where('prestasi.idprestasi', $idprestasi)
            ->firstOrFail();

        return view('prestasi.prestasi-ubah', [
            'prestasi_ubah' => $prestasi_ubah,
        ]);
    }

    public function update(Request $request, $idprestasi)
    {
        // Validasi input
        $validated = $request->validate([
            'note' => 'nullable|max:200',
        ]);

        // Ambil data prestasi berdasarkan ID
        $prestasi = Prestasi::findOrFail($idprestasi);

        // Jika tidak ada input 'note', atur 'note' menjadi null untuk menghapusnya
        if (!$request->input('note')) {
            // Update status menjadi 'disetujui' karena tidak ada input pada 'note'
            $prestasi->update([
                'note' => null,
                'statusprestasi' => 'disetujui'
            ]);
        } else {
            // Jika ada input pada 'note', atur 'statusprestasi' menjadi 'ditolak'
            $prestasi->update([
                'note' => $validated['note'],
                'statusprestasi' => 'ditolak'
            ]);
        }

        // Memberikan notifikasi sukses
        Alert::info('Success', 'Data Prestasi berhasil disimpan!');
        return redirect('/prestasi');
    }



    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $idprestasi)
    // {
    //     $validated = $request->validate([
    //         // Validasi lainnya
    //         'sertifikat' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',
    //         'dokumentasi' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048',
    //         'status_prestasi' => 'required|in:disetujui,ditolak',
    //         'note' => 'nullable|max:300',
    //     ]);

    //     $prestasi = Prestasi::findOrFail($idprestasi);

    //     // Proses gambar sertifikat
    //     if ($request->hasFile('sertifikat')) {
    //         $file = $request->file('sertifikat');
    //         $fileName = $file->getClientOriginalName(); // Menggunakan nama asli file

    //         // Menyimpan file ke folder public/sertifikat
    //         $sertifikatPath = $file->storeAs('sertifikat', $fileName, 'public');

    //         // Hapus file lama jika ada
    //         if ($prestasi->sertifikat) {
    //             Storage::delete('public/' . $prestasi->sertifikat);
    //         }

    //         $validated['sertifikat'] = $sertifikatPath;
    //     }

    //     // Proses gambar dokumentasi
    //     if ($request->hasFile('dokumentasi')) {
    //         $file = $request->file('dokumentasi');
    //         $fileName = $file->getClientOriginalName(); // Menggunakan nama asli file

    //         // Menyimpan file ke folder public/sertifikat
    //         $dokumentasiPath = $file->storeAs('dokumentasi', $fileName, 'public');

    //         // Hapus file lama jika ada
    //         if ($prestasi->dokumentasi) {
    //             Storage::delete('public/' . $prestasi->dokumentasi);
    //         }

    //         $validated['dokumentasi'] = $dokumentasiPath;
    //     }

    //     // Set nilai status prestasi dari input formulir
    //     $validated['statusprestasi'] = $request->status_prestasi;

    //     // Simpan perubahan dengan validasi yang sudah diatur sebelumnya
    //     $prestasi->update($validated);

    //     Alert::info('Success', 'Data Prestasi berhasil disimpan !');
    //     return redirect('/prestasi');
    // }
}
