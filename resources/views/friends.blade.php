@extends('layouts.app')

@section('content')
<div class="px-5 mt-5">
    <h2>Mes amis</h2>
    <hr>
    <nav class="mt-3">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active col-4" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Tous mes amis</a>
            <a class="nav-item nav-link col-4" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Demandes reçues</a>
            <a class="nav-item nav-link col-4" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Demandes envoyées</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
             
            @foreach($user->friendsAccepted as $friend)
                <div class="col-12 d-flex justify-content-between align-items-center p-3 bg-white rounded mt-2">
                    <a href="/user/{{$friend->id}}" class="d-flex align-items-center">
                        <img src="{{asset('images/avatar.jpeg')}}" class="icon" alt="" srcset="">
                        <h5 class="ml-3 my-0">{{$friend->name}}</h5>
                    </a>
                    <form action="/deleteFriend" method="post">
                        @csrf
                        <input type="hidden" value="{{$friend->id}}" name="friend_id">
                        <button type="submit" class="btn btn-main-color btn-rounded">Supprimer</button>
                    </form>  
                </div>
            @endforeach
            @foreach($user->friendOfAccepted as $friend)
                <div class="col-12 d-flex justify-content-between align-items-center p-3 bg-white rounded mt-2">
                    <a href="/user/{{$friend->id}}" class="d-flex align-items-center">
                        <img src="{{asset('images/avatar.jpeg')}}" class="icon" alt="" srcset="">
                        <h5 class="ml-3 my-0">{{$friend->name}}</h5>
                    </a>
                    <form action="/deleteFriend" method="post">
                        @csrf
                        <input type="hidden" value="{{$friend->id}}" name="friend_id">
                        <button type="submit" class="btn btn-main-color btn-rounded">Supprimer</button>
                    </form>
                    
                </div>
            @endforeach
            @if(count($user->friendOfAccepted) == 0 && count($user->friendsAccepted) == 0)
            <div class="mt-4 p-3 d-flex justify-content-center bg-white d-flex">
                <p>Vous n'avez pas encore d'amis</p>
            </div>
            @endif
        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            @foreach($user->friendOf as $friend)
                <div class="col-12 d-flex justify-content-between align-items-center p-3 bg-white rounded mt-2">
                    
                    <a href="/user/{{$friend->id}}" class="d-flex align-items-center">
                        <img src="{{asset('images/avatar.jpeg')}}" class="icon" alt="" srcset="">
                        <h5 class="ml-3 my-0 ">{{$friend->name}}</h5>
                    </a>
                    
                    <form action="/acceptFriend" method="post">
                        @csrf
                        <input type="hidden" value="{{$friend->id}}" name="friend_id">
                        <button type="submit" class="btn btn-main-color btn-rounded">Accepter</button>
                    </form>
                </div>
            @endforeach
            @if(count($user->friendOf) == 0)
            <div class="mt-4 p-3 justify-content-center bg-white d-flex">
                <p>Vous n'avez pas reçu de demande d'amis</p>
            </div>
            @endif
        </div>

        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            @foreach($user->friendsOfMine as $friend)
                <div class="col-12 d-flex justify-content-between align-items-center p-3 bg-white rounded mt-2">
                    <a href="/user/{{$friend->id}}" class="d-flex align-items-center">
                        <img src="{{asset('images/avatar.jpeg')}}" class="icon" alt="" srcset="">
                        <h5 class="ml-3 my-0">{{$friend->name}}</h5>
                    </a>
                    <form action="/deleteFriend" method="post">
                        @csrf
                        <input type="hidden" value="{{$friend->id}}" name="friend_id">
                        <button type="submit" class="btn btn-main-color btn-rounded">Supprimer</button>
                    </form>
                        
                </div>
            @endforeach
            @if(count($user->friendsOfMine) == 0)
            <div class="mt-4 p-3 justify-content-center bg-white d-flex">
                <p>Vous n'avez pas fait de demande d'amis</p>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection