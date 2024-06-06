<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login_new', [
            'title' => 'LOGIN',
        ]);
    }

    public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required',
        'password' => 'required'
    ]);

    // Cari pengguna berdasarkan email
    $user = User::where('email', $credentials['email'])->first();

    // Cek apakah autentikasi berhasil
    if (Auth::attempt($credentials)) {
        // Autentikasi berhasil, perbarui kolom last_login
        $user->update(['last_login' => now()->timezone('Asia/Jakarta')]);

        // Regenerasi session untuk keamanan
        $request->session()->regenerate();

        Alert::success('Success', 'Login success !');
        return redirect()->intended('/dashboard');
    } else {
        // Autentikasi gagal, tampilkan pesan error
        Alert::error('Error', 'Login failed !');
        return redirect('/login');
    }
}


    public function register()
    {
        return view('auth.register', [
            'title' => 'REGISTER',
        ]);
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'ketua' =>'required',
            'passwordConfirm' => 'required|same:password'
        ]);

        $validated['password'] = Hash::make($request['password']);

        $user = User::create($validated);

        Alert::success('Success', 'Register user has been successfully !');
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        Alert::success('Success', 'Log out success !');
        return redirect('/login');
    }
}
