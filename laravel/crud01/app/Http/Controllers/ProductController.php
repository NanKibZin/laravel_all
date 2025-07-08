<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request){
        if($request->get('search')!=''){
            $products=Product::orderBy("id","DESC")->where('name','LIKE','%'. $request->get('search'). '%')->paginate(8);
        }else{
            $products=Product::orderBy('id','DESC')->paginate(8);
        }
        // return $products;
        return view('product',[
            'products' => $products
        ]);
    }
    public function create(){
        return view('create');
    }
    public function edit(string $id){
        $product=Product::find($id);
        // return $product;
        return view('edit',[
            "product"=>$product
        ]);
    }
    public function store(Request $request){
       
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'price' => 'required|numeric',
            'qty' => 'required|integer'
        ]);
        
        if($validator->passes()){
            $product=new Product();
            $product->name=$request->input('name');
            $product->price=$request->input('price');
            $product->des=$request->input('des');
            $product->qty=$request->input('qty');
            if(asset($request->file('image'))){
                $file=$request->file('image');
                //extension image
                //phone.jpg
                $ext=$file->getClientOriginalExtension();//=>jpg
                //set image name 
                // 0->9 ,1->8
                $imageName=rand(0,99999999).'.'.$ext;  //24345.jpg
                // move to directory
                $file->move(public_path("uploads"),$imageName);
                $product->image=$imageName;
            }
            //with session
            session()->flash("success","Product Cre,ded");
            $product->save();
            return response()->json([
                'status' => 200,
                'message'=>"Product created successfully"
            ]);
        }else{
            return response([
                "status"=>500,
                "message"=>"Please confige error",
                "errors"=>$validator->errors(),
            ]);
        }
       
        // return view('store');
    }
    public function delete(string $id){
        $product=Product::find($id);
        // if($product===null){
        //     return redirect()->back();
        // }
        if($product->image!=null){
            $image_path=public_path("uploads/".$product->image);
            if(File::exists($image_path)){
               File::delete($image_path);
            }
        }
        $product->delete();
        return redirect()->back()->with('success','Product delete success');
    }
    public function update(Request $request,string $id){   //1 get param 2 get data that request here
        // dd($request->all());
        $product=Product::find($id);
        //  return $product;
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'des' => 'required',
            'qty' => 'required'
        ]);
        if($product==null){
            return redirect()->back()->with("error","Product not found with id $id");
        }
        if($validator->passes()){
            $product->name=$request->input('name');
            $product->price=$request->input('price');
            $product->des=$request->input('des');
            $product->qty=$request->input('qty');
            if($request->hasFile('image')){
                $file=$request->file('image');
                $fileName=rand(0,99999999).'.'.$file->getClientOriginalExtension();//=>2334563.jpg
                $file->move(public_path('uploads'),$fileName);
                if($request->old_image!=null){
                    $image_path=public_path("uploads/".$request->old_image);
                    if(File::exists($image_path)){
                        File::delete($image_path);
                    }
                }
            }else{
                $imageName=$request->old_image;
            }
            $product->image=$imageName;
            $product->save();
            return redirect()->route('p.list')->with('success', 'Product updated');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
     
    }
   
    public function deleteSelect(Request $request){
        $productids = explode(",", $request->id); // Ensure it's an array
        foreach($productids as $productId){
            $product = Product::find($productId);
            if ($product) {
                if (!empty($product->image)) {
                    $image_path = public_path("uploads/".$product->image);
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                $product->delete();
            }
        }
        return response()->json([
            "status" => 200,
            "message" => "Delete success"
        ]);
    }
    
}
