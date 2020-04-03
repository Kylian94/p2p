<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'DESC');
    }
    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    protected $fillable = [
        'user_id', 'content', 'image',
    ];
}
