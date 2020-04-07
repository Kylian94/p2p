@extends('layouts.welcome')

@section('content')
    <a href="/" class="main-color fixed-top pt-5 pl-5"><img src="{{asset('images/back.png')}}" class="mr-3 img-fluid icon" alt="" srcset="">Retour</a>
    <div class="container">
        <div class="d-flex flex-column align-items-center justify-content-center vh-100 position-relative">
            {{-- <img src="{{asset('images/bg-p2p.png')}}" class="position-absolute bg-welcome" alt="" srcset=""> --}}
            <img src="{{asset('images/p2p-logo.png')}}" alt="" srcset="">
            
            <h2 class="mt-2">Connexion</h2>

            <div class="mt-3">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="email" class="col-md-6 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-6 col-form-label text-md-left">{{ __('Password') }}</label>

                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12 ">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Se souvenir de moi') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="d-flex flex-column align-items-center justify-content-center col-md-12">
                            <button type="submit" class="btn btn-main-color btn-rounded px-4 py-2">
                                {{ __('Login') }}
                            </button>
                            <a class="btn btn-link mt-2 text-secondary" href="{{ route('register') }}">
                                {{ __('Vous n\'avez pas de compte ?') }}
                            </a>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link mt-2 main-color" href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié ?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
