<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Helper;
use Carbon\Carbon;

class user extends Authenticatable
{
    use Helper;
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

   public function attendances()
   {
      return $this->hasMany('App\attendance', 'student_id', 'identification');
   }

   public function exeats()
   {
      return $this->hasMany('App\exeat', 'student_id', 'identification');
   }

   public static function getStudentsIdentification($numberOfUsers)
   {
       return self::select('identification')->where('role','student')->limit($numberOfUsers)->get();
   }

   public static function getAllStudents()
   {
       return self::select('identification')->where('role','student')->get();
   }

}
