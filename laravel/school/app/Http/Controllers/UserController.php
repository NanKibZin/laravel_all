<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function profile()
    {
        $data["header_title"] = "My Profile";

        $data['student'] = Auth::user();

        if (Auth::user()->role == 'teacher') {

            return view('teacher.profile', $data);
        } else if (Auth::user()->role == 'student') {
            $data['classes'] = Classes::get();
            return view('student.profile', $data);
        } else if (Auth::user()->role == 'parent') {
            return view('parent.profile', $data);
        } else if (Auth::user()->role == 'admin') {

            return view('parent.profile', $data);
        }
        //    dd($data);
    }
    public function changeProfile(Request $request)
    {
        $user = User::find($request->id);

        if (!$user) {
            return redirect()->back()->with('error', 'Student not found');
        }
        // Update student data
        $user->name = $request->first_name; // Note: The DB has 'name' but form has 'first_name'
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->experience = $request->experience;
        $user->mobile_number = $request->mobile_number;
        $user->email = $request->email;
        $user->status = $request->status;
        // Only update password if a new one was provided
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            // Delete old image if exists
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/teacher'), $filename);
            $user->image = 'uploads/teacher/' . $filename;
        }

        $user->save();

        return redirect()->back()->with('success', 'Student updated successfully');
    }
    public function index()
    {
        $data["header_title"] = "Change Password";
        return view('profile.changePassword', $data);
    }
    public function changePassword(Request $request)
    {
        // dd($request);
        $request->validate([
            'old_pass' => 'required',
            'new_pass' => 'required',
        ]);
        $user = User::find(Auth::user()->id);
        if (Hash::check($request->old_pass, $user->password)) {
            $user->password = Hash::make($request->new_pass);
            $user->save();
            return redirect()->back()->with('success', 'Password updated successfully');
        } else {
            return redirect()->back()->with('error', 'old Password is in correct');
        }
    }
}
