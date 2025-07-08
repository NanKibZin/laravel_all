<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\ClassSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\Caster\ClassStub;

class ClassSubjectController extends Controller
{
    public function index()
    {
        $data["header_title"] = "Admin Add Subject";
        $data['classes'] = Classes::all();
        $data['subjects'] = Subject::all();
        return view('admin.cs.add', $data);
    }
    public function add(Request $request)
    {
        foreach ($request->subject_id as $subjectId) {
            $data = new ClassSubject();
            $data->class_id = $request->class_id;
            $data->subject_id = $subjectId;
            $data->status = $request->status;
            $data->create_by = Auth::user()->role;
            $data->save();
        }
        return redirect()->route('cs.list')->with('success', 'Subject Added Successfully');
    }
    public function list(Request $request)
    {
        $query = ClassSubject::query();

        // Filter by name (search input)
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        // Filter by subject type (dropdown)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Optional: filter by created date (if needed)
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $data["header_title"] = "Admin Add Class and Sub";
        $data['class'] = $query->with(['Class', 'Subject'])->get();

        return view('admin.cs.list', $data);
    }

    public function delete(string $id)
    {
        $data = ClassSubject::find($id);
        $data->delete();
        return redirect()->route('cs.list')->with('success', 'Subject  delete Successfully');
    }
    public function edit($id)
    {
        // Get the class-subject relationship being edited
        $classSubject = ClassSubject::findOrFail($id);

        // Get all subjects associated with this class
        $selectedSubjects = ClassSubject::where('class_id', $classSubject->class_id)
            ->pluck('subject_id')
            ->toArray();
        //>pluck('subject_id') យកតែជួរឈរ subject_id ពីលទ្ធផលដែលរកឃើញ pluck() មានន័យថា "ចាប់យក" តែព័ត៌មានជាក់លាក់មួយ toArray() ដើម្បីងាយស្រួលដំណើរការនៅពេលក្រោយ $selectedSubjects = [1, 2, 3];
        $data = [
            'ClassSubject' => $classSubject,
            'classes' => Classes::all(),
            'subjects' => Subject::all(),
            'selectedSubjects' => $selectedSubjects // Pass the selected subject IDs
        ];

        return view('admin.cs.edit', $data);
    }
    public function update(Request $request)
    {
        ClassSubject::where('class_id', $request->class_id)->delete();
        foreach ($request->subject_id as $subjectId) {
            $data = new ClassSubject();
            $data->class_id = $request->class_id;
            $data->subject_id = $subjectId;
            $data->status = $request->status;
            $data->create_by = Auth::user()->role;
            $data->save();
        }
        return redirect()->route('cs.list')->with('success', 'subject updated successfully');
    }
}
