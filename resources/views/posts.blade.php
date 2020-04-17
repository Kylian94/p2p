@extends('layouts.app')

@section('content')
<div class="px-5">
    <h2 class="mt-5">Tous mes posts</h2>
    <hr>
    @if(count($posts) != 0)
    
    @foreach ($posts as $post)

    <div class="bg-white mb-4 p-3">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                @if( $post->user->imageProfile != null)
                <img class="avatar mr-3" src="{{ asset('images/userProfileImages/' . $post->user->imageProfile ) }}" alt="" srcset="">
                @else 
                <img src="{{asset('images/avatar.jpeg')}}" class="avatar mr-3" alt="" srcset="">
                @endif
                
                <div class="d-flex flex-column">
                    <div class="d-flex">
                            <h6 class="font-weight-bold m-0">{{$post->user->firstname}}</h6>
                            <h6 class="font-weight-bold my-0 ml-1">{{$post->user->lastname}}</h6>
                    </div>
                    
                    <p class="m-0">{{$post->created_at->diffForHumans()}}</p>
                </div>
            </div>
            <form action="/deletePost" method="post">
                @csrf
                <input name="id" type="hidden" value="{{$post->id}}">
                <button type="submit" class="btn btn-secondary btn-rounded" onclick="return confirm('Cette action est irréversible.. Souhaitez vous vraiment supprimer votre post ?')">X</button>
            </form>
            
        </div>
        @if($post->image)
            <div class="image  mt-3">
                <img class="post-image" src="{{asset('images/postImages/' . $post->image)}}"/>
            </div>
        @endif
        <div class="content  mt-3">
            <p>{{$post->content}}</p>
        </div>
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                @if(count($post->likes()->get()))
                <img src="{{asset('images/heart-fill.png')}}" class="icon" alt="" srcset="">
                @else
                <img src="{{asset('images/heart.png')}}" class="icon" alt="" srcset="">
                @endif
                @if(count($post->likes()->get()) <= 1 )
                <p class="my-0 ml-2">{{count($post->likes()->get())}} like</p>
                @else 
                <p class="my-0 ml-2">{{count($post->likes()->get())}} likes</p>
                @endif
            </div>
            
            <div class="d-flex align-items-center">
                <img src="{{asset('images/comment.png')}}" class="icon " alt="" srcset="">
                <a id="nav-profile-tab" data-toggle="tab" href="#nav-profile{{$post->id}}" role="tab" aria-controls="nav-profile" aria-selected="false" class="my-0 nav-item nav-link d-flex justify-content-center text-dark">{{count($post->comments()->get())}} 
                    @if(count($post->comments()->get()) <= 1 )
                    commentaire
                    @else
                    commentaires
                    @endif
                </a>
            </div>
        </div>
    
        <hr class="w-100">
        <!-- NAV LIKE COMMENT-->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <!-- CHANGE A IN FORM TO LIKE -->
                <div class=" col-6 d-flex justify-content-center">
                    @if(count($post->likes()->get()))
                    <form  action="/deleteLike" method="post">
                        @csrf
                        <input type="hidden" value={{$post->id}} name="post_id">
                        <button type="submit " class="btn btn-none text-primary btn-rounded">J'aime plus</button>
                    </form>
                    @else 
                    <form  action="/createLike" method="post">
                        @csrf
                        <input type="hidden" value={{$post->id}} name="post_id">
                        <button type="submit " class="btn btn-none text-primary btn-rounded">J'aime</button>
                    </form>
                    @endif 
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
            
                @foreach ($post->comments()->get() as $comment)
                <div class="d-flex flex-column px-5 ml-3">
                        <div class="d-flex align-items-center mt-3">
                            @if( $comment->user->imageProfile != null)
                            <img class="avatar mr-3" src="{{ asset('images/userProfileImages/' . $comment->user->imageProfile ) }}" alt="" srcset="">
                            @else 
                            <img src="{{asset('images/avatar.jpeg')}}" class="avatar mr-3" alt="" srcset="">
                            @endif
                            
                            <div class="d-flex flex-column">
                                    <a @if($comment->user->id == Auth::user()->id) href="/profil" @else href="/user/{{$comment->user->id}}" @endif class="d-flex">
                                            <h6 class="font-weight-bold m-0">{{$comment->user->firstname}}</h6>
                                            <h6 class="font-weight-bold my-0 ml-1">{{$comment->user->lastname}}</h6>
                                    </a>
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
    @else
    <div class="d-flex flex-column align-items-center mt-5 p-5 bg-white rounded">
        <p>Vous n'avez pas encore posté...</p>
        <a href="/home" class="btn btn-rounded btn-main-color px-4 py-2">Publier maintenant</a>
    </div>
    
    
    @endif
</div>

@endsection