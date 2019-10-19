<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Str;
class TeacharController extends Controller
{
    public function teacher_view()
    {
        $teachers = DB::table('teacher')->get(['id','name','designation','phone','address','status']);
        //dd($teachers);
        if(request()->ajax())
        {
            return datatables()->of($teachers)
                    ->addColumn('name', function($data){
                            $button = '<a href="'.route('teacher_profile', base64_encode($data->id)).'" target="_blank" data-toggle="tooltip" data-placement="top" title="View Profile"><b style="color: darkcyan">'.$data->name.'</b></a>';
                            $button .= '&nbsp;&nbsp;';
                            return $button;   
                    })
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-blue btn-xs" data-toggle="modal" data-target="#editTeacher" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>';
                        $button .= '&nbsp;&nbsp;';
                        
                        return $button;
                    })
                    ->rawColumns(['name','action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('backend.teacher.teacher_list');
    }


    /**
     * add new teacher
     */
    public function create_teacher(Request $request)
    {
        
       $rules = array(
            'name'=>'required',
            'email'=>'required|unique:teacher',
            'phone'=>'required',
            'address'=>'required', 
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        $cms_id = "TEA-".(rand(10,500));
        //$cms_id = bchexdec(uniqid());
        $create_teacher = DB::table('teacher')->insert([
            'cms_id'=>$cms_id,
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'designation'=>$request->designation,
            'address'=>$request->address,           
            'status'=>1,
            'created_by'=>Auth::user()->id,
            'created_at'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString()
        ]);

        if ($create_teacher) {
            DB::table('users')->insert([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt('admin'),
                'is_permission'=>2,           
                'created_at'=>Carbon::now()->toDateTimeString(),
                'updated_at'=>Carbon::now()->toDateTimeString()
            ]);
            return response()->json(['success' => 'Teacher Created successfully.']);
            //return "Department added Successfully";
         } else {
            return response()->json(['failed' => 'Teacher Created failed.']);
         }
    }

    /**
     * Edit teacher modal data
     */
    public function edit_teacher($id)
    {
        $teacher = DB::table('teacher')->where('id',$id)->first(['id','name','designation','phone','address','status']);
        return response()->json($teacher);
    }

    /**
     * Update teachar
     */
    public function update_teacher(Request $request)
    {
       
        $rules = array(
            'edit_name'=>'required', 
            'edit_phone'=>'required',
            'edit_designation'=>'required',
            'status'=>'required',
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $teacher_update =  DB::table('teacher')
        ->where('id',$request->id)
        ->update(
            [
                'name'=>$request->edit_name,
                'phone'=>$request->edit_phone,
                'designation'=>$request->edit_designation,     
                'status'=>$request->status     
                
            ]
        );

        if ($teacher_update) {
            return response()->json(['success' => 'Update successfully !!!']);
            //return "Department added Successfully";
        } else {
            return response()->json(['falied' => 'Update Nothing.']);
        }
        
    }

    /**
     * teachar profile
     */
    public function teacher_profile($id)
    {
        $id = base64_decode($id);
        $teacher = DB::table('teacher')->where('id',$id)->first();
        //dd($teachers);
        return view('backend.teacher.teacher_profile',compact('teacher'));
    }

    /**
     * teachar profile photo update
     */
    public function update_photo(Request $request){
        // $this->validate($request,[
        //     'image'=>'required|mimes:jpeg,bmp,png,jpg',
        // ]);
        $teacher=DB::table('teacher')->where('id','=',$request->id)->first();
        //dd($teacher);
        $unique=$teacher->cms_id;
        $image=$teacher->image;
        if($image!=null){
            $path = public_path() . "/teacher_images/" . $image;
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
            $name='teacher'.'-'.time().'.'.$file->getClientOriginalExtension();
            $file->move('teacher_images',$name);
            DB::table('teacher')->where('id','=',$request->id)->update([
                'image'=>$name,
            ]);
        }
        // Session::flash('success','Image Updated');
        // return redirect()->back();
        return response()->json(['success' => 'Image Updated.']);
    }
}
