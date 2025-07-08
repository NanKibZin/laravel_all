<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function list(){

        $products = Product::all();

        return response([
            'products'  => $products
        ],200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'price' =>'required|numeric',
            'qty' =>'required|numeric'
        ]);
        if($validator->fails()){
            return response([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ],400);
        }
        try{
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'qty' => $request->qty
            ]);
            return response([
                'message' => 'Product created successfully',
                'product' => $product
            ],201);

        }catch(\Exception $e){
            return response([
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ],500);
        }
    }
}
