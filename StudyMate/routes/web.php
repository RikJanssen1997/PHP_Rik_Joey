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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'DashboardController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('admin/users', 'Admin\UsersController',['except' => ['show', 'create','store']]);

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:admin-role')->group(function(){
    Route::resource('/users', 'UsersController',['except' => ['show', 'create','store']]);
    Route::resource('/module', 'ModuleController');
    Route::resource('/admin', 'AdminController');
    Route::resource('/teacher', 'TeacherController');
    Route::resource('/lesson', 'LessonController');
    Route::get('/grades/edit{lesson}', 'GradesController@edit')->name('grades.edit');
    Route::get('/grades/update{lesson, request}', 'GradesController@update')->name('grades.update');
});