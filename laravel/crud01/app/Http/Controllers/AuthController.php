<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function ShowLogin(){
        if(Auth::check()){
            return redirect()->route('p.list');
        }
        return view('login');
    }
    public function showRegister(){
        if(Auth::check()){
            return redirect()->route('p.list');
        }
        return view('register');
    }
    public function processRegister(Request $request){
        // dd($request->all());
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:2|max:10',
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
            'confirm_password'=>'required|same:password'
        ]);
        if($validator->passes()){
            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->save();
            return redirect()->route('p.list');
        }else{
            // dd($validator->errors());
            return back()->withErrors($validator)->withInput();
        }
    }
    public function processLogin(Request $request){
        // dd($request->all()); //
        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if($validator->passes()){
             $credentials = [
                 'email' => $request->email,
                 'password' => $request->password,	
             ];
             if(Auth::attempt($credentials)){
                  return redirect()->route('p.list')->with('success','login success');
             }else{
                return redirect()->back()->with('error','invalid Email or Password');
             } 
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }
    // public function logout(){
    //     Auth::logout();   //destroy session
    //     return redirect()->route('auth.logout')->with('success','logout success');
    // }
    public function logout(){
        Auth::logout();   
        return redirect()->route('auth.login')->with('success','logout success');
    }
}
