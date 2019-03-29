<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Photo;
use App\Category;
use App\Role;
use App\Comment;
use App\CommentReply;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Post extends Model
{

    use Sluggable;
    use SluggableScopeHelpers;

    public function sluggable() {
        return [
            'slug'      => [ 'source' => 'title'],

        ];
    }

    //fillables
    protected $fillable = [
        'category_id',
        'photo_id',
        'title',
        'body'
    ];


    //relations
    public function user(){
 
        return $this->belongsTo('App\User');
        
    }

    public function photo(){
 
        return $this->belongsTo('App\Photo');
        
    }

    public function category(){
 
        return $this->belongsTo('App\Category');
        
    }

    public function comments(){
 
        return $this->hasMany('App\Comment');
        
    }
}


