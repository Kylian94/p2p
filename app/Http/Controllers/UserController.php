<?php

namespace App\Http\Controllers;

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
        return view('profil', compact('user', 'users'));
    }
    public function user($id)
    {
        $user = User::find($id);
        $users = User::paginate(5);
        return view('user', compact('user', 'users'));
    }
}
