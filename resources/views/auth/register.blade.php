@extends('layouts.welcome')

@section('content')
<a href="/" class="main-color fixed-top pt-5 pl-5"><img src="{{asset('images/back.png')}}" class="mr-3 img-fluid icon" alt="" srcset="">Retour</a>

<div class="container">
    <div class="d-flex flex-column align-items-center justify-content-center vh-100 position-relative">
        {{-- <img src="{{asset('images/bg-p2p.png')}}" class="position-absolute bg-welcome" alt="" srcset=""> --}}
        <img src="{{asset('images/p2p-logo.png')}}" alt="" srcset="">
        
        <h2 class="mt-2">Inscription</h2>
    
        <div class="">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group row">
                        <label for="lastname" class="col-md-6 col-form-label text-md-left">{{ __('Nom') }}</label>
    
                        <div class="col-md-12">
                            <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                <div class="form-group row">
                    <label for="firstname" class="col-md-6 col-form-label text-md-left">{{ __('Prénom') }}</label>

                    <div class="col-md-12">
                        <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="email" class="col-md-6 col-form-label text-md-left">{{ __('Adresse email') }}</label>

                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-6 col-form-label text-md-left">{{ __('Mot de passe') }}</label>

                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-8 col-form-label text-md-left">{{ __('Confirmation du mot de passe') }}</label>

                    <div class="col-md-12">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                        <div class="d-flex flex-column align-items-center justify-content-center col-md-12">
                                <button type="submit" class="btn btn-main-color btn-rounded px-4 py-2">
                                    {{ __('S\'inscire') }}
                                </button>
                                <a class="btn btn-link mt-2 text-secondary" href="{{ route('login') }}">
                                    {{ __('Vous avez déja un compte ?') }}
                                </a>
                                
                            </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
