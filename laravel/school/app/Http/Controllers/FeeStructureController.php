<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Classes;
use App\Models\FeeHead;
use App\Models\FeeStructure;
use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    public function index(){
        $data['classes']=Classes::all();
        $data['academic_years']=AcademicYear::all();
        $data['fee_heads']=FeeHead::all();
        return view('admin.fee-structure.fee-structure',$data);
    }
    public function store(Request $request){
        $request->validate([
            'academic_year_id'=>"required",
            'class_id'=>"required",
            'fee_head_id'=>"required",
        ]);
        $data = new FeeStructure();
    $data->class_id = $request->class_id;
    $data->academic_id = $request->academic_year_id;
    $data->fee_head_id = $request->fee_head_id;
    $data->april = $request->april;
    $data->may = $request->may;
    $data->june = $request->june;
    $data->august = $request->august;
    $data->september = $request->september;
    $data->october = $request->october;
    $data->november = $request->november;
    $data->december = $request->december;
    $data->january = $request->january;
    $data->february = $request->February; // ចំណាំ៖ ឈ្មោះ field នេះមិនសុីគ្នារវាង input និង database column
    $data->march = $request->march;
    
    $data->save();
    
    return redirect()->route('fee-str.create')->with('success', 'Fee Structure Added Successfully');
        // dd($request->all());
    }
    public function read(){
        $data= FeeStructure::with(['FeeHead','AcademicYear','Class'])->get();
        // dd($data);
        // $data['classes']=Classes::all();
        // $data['academic_years']=AcademicYear::all();
        // $data['fee_heads']=FeeHead::all();
        return view('admin.fee-structure.fee-structure-list', ['data' => $data]);
    }
    public function delete(string $id){
        $data=FeeStructure::find($id);
        $data->delete();
        return redirect()->route('fee-str.read')->with('success','Academic year delete Successfully');
    }
    public function edit($id)
{
    $feeStructure = FeeStructure::findOrFail($id);
    
    $data = [
        'feeStructure' => $feeStructure,
        'classes' => Classes::all(),
        'academic_years' => AcademicYear::all(),
        'fee_heads' => FeeHead::all()
    ];
    // dd($data);
    return view('admin.fee-structure.fee-structure-edit', $data);
}
public function update(Request $request)
{
    $request->validate([
        'academic_year_id' => "required",
        'class_id' => "required",
        'fee_head_id' => "required",
        
    ]);

    $data = FeeStructure::find($request->id);
    $data->class_id = $request->class_id;
    $data->academic_id = $request->academic_year_id;
    $data->fee_head_id = $request->fee_head_id;
    $data->april = $request->april;
    $data->may = $request->may;
    $data->june = $request->june;
    $data->august = $request->august;
    $data->september = $request->september;
    $data->october = $request->october;
    $data->november = $request->november;
    $data->december = $request->december;
    $data->january = $request->january;
    $data->february = $request->february;
    $data->march = $request->march;
    $data->update();
    
    return redirect()->route('fee-str.read')->with('success', 'Updated successfully');
}
}
