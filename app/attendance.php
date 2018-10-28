<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    //
    //
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $guarded = ['id'];

   public function attendedEvent($event_id)
   {
       if ($this->status == 'PRESENT' && $this->event_id == $event_id) {
           return $this->student_id;
       }

       return null;
   }

   public function didNotAttendEvent($event_id)
   {
       if ($this->status == 'ABSENT' && $this->event_id == $event_id) {
           return $this->student_id;
       }

       return null;
   }

   public function onExeatForEvent($event_id)
   {
       if ($this->status == 'ON EXEAT' && $this->event_id == $event_id) {
           return $this->student_id;
       }

       return null;
   }

   public static function getAttendanceForEvent($event_id)
   {
       return self::select('student_id','status')->where('event_id', $event_id)->orderBy('status')->get();
   }

   public static function getPresentForEvent($event_id)
   {
       return self::select('student_id','status')->where('event_id', $event_id)->where('status', 'PRESENT')->get();
   }

   public static function getAbsentForEvent($event_id)
   {
       return self::select('student_id','status')->where('event_id', $event_id)->where('status', 'ABSENT')->get();
   }
}
