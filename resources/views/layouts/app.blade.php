<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Peer2Pear</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <main class="py-4">
            <div class="d-flex flex-wrap">

                <div class="col-3 d-flex flex-column align-items-end pr-5 sticky-top mt-4">
                    <div class=" d-flex" href="{{ url('/home') }}">
                        <img src="{{asset('images/p2p-logo.png')}}" class="icon" alt="" srcset=""><h2 class="m-0">Peer2Pear</h2> 
                    </div>
                    <a href="/home" class="mt-5 text-secondary"><h3>Accueil</h3></a>
                    <a href="/profil" class="mt-3 text-secondary"><h3>Mon profil</h3></a>
                    <a href="/friends" class="mt-3 text-secondary"><h3>Mes amis</h3></a>
                    <a href="/posts" class="mt-3 text-secondary"><h3>Mes posts</h3></a>
                    <a href="/comments" class="mt-3 text-secondary"><h3>Mes commentaires</h3></a>
                    <a class="btn btn-rounded px-4 py-2 btn-secondary mt-5" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Déconnexion') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>

                <div class="col-6 border-left border-right main-part pt-4">
                        @yield('content')
                </div>

                <div class="col-3 sticky-top mt-4">
                    <h3 class="text-secondary  mb-4">Vous connaissez peut-être...</h3>
                    @foreach($users as $user)
                    <!-- SUGGEST USER -->
                    @php 
                        $userAccepted = App\Friend::where('friend_id', $user->id)
                                            ->where('user_id', Auth::user()->id)
                                            ->where('isAccepted', 1)
                                            ->get();

                        $friendAccepted = App\Friend::where('friend_id', Auth::user()->id)
                                            ->where('user_id', $user->id)
                                            ->where('isAccepted', 1)
                                            ->get();
                    @endphp
                    @if(count($userAccepted) || count($friendAccepted))
                    @else
                    @if($user->id != Auth::user()->id)
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="/user/{{$user->id}}" class="d-flex align-items-center col-4">
                            <img src="{{asset('images/avatar.jpeg')}}" class="avatar mr-3" alt="" srcset="">
                            <h5 class="mr-1 my-0 text-dark">{{$user->firstname}}</h5>
                            <h5 class="my-0 text-dark">{{$user->lastname}}</h5>
                        </a>
                        
                        @php
                            $userFriends = App\Friend::where('friend_id', $user->id)->where('user_id', Auth::user()->id)->get();
                        @endphp
                            
                       
                        <form action="/createFriend" method="post" class="mt-3">
                            @csrf
                            <input type="hidden" value={{$user->id}} name="friend_id">
                                 @if(count($userFriends))
                                 <button type="button" class="btn btn-secondary btn-rounded btn-add disabled ">
                                        <img src="{{asset('images/wait.png')}}" alt="" srcset="" class="icon-little"> 
                                    </button>
                                @else 
                                <button type="submit" class="btn btn-main-color btn-rounded btn-add ">
                                        <img src="{{asset('images/add-user.png')}}" alt="" srcset="" class="icon-little"> 
                                    </button>
                                @endif  
                        </form>
                        
                    </div>
                    <hr class="w-100">
                    @endif
                    @endif
                    @endforeach
                    <!-- END SUGGEST USER-->
                    {{ $users->links() }}
                </div>
                
            </div>
        </main>
    </div>
</body>
</html>
