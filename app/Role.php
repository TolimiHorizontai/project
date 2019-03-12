<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Collection;

class Role extends Model
{
    //fillables
    protected $fillable = ['name'];

    public function user(){
        return $this->hasMany('App\User');
    }

  
}
