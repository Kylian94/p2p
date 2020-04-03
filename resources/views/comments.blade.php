@extends('layouts.app')

@section('content')
<div class="px-5">
    <h2>Tous mes commentaires</h2>
    @if(count($comments) != 0)
    
    @foreach ($comments as $comment)
    <div class="bg-white mb-4 p-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="{{asset('images/avatar.jpeg')}}" class="avatar mr-3" alt="" srcset="">
                <div class="d-flex flex-column">
                    <h6 class="font-weight-bold m-0">{{$comment->user->name}}</h6>
                    <p class="m-0">{{$comment->created_at->diffForHumans()}}</p>
                </div>
            </div>
            <form action="/deleteComment" method="post">
                @csrf
                <input name="id" type="hidden" value="{{$comment->id}}">
                <button type="submit" class="btn btn-secondary btn-rounded" onclick="return confirm('Cette action est irréversible.. Souhaitez vous vraiment supprimer votre comment ?')">X</button>
            </form>
            
        </div>
        <div class="content  mt-3">
            <p>{{$comment->content}}</p>
        </div>
    </div>
    @endforeach
    @else
    <div class="d-flex flex-column align-items-center mt-5 p-5 bg-white rounded">
        <p>Vous n'avez pas encore commenté...</p>
        <a href="/home" class="btn btn-rounded btn-main-color px-4 py-2">Publier maintenant</a>
    </div>
    
    
    @endif
</div>

@endsection