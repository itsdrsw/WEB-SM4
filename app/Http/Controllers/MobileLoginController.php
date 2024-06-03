<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MobileLoginController extends Controller
{
    public function register(Request $request)
    {
        $akun = User::create($request->all());
        return response()->json(['message' => 'Success', 'data' => $akun]);
    }

    public function loginApi(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($loginData)) {
            $token = Auth::user()->createToken('authToken')->plainTextToken;
            return response()->json([
                'token' => $token,
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid Credentials',
        ], 400);
    }

    public function getUserData()
    {
        $user = Auth::user();

        if ($user) {
            return response()->json([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'ketua' => $user->ketua,
            ]);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function changePassword(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->password = Hash::make($password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);
    }

    public function update(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'ketua' => 'required|string',
        ]);

        $user = Auth::user();

        if ($user) {

            $user->name = $request->name;
            $user->email = $request->email;
            $user->ketua = $request->ketua;

            $user->save();

            return response()->json(['message' => 'User data updated successfully']);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    public function validateOldPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
        ]);

        $user = Auth::user();

        if (!$user || !Hash::check($request->old_password, $user->password)) {
            return response()->json(['error' => 'Invalid old password'], 401);
        }

        return response()->json(['message' => 'Old password is valid']);
    }
}
