<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email yang anda masukan tidak valid'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return ['status' => __('Silahkan periksa email anda untuk verifikasi reset password')];
        }

        throw ValidationException::withMessages([
            'email' => [trans('Email yang anda masukan belum terdaftar')]
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', RulesPassword::defaults()]
        ], [
            'token.required' => 'Token harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Yang anda masukan bukan email',
            'password.required' => 'Password harus diisi'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => bcrypt($request->password),
                    'remember_token' => Str::random(80)
                ])->save();

                event(new PasswordReset($user));
            }

        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message' => 'Password berhasil diubah'
            ]);
        }

        return response(['message' => __($status)], 500);
    }
}
