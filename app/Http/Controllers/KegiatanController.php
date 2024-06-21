<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class KegiatanController extends Controller
{
    //
    public function index()
    {
        $role = auth()->user()->role;
        $kegiatan = Kegiatan::join('users', 'kegiatan.user_id', '=', 'users.id')
            ->join('progam_kerja', 'kegiatan.proker_id', '=', 'progam_kerja.idproker')
            ->select('kegiatan.*', 'users.name as user_name', 'progam_kerja.nama_proker', 'progam_kerja.penanggung_jawab as proker_penanggung_jawab')
            ->orderBy('kegiatan.nama_kegiatan', 'asc');

        if ($role == 'kemahasiswaan') {
            $kegiatan->where(function ($query) {
                $query->where('kegiatan.status_kegiatan', 'ajuanukm')
                    ->orWhere('kegiatan.status_kegiatan', 'revisiukmkemahasiswaan')
                    ->orWhere('kegiatan.status_kegiatan', 'revisikemahasiswaan')
                    ->orWhere('kegiatan.status_kegiatan', 'pencairan')
                    ->orWhere('kegiatan.status_kegiatan', 'selesai');
            });
        } elseif ($role == 'bem') {
            $kegiatan->where(function ($query) {
                $query->where('kegiatan.status_kegiatan', 'terkirim')
                    ->orWhere('kegiatan.status_kegiatan', 'revisibem')
                    ->orWhere('kegiatan.status_kegiatan', 'revisiukmbem');;
            });
        }

        $kegiatan = $kegiatan->get();

        return view('kegiatan.kegiatan', compact('kegiatan'));
    }


    public function edit($idkegiatan)
    {
        $kegiatan_ubah = Kegiatan::join('users', 'kegiatan.user_id', '=', 'users.id')
            ->join('progam_kerja', 'kegiatan.proker_id', '=', 'progam_kerja.idproker')
            ->select('kegiatan.*', 'users.name as user_name', 'progam_kerja.nama_proker', 'progam_kerja.penanggung_jawab as proker_penanggung_jawab')
            ->where('kegiatan.idkegiatan', $idkegiatan)
            ->firstOrFail();

        return view('kegiatan.kegiatan-ubah', [
            'kegiatan_ubah' => $kegiatan_ubah,
        ]);
    }

    public function update(Request $request, $idkegiatan)
    {
        $validated = $request->validate([
            // Validasi lainnya
            'dana_cair' => 'nullable|numeric',
            'proposal_kegiatan' => 'nullable|mimes:pdf|max:3000', // Hanya file PDF dengan ukuran maksimum 3MB yang diterima
            'status_kegiatan' => 'required|in:revisibem,revisiukmbem,ajuanukm,revisikemahasiswaan,revisiukmkemahasiswaan,pencairan,selesai',
        ]);

        $kegiatan = Kegiatan::findOrFail($idkegiatan);

        // Proses file proposal kegiatan
        if ($request->hasFile('proposal_kegiatan')) {
            $file = $request->file('proposal_kegiatan');
            $fileName = $file->getClientOriginalName(); // Menggunakan nama asli file

            // Menyimpan file ke folder public/proposal-kegiatan
            $proposalPath = $file->storeAs('proposal-kegiatan', $fileName, 'public');

            // Hapus file lama jika ada
            if ($kegiatan->proposal_kegiatan) {
                Storage::delete('public/' . $kegiatan->proposal_kegiatan);
            }

            $validated['proposal_kegiatan'] = $proposalPath;

            // Set status_kegiatan berdasarkan role dan adanya file upload
            if (Auth::user()->role == 'bem') {
                $validated['status_kegiatan'] = 'revisibem';
            } elseif (Auth::user()->role == 'kemahasiswaan') {
                $validated['status_kegiatan'] = 'revisikemahasiswaan';
            }
        } else {
            // Set status_kegiatan berdasarkan role tanpa file upload
            if (Auth::user()->role == 'bem') {
                $validated['status_kegiatan'] = 'ajuanukm';
            } elseif (Auth::user()->role == 'kemahasiswaan') {
                $validated['status_kegiatan'] = 'pencairan';

                // Validate dana_cair field for role kemahasiswaan
                $request->validate([
                    'dana_cair' => 'required|numeric',
                ]);
            }
        }

        // Dapatkan sisa anggaran
        $sisaAnggaran = DB::table('pendanaan')
            ->join('kegiatan', 'pendanaan.user_id', '=', 'kegiatan.user_id')
            ->where('pendanaan.user_id', $kegiatan->user_id)
            ->groupBy('pendanaan.anggaran_tersedia')
            ->selectRaw('pendanaan.anggaran_tersedia - COALESCE(SUM(kegiatan.dana_cair), 0) as sisa_anggaran')
            ->value('sisa_anggaran');
        // dd($sisaAnggaran); //     Tambahkan ini untuk debug

        // Validasi dana_cair tidak melebihi sisa anggaran
        if ($request->dana_cair > $sisaAnggaran) {
            // dd('Sisa Anggaran:', $sisaAnggaran, 'Dana Cair:', $request->dana_cair);
            Alert::warning('Peringatan', 'Nominal pendanaan melebihi anggaran yang tersedia !');
            return redirect()->back()->withErrors(['dana_cair' => 'Nominal kegiatan tidak boleh melebihi sisa anggaran yang tersedia.'])->withInput();
        }

        // Simpan perubahan dengan validasi yang sudah diatur sebelumnya
        $kegiatan->update($validated);

        Alert::info('Success', 'Data Kegiatan berhasil disimpan !');
        return redirect('/kegiatan');
    }

    public function destroy($id_kegiatan)
    {
        try {
            $deleteduser = Kegiatan::findOrFail($id_kegiatan);

            $deleteduser->delete();

            Alert::info('Success', 'Data kegiatan berhasil dihapus !');
            return redirect('/kegiatan');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Data kegiatan gagal dihapus !');
            return redirect('/kegiatan');
        }
    }
}
