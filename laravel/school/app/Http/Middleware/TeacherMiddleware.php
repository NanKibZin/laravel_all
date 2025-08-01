<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!empty(Auth::check())){
            if(Auth::user()->role=='teacher'){ 
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
