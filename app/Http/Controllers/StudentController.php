<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function student_view()
    {
         //echo "Tea-".(rand(10,500));
        return view('backend.student.student_list');
    }
    
}
