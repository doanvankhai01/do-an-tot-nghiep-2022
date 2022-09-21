<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AuthUpdateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)//Tên không thể thay đổi 
    {
        // Middleware không thể sử dụng được model
        //nhiều quyền
        if(Auth::user()->hasAnyRoles(['update'])){
            return $next($request);
        }
        // 1 quyền
        // if(Auth::user()->hasRoles('select')){
        //     return $next($request);
        // }
        return redirect('/dashboard');
        
    }
}
