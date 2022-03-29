<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function attemptLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Yang anda masukan bukan email',
            'password.required' => 'Password harus diisi'
        ]);


        $user = User::where('email', $request['email'])->first();
        
        if ($user) {
            if (Auth::attempt($credentials, $request->remember)) {
                $request->session()->regenerate();

                return response()->json(['user'=>auth()->user()]);
            }
            return response()->json(['error' => 'Password yang anda masukan salah']);
        }
        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ]);
        return response()->json(['error' => 'Email yang anda masukan tidak terdaftar']);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function attemptRegister(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'min:5|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:5'
        ], [
            'name.required' => 'Nama harus diisi',
            'name.min' => 'Nama minimal harus 5 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Yang anda masukan bukan email',
            'email.unique' => 'Email yang anda masukan sudah terdaftar',
            'password.required_with' => 'Password dan konfirmasi password harus diisi',
            'password.min' => 'Password minimal 5 karakter',
            'password.same' => 'Password dan konfirmasi password tidak sama',
            'password_confirmation.min' => 'Konfirmasi password minimal 5 karakter',
        ]);

        $data = $user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),

        ]);

        Auth::login($data);
        // return redirect()->route('verification.notice')->with('message', 'Selamat anda telah terdaftar pada sistem kami, silahkan verifikasi link akun anda yang terkirim ke email anda');
        return response()->json(['data' => $data, 'message' => 'Data berhasil di tambahkan']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');

        // return response()->json(['message'=>'Anda berhasil keluar']);
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $account = User::where('email', $user->email)->first();


        if ($account->provider_id == null) {
            $account->update([
                'provider' => $provider,
                'provider_id' => $user->id
            ]);
            $authUser = $this->findOrCreateUser($user, $provider);
        }
        try {
            $authUser = $this->findOrCreateUser($user, $provider);
            Auth::login($authUser, true);
            return redirect('/home');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


    public function findOrCreateUser($user, $provider)
    {

        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {

            return $authUser;
        } else {

            $data = User::create([
                'name'     => $user->name,
                'email'    => !empty($user->email) ? $user->email : '',
                'password' => bcrypt($user->email),
                'provider' => $provider,
                'provider_id' => $user->id
            ]);
            return $data;
        }
    }

    public function forgot()
    {
        return view('auth.passwords.email');
    }
}
