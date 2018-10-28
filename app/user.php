<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Helper;
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

   public static function getStudentsIdentification($numberOfUsers)
   {
       return self::select('identification')->where('role','student')->limit($numberOfUsers)->get();
   }

   public static function getAllStudents()
   {
       return self::select('identification')->where('role','student')->get();
   }

   public function getStudentsAbsentForEvent($event_id)
   {
       $students = self::getAllStudents();
       $absent = [];
       foreach ($students as $student) {//loop through student
           $isAbsent = True;
           foreach ($student->attendances as $attendance) { //loop through students attendance to see if student is present for particular event
               if ($attendance->event_id != $event_id) {
                   continue;
               }
              if ($attendance->attendedEvent($event_id) != null ) {
                  $isAbsent = False;
              }
           }

           if ($isAbsent) {
               $absent[] = $student->identification;
           }
       }
       return $absent;
   }

}
