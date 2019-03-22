<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Photo;
use App\Category;
use App\Role;
use App\Comment;


class CommentReply extends Model
{
    //

    protected $fillable = [
        'comment_id',
        'author',
        'email',
        'body',
        'is_active'

    ];

    public function comment(){
 
        return $this->belongsTo('App\Comment');
        
    }

}
