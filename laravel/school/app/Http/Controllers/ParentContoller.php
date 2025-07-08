<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ParentContoller extends Controller
{

    // app/Http/Controllers/ParentController.php
public function myStu($id)
{
    $students = User::where('parent_id', $id)
    ->where('role', 'student')
    ->orderBy('name')
    ->get();

    // dd($students);
    return view('parent.myStu', [
        // 'parent' => $parent,
        'students' => $students,
        // 'header_title' => "{$parent->name}'s Children"
    ]);
}
    public function mySon(Request $request, $id)
    {
        $query = User::where('role', 'student')->with('parent');

        // Individual field filters
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('id')) {
            $query->where('id', 'like', '%' . $request->id . '%'); // Fixed: was using name instead of id
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $data["header_title"] = "Parent Student List";
        $data['data'] = $query->orderBy('name')->get();
        // dd($data);
        $data['parent_id'] = $id;

        return view('admin.parent.mySon', $data);
    }
    public function assignStudentToParent($student_id, $parent_id)
    {
        $student = User::find($student_id);
        $student->parent_id = $parent_id;
        $student->save();
        return redirect()->back()->with('success', 'Student Assign to Parent Successfully');
    }
    public function index()
    {
        return view('admin.parent.add');
    }
    public function store(Request $request)
    {

        $user = new User();
        // Map form fields to database columns
        $user->name = $request->first_name; // Note: The DB has 'name' but form has 'first_name'
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->job = $request->job;
        $user->mobile_number = $request->mobile_number;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->password = Hash::make($request->password);
        $user->role = 'parent'; // Set role to student as in your original function

        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/parent'), $filename);
            $user->image = 'uploads/parent/' . $filename; // Note: The DB has 'image' but form has 'profile_pic'
        }
        $user->save();

        return redirect()->route('pa.read')->with('success', 'Student Added Successfully');
    }

    public function read(Request $request)
    {
        $query = User::where('role', 'parent');
        // Individual field filters
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        $data["header_title"] = "Parent List";
        $data['data'] = $query->orderBy('name')->get();

        return view('admin.parent.list', $data);
    }
    public function edit($id)
    {

        $students = User::find($id);
        return view('admin.parent.edit', [
            'student' => $students
        ]);
    }
    public function update(Request $request)
    {
        // Validate request data


        // Find the student to update
        $user = User::find($request->id);

        if (!$user) {
            return redirect()->back()->with('error', 'teacher not found');
        }

        // Update student data
        $user->name = $request->first_name; // Note: The DB has 'name' but form has 'first_name'
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->job = $request->job;
        $user->mobile_number = $request->mobile_number;
        $user->email = $request->email;
        $user->status = $request->status;

        // Only update password if a new one was provided
        

        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            // Delete old image if exists
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/parent'), $filename);
            $user->image = 'uploads/parent/' . $filename;
        }

        $user->save();

        return redirect()->route('pa.read')->with('success', 'Parent updated successfully');
    }
    public function delete(string $id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->route('pa.read')->with('success', 'Parent delete Successfully');
    }
}
