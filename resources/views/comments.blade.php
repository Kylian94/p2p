@extends('layouts.app')

@section('content')
<div class="px-5">
    <h2 class="mt-5">Tous mes commentaires</h2>
    <hr>
    @if(count($comments) != 0)
    
    @foreach ($comments as $comment)
    <div class="bg-white mb-4 p-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="{{asset('images/avatar.jpeg')}}" class="avatar mr-3" alt="" srcset="">
                <div class="d-flex flex-column">
                    <div class="d-flex">
                            <h6 class="font-weight-bold m-0">{{$comment->user->firstname}}</h6>
                            <h6 class="font-weight-bold my-0 ml-2">{{$comment->user->lastname}}</h6>
                    </div>
                    
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
    </div>
    
    
    @endif
</div>

@endsection