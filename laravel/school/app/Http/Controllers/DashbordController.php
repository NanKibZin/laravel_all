<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashbordController extends Controller
{
    public function dashboard(){
        if(Auth::user()->role=='admin'){
            // Auth::guard('admin')->logout();
            // return redirect()->route('admin.login')->with('error','Unautherise user'); 
            return view('admin.dashboard');
        }else if(Auth::user()->role=='student'){
            return view('student.dashboard');

        }else if(Auth::user()->role=='parent'){
            return view('parent.dashboard');

        }else if(Auth::user()->role=='teacher'){
            return view('teacher.dashboard');
        }
    }
}
