<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(!empty(Auth::check())){
            if(Auth::user()->role=='admin'){ 
                return $next($request);
            }else{
                Auth::logout();
                return redirect()->back();
            }
        }else{
            Auth::logout();
            return redirect()->back();
        }
    }
}
// if(Auth::guard('admin')->check()){
//     return $next($request);
// }else{
// }
