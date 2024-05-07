<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::orderBy('name', 'asc')->get();

        return view('profil.profil', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.barang-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:users',
            'category' => 'required',
            'supplier' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'note' => 'max:1000',
        ]);

        $user = User::create($request->all());

        Alert::success('Success', 'Barang has been saved !');
        return redirect('/profil');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_user)
    {
        $user = user::findOrFail($id_user);

        return view('profil.profil-ubah', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_user)
    {
        $validated = $request->validate([
            'name' => 'required|max:100|unique:users,name,' . $id_user . ',id',
            'email' => 'required',
            'ketua' => 'required',
            // 'stock' => 'required',
            // 'price' => 'required',
            // 'note' => 'max:1000',
        ]);

        $user = User::findOrFail($id_user);
        $user->update($validated);

        Alert::info('Success', 'Data user berhasil disimpan !');
        return redirect('/profil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_user)
    {
        try {
            $deleteduser = User::findOrFail($id_user);

            $deleteduser->delete();

            Alert::error('Success', 'Data user berhasil dihapus !');
            return redirect('/profil');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Data user gagal dihapus !');
            return redirect('/profil');
        }
    }
}
