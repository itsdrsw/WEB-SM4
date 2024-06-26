<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Prestasi;
use App\Models\ProgamKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function viewLandingPage()
    {
        return view('LandingPage');
    }
    public function index(Request $request)
    {
        $title = 'Dashboard';
        $jmlkegiatan    = Kegiatan::count();
        $jmlprestasi    = Prestasi::count();
        $jmlproker      = ProgamKerja::count();

        return view('dashboard.dashboard', compact('title', 'jmlkegiatan', 'jmlprestasi', 'jmlproker'));
    }

    public function BlokirAksesView()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        Alert::error('Peringatan', 'Anda Tidak Berhak Akses Halaman Admin !');
        return redirect('/login');
    }

    public function BlokirAksesBem()
    {
        Alert::error('Peringatan', 'Anda Tidak Berhak Akses Fitur Tersebut !');
        return redirect('/dashboard');
    }

    public function jumlahKegiatan()
    {
        $jmlkegiatan = Kegiatan::count();
        return view('dashboard.dashboard', compact('jmlkegiatan'));
    }
}
