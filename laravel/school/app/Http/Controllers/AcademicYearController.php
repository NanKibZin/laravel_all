<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index(){
        return view('admin.academic_year');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>"required",
        ]);
        $data=new AcademicYear();
        $data->name=$request->name;
        $data->save();
        return redirect()->route('academic-year.read')->with('success','Academic year Added Successfully');
        // dd($request->all());
    }
    public function read(){
        $data['academic_year'] = AcademicYear::get();
        // dd($data);
        return view('admin.academic_year_list', $data);
    }
    public function delete(string $id){
        $data=AcademicYear::find($id);
        $data->delete();
        return redirect()->route('academic-year.create')->with('success','Academic year delete Successfully');
    }
    public function edit($id){
        $dat['data']=AcademicYear::find($id);
         return view('admin.edit_academic_year',$dat);
    }
    public function update(Request $request){
        $data=AcademicYear::find($request->id);
        $data->name=$request->name;
        $data->update();
        return redirect()->route('academic-year.read')->with('success','updated successfully');
    }
}
