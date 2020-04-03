<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::paginate(5);
        $posts = Post::orderBy('created_at', 'DESC')->get();
        $friends = Friend::where('user_id', Auth::user()->id)->get();
        $allFriends = Friend::where('user_id', Auth::user()->id)->get();
        $friendsAccepted = Friend::where('isAccepted', 1)->where('user_id', Auth::user()->id)->get();
        $askedFriends = Friend::where('friend_id', Auth::user()->id)->get();

        return view('home', compact('users', 'posts', 'friends', 'allFriends', 'friendsAccepted', 'askedFriends'));
    }
}
