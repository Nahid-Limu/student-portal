<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Str;

class DepeartmentController extends Controller
{
    public function department_view()
    {
        //echo "Tea-".(rand(10,500));
        $department = DB::table('department')->get(['id','department_name','status']);
        //dd($teachers);
        if(request()->ajax())
        {
            return datatables()->of($department)
                    
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-blue btn-xs" data-toggle="modal" data-target="#editDepartment" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>';
                        $button .= '&nbsp;&nbsp;';
                        
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('backend.department.depeartment_list');
    }

    /**
    * add new department
    */
    public function create_department(Request $request)
    {
        //return response()->json(['success' => 'Teacher Created success.']); 
       $rules = array(
            'department_name'=>'required|unique:department' 
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        
        $create_department = DB::table('department')->insert([
            'department_name'=>$request->department_name,
            'remarks'=>$request->remarks,           
            'status'=>1,
            'created_by'=>Auth::user()->id,
            'created_at'=>Carbon::now()->toDateTimeString(),
            'updated_at'=>Carbon::now()->toDateTimeString()
        ]);

        if ($create_department) {
            
            return response()->json(['success' => 'Department Created successfully.']);
            //return "Department added Successfully";
         } else {
            return response()->json(['failed' => 'Department Created failed.']);
         }
    }

    /**
     * Edit department modal data
     */
    public function edit_department($id)
    {
        $department = DB::table('department')->where('id',$id)->first(['id','department_name','remarks','status']);
        return response()->json($department);
    }

    /**
     * Update department
     */
    public function update_department(Request $request)
    {
       
        // $rules = array(
        //     'department_name'=>'required|unique:department' 
        // );
        // $error = Validator::make($request->all(), $rules);
        // if($error->fails())
        // {
        //     return response()->json(['errors' => $error->errors()->all()]);
        // }
        $check = DB::table('department')->where('department_name',$request->edit_department_name)->first();

        // if ($check) {
        //     return response()->json(['warning' => 'Department Already Exist.']);
        // }else{
            
            $department_update =  DB::table('department')
            ->where('id',$request->id)
            ->update(
                [
                    'department_name'=>$request->edit_department_name,
                    'remarks'=>$request->edit_remarks,
                    'status'=>$request->status     
                    
                ]
            );
    
            if ($department_update) {
                return response()->json(['success' => 'Update successfully !!!']);
                //return "Department added Successfully";
            } else {
                return response()->json(['falied' => 'Update Nothing.']);
            }
        // }
        
        
    }
}
