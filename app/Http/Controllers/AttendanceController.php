<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\attendance;
use App\event;
use App\exeat;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    //
    public function getStudentsAbsentForEvent($event_id)
    {
        $students = user::getAllStudents();
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

    public function getStudentsOnExeatDuringEvent($event_id)
    {
        $students = self::getAllStudents();
        $event = event::find($event_id);
        $onExeat = [];
        foreach ($students as $student) {
            //get latest exeat
            $exeat = $student->exeats()->orderBy('updated_at','desc')->first();
            if (!empty($exeat)) {
                //for exeat to be tenable startdate must be less than or equl to start of event and end must be greater than or equal to end of event
                $exeatStart = Carbon::createFromFormat("Y-m-d", $exeat->start);
                $exeatEnd = Carbon::createFromFormat("Y-m-d", $exeat->end);
                $eventStart = Carbon::createFromFormat("Y-m-d", $event->start);
                $eventEnd = Carbon::createFromFormat("Y-m-d", $event->end);
                if ($exeatStart <= $eventStart && $exeatEnd>= $eventEnd) {
                    $onExeat[] = $student->identification;
                }

            }
        }
        return $onExeat;
    }
}
