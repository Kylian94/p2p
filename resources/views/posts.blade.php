@extends('layouts.app')

@section('content')
<div class="px-5">
    <h2>Tous mes posts</h2>
    @foreach ($posts as $post)
    <div class="bg-white mb-4 p-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img src="{{asset('images/avatar.jpeg')}}" class="avatar mr-3" alt="" srcset="">
                <div class="d-flex flex-column">
                    <h6 class="font-weight-bold m-0">{{$post->user->name}}</h6>
                    <p class="m-0">{{$post->created_at->diffForHumans()}}</p>
                </div>
            </div>
            <form action="/deletePost" method="post">
                @csrf
                <input name="id" type="hidden" value="{{$post->id}}">
                <button type="submit" class="btn btn-secondary btn-rounded" onclick="return confirm('Cette action est irréversible.. Souhaitez vous vraiment supprimer votre post ?')">X</button>
            </form>
            
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
    
        <hr class="w-100">
        <!-- NAV LIKE COMMENT-->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <!-- CHANGE A IN FORM TO LIKE -->
                <a class=" col-6 nav-item nav-link d-flex justify-content-center" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><img class="icon "src="{{asset('images/heart.png')}}" alt="" srcset="">
                    <p class="my-0 ml-2">J'aime</p>
                </a>
                <a class=" col-6 nav-item nav-link d-flex justify-content-center" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><img class="icon " src="{{asset('images/comment.png')}}" alt="" srcset="">
                    <p class="my-0 ml-2">Commenter</p>
                </a>
            </div>
        </nav>
        <!-- END NAV -->
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">...</div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <hr class="w-100">
                <!-- INPUT COMMENT -->
                <form action="#" method="post" class="mt-3">
                    <textarea name="post" id="post" placeholder="Répondre" class="col-12 p-3 bg-light"></textarea>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-rounded px-4 py-2 btn-main-color">Répondre</button>
                    </div>
                </form>
                <hr class="w-100">
                <!-- ALL COMMENTS -->
                <div class="d-flex flex-column px-5 ml-3">
                    <div class="d-flex align-items-center mt-3">
                        <img src="{{asset('images/avatar.jpeg')}}" class="avatar mr-3" alt="" srcset="">
                        <div class="d-flex flex-column">
                            <h6 class="font-weight-bold m-0">Kylian Petitgenet</h6>
                            <p class="m-0">17 min</p>
                        </div>
                    </div>
                    <div class="content  mt-3">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa obcaecati eveniet beatae quas! Veniam quae sint, dolores expedita voluptatem praesentium, ipsum, itaque quidem sunt debitis deserunt reiciendis nostrum quia corporis!</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <img src="{{asset('images/heart.png')}}" class="icon" alt="" srcset="">
                            <p class="my-0 ml-2">6 likes</p>
                        </div>
                    </div>
                </div>
                <!-- END COMMENTS -->
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection