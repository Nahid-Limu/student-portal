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
        $student = DB::table('student')
        ->leftJoin('department','student.department_id','=','department.id')
        //->get(['id','cms_id','name','email','address','status']);
        ->select('student.id','student.cms_id','student.name','student.email','student.status','department.department_name')
        ->get();
        if(request()->ajax())
        {
            return datatables()->of($student)
                    ->addColumn('cms_id', function($data){
                            $button = '<a href="'.route('student_profile', base64_encode($data->id)).'" target="_blank" data-toggle="tooltip" data-placement="top" title="View Profile"><b style="color: darkcyan">'.$data->cms_id.'</b></a>';
                            $button .= '&nbsp;&nbsp;';
                            return $button;   
                    })
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-blue btn-xs" data-toggle="modal" data-target="#editStudent" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>';
                        $button .= '&nbsp;&nbsp;';
                        
                        return $button;
                    })
                    ->rawColumns(['cms_id','action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('backend.student.student_list');
    }

    /**
    * add new student
    */
    public function create_student(Request $request)
    {
        
       $rules = array(
            'name'=>'required',
            'email'=>'required|unique:student',
            'department_id'=>'required',
            'date'=>'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        $cms_id = "STU-".(rand(10,500));
        //$cms_id = bchexdec(uniqid());
        $create_student = DB::table('student')->insert([
            'cms_id'=>$cms_id,
            'name'=>$request->name,
            'email'=>$request->email,
            'department_id'=>$request->department_id,
            'date'=>$request->date,
            'address'=>$request->address,           
            'status'=>1,
            'created_by'=>Auth::user()->id,
            'created_at'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString()
        ]);

        if ($create_student) {
            DB::table('users')->insert([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt('admin'),
                'is_permission'=>3,           
                'created_at'=>Carbon::now()->toDateTimeString(),
                'updated_at'=>Carbon::now()->toDateTimeString()
            ]);
            return response()->json(['success' => 'Student Created successfully.']);
            //return "Department added Successfully";
         } else {
            return response()->json(['failed' => 'Student Created failed.']);
         }
    }

    /**
     * Edit student modal data
     */
    public function edit_student($id)
    {
        $student = DB::table('student')->where('id',$id)->first(['id','name','department_id','status']);
        return response()->json($student);
    }

    /**
     * Update student
     */
    public function update_student(Request $request)
    {
        //return response()->json($request->all());
        $rules = array(
            'edit_name'=>'required', 
            'edit_department_id'=>'required',
            'status'=>'required',
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $update_student =  DB::table('student')
        ->where('id',$request->id)
        ->update(
            [
                'name'=>$request->edit_name,
                'department_id'=>$request->edit_department_id, 
                'status'=>$request->status     
                
            ]
        );

        if ($update_student) {
            return response()->json(['success' => 'Update successfully !!!']);
            //return "Department added Successfully";
        } else {
            return response()->json(['falied' => 'Update Nothing.']);
        }
        
    }


    /**
     * student profile
     */
    public function student_profile($id)
    {
        $id = base64_decode($id);
        $student = DB::table('student')
        ->leftJoin('department','student.department_id','=','department.id')
        ->select('student.id','student.cms_id','student.name','student.email','student.phone','student.address','student.date','student.status','student.image','department.department_name')
        ->where('student.id',$id)
        ->first();
        //dd($student);
        return view('backend.student.student_profile',compact('student'));
    }

    /**
     * student profile photo update
     */
    public function student_update_photo(Request $request){
        // $this->validate($request,[
        //     'image'=>'required|mimes:jpeg,bmp,png,jpg',
        // ]);
        $student=DB::table('student')->where('id','=',$request->id)->first();
        //dd($teacher);
        $unique=$student->cms_id;
        $image=$student->image;
        if($image!=null){
            $path = public_path() . "/student_images/" . $image;
            if (file_exists($path)) {
                unlink($path);
            }
        }
        if($file=$request->file('image')){
            if($request->file('image')->getClientSize()>2000000)
            {
                // Session::flash('error','Could Not Upload. File Size Limit Exceeded.');
                // return redirect()->back();
                return response()->json(['error' => 'Could Not Upload. File Size Limit Exceeded.']);
            }
            $name='student'.'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move('student_images',$name);
            DB::table('student')->where('id','=',$request->id)->update([
                'image'=>$name,
            ]);
        }
        // Session::flash('success','Image Updated');
        // return redirect()->back();
        return response()->json(['success' => 'Image Updated.']);
    }
    
}
