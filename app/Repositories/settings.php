<?php

namespace App\Repositories;
use Carbon\Carbon;
use auth;
use Illuminate\Support\Facades\DB;

class Settings{
    // all department
    public function all_department()
    {
        return DB::table('department')->where('status',1)->select('id','department_name')->get();
    }

    // all course
    public function all_course()
    {
        return DB::table('course')->where('status',1)->select('id','course_name')->get();
    }

    // all teacher
    public function all_teacher()
    {
        return DB::table('teacher')->where('status',1)->select('id','name')->get();
    }
}