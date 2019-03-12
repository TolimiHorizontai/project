<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\User;

class Photo extends Model
{

    protected $uploads  = 'images/';

    protected $fillable = [
        'file'
    ];


public function role(){
    return $this->belongsTo('App\Role');
}

/*
public function user(){
    return $this->belongsTo('App\User');
}
*/

public function getFileAttribute($photo){
    
    return asset($this->uploads . $photo);
}

}
