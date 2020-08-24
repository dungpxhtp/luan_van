<?php

namespace App\Http\Controllers;

use App\Models\users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Socialite;
class SocialAuthController extends Controller
{
    //
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleProviderCallback(Request $request)
    {
         if (!$request->has('code') || $request->has('denied'))
         {
            return redirect()->route('home')->with("message",["type"=>"danger","msg"=>"Không Cấp Quyền Truy Cập "]);
        }
             $getInfo  = Socialite::driver('facebook')->user();
            $user=$this->checklogin($getInfo);
            if($user->status==0)
            {
                return redirect()->route('home')->with("message",["type"=>"danger","msg"=>"Tài Khoản Bị Khóa"]);
            }
            Auth::guard('khachhang')->login($user);

            return redirect()->route('home')->with("message",["type"=>"success","msg"=>"Đăng Nhập Thành Công"]);




    }
    public function checklogin($getInfo)
    {
        $user=users::where('provider_id','=',$getInfo->id)->first();
        if(!$user)
        {
            $user=new users;
              $user->name     = $getInfo->name;
                $user->email    = $getInfo->email;
                $user->provider_id = $getInfo->id;
                $user->created_at=Carbon::now('Asia/Ho_Chi_Minh');
                $user->codeuser='FB'.$getInfo->id;
                $user->socialnetworks='Facebook';

                $user->save();
        }
        return $user;
    }
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(Request $request)
    {
        $getInfo  = Socialite::driver('google')->user();
        $user=$this->checkLoginGoogle($getInfo);
        if($user->status==0)
        {
            return redirect()->route('home')->with("message",["type"=>"danger","msg"=>"Tài Khoản Bị Khóa"]);
        }
        Auth::guard('khachhang')->login($user);

        return redirect()->route('home')->with("message",["type"=>"success","msg"=>"Đăng Nhập Thành Công"]);
    }
    public function checkLoginGoogle($getInfo)
    {
        $user=users::where('provider_id','=',$getInfo->id)->first();
        if(!$user)
        {
                $user=new users;
                $user->name     = $getInfo->name;
                $user->email    = $getInfo->email;
                $user->provider_id = $getInfo->id;

                $user->created_at=Carbon::now('Asia/Ho_Chi_Minh');
                $user->codeuser='GG'.$getInfo->id;
                $user->socialnetworks='Google';

                $user->save();
        }
        return $user;
    }
}
