<?php

namespace App\Http\Controllers\Frontend\Admin\nhanVien;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Illuminate\Http\Request;
use Validator;
class nhanviencontroller extends Controller
{
    //
    public function account()
    {
        return view('admin.admin.accountInformation');
    }
    public function update(Request $request,$id_admin){
        try {

            $v=Validator::make($request->all(),[
                'name'=>'required',

                'phone'=>'required|min:10|max:12',


        ],[
                'name.required'=>'Không Được Bỏ Trống Tên ',

                'phone.min'=>'Không đúng định dạng',
                'phone.max'=>'Không đúng định dạng',

        ]);
        if($v->fails())
        {
            return redirect()->back()
            ->withErrors($v)
            ->withInput();
        }
            $update_admin=admin::find($id_admin);
            $update_admin->fullname=$request->get('name');
            $update_admin->phone=$request->get('phone');
            if($request->get('password-new')!=null)
            {
                $update_admin->password=bcrypt($request->get('password-new'));
            }
            $update_admin->save();

            return redirect()->back()->with("message",["type"=>"success","msg"=>"Sửa Thành Công"]);
        }catch(Exception $e)
        {
            return redirect()->back()->with("message",["type"=>"danger","msg"=>"Phát sinh lỗi"]);
        }
    }
}
