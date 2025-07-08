<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{


    public function index()
    {

        return view('admin.teacher.add');
    }
    public function store(Request $request)
    {
        $user = new User();

        // Map form fields to database columns
        $user->name = $request->first_name; // Note: The DB has 'name' but form has 'first_name'
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->experience = $request->experience;
        $user->qualification = $request->qualification;
        $user->note = $request->note;

        $user->mobile_number = $request->mobile_number;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->password = Hash::make($request->password);
        $user->role = 'teacher'; // Set role to student as in your original function
        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/teacher'), $filename);
            $user->image = 'uploads/teacher/' . $filename; // Note: The DB has 'image' but form has 'profile_pic'
        }
        $user->save();

        return redirect()->route('te.read')->with('success', 'Student Added Successfully');
    }
    public function read(Request $request)
    {
        $query = User::with(['studentClass',])
            ->where('role', 'teacher');

        // Individual field filters
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('last_name')) {
            $query->where('last_name', 'like', '%' . $request->last_name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('admission_number')) {
            $query->where('admission_number', $request->admission_number);
        }

        // Other filters
        if ($request->filled('roll_number')) {
            $query->where('roll_number', $request->roll_number);
        }

        if ($request->filled('class')) {
            $query->whereHas('studentClass', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->class . '%');
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('caste')) {
            $query->where('caste', 'like', '%' . $request->caste . '%');
        }

        if ($request->filled('mobile_number')) {
            $query->where('mobile_number', 'like', '%' . $request->mobile_number . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Date filters
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->filled('admission_date_from') && $request->filled('admission_date_to')) {
            $query->whereBetween('admission_date', [
                $request->admission_date_from,
                $request->admission_date_to
            ]);
        } elseif ($request->filled('admission_date_from')) {
            $query->where('admission_date', '>=', $request->admission_date_from);
        } elseif ($request->filled('admission_date_to')) {
            $query->where('admission_date', '<=', $request->admission_date_to);
        }

        $data["header_title"] = "Teacher List";
        $data['parents'] = $query->orderBy('name')->get();

        return view('admin.teacher.list', $data);
    }
    public function edit($id)
    {
        $students = User::find($id);
        return view('admin.teacher.edit', [
            'student' => $students
        ]);
    }
    public function update(Request $request)
    {
        // Validate request data
        // Find the student to update
        $user = User::find($request->id);

        if (!$user) {
            return redirect()->back()->with('error', 'Student not found');
        }

        // Update student data
        $user->name = $request->first_name; // Note: The DB has 'name' but form has 'first_name'
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->experience = $request->experience;
        $user->qualification = $request->qualification;
        $user->note = $request->note;
        $user->mobile_number = $request->mobile_number;
        $user->email = $request->email;
        $user->status = $request->status;
       
        $user->role = 'teacher'; // Set role to student as in your original function

        // Only update password if a new one was provided
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

        return redirect()->route('te.read')->with('success', 'Student updated successfully');
    }
    public function delete(string $id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->route('te.read')->with('success', 'Academic year delete Successfully');
    }
 public function myClassSubject() {
    $data['assignments'] = AssignClassTeacher::where('teacher_id', Auth::user()->id)->with(['class', 'subjects.subject'])->get();
    
    return view('teacher.my_class_subject', $data);
}
}
