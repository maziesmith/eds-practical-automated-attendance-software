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
}
