<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Facades\Session;
use Validator;
class DashboardController extends Controller
{
    public function dashbord()
    {
        //dd(Auth::user()->is_permission);
        $user = DB::table('users')->count();
        $teacher = DB::table('teacher')->count();
        $student = DB::table('student')->count();
        $department = DB::table('department')->count();
        $course = DB::table('course')->count();
        return view('dashbord', compact('user','teacher','student','department','course'));
    }

    public function change_password(Request $request)
    {
        //return response()->json($request->all());
        $rules = array(
            'current_password'=>'required',
            'new_password'=>'required',
            'confirm_password'=>'required',
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        $old = bcrypt($request->current_password);
        // echo $old.'<br>';
        // echo Auth::user()->password;
        if (Hash::check($request->current_password, Auth::user()->password)) {
            if ($request->new_password == $request->confirm_password) {
            
                $user = DB::table('users')->where('id', Auth::user()->id)
                ->update([
                    'password'=>bcrypt($request->confirm_password),
                ]);
                if ( $user) {
                    return response()->json(['success' => 'Password change successfully !!']);
                    //return redirect()->back()->with('success','Password change successfully !!');
                } else {
                    return response()->json(['falied' => 'Failed !!']);
                    //return redirect()->back()->with('error','Failed !!');
                }
                
            
            } else {
                return response()->json(['falied' => 'Password Not Match !!']);
                //return redirect()->back()->with('error','Password Not Match');
            }
            
            
        }else {
            return response()->json(['falied' => 'Current password is not match !! !!']);
            //return redirect()->back()->with('error','Current password is not match');;
        }
        
    }
}
