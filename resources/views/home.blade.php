@extends('layouts.app')

@section('content')

    <h1 class="px-5 mt-5">Hello {{Auth::user()->name}},<br>
        Quoi de beau aujourd'hui ?
    </h1>
    <form action="#" method="post" class="px-5 mt-3">
        <textarea name="post" id="post" placeholder="Partagez vos idées ici..." class="col-12 p-3"></textarea>
        <button type="submit" class="btn btn-rounded px-4 py-2 btn-main-color float-right">Publier</button>
    </form>

@endsection
