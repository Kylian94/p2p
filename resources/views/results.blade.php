@extends('layouts.app')

@section('content')
<div class="px-5">
    <h2>Les résultats de votre recherche :</h2>
    @foreach ($usersFounded as $userFounded)
    <div class="d-flex align-items-center justify-content-between p-3 bg-white mb-2">
        <a href="/user/{{$userFounded->id}}" class="d-flex align-items-center col-4">
            @if( $userFounded->imageProfile != null)
            <img class="avatar mr-3" src="{{ asset('images/userProfileImages/' . $userFounded->imageProfile ) }}" alt="" srcset="">
            @else 
            <img src="{{asset('images/avatar.jpeg')}}" class="avatar mr-3" alt="" srcset="">
            @endif
            <h5 class="mr-1 my-0 text-dark">{{$userFounded->firstname}}</h5>
            <h5 class="my-0 text-dark">{{$userFounded->lastname}}</h5>
        </a>
            
        <form action="/createFriend" method="post" class="mt-3">
            @csrf
            <input type="hidden" value={{$userFounded->id}} name="friend_id">
                @if(count($userFounded->friendsOfMine()->get()) || count($userFounded->friendOf()->get()))
                    <button type="button" class="btn btn-secondary btn-rounded btn-add disabled ">
                        <img src="{{asset('images/wait.png')}}" alt="" srcset="" class="icon-little"> 
                    </button>
                @elseif(count($userFounded->friendsOfMineAccepted()->get()) || count($userFounded->friendOfAccepted()->get())) 
                    <h6>Vous êtes amis</h6>
                @else
                    <button type="submit" class="btn btn-main-color btn-rounded btn-add ">
                        <img src="{{asset('images/add-user.png')}}" alt="" srcset="" class="icon-little"> 
                    </button>
                @endif  
        </form>
        
    </div>
    @endforeach
</div>

@endsection