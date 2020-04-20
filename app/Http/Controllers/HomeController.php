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
    public function index(Request $request)
    {
        if ($request->search) {

            $users = User::paginate(5);
            $usersFounded = User::where('firstname', 'LIKE',  '%' . $request->search . '%')->orWhere('lastname', 'LIKE', '%' . $request->search . '%')->get();

            return view('results', compact('usersFounded', 'users'));
        }

        $users = User::paginate(5);

        $user = Auth::user();
        $myFriends = Friend::where('user_id', Auth::user()->id)->where('isAccepted', 1)->get();
        $FriendsOf = Friend::where('friend_id', Auth::user()->id)->where('isAccepted', 1)->get();
        $posts = [];

        foreach ($myFriends as $myFriend) {
            $postsOfFriend = Post::where('user_id', $myFriend->friend_id)->orderBy('created_at', 'DESC')->get();
            foreach ($postsOfFriend as $postOfFriend) {
                array_push($posts, $postOfFriend);
            }
        }
        foreach ($FriendsOf as $FriendOf) {
            $postsOfFriendsOf = Post::where('user_id', $FriendOf->user_id)->orderBy('created_at', 'DESC')->get();

            foreach ($postsOfFriendsOf as $postOfFriendsOf) {
                array_push($posts, $postOfFriendsOf);
            }
        }
        $myPosts = Post::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();

        foreach ($myPosts as $myPost) {
            array_push($posts, $myPost);
        }

        $keys = array_column($posts, 'created_at');
        array_multisort($keys, SORT_DESC, $posts);




        return view('home', compact('users', 'posts', 'user'));
    }
}
