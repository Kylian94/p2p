@extends('layouts.welcome')

@section('content')
<div class="container">
    <div class="d-flex flex-column align-items-center justify-content-center vh-100 position-relative">
        <img src="{{asset('images/bg-p2p.png')}}" class="position-absolute bg-welcome" alt="" srcset="">
        <img src="{{asset('images/p2p-logo.png')}}" alt="" srcset="">
        <h1 class="mt-3">Peer 2 pear, c'est quoi ?</h1>
        <div class="d-flex flex-column  align-items-center mt-4">
            <p>Peer 2 Pear est un réseau social permettant de partager,<br>
                commenter et discuter de ses idées.<br>
                <br>
            Il te suffit créer un compte et de partager au monde entier !</p>
            <a href="{{ route('register') }}" class="btn btn-rounded btn-main-color px-4 py-2 mt-3">Créer un compte</a>
        </div>
        <a href="/" class="fixed-bottom text-secondary text-center pb-5">Retour</a>
    </div>
</div>
@endsection