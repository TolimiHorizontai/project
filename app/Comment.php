<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Photo;
use App\Category;
use App\Role;
use App\CommentReply;

class Comment extends Model
{
    //
    protected $fillable = [
        'post_id',
        'author',
        'email',
        'body',
        'is_active'

    ];

    public function reply(){
 
        return $this->hasMany('App\CommentReply');
        
    }
}
