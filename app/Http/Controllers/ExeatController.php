<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\exeat;

class ExeatController extends Controller
{
    //
    public function create(Request $request)
    {
        //validate input
        $this->validate($request,[
          'student_id' => 'required|exists:users,identification',
          'start' => 'required',
          'end' => 'required'
        ]);
        //save exeat
        $data = $request->only('student_id','start','end');
        exeat::create($data);
        return redirect(route('exeat-show'))->with('success','Exeat created');
    }
}
