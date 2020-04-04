<?php

namespace App\Http\Controllers;

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
        return view('profil', compact('user', 'users', 'posts'));
    }
    public function user($id)
    {
        $user = User::find($id);
        $users = User::paginate(5);
        $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        return view('user', compact('user', 'users', 'posts'));
    }
}
