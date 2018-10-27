<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class user extends Authenticatable
{
    //
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $guarded = ['id'];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [
       'password', 'remember_token',
   ];

   public function setEmailAttribute($value) {
      $this->attributes['email'] = strtolower($value);
   }

   public function setPasswordAttribute($value) {
       $this->attributes['password'] = bcrypt($value);
   }

}
