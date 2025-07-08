<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index()
    {
        $data["header_title"] = "Admin Add Subject";
        return view('admin.subject.add', $data);
    }
    public function add(Request $request)
    {
        $data = new Subject();
        $data->name = $request->name;
        $data->type = $request->type;
        $data->status = $request->status;
        $data->create_by = Auth::user()->role;
        $data->save();
        return redirect()->route('sub.list')->with('success', 'Subject Added Successfully');
        // dd($request->all());
    }
    public function list(Request $request)
    {
        $query = Subject::query();

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

        $data["header_title"] = "Admin Add Class";
        $data['class'] = $query->get();

        return view('admin.subject.list', $data);
    }


    public function delete(string $id)
    {
        $data = Subject::find($id);
        $data->delete();
        return redirect()->route('sub.list')->with('success', 'Subject  delete Successfully');
    }
    public function edit($id)
    {
        $dat['header_title'] = "Admin Class Edit";
        $dat['data'] = Subject::find($id);
        return view('admin.subject.edit', $dat);
    }
    public function update(Request $request)
    {
        $data = Subject::find($request->id);
        $data->name = $request->name;
        $data->type = $request->type;
        $data->status = $request->status;
        $data->update();
        return redirect()->route('sub.list')->with('success', 'subject updated successfully');
    }
}
