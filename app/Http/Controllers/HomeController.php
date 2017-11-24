<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth::user()->role;
        switch ($role) {
            case '1':
                return view('client.home');
                break;
            case '2':
                return view('technical.home');
                break;
            case '3':
                return view('billing.home');
                break;
            case '4':
                return view('sales.home');
                break;
            case '5':
                return view('master.home');
                break;
            default:
                return view('error');
                break;
        }
    }
}
