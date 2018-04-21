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

Route::get('/',function (){return view('welcome');});
Auth::routes();
Route::post('/clusters/{courseID}', 'CourseController@getTeams');
//Route::get('/', 'StudentDataController@index')->name('home');
Route::resource('users', 'UserController');
Route::resource('course','CourseController');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');
Route::resource('studentdata', 'StudentDataController');
//Route::resource('clusters', 'CourseController@getTeams');
