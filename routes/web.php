<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//home controller
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/attendance', 'HomeController@attendance')->name('attendance-show');
Route::get('/event', 'HomeController@event')->name('event-show');
Route::get('/exeat', 'HomeController@exeat')->name('exeat-show');
//exeat controller
Route::post('/exeat/create', "ExeatController@create")->name('exeat-create');
//event controller
Route::post('/event/create', "EventController@create")->name('event-create');
