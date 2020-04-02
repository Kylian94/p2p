<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
    public function user($id)
    {
        $user = User::find($id);
        $users = User::paginate(5);
        return view('user', compact('user', 'users'));
    }
}
