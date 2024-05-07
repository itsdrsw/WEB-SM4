<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
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
        $prestasi = Prestasi::join('users', 'prestasi.user_id', '=', 'users.id')
            ->select('prestasi.*', 'users.name')
            ->orderBy('prestasi.namalomba', 'asc')
            ->get();

        $prestasi_ubah = Prestasi::findOrFail($idprestasi);

        return view('prestasi.prestasi-ubah', [
            'prestasi' => $prestasi,
            'prestasi_ubah' => $prestasi_ubah,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idprestasi)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:users,name,' . $idprestasi . ',id',
            'email' => 'required',
            'ketua' => 'required',
            // 'stock' => 'required',
            // 'price' => 'required',
            // 'note' => 'max:1000',
        ]);

        $prestasi = Prestasi::findOrFail($idprestasi);
        $prestasi->update($validated);

        Alert::info('Success', 'Data Prestasi berhasil disimpan !');
        return redirect('/prestasi');
    }
}
