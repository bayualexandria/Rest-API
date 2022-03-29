@extends('layouts.app')

@section('content')
    {{-- <div class="container mx-auto">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                @if (session('messageError'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('messageError') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>
                                @endif
                            </div>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0 row">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <div class="flex px-2 mt-3 text-center">
                            <a href="{{ route('auth-provider', 'google') }}"
                                class="border rounded-circle btn btn-sm overly border-danger">
                                <i class="fab fa-google text-danger"></i>
                            </a>
                            <a href="{{ route('auth-provider', 'facebook') }}"
                                class="border rounded-circle btn btn-sm overly border-primary">
                                <i class="fab fa-facebook text-primary"></i>
                            </a>
                            <a href="{{ route('auth-provider', 'twitter') }}"
                                class="border rounded-circle btn btn-sm overly border-info">
                                <i class="fab fa-twitter text-info"></i>
                            </a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div> --}}
<div id="login" endpoint={{ route('login') }}></div>  
@endsection


