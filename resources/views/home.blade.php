@extends('layouts.app')

@section('content')
    <div class="px-5">
        <div class="d-flex align-items-center mt-3">
            <a href="{{ route('profil') }}">
                <img src="{{asset('images/avatar.jpeg')}}" class="main-avatar mr-3" alt="" srcset="">
            </a>
            <h1 class="">Hello {{Auth::user()->name}},<br>
                Quoi de beau aujourd'hui ?
            </h1>
        </div>
        <form action="/createPost" method="post" class="mt-3">
            @csrf
            <textarea name="content" id="post" placeholder="Partagez vos idées ici..." class="col-12 p-3"></textarea>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-rounded px-4 py-2 btn-main-color">Publier</button>
            </div>
        </form>
        <hr>
        <h3>Votre actualité</h3>
        @foreach ($posts as $post)
        <div class="d-flex flex-column bg-white p-3 rounded mb-4">
            <!-- POST -->
            
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
                        @if(count($post->likes()->get()) <= 1 )
                        <p class="my-0 ml-2">{{count($post->likes()->get())}} like</p>
                        @else 
                        <p class="my-0 ml-2">{{count($post->likes()->get())}} likes</p>
                        @endif
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <img src="{{asset('images/comment.png')}}" class="icon " alt="" srcset="">
                        <a id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" class="my-0 nav-item nav-link d-flex justify-content-center text-dark">{{count($post->comments()->get())}} 
                            @if(count($post->comments()->get()) <= 1 )
                            commentaire
                            @else
                            commentaires
                            @endif
                        </a>
                    </div>
                </div>
            
            <!-- END POST -->
            <hr class="w-100">
            <!-- NAV LIKE COMMENT-->
            @php 
            $like = App\Like::where([
                'user_id' => Auth::user()->id,
                'post_id' => $post->id
                ])->get();
            
            @endphp
            @if(count($like))
            <form  action="/deleteLike" method="post">
                @csrf
                <input type="hidden" value={{$post->id}} name="post_id">
                <button type="submit " class="btn btn-main-color btn-rounded">J'aime plus</button>
            </form>
            @else 
            <form  action="/createLike" method="post">
                @csrf
                <input type="hidden" value={{$post->id}} name="post_id">
                <button type="submit " class="btn btn-main-color btn-rounded">J'aime</button>
            </form>
            @endif
            
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <!-- CHANGE A IN FORM TO LIKE -->
                    <div class=" col-6 d-flex justify-content-center">
                            
                    </div>
                    
                    <a class=" col-6 nav-item nav-link d-flex justify-content-center" id="nav-profile-tab{{$post->id}}" data-toggle="tab" href="#nav-profile{{$post->id}}" role="tab" aria-controls="nav-profile" aria-selected="false"><img class="icon " src="{{asset('images/comment.png')}}" alt="" srcset="">
                        <p class="my-0 ml-2">Commenter</p>
                    </a>
                </div>
            </nav>
            <!-- END NAV -->
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade" id="nav-profile{{$post->id}}" role="tabpanel" aria-labelledby="nav-profile-tab{{$post->id}}">
                    <hr class="w-100">
                    <!-- INPUT COMMENT -->
                    <form action="/createComment" method="post" class="mt-3">
                        @csrf
                        <input type="hidden" value={{$post->id}} name="post_id">
                        <textarea name="content" id="post" placeholder="Répondre" class="col-12 p-3 bg-light"></textarea>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-rounded px-4 py-2 btn-main-color">Répondre</button>
                        </div>
                    </form>
                    <hr class="w-100">
                    <!-- ALL COMMENTS -->
                    @php
                    $comments = App\Post::find($post->id)->comments
                    @endphp
                    
                    @foreach ($comments as $comment)
                    <div class="d-flex flex-column px-5 ml-3">
                            <div class="d-flex align-items-center mt-3">
                                <img src="{{asset('images/avatar.jpeg')}}" class="avatar mr-3" alt="" srcset="">
                                <div class="d-flex flex-column">
                                    <h6 class="font-weight-bold m-0">{{$comment->user->name}}</h6>
                                    <p class="m-0">{{$comment->created_at->diffForHumans()}}</p>
                                </div>
                            </div>
                            <div class="content  mt-3">
                                <p>{{$comment->content}}</p>
                            </div>
                        </div>
                        <hr class="w-75 align-right">
                    @endforeach
                    
                    <!-- END COMMENTS -->
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
    
@endsection
