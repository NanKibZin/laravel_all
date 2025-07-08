<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\MiddlewareAccess\MiddlewareAccess;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/product',function(){
//     return view('product');
// });
// Route::get('/product/create',function(){
//     return view('create');
// });
// Route::get('/product/edit',function(){
//     return view('edit');
// });
Route::prefix('admin')->group(function(){
    Route::get('/', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('/register/process', [AuthController::class, 'processRegister'])->name('auth.registerProcess');
    Route::post('/login/process', [AuthController::class, 'processLogin'])->name('auth.loginProcess');
    #router with controller
    Route::middleware(MiddlewareAccess::class)->group(function(){
        Route::get('/product', [ProductController::class, 'index'])->name('p.list');
        Route::get('/product/create', [ProductController::class, 'create'])->name('p.create');
        Route::post('/product/store', [ProductController::class, 'store'])->name('p.store');
        Route::get('/product/{id}', [ProductController::class, 'delete'])->name('p.delete');
        Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('p.edit');
        Route::get('/product/update/{id}', [ProductController::class, 'update'])->name('p.update');
        Route::post('/product/deleteSelect', [ProductController::class, 'deleteSelect'])->name('p.deleteSelect');
        Route::get('/logout', [AuthController::class,'logout'])->name('auth.logout');
    });
   
});
    
    //middlware group
#Auth routers

// Route::get('/login',function(){
//     return view('login');
// });
// Route::get('/register',function(){
//     return view('register');});