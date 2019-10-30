<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Str;


class CourseTeacherController extends Controller
{
    

    public function courseTeacher_view()
    {
        $teacher_course = DB::table('teacher_course')
        ->leftJoin('teacher','teacher_course.teacher_id','=','teacher.id')
        ->leftJoin('course','teacher_course.course_id','=','course.id')
        ->select('teacher_course.id','teacher.name',DB::raw("(GROUP_CONCAT(course.course_name SEPARATOR ' ,')) as courses"))
        ->groupBy('teacher_id')
        ->get();
        //dd($teacher_course);
        if(request()->ajax())
        {
            return datatables()->of($teacher_course)
                    
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-blue btn-xs" data-toggle="modal" data-target="#editDepartment" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>';
                        $button .= '&nbsp;&nbsp;';
                        
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('backend.assign_course_teacher.course_teacher_list');
    }

    /**
    * Assign Course teacher
    */
    public function assign_courseTeacher(Request $request)
    {
        //return response()->json($request->all()); 
       $rules = array(
            'teacher_id'=>'required',
            'course_id'=>'required' 
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        foreach ($request->course_id as $key => $course) {
            $assign_courseTeacher = DB::table('teacher_course')->insert([
                'teacher_id'=>$request->teacher_id,
                'course_id'=>$course,           
                'created_at'=>Carbon::now()->toDateTimeString(),
                'updated_at'=>Carbon::now()->toDateTimeString()
            ]);
        }
        

        if ($assign_courseTeacher) {
            
            return response()->json(['success' => 'Successfully.']);
            //return "Department added Successfully";
         } else {
            return response()->json(['failed' => 'Failed.']);
         }
    }

    
}
