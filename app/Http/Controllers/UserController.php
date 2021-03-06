<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Friend;
use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function profil()
    {
        $user = Auth::user();
        $users = User::paginate(5);
        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        $comments = Comment::where('user_id', $user->id)->get();
        $likes = Like::where('user_id', $user->id)->get();
        $nbFriends = count($user->friendOfAccepted) + count($user->friendsAccepted);
        return view('profil', compact('user', 'users', 'posts', 'comments', 'likes', 'nbFriends'));
    }
    public function user($id)
    {
        $user = User::find($id);
        $users = User::paginate(5);
        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        $comments = Comment::where('user_id', $user->id)->get();
        $likes = Like::where('user_id', $user->id)->get();
        $nbFriends = count($user->friendOfAccepted) + count($user->friendsAccepted);

        return view('user', compact('user', 'users', 'posts', 'comments', 'likes', 'nbFriends'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'imageProfile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bannerImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($request->bannerImage) {

            if (Auth::user()->bannerImage) {
                unlink(public_path('images/userBannerImages/' . Auth::user()->bannerImage));
            }

            $bannerImageName = time() . '.' . $request->bannerImage->extension();
            $request->bannerImage->move(public_path('images/userBannerImages'), $bannerImageName);
            $user->bannerImage = $bannerImageName;
        }

        if ($request->imageProfile) {

            if (Auth::user()->imageProfile) {
                unlink(public_path('images/userProfileImages/' . Auth::user()->imageProfile));
            }

            $imageProfileName = time() + 1 . '.' . $request->imageProfile->extension();
            $request->imageProfile->move(public_path('images/userProfileImages'), $imageProfileName);
            $user->imageProfile = $imageProfileName;
        }

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->description = $request->description;
        $user->save();

        return back();
    }
}
