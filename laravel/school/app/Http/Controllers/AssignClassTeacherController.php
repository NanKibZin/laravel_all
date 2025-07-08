<?php

namespace App\Http\Controllers;

use App\Models\AssignClassTeacher;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignClassTeacherController extends Controller
{
    public function index()
    {
        $data["header_title"] = "Assign class Teacher";
        $data['classes'] = Classes::all();
        $data['teacher'] = User::where('role','teacher')->get();
        return view('admin.assignClassTeacher.add', $data);
    }
    public function add(Request $request)
    {
        foreach ($request->subject_id as $subjectId) {
            $data = new AssignClassTeacher();
            $data->class_id = $request->class_id;
            $data->teacher_id = $subjectId;
            $data->status = $request->status;
           
            $data->save();
        }
        return redirect()->route('ct.list')->with('success', 'Assign class to teacher Successfully');
    }
    public function list(Request $request)
    {
        $query = AssignClassTeacher::query();

        // Filter by name (search input)
        if ($request->filled('search')) {
            $query->where('teacher_id', 'like', '%' . $request->search . '%');
        }
        // Filter by subject type (dropdown)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

       
        $data["header_title"] = "Assign Class to Teacher";
        $data['class'] = $query->with(['Class', 'teacher'])->get();

        return view('admin.assignClassTeacher.list', $data);
    }

    public function delete(string $id)
    {
        $data = AssignClassTeacher::find($id);
        $data->delete();
        return redirect()->route('ct.list')->with('success', 'Subject  delete Successfully');
    }
    public function edit($id)
    {
        // Get the class-subject relationship being edited
        $classSubject = AssignClassTeacher::findOrFail($id);

        // Get all subjects associated with this class
        $selectedSubjects = AssignClassTeacher::where('class_id', $classSubject->class_id)
            ->pluck('teacher_id')
            ->toArray();
        //>pluck('subject_id') យកតែជួរឈរ subject_id ពីលទ្ធផលដែលរកឃើញ pluck() មានន័យថា "ចាប់យក" តែព័ត៌មានជាក់លាក់មួយ toArray() ដើម្បីងាយស្រួលដំណើរការនៅពេលក្រោយ $selectedSubjects = [1, 2, 3];
        $data = [
            'ClassSubject' => $classSubject,
            'classes' => Classes::all(),
            'subjects' => User::where("role",'teacher')->get(),
            'selectedSubjects' => $selectedSubjects // Pass the selected subject IDs
        ];

        return view('admin.assignClassTeacher.edit', $data);
    }
    public function update(Request $request)
    {
        AssignClassTeacher::where('class_id', $request->class_id)->delete();
        foreach ($request->subject_id as $subjectId) {
            $data = new AssignClassTeacher();
            $data->class_id = $request->class_id;
            $data->teacher_id = $subjectId;
            $data->status = $request->status;
            $data->save();
        }
        return redirect()->route('ct.list')->with('success', 'subject updated successfully');
    }
}
