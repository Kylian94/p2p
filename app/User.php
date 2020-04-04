<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public function posts()
    {
        return $this->hasMany('App\Post')->orderBy('created_at', 'DESC');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'DESC');
    }
    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function friends()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id')
            ->wherePivot('isAccepted', '=', 0)
            ->withPivot('isAccepted');
    }
    public function friendsAccepted()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id')
            ->wherePivot('isAccepted', '=', 1)
            ->withPivot('isAccepted');
    }
    function friendsOfMine()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id')
            ->wherePivot('isAccepted', '=', 0)
            ->withPivot('isAccepted');
    }
    // friendship that I was invited to 
    function friendOf()
    {
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id')
            ->wherePivot('isAccepted', '=', 0)
            ->withPivot('isAccepted');
    }
    function friendsOfMineAccepted()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id')
            ->wherePivot('isAccepted', '=', 1)
            ->withPivot('isAccepted');
    }
    // friendship that I was invited to 
    function friendOfAccepted()
    {
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id')
            ->wherePivot('isAccepted', '=', 1)
            ->withPivot('isAccepted');
    }
    // accessor allowing you call $user->friends
    public function getFriendsAttribute()
    {
        if (!array_key_exists('friends', $this->relations)) $this->loadFriends();
        return $this->getRelation('friends');
    }
    protected function loadFriends()
    {
        if (!array_key_exists('friends', $this->relations)) {
            $friends = $this->mergeFriends();
            $this->setRelation('friends', $friends);
        }
    }
    protected function mergeFriends()
    {
        return $this->friendsOfMine->merge($this->friendOf);
    }
    protected function mergeFriendsAccepted()
    {
        return $this->friendsOfMineAccepted->merge($this->friendOfAccepted);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
