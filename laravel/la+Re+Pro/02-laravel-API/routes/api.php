<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Route::("/store")

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post("/login",[ProductController::class,'login']);
Route::post("/register",[ProductController::class,'register']);
Route::post("/store",[ProductController::class,'store']);
Route::get("/list",[ProductController::class,'list']);
Route::post("/delete/{id}",[ProductController::class,'delete']);
Route::get("/edit/{id}",[ProductController::class,'edit']);
Route::get("/search/{key}",[ProductController::class,'search']);
Route::post("/update/{id}",[ProductController::class,'update']);
// Route::p("/update/{id}",[ProductController::class,'update']);