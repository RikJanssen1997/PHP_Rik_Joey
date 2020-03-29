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

Route::namespace('DeadlineManager')->prefix('deadlineManager')->name('deadlineManager.')->middleware('can:deadlineManager-role')->group(function(){
    Route::get('/deadlineManager/index', 'DeadlineManagerController@index')->name('deadlinemanager.index');
    Route::get('/deadlineManager/create{lesson}', 'DeadlineManagerController@create')->name('deadlinemanager.create');
    Route::put('/deadlineManager/store{lesson}', 'DeadlineManagerController@store')->name('deadlinemanager.store');
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:admin-role')->group(function(){
    Route::resource('/users', 'UsersController',['except' => ['show', 'create','store']]);
    Route::resource('/module', 'ModuleController');
    Route::resource('/admin', 'AdminController');
    Route::resource('/teacher', 'TeacherController');
    Route::resource('/lesson', 'LessonController');
    Route::get('/grades/edit{lesson}', 'GradesController@edit')->name('grades.edit');
    Route::put('/grades/update{lesson}', 'GradesController@update')->name('grades.update');
});