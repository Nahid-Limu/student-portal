<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/dashbord';
    protected function authenticated() {
        if (Auth::user()->is_permission == 1) {
            return redirect()->route('dashbord');
        }else if (Auth::user()->is_permission == 2) {
            return redirect('/home');
        }
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // if (Auth::user()->is_permission == 1) {
        //     $redirectTo = '/dashbord';
        // }
        $this->middleware('guest')->except('logout');
    }
}
