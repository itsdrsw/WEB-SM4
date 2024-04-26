<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LPJController extends Controller
{
    //
    public function index()
    {
        $user = User::orderBy('name', 'asc')->get();

        return view('lpj.lpj', [
            'user' => $user
        ]);
    }
}
