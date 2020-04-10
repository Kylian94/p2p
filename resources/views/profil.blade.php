@extends('layouts.app')

@section('content')
<div class="px-5 ">
   <button type="button" class="float-right mb-3 btn btn-main-color btn-rounded" data-toggle="modal" data-target="#exampleModalCenter">
      Modifier le profil
    </button>
   <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modifier votre profil</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/editProfil" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body d-flex flex-wrap">
               <div class="form-group col-12 row">
                  <label for="banner-image-upload" class="col-md-6 col-form-label text-md-left">{{ __('Image de bannière') }}</label>
                  <div class="col-md-12">
                     <input id="banner-image-upload" name="bannerImage" type="file" value="{{Auth::user()->bannerImage}}">
                  </div>
               </div>
               <div class="form-group col-12 row">
                  <label for="profile-image-upload" class="col-md-6 col-form-label text-md-left">{{ __('Image de profil') }}</label>
                  <div class="col-md-12">
                     <input id="profile-image-upload" name="imageProfile" type="file" value="{{Auth::user()->imageProfile}}">
                  </div>
               </div>
               
               <div class="form-group col-6 row">
                  <label for="firstname" class="col-md-6 col-form-label text-md-left">{{ __('Prénom') }}</label>

                  <div class="col-md-12">
                     <input value="{{Auth::user()->firstname}}" id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" required >

                      @error('firstname')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
               </div>
               <div class="form-group col-6 row">
                  <label for="lastname" class="col-md-6 col-form-label text-md-left">{{ __('Nom') }}</label>
                  <div class="col-md-12">
                     <input value="{{Auth::user()->lastname}}" id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" required >

                      @error('lastname')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
               </div>
               <div class="form-group col-12 row">
                  <label for="email" class="col-md-6 col-form-label text-md-left">{{ __('Email') }}</label>
                  <div class="col-md-12">
                     <input value="{{Auth::user()->email}}" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required >

                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
               </div>
               <div class="form-group col-12 row">
                  <label for="description" class="col-md-6 col-form-label text-md-left">{{ __('Description') }}</label>
                  <div class="col-md-12">
                     <textarea rows="6" placeholder="Lorem, ipsum dolor sit amet consectetur adipisicing elit. At, nostrum aut. Consequuntur, voluptas eius tempore sit vel quibusdam enim, qui inventore doloremque ipsa, distinctio molestias blanditiis illo et voluptates ratione!" id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" >
                        {{Auth::user()->description}}
                        
                     </textarea>

                      @error('description')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
               </div>
            </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-rounded btn-main-color ">Enregistrer</button>
            </div>
          </form>
          
        </div>
      </div>
    </div>
    @if( Auth::user()->bannerImage != null)
    <img id="banner-image" class="position-relative img-banner" src="{{ asset('images/userBannerImages/' . Auth::user()->bannerImage ) }}" alt="" srcset="">
    @else 
    <img id="banner-image" class="position-relative img-banner" src="{{asset('images/banner-default.png')}}" alt="" srcset="">
    @endif
    
   @if( Auth::user()->imageProfile != null)
   <img id="profile-image" class="position-absolute img-profil img-thumbnail" src="{{ asset('images/userProfileImages/' . Auth::user()->imageProfile ) }}" alt="" srcset="">
   @else 
   <img id="profile-image" class="position-absolute img-profil img-thumbnail" src="{{asset('images/avatar.jpeg')}}" alt="" srcset="">
   @endif

   
   <div class="d-flex pt-4 mt-5">
         <h2 class="mr-1">{{$user->firstname}}</h2>
         <h2>{{$user->lastname}}</h2>
 </div>
   <div class="d-flex">
      <a href="/friends">{{$nbFriends}} Amis</a>
      <p class="mx-3"> | </p>
      <p>{{count($comments)}} Commentaires</p>
      <p class="mx-3"> | </p>
      <p>{{count($likes)}} J'aime</p>
   </div>
   <h4>Ma description :</h4>
   @if($user->description)
   <p>{{$user->description}}</p>
   @else
   <div class="alert alert-info">Vous n'avez pas encore de description perso, vous pouvez en ajouter une en modifiant votre profil !</div>
   @endif
   
   <hr>
   <h4>Mes posts :</h4>
   @if(count($posts) == 0)
      <div class="d-flex justify-content-center mt-3 p-4 rounded bg-white">
         <p class="m-0">Vous n'avez pas encore posté...</p>
      </div>
   @endif
   @foreach($posts as $post) 
   <div class="d-flex flex-column bg-white p-3 rounded mb-4">
      <!-- POST -->
            @php 
            $like = App\Like::where([
               'user_id' => Auth::user()->id,
               'post_id' => $post->id
               ])->get();
            
            @endphp
            <div class="d-flex align-items-center  justify-content-between mt-4">

               <div class="d-flex">
                     @if( $post->user->imageProfile != null)
                     <img class="avatar mr-3" src="{{ asset('images/userProfileImages/' . $post->user->imageProfile ) }}" alt="" srcset="">
                     @else 
                     <img src="{{asset('images/avatar.jpeg')}}" class="avatar mr-3" alt="" srcset="">
                     @endif                  <div class="d-flex flex-column">
                     <div class="d-flex">
                           <h6 class="font-weight-bold m-0">{{$post->user->firstname}}</h6>
                           <h6 class="font-weight-bold m-0">{{$post->user->lastname}}</h6>
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
            <div class="content  mt-3">
               <p>{{$post->content}}</p>
            </div>
            <div class="d-flex justify-content-between">
               <div class="d-flex">
                  @if(count($like))
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
                  @if(count($like))
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
               @php
               $comments = App\Post::find($post->id)->comments
               @endphp
               
               @foreach ($comments as $comment)
               <div class="d-flex flex-column ml-5  bg-light py-3 px-5 mb-2">
                  <div class="d-flex align-items-center mt-3 ">
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
                  
               @endforeach
               
               <!-- END COMMENTS -->
            </div>
      </div>
   </div>
   @endforeach
</div>
@endsection