<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::resource('user','App\Http\Controllers\UserController');
// Route::get('user/{id}/edit/','App\Http\Controllers\UserController@edit');
// 

Route::resource('user','App\Http\Controllers\UserController')->middleware('auth');
Route::get('user/{id}/edit/','App\Http\Controllers\UserController@edit');
Route::get('user/{id}', 'App\Http\Controllers\UserController@destroy'); 
Route::post('user/{id}/update', 'App\Http\Controllers\UserController@update');

Route::resource('project','App\Http\Controllers\ProjectController')->middleware('auth');
Route::get('project/{id}/edit/','App\Http\Controllers\ProjectController@edit');
Route::get('project/{id}', 'App\Http\Controllers\ProjectController@destroy'); 
Route::post('project/{id}/update', 'App\Http\Controllers\ProjectController@update');

Route::resource('location','App\Http\Controllers\LocationController')->middleware('auth');
Route::get('location/{id}/edit/','App\Http\Controllers\LocationController@edit');
Route::get('location/{id}', 'App\Http\Controllers\LocationController@destroy'); 
Route::post('location/{id}/update', 'App\Http\Controllers\LocationController@update');
Route::get('location/{id}/add','App\Http\Controllers\LocationController@add');


Route::get('/test', function () {
    return view('test');
});
Route::get('/test1', function () {
    return view('test1');
});
