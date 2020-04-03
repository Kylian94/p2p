<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand d-flex" href="{{ url('/home') }}">
                   <img src="{{asset('images/p2p-logo.png')}}" class="icon" alt="" srcset=""><p class="m-0">Peer2Pear</p> 
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Mon compte <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <h4 class="dropdown-item">{{Auth::user()->name}}</h4>
                                    <a class="dropdown-item" href="{{ route('profil') }}">
                                         {{ __('Profil') }}
                                     </a>
                                     <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Déconnexion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="d-flex flex-wrap">

                <div class="col-3 d-flex flex-column align-items-end pr-5 sticky-top mt-10">
                    <a href="/home" class="mt-5 text-secondary"><h3>Accueil</h3></a>
                    <a href="/friends" class="mt-3 text-secondary"><h3>Amis</h3></a>
                    <a href="/posts" class="mt-3 text-secondary"><h3>Posts</h3></a>
                    <a href="/comments" class="mt-3 text-secondary"><h3>Comments</h3></a>
                </div>

                <div class="col-6 border-left border-right main-part">
                        @yield('content')
                </div>

                <div class="col-3 sticky-top mt-10">
                    <h3 class="text-secondary mt-5 mb-4">Vous connaissez peut-être...</h3>
                    @foreach($users as $user)
                    <!-- SUGGEST USER -->
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="/user/{{$user->id}}" class="d-flex align-items-center col-4">
                            <img src="{{asset('images/avatar.jpeg')}}" class="avatar mr-3" alt="" srcset="">
                            <h5 class="mr-3 my-0">{{$user->name}}</h5>
                        </a>
                        
                        @php
                            $userFriends = App\Friend::where('friend_id', $user->id)->get();
                            
                        @endphp
                            
                       
                        <form action="/createFriend" method="post" class="mt-3">
                            @csrf
                            <input type="hidden" value={{$user->id}} name="friend_id">
                            
                                
                                @if(count($userFriends))
                                invité
                                @else
                                <button type="submit" class="btn btn-main-color btn-rounded btn-add ">
                                        <img src="{{asset('images/add-user.png')}}" alt="" srcset="" class="icon-little"> 
                                    </button>
                                @endif
                            
                            
                        </form>
                        
                    </div>
                    <hr class="w-100">
                    @endforeach
                    <!-- END SUGGEST USER-->
                    {{ $users->links() }}
                </div>
                
            </div>
        </main>
    </div>
</body>
</html>
