<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
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
                $query->where('kegiatan.status_kegiatan', 'perbaikanbem')
                    ->orWhere('kegiatan.status_kegiatan', 'perbaikankemahasiswaan')
                    ->orWhere('kegiatan.status_kegiatan', 'revisikemahasiswaan')
                    ->orWhere('kegiatan.status_kegiatan', 'pencairan')
                    ->orWhere('kegiatan.status_kegiatan', 'selesai');
            });
        } elseif ($role == 'bem') {
            $kegiatan->where(function ($query) {
                $query->where('kegiatan.status_kegiatan', 'terkirim')
                    ->orWhere('kegiatan.status_kegiatan', 'revisibem');
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
            'status_kegiatan' => 'required|in:revisi,pencairan,selesai', // Ubah menjadi lowercase sesuai inputan di blade
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
        }

        // Set nilai status kegiatan dari input formulir
        $validated['status_kegiatan'] = $request->status_kegiatan;

        // Simpan perubahan dengan validasi yang sudah diatur sebelumnya
        $kegiatan->update($validated);

        Alert::info('Success', 'Data Kegiatan berhasil disimpan !');
        return redirect('/kegiatan');
    }
}
