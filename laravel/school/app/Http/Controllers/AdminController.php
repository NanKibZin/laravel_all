<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function list()
    {
        $data['header_title'] = "Admin List";
        $data['data'] = User::where('role', 'admin')->get();
        return view("admin.admin.list", $data);
    }
    public function add()
    {
        $data["header_title"] = "Add Admin";
        return view('admin.admin.add', $data);
    }
    public function index()
    {
        if (!empty(Auth::check())) {
            if (Auth::user()->role == 'admin') {
                return view('admin.dashboard');
            } else if (Auth::user()->role == 'student') {
                return view('student.dashboard');
            } else if (Auth::user()->role == 'parent') {
                return view('parent.dashboard');
            } else if (Auth::user()->role == 'teacher') {
                return view('teacher.dashboard');
            }
        } else {
            return view('login.login');
        }
    }
    public function auth(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role == 'admin') {
                return view('admin.dashboard');
            } else if (Auth::user()->role == 'student') {
                return view('student.dashboard');
            } else if (Auth::user()->role == 'parent') {
                return view('parent.dashboard');
            } else if (Auth::user()->role == 'teacher') {
                return view('teacher.dashboard');
            }
            return view('login.login');
        } else {
            return redirect()->back()->with('error', 'something when wrong');
        }
    }
    public function register(Request $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->role = "teacher";
        $user->email = $request->email;
        $user->password = Hash::make('1');
        $user->save();
        return redirect()->route('admin.list')->with('success', 'User created');
    }
    public function edit($id)
    {
        $data["header_title"] = "Edit Admin";
        $data['admin'] = User::find($id);
        return view('admin.admin.edit', $data); // Ensure view path matches
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('admin.list')->with('success', 'Admin updated successfully');
    }
    public function delete(string $id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Admin  delete Successfully');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'logout successfully');
    }
    public function forgotPassword()
    {
        return view("login.forgot");
    }

    public function postPassword(Request $request)
    {
        // $getEmailSingle=User::getEmailSingle($request->email)    
        // dd($getEmailSingle);
        try {
            $user = User::getEmailSingle($request->email);

            if (!empty($user)) {
                $user->remember_token = Str::random(30);
                $user->save();

                Mail::to($user->email)->send(new ForgotPasswordMail($user));
                return redirect()->back()->with('success', 'Please check your email!');
            } else {
                return redirect()->back()->with('error', 'Email not found in this system!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error sending email: ' . $e->getMessage());
        }
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function form()
    {
        return view('admin.form');
    }
    public function table()
    {
        return view('admin.admin.list');
    }
}
