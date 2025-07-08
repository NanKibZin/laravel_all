<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $data['classes'] = Classes::all();
        return view('admin.student.add', $data);
    }
    public function store(Request $request)
    {

        $user = new User();
        $user->name = $request->first_name; // Note: The DB has 'name' but form has 'first_name'
        $user->last_name = $request->last_name;
        $user->admission_number = $request->admission_number;
        $user->roll_number = $request->roll_number;
        $user->class_id = $request->class_id;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->caste = $request->caste;
        $user->admission_date = $request->admission_date;
        $user->mobile_number = $request->mobile_number;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->password = Hash::make($request->password);
        $user->role = 'student'; // Set role to student as in your original function

        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/students'), $filename);
            $user->image = 'uploads/students/' . $filename; // Note: The DB has 'image' but form has 'profile_pic'
        }
        $user->save();

        return redirect()->route('stu.create')->with('success', 'Student Added Successfully');
    }

    public function read(Request $request)
    {
        $query = User::with(['studentClass','parent'])->where('role','student');

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

        $data["header_title"] = "Student List";
        $data['data'] = $query->orderBy('name')->get();
        // dd($data);
        return view('admin.student.list', $data);
    }
    public function edit($id)
    {
        $classes = Classes::all();
        $students = User::find($id);
        return view('admin.student.edit', [
            'classes' => $classes,
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
        $user->name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->admission_number = $request->admission_number;
        $user->roll_number = $request->roll_number;
        $user->class_id = $request->class_id;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->caste = $request->caste;
        $user->admission_date = $request->admission_date;
        $user->mobile_number = $request->mobile_number;
        $user->email = $request->email;
        $user->status = $request->status;
        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            // Delete old image if exists
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/students'), $filename);
            $user->image = 'uploads/students/' . $filename;
        }

        $user->save();

        return redirect()->route('stu.read')->with('success', 'Student updated successfully');
    }
    public function delete(string $id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->route('stu.read')->with('success', 'Academic year delete Successfully');
    }
    public function my_subject()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first');
        }
    
        $user = Auth::user();
        
        // Verify the user is a student
        if ($user->role !== 'student') {
            return redirect()->back()->with('error', 'Only students can view subjects');
        }
    
        // Eager load the relationships
        $student = $user->load([
            'class.classSubjects.subject'
        ]);
    
        // Check if student has a class assigned
        if (!$student->class) {
            return back()->with('error', 'This student is not assigned to any class yet');
        }
    //    dd($student);
        return view('student.mySubject', [
            'student' => $student,
            'class_name' => $student->class->name,
            'subjects' => $student->class->classSubjects
        ]);
    }
}
