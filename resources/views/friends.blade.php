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
            
            @foreach($friendsAccepted as $friendAccepted)
                @php
                    $userFriendsAccepted = App\User::where('id', $friendAccepted->friend_id)->orWhere('id', $friendAccepted->user_id)->get();
                @endphp
                @foreach($userFriendsAccepted as $userFriendAccepted)
                <div class="col-12 d-flex justify-content-between align-items-center p-3 bg-white rounded mt-2">
                    <h5>{{$userFriendAccepted->name}}</h5>
                    <form action="/deleteFriend" method="post">
                        @csrf
                        <input type="hidden" value="{{$userFriendAccepted->id}}" name="friend_id">
                        <button type="submit" class="btn btn-main-color btn-rounded">Supprimer</button>
                    </form>
                    
                </div>
                
                @endforeach
            @endforeach
            
        </div>


        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                @foreach($askedFriends as $askedFriend)
                @php
                    $askFriends = App\User::where('id', $askedFriend->user_id)->get();
                @endphp
                @foreach($askFriends as $askFriend)
                <div class="col-12 d-flex justify-content-between align-items-center p-3 bg-white rounded mt-2">
                    <h5>{{$askFriend->name}}</h5>
                    <form action="/acceptFriend" method="post">
                        @csrf
                        <input type="hidden" value="{{$askFriend->id}}" name="friend_id">
                        <button type="submit" class="btn btn-main-color btn-rounded">Accepter</button>
                    </form>
                    
                </div>
                @endforeach
            @endforeach
        </div>


        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                @foreach($allFriends as $allFriend)
                    @php
                        $userFriends = App\User::where('id', $allFriend->friend_id)->get();
                    @endphp
                    @foreach($userFriends as $userFriend)
                    <div class="col-12 d-flex justify-content-between align-items-center p-3 bg-white rounded mt-2">
                            <h5>{{$userFriend->name}}</h5>
                            <form action="/deleteFriend" method="post">
                                @csrf
                                <input type="hidden" value="{{$userFriend->id}}" name="friend_id">
                                <button type="submit" class="btn btn-main-color btn-rounded">Supprimer</button>
                            </form>
                            
                        </div>
                    @endforeach
                @endforeach
        </div>
    </div>
</div>

@endsection