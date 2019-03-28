<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Photo;
use App\Category;
use App\Role;
use App\CommentReply;
use App\Post;

class Comment extends Model
{
    //
    protected $fillable = [
        'post_id',
        'author',
        'email',
        'body',
        'is_active',
        'photo'

    ];

    public function replies(){
 
        return $this->hasMany('App\CommentReply');
        
    }

    public function category(){

        return $this->belongsTo('App\Category');

    }

    public function post(){

        return $this->belongsTo('App\Post');
    }
}
