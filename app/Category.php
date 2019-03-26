<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Photo;
use App\Post;
use App\Role;

use App\Comment;
use App\CommentReply;

class Category extends Model
{
    //
    protected $fillable = [
        'name'
    ];

public function post(){
    
    return $this->hasMany('App\Post');

}


}
