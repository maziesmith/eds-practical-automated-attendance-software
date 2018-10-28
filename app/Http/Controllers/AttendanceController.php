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

               //prevent logging of absent if it has already been done
               if ($attendance->didNotAttendEvent($event_id) != null ) { //if student is registered absent
                  $isAbsent = False;
               }

               //prevent logging of bsent if student already logge as on exeat
               if ($attendance->onExeatForEvent($event_id) != null ) {//if student is registered ONEXEAT
                   //leave as it is
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
        $students = user::getAllStudents();
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

    public function computeAbsent($event_id){
        $absents = $this->getStudentsAbsentForEvent($event_id);
        foreach ($absents as $student) {
            attendance::create([
                'event_id' => $event_id,
                'student_id' => $student,
                'status' => 'ABSENT'
            ]);
        }
    }

    public function computeOnExeat($event_id)
    {
        $onExeats = $this->getStudentsOnExeatDuringEvent($event_id);
        foreach ($onExeats as $student) {
            $studentObject = user::where('identification', $student)->first();
            foreach ($studentObject->attendances as $attendance) { //loop through students attendance to see if student is present for particular event
                if ($attendance->event_id != $event_id) {
                    continue;
                }
               if ($attendance->didNotAttendEvent($event_id) != null ) { //if student is registered absent
                  $attendance->status = 'ON EXEAT';
                  $attendance->save();
                  continue;
               }

               if ($attendance->attendedEvent($event_id) != null ) {//if student is registered present
                   //leave as it is
                   continue;
               }

               if ($attendance->onExeatForEvent($event_id) != null ) {//if student is registered ON EXEAT
                   //leave as it is
                   continue;
               }

               attendance::create([
                   'event_id' => $event_id,
                   'student_id' => $student,
                   'status' => 'ON EXEAT'
               ]);
            }
        }
    }

    public function computeAttendance(Request $request)
    {
        //validate input
        $this->validate($request,[
          'event_id' => 'required|exists:events,id'
        ]);

        $event_id = $request->event_id;
        $this->computeAbsent($event_id);
        $this->computeOnExeat($event_id);
        return redirect(route('attendance-show'))->with('success','Attendances Computed');
    }

    public function uploadAttendance(Request $request)
    {
        //validate input
        $this->validate($request,[
          'event_id' => 'required|exists:events,id',
          'attendance' => 'required|mimes:csv,txt'
        ]);


       if ($request->hasFile('attendance')) {
            $file = $request->file('attendance');
            if ($file->getClientOriginalExtension() != "csv") {
                return back()->withErrors(['attendance' => 'File type not allowed'])->withInput();
            }
            $fileName = time() . "." . $file->getClientOriginalExtension();
            $relativeFilePath = $file->storeAs('/uploads/attendances/',$fileName);
            $absoluteFilePath = public_path() . "/" . $relativeFilePath;
            $event_id = $request->event_id;
            //read file contents
            $attendances = $this->readUploadedAttendance($absoluteFilePath);
            $isRecorded = false;
            foreach ($attendances as $student_id) {
                if(is_array($student_id)) {
                    $studentObject = user::where('identification', $student_id[0])->first();
                    foreach ($studentObject->attendances as $attendance) { //loop through students attendance to see if student is present for particular event
                        if ($attendance->event_id != $event_id) {
                            continue;
                        }
                       if ($attendance->didNotAttendEvent($event_id) != null ) { //if student is registered absent CONTINUE
                           $isRecorded = true;
                          continue;
                       }

                       if ($attendance->attendedEvent($event_id) != null ) {//if student is registered present
                           //leave as it is
                           $isRecorded = true;
                           continue;
                       }

                       if ($attendance->onExeatForEvent($event_id) != null ) {//if student is registered ON EXEAT
                           //leave as it is
                           $isRecorded = true;
                           continue;
                       }
                    }

                    if (!$isRecorded) {
                        attendance::create([
                            'event_id' => $event_id,
                            'student_id' => $student_id[0],
                            'status' => 'PRESENT'
                        ]);
                    }                       
                }
            }
        }
        return redirect(route('attendance-upload-show'))->with('success', 'Attendance uploaded for event');
    }

    public function readUploadedAttendance($filepath)
    {
        $file_handle = fopen($filepath, 'r');
        while (!feof($file_handle) ) {
            $fileContents[] = fgetcsv($file_handle, 1024);
        }
        fclose($file_handle);
        return $fileContents;
    }


}
