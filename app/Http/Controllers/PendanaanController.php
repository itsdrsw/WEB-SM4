<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PendanaanController extends Controller
{
    //
    public function index()
    {
        $user = User::orderBy('name', 'asc')->get();

        return view('pendanaan.pendanaan', [
            'user' => $user
        ]);
    }
}
