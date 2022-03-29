<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Yang anda masukkan bukan email',
            'email.unique' => 'Email yang anda masukan sudah terdaftar',
            'password.required' => 'Password harud diisi'
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);


        $token = $user->createToken('token')->plainTextToken;
        event(new Registered($user));

        return response()
            ->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer',], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Yang anda masukkan bukan email',
            'password.required' => 'Password harus diisi'
        ]);

        $user = User::where('email', $request['email'])->first();
        if ($user) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $token = $user->createToken('token')->plainTextToken;
                return response()->json([
                    'message' => 'Hi ' . $user->name . ', welcome to home',
                    'email' => $user->email,
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ], 200);
            } else {
                return response()->json(['message' => 'Password yang anda masukan salah'], 401);
            }
        } else {
            return response()->json(['message' => 'Email yang anda masukan belum terdaftar'], 401);
        }
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();
        // session()->forget('user');

        return response()->json(['message' => 'Anda berhasil logout'], 200);
    }
}
