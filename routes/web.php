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
    return view('auth/login');
});
Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes();
Route::group(['middleware'=>'auth'],function (){
    Route::get('/dashbord', 'DashboardController@dashbord')->name('dashbord');
    Route::post('/change/pass','DashboardController@change_password')->name('change_password');
    Route::get('/home', 'HomeController@index')->name('home');
    
    //========================Teacher Start=============================
    Route::get('/teachers', 'TeacharController@teacher_view')->name('teacher_view');
    Route::post('/teachers/create', 'TeacharController@create_teacher')->name('create_teacher');
    Route::get('teachers_edit/{id}','TeacharController@edit_teacher')->name('edit_teacher');
    Route::post('/teachers/update','TeacharController@update_teacher')->name('update_teacher');
    Route::get('/teachers/profile/{id}', 'TeacharController@teacher_profile')->name('teacher_profile');
    Route::post('/teachers/changePhoto','TeacharController@update_photo')->name('update_photo');
    //========================Teacher End===============================
});

