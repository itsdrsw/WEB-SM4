<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Exception;
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

    public function destroy($id_prestasi)
    {
        try {
            $deleteduser = Prestasi::findOrFail($id_prestasi);

            $deleteduser->delete();

            Alert::info('Success', 'Data prestasi berhasil dihapus !');
            return redirect('/prestasi');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Data prestasi gagal dihapus !');
            return redirect('/prestasi');
        }
    }
}
