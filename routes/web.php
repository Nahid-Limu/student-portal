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
    return view('auth.login');
});
Route::get('/logout', 'Auth\LoginController@logout');

Auth::routes();
Route::group(['middleware'=>'auth'],function (){
    Route::get('/dashbord', 'DashboardController@dashbord')->name('dashbord');
    Route::post('/change/pass','DashboardController@change_password')->name('change_password');
    Route::get('/home', 'HomeController@index')->name('home');
    
    //==================================Teacher Start================================
    Route::get('/teachers', 'TeacharController@teacher_view')->name('teacher_view');
    Route::post('/teachers/create', 'TeacharController@create_teacher')->name('create_teacher');
    Route::get('teachers_edit/{id}','TeacharController@edit_teacher')->name('edit_teacher');
    Route::post('/teachers/update','TeacharController@update_teacher')->name('update_teacher');
    Route::get('/teachers/profile/{id}', 'TeacharController@teacher_profile')->name('teacher_profile');
    Route::post('/teachers/changePhoto','TeacharController@update_photo')->name('update_photo');
    //=================================Teacher End===================================

    //==================================Student Start================================
    Route::get('/student', 'StudentController@student_view')->name('student_view');
    Route::post('/student/create', 'StudentController@create_student')->name('create_student');
    Route::get('student_edit/{id}','StudentController@edit_student')->name('edit_student');
    Route::post('/student/update','StudentController@update_student')->name('update_student');
    Route::get('/student/profile/{id}', 'StudentController@student_profile')->name('student_profile');
    Route::post('/student/changePhoto','StudentController@student_update_photo')->name('student_update_photo');
    //=================================Student End===================================

    //==================================Department Start================================
    Route::get('/department', 'DepeartmentController@department_view')->name('department_view');
    Route::post('/department/create', 'DepeartmentController@create_department')->name('create_department');
    Route::get('department_edit/{id}','DepeartmentController@edit_department')->name('edit_department');
    Route::post('/department/update','DepeartmentController@update_department')->name('update_department');
    //=================================Department End===================================

    //==================================Course Start================================
    Route::get('/course', 'CourseController@course_view')->name('course_view');
    Route::post('/course/create', 'CourseController@create_course')->name('create_course');
    Route::get('course_edit/{id}','CourseController@edit_course')->name('edit_course');
    Route::post('/course/update','CourseController@update_course')->name('update_course');
    //=================================Course End===================================

    //==================================Assign Course Teacher Start================================
    Route::get('/courseTeacher', 'CourseTeacherController@courseTeacher_view')->name('courseTeacher_view');
    Route::post('/courseTeacher/assign', 'CourseTeacherController@assign_courseTeacher')->name('assign_courseTeacher');
    // Route::get('course_edit/{id}','CourseController@edit_course')->name('edit_course');
    // Route::post('/course/update','CourseController@update_course')->name('update_course');
    //=================================Assign Course Teacher End===================================

    //==================================ajax Start================================
    Route::get('/ajax/get_department','DepeartmentController@get_department')->name('ajax.get_department');
    Route::get('/ajax/get_course','CourseController@get_course')->name('ajax.get_course');
    Route::get('/ajax/get_teacher','TeacharController@get_teacher')->name('ajax.get_teacher');
    //=================================ajax End===================================
});

