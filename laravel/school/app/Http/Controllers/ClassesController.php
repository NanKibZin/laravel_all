<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index(){
        return view('admin.class.class');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>"required",
        ]);
        $data=new Classes();
        $data->name=$request->name;
        $data->status=$request->status;
        $data->save();
        return redirect()->route('class.read')->with('success','Academic year Added Successfully');
        // dd($request->all());
    }
    public function read(Request $request)
    {
        $query = Classes::query();
    
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $data["header_title"]="Admin Add Class";
        $data['class'] = $query->get();
    
        return view('admin.class.class_list', $data);
    }
    
    public function delete(string $id){
        $data=Classes::find($id);
        $data->delete();
        return redirect()->route('class.read')->with('success','Classes  delete Successfully');
    }
    public function edit($id){
        $dat['header_title']="Admin Class Edit";
        $dat['data']=Classes::find($id);
         return view('admin.class.class_edit',$dat);
    }
    public function update(Request $request){
        $data=Classes::find($request->id);
        $data->name=$request->name;
        $data->status=$request->status;
        $data->update();
        return redirect()->route('class.read')->with('success','updated successfully');
    }
}
