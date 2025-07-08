<?php

namespace App\Http\Controllers;

use App\Models\FeeHead;
use Illuminate\Http\Request;

class FeeHeadController extends Controller
{
    public function index(){
        return view('admin.fee-head.fee-head');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>"required",
        ]);
        $data=new FeeHead();
        $data->name=$request->name;
        $data->save();
        return redirect()->route('class.read')->with('success','Academic year Added Successfully');
        // dd($request->all());
    }
    public function read(){
        $data['fee_heads'] = FeeHead::get();
        // dd($data);
        return view('admin.fee-head.fee-head-list', $data);
    }
    public function delete(string $id){
        $data=FeeHead::find($id);
        $data->delete();
        return redirect()->route('fee-head.create')->with('success','Academic year delete Successfully');
    }
    public function edit($id){
        $dat['data']=FeeHead::find($id);
         return view('admin.fee-head.fee-head-edit',$dat);
    }
    public function update(Request $request){
        $data=FeeHead::find($request->id);
        $data->name=$request->name;
        $data->update();
        return redirect()->route('fee-head.read')->with('success','updated successfully');
    }
}
