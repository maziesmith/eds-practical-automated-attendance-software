<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin-dashboard');
    }

    public function attendance()
    {
        return view('admin-attendance');
    }

    public function attendanceUpload()
    {
        return view('admin-attendance-upload');
    }

    public function attendanceView()
    {
        return view('admin-attendance-view');
    }

    public function event()
    {
        return view('admin-event');
    }

    public function exeat()
    {
        return view('admin-exeat');
    }
}
