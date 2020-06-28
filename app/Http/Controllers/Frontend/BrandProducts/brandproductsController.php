<?php

namespace App\Http\Controllers\Frontend\BrandProducts;

use App\Http\Controllers\Controller;
use App\Models\brandproducts;
use Illuminate\Http\Request;

class brandproductsController extends Controller
{
    //
    public function index()
    {
        $getData=brandproducts::all();
        return view('admin.brandproducts.index',compact('getData'));
    }
    public function update_status($id)
    {
        $row=brandproducts::findOrFail($id);
        if($row->status==0)
        {
            $row->status=1;
            $row->save();
            return redirect()->back()->with("message",["type"=>"success","msg"=>"Bật Trạng Thái Thành Công "]);
        }else
        {
            $row->status=0;
            $row->save();
            return redirect()->back()->with("message",["type"=>"success","msg"=>"Tắt Trạng Thái Thành Công "]);
        }

    }
    public function update_brandproduct($id_brandproducts,$slug)
    {
        $getData=brandproducts::findOrFail($id_brandproducts);
        return view('admin.brandproducts.update_brandproduct',compact('getData'));
    }
    public function post_brandproduct(Request $request,$id_brandproducts)
    {
        dd($request->all());
    }
}
