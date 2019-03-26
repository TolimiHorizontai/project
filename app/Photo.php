<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\User;
use App\Post;

class Photo extends Model
{

    protected $uploads  = 'images/';

    protected $fillable = [
        'file'
    ];

public function role(){
    return $this->belongsTo('App\Role');
}

public function post(){

    return $this->hasOne('App\Post');

}

/*
public function user(){
    return $this->belongsTo('App\User');
}
*/

/*
//Anksciau buvusi funkcija, su ja nei sarase, nei edit puslapy nerodo nuotrauku:
public function getFileAttribute($photo){
    return $this->uploads . $photo;
}
*/

//Udemy pasiulyta funkcija del users sarase nerodomu paveiksleliu veliau buvo problemos su unlink()
public function getFileAttribute($photo){
    return $this->uploads . $photo;
    }
}
