<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected function redirectTo(){
        $role = Auth::user()->role;
        switch ($role) {
            case '1':
                return '/client/home';
                break;
            case '2':
                return '/technical/home';
                break;
            case '3':
                return '/billing/home';
                break;
            case '4':
                return '/sales/home';
                break;
            case '5':
                return '/master/home';
                break;
            default:
                return '/error';
                break;
        }
    }

    /**  
     * Allow users to authetincate via username 
    */
    public function username(){
        return 'username';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
