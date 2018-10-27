<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\event;

class EventController extends Controller
{
    //
    public function create(Request $request)
    {
        //validate input
        $this->validate($request,[
          'name' => 'required',
          'start' => 'required',
          'end' => 'required'
        ]);
        //save event
        $data = $request->only('name','start','end');
        event::create($data);
        return redirect(route('event-show'))->with('success','Event created');
    }
}
