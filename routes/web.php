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
Route::post('/clusters/{id}', 'CourseController@get_teams');
Route::get('/', 'StudentDataController@index')->name('home');
Route::resource('users', 'UserController');
Route::resource('course', 'courseController');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');
Route::resource('studentdata', 'StudentDataController');
