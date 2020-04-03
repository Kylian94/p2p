<?php

namespace App\Http\Controllers;

use App\Friend;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $friend = new Friend;
        $friend->user_id = Auth::user()->id;
        $friend->friend_id = $request->friend_id;
        $friend->save();


        return redirect('/home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function show(Friend $friend)
    {
        $users = User::paginate(5);

        $allFriends = Friend::where('user_id', Auth::user()->id)->where('isAccepted', 0)->get();

        $friendsAccepted = Friend::where('isAccepted', 1)->where('user_id', Auth::user()->id)->orWhere('friend_id', Auth::user()->id)->get();

        $askedFriends = Friend::where('friend_id', Auth::user()->id)->where('isAccepted', 0)->get();

        return view('friends', compact('users', 'allFriends', 'friendsAccepted', 'askedFriends'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function edit(Friend $friend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $users = User::paginate(5);

        Friend::where('friend_id', Auth::user()->id)->where('user_id', $request->friend_id)->update(['isAccepted' => 1]);

        $allFriends = Friend::where('user_id', Auth::user()->id)->where('isAccepted', 0)->get();

        $friendsAccepted = Friend::where('isAccepted', 1)->where('user_id', Auth::user()->id)->orWhere('friend_id', Auth::user()->id)->get();

        $askedFriends = Friend::where('friend_id', Auth::user()->id)->where('isAccepted', 0)->get();

        return view('friends', compact('users', 'allFriends', 'friendsAccepted', 'askedFriends'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $users = User::paginate(5);

        Friend::where('friend_id', $request->friend_id)->where('user_id', Auth::user()->id)->delete();

        $allFriends = Friend::where('user_id', Auth::user()->id)->where('isAccepted', 0)->get();

        $friendsAccepted = Friend::where('isAccepted', 1)->where('user_id', Auth::user()->id)->orWhere('friend_id', Auth::user()->id)->get();

        $askedFriends = Friend::where('friend_id', Auth::user()->id)->where('isAccepted', 0)->get();

        return view('friends', compact('users', 'allFriends', 'friendsAccepted', 'askedFriends'));
    }
}
