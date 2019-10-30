<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Str;
use App\Repositories\Settings;

class CourseController extends Controller
{
    protected $settings;

    public function __construct()
    {
        // create object of settings class
        $this->settings = new Settings();
    }

    /**
    * view course list
    */
    public function course_view()
    {
        // //echo "Tea-".(rand(10,500));
        $course = DB::table('course')->get(['id','course_name','course_code','status']);
        //dd($teachers);
        if(request()->ajax())
        {
            return datatables()->of($course)
                    
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-blue btn-xs" data-toggle="modal" data-target="#editCourse" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>';
                        $button .= '&nbsp;&nbsp;';
                        
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('backend.course.course_list');
    }


    /**
    * add new course
    */
    public function create_course(Request $request)
    {
        //return response()->json(['success' => 'Teacher Created success.']); 
       $rules = array(
            'course_name'=>'required|unique:course' 
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        
        $create_course = DB::table('course')->insert([
            'course_name'=>$request->course_name,
            'course_code'=>$request->course_code,
            'department_id'=>$request->department_id, 
            'remarks'=>$request->remarks,           
            'status'=>1,
            'created_by'=>Auth::user()->id,
            'created_at'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString()
        ]);

        if ($create_course) {
            
            return response()->json(['success' => 'Course Created successfully.']);
            //return "Department added Successfully";
         } else {
            return response()->json(['failed' => 'Course Created failed.']);
         }
    }

    /**
     * Edit course modal data
     */
    public function edit_course($id)
    {
        $course = DB::table('course')->where('id',$id)->first(['id','course_name','course_code','remarks','status']);
        return response()->json($course);
    }

    /**
     * Update course
     */
    public function update_course(Request $request)
    {
       
        // $rules = array(
        //     'department_name'=>'required|unique:department' 
        // );
        // $error = Validator::make($request->all(), $rules);
        // if($error->fails())
        // {
        //     return response()->json(['errors' => $error->errors()->all()]);
        // }
        //$check = DB::table('course')->where('department_name',$request->edit_department_name)->first();

        // if ($check) {
        //     return response()->json(['warning' => 'Department Already Exist.']);
        // }else{
            
            $course_update =  DB::table('course')
            ->where('id',$request->id)
            ->update(
                [
                    'course_name'=>$request->edit_course_name,
                    'course_code'=>$request->edit_course_code,
                    'remarks'=>$request->edit_remarks,
                    'status'=>$request->status     
                    
                ]
            );
    
            if ($course_update) {
                return response()->json(['success' => 'Update successfully !!!']);
                //return "Department added Successfully";
            } else {
                return response()->json(['falied' => 'Update Nothing.']);
            }
        // }
        
        
    }

    //all course
    public function get_course()
    {  
        $course = $this->settings->all_course();
        //dd($department);
        return view('backend.ajax.get_course',compact('course'));
       
    }
}
