<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginAdminController extends Controller
{
    //
    public function getLogin()
    {
        if(Auth::guard('admin')->check())
        {
            return redirect()->route('dashboard');
        }
           return view('admin.login');

    }
    public function loginAdmin(Request $request)
    {
        $v=
        Validator::make($request->all(), [
            'inputEmail'=>'required|email',
            'inputPassword'=>'required',
        ], [
            'inputEmail.required'=>'Vui Lòng Nhập Email',
            'inputEmail.email'=>'Vui lòng Nhập Đúng Định Dạng Email',
            'inputPassword'=>'Vui Lòng Nhập Vào Password',
        ]);
        if($v->fails())
        {
            return redirect()->back()->withErrors($v)->withInput();
        }
        $inputEmail=$request->inputEmail;
        $inputPassword=$request->inputPassword;
        if(Auth::guard('admin')->attempt(['email' => $inputEmail, 'password' => $inputPassword]))
            {

           // echo $id=Auth::guard('admin')->user()->fullname;
                return redirect()->route('dashboard');
            }
            else
            {
                return redirect()->route('getLogin');
            }


    }

}
