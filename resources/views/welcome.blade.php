@extends('layouts.welcome')

@section('content')
<div class="container">
    <div class="d-flex flex-column align-items-center justify-content-center vh-100 position-relative">
        <img src="{{asset('images/bg-p2p.png')}}" class="position-absolute bg-welcome" alt="" srcset="">
        <img src="{{asset('images/p2p-logo.png')}}" alt="" srcset="">
        <h1 class="mt-3">Bienvenue sur Peer 2 pear</h1>
        <div class="d-flex align-items-center mt-4">
            <a href="{{ route('login') }}" class="btn btn-rounded btn-main-color px-4 py-2">Connexion</a>
            <a href="{{ route('register') }}" class=" main-color ml-3">Créer un compte</a>
        </div>
        <a href="/about" class="fixed-bottom text-secondary text-center pb-5">Peer 2 Pear, qu'est ce que c'est ?</a>
    </div>
</div>
@endsection