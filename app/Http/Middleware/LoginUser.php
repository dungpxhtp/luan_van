<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LoginUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('khachhang')->check())
        {

           return $next($request);



        }else
        {
           if($request->ajax())
           {
               return response()->json(['success'=>'Yêu Cầu Đăng Nhập']);
           }else
           {
            return redirect()->back()->with("message",["type"=>"danger","msg"=>"Yêu Cầu Đăng Nhập"]);
           }

        }

    }
}
