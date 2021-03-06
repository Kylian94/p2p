@extends('layouts.app')

@section('content')
<div class="px-5 mt-5">

    @if( $user->bannerImage != null)
    <img id="banner-image" class="position-relative img-banner" src="{{ asset('images/userBannerImages/' . $user->bannerImage ) }}" alt="" srcset="">
    @else 
    <img id="banner-image" class="position-relative img-banner" src="{{asset('images/banner-default.png')}}" alt="" srcset="">
    @endif
    
    @if( $user->imageProfile != null)
    <img id="profile-image" class="position-absolute img-profil img-thumbnail" src="{{ asset('images/userProfileImages/' . $user->imageProfile ) }}" alt="" srcset="">
    @else 
    <img id="profile-image" class="position-absolute img-profil img-thumbnail" src="{{asset('images/avatar.jpeg')}}" alt="" srcset="">
    @endif

    <div class="d-flex pt-4 mt-5">
            <h2 class="mr-1">{{$user->firstname}}</h2>
            <h2>{{$user->lastname}}</h2>

    </div>
    
    <div class="d-flex">
        <p>{{$nbFriends}} Amis</p>
        <p class="mx-3"> | </p>
        <p>{{count($comments)}} Commentaires</p>
        <p class="mx-3"> | </p>
        <p>{{count($likes)}} J'aime</p>
    </div>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione laborum cupiditate voluptates laboriosam natus, doloribus vitae itaque excepturi. Dolorem, velit nostrum incidunt nam veritatis expedita dolorum qui corrupti id molestias.</p>
    <hr>
   
   @if(count($user->friendsOfMineAccepted()->get()) || count($user->friendOfAccepted()->get()))

   <p>You are friend</p>
 
   @foreach($posts as $post)
   <div class="d-flex flex-column bg-white p-3 rounded mb-4">
         <!-- POST -->
             
             <div class="d-flex align-items-center mt-4">
                    @if( $post->user->imageProfile != null)
                    <img class="avatar mr-3" src="{{ asset('images/userProfileImages/' . $post->user->imageProfile ) }}" alt="" srcset="">
                    @else 
                    <img src="{{asset('images/avatar.jpeg')}}" class="avatar mr-3" alt="" srcset="">
                    @endif                 <div class="d-flex flex-column">
                    <a href="/user/{{$post->user->id}}" class="d-flex">
                            <h6 class="font-weight-bold m-0">{{$post->user->firstname}}</h6>
                            <h6 class="font-weight-bold my-0 ml-1">{{$post->user->lastname}}</h6>
                     </a>
                     
                     <p class="m-0">{{$post->created_at->diffForHumans()}}</p>
                 </div>
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
         
         <!-- END POST -->
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
                 
                 <a class=" col-6 nav-item nav-link d-flex justify-content-center" id="nav-profile-tab{{$post->id}}" data-toggle="tab" href="#nav-profile{{$post->id}}" role="tab" aria-controls="nav-profile" aria-selected="false">
                     {{-- <img class="icon " src="{{asset('images/comment.png')}}" alt="" srcset=""> --}}
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
                 <div class="d-flex flex-column ml-5  bg-light py-3 px-5 mb-2">
                     <div class="d-flex align-items-center mt-3 ">
                            @if( $comment->user->imageProfile != null)
                            <img class="avatar mr-3" src="{{ asset('images/userProfileImages/' . $comment->user->imageProfile ) }}" alt="" srcset="">
                            @else 
                            <img src="{{asset('images/avatar.jpeg')}}" class="avatar mr-3" alt="" srcset="">
                            @endif                         <div class="d-flex flex-column">
                                <a href="/user/{{$post->user->id}}" class="d-flex">
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
                     
                 @endforeach
                 <!-- END COMMENTS -->
             </div>
         </div>
     </div>

   @endforeach
   
   @else 
   <div class="d-flex justify-content-between align-items-center">
        <p class="mt-3">Vous n'êtes pas encore amis...</p>                                     
        <form action="/createFriend" method="post" class="mt-3">
            @csrf
            
            <input type="hidden" value={{$user->id}} name="friend_id">
            
                @if(count($user->friendsOfMine()->get()) || count($user->friendOf()->get()))
                    
                    <button type="button" class="btn btn-secondary btn-rounded btn-add disabled px-4 py-2">
                            En attente d'acceptation
                    </button>
                @else 
                
                <button type="submit" class="btn btn-main-color btn-rounded btn-add px-4 py-2">
                        Ajouter comme ami 
                    </button>
                @endif  
        </form>
       </div>
   @endif
</div>
@endsection