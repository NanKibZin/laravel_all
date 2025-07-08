<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class ProductController extends Controller
{
    public function login(Request $request){
        $validator=Validator::make($request->all(),[
            "password"=>"required",
        ]);
        if($validator->fails()){
            return response([

                "status"=>false,
                "error"=>$validator->errors()
            ],422);
        }
        $credentials=$request->only('email',"password");
        if(Auth::attempt($credentials)){
            $token=Auth::user()->createToken("API Token")->plainTextToken;
            $user=Auth::user();
            return response([
                "status"=>true,
                "user"=>$user,
                "token"=>$token,
                "message"=>"login successfully"
            ],200);
        }else{
            return response([
                "status"=>false,
                "message"=>"invalid email or password",
            ],401);
        }
    }
    public function register(Request $request){
        $validator=Validator::make($request->all(),[
            "password"=>"required",
        ]);
        if($validator->fails()){
            return response([

                "status"=>false,
                "error"=>$validator->errors()
            ],422);
        }else{

            $user=new User();
            $user->email=$request->email;
            $user->name=$request->name;
            $user->password=Hash::make($request->password);
            $user->save();
            $token=$user->createToken('API Token')->plainTextToken;
            return response([
                'status'=>true,
                'message'=>'Registration successfully created',
                'token'=>$token
            ],201);
        }
    }
    public function logout(){
        Auth::user()->tokens()->delete();
        return response([
            "status"=>true,
            "message"=>"logout successfully"
        ],200);
    }
    public function list(){
        $product=Product::orderBy("id","DESC")->get();
        return response([
            "status"=>"true",
            "products"=>$product
        ],200);
    }
    public function store(Request $request){
        $product=new Product();
        $product->name=$request->name;
        $product->price=$request->price;
        $product->qty=$request->qty;
        $product->status=$request->status;
        $product->des=$request->des;
        if($request->hasFile('image')){
            $file=$request->file('image');
            $fileName=rand(0,999999999).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'),$fileName);
            $product->image="http://127.0.0.1:8000/uploads/$fileName";
        }
        $product->save();
        return response([
            "status"=>"true",
            "message"=>"Product create successfully"
        ],200);
    }
    public function delete(string $id){
        $product=Product::find($id);
        if(!$product){
            return response([
                "status"=>"false",
                "message"=>"Product not found",
            ],404);
        }else{
            $image=$product->image;
            $imageName=basename($image);
            $imagePath=public_path("uploads/$imageName");
            if(File::exists($imagePath)){
                File::delete($imagePath);
            }
            $product->delete();
            return response([
                "status"=>"true",
                "message"=>"Product deleted",
            ],200);
        }
    }
    public function edit(string $id){
        $product=Product::find($id);
        return response([
            "status"=>"true",
            "message"=>"edit successfully",
            "products"=>$product,
        ],200);
    }
    public function update(Request $request,string $id){
        $product=Product::find($id);
        if (!$product) {
            return response([
                "status" => "false",
                "message" => "Product not found"
            ], 404);
        }
        $product->name=$request->name;
        $product->price=$request->price;
        $product->qty=$request->qty;
        $product->status=$request->status;
        $product->des=$request->des;
        if($request->hasFile('image')){
            if($product->image!=null){
                $image=$product->image;
                $imagePath=public_path('uploads/'.basename($image));
                if(File::exists($imagePath)){
                    File::delete($imagePath);
                }
            }
            $file=$request->file('image');
            $fileName=rand(0,999999999).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'),$fileName);
            $product->image="http://127.0.0.1:8000/uploads/$fileName";
            
        }
        $product->save();
        return response([
            "status"=>"true",
            "message"=>"Product update successfully"
        ],200);
    }
}
