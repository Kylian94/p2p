@extends('layouts.app')

@section('content')
<div class="px-5">
    @foreach ($posts as $post)
    <div class="d-flex align-items-center mt-4">
            <img src="{{asset('images/avatar.jpeg')}}" class="avatar mr-3" alt="" srcset="">
            <div class="d-flex flex-column">
                <h6 class="font-weight-bold m-0">{{$post->user->name}}</h6>
                <p class="m-0">{{$post->created_at->diffForHumans()}}</p>
            </div>
        </div>
        <div class="content  mt-3">
            <p>{{$post->content}}</p>
        </div>
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <img src="{{asset('images/heart.png')}}" class="icon" alt="" srcset="">
                <p class="my-0 ml-2">6 likes</p>
            </div>
            
            <div class="d-flex align-items-center">
                <img src="{{asset('images/comment.png')}}" class="icon " alt="" srcset="">
                <a id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" class="my-0 nav-item nav-link d-flex justify-content-center text-dark">15 commentaires</a>
            </div>
        </div>
    @endforeach
</div>

@endsection