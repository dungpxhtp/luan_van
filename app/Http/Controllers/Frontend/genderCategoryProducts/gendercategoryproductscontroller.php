<?php

namespace App\Http\Controllers\Frontend\genderCategoryProducts;

use App\Http\Controllers\Controller;
use App\Models\gendercategoryproducts;
use App\Models\products;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class gendercategoryproductscontroller extends Controller
{
    //
    public function indexgendercategoryproducts(){
        return view('admin.genderproducts.index');
    }
    public function fetchgendercategoryproducts(Request $request)
    {
        if($request->ajax())
        {
            $getData=gendercategoryproducts::query();
            return Datatables::of($getData)
            ->setRowAttr(['align'=>'center'])
            ->addColumn('status_brandproduct',function($getData){
                    if($getData->status==1){
                            $span='<span class="btn btn-sm btn-success" style="cursor: default;"><i class="fas fa-toggle-on"></i>Bật</span>';
                            return $span;

                    }else{
                             $span='<span class="btn btn-sm btn-success" style="cursor: default;"><i class="fas fa-toggle-on"></i>Tắt</span>';
                             return $span;
                    }
            })
            ->addColumn('created_at_brandproduct',function($getData){
                $time=  \Carbon\Carbon::parse($getData->created_at)->format('d/m/Y');
                return $time;
            })
            ->addColumn('action',function($getData){
                        if($getData->status==1){
                            $button='<a type="button" href="'.$getData->id.'" name="update_status"  class="update_status btn btn-danger btn-sm"><i class="fas fa-power-off"></i>Tắt</a>';


                        }else{
                            $button ='<a type="button" href="'.$getData->id.'" name="update_status" class="update_status btn btn-success btn-sm"><i class="fas fa-power-off"></i>Bật</a>';

                        }
                          $button.='<a type="button" href="'.$getData->id.'" name="update_status"  class="delete_brands btn btn-secondary btn-sm"> <i class="fas fa-trash"></i> Xóa</a>';
                          $button.='<a type="button" href="update_gendercategoryproducts/'.$getData->id.'/'.$getData->slug.'" name="update_status"  class="update_brands btn btn-info btn-sm">Sửa</a>';

                          return $button;

            })
            ->rawColumns(['status_brandproduct','created_at_brandproduct','action'])
            ->make('true');
        }
    }
    public function update_status(Request $request,$id)
    {
      if($request->ajax())
      {

        $row=gendercategoryproducts::findOrFail($id);

        if($row->status==0)
        {
            $row->status=1;
            $row->save();
            return response()->json('Bật Trạng Thái Thành Công');
        }else
        {
            $row->status=0;
            $row->save();
            return response()->json('Tắt Trạng Thái Thành Công');
        }
      }

    }
    public function destroy_gendercategoryproducts(Request $request ,$id)
    {
        if($request->ajax())
        {

            if(products::where([['id_gendercategoryproducts','=',$id]])->count())
            {
                return response()->json('Không Thể Xóa Do Còn Sản Phẩm Liên Quan');
            }
            $getData=gendercategoryproducts::findOrFail($id);
            if($getData->delete())
            {
                return response()->json('Xóa Thành Công');
            }

        }
    }
    public function update_gendercategoryproducts($id_gendercategoryproducts,$slug)
    {
        $getData=gendercategoryproducts::findOrFail($id_gendercategoryproducts);
        return view('admin.genderproducts.update_gendercategoryproducts',compact('getData'));
    }
    public function post_update_gendercategoryproducts(Request $request ,$id_gendercategoryproducts)
    {
        $v=Validator::make($request->all(), [
            'name'=>'required',


        ],
        [
            'name.required'=>'Tên Không Được Bỏ Trống',



        ] );
        if($v->fails())
            {
                return redirect()->back()
                ->withErrors($v)
                ->withInput();
            }
    if(gendercategoryproducts::where([['name','=',$request->name],['id','<>',$id_gendercategoryproducts]])->count())
            {
                return redirect()->back()->with("message",["type"=>"danger","msg"=>"Tên  Đã Tồn Tại. Nhập Lại "]);
            }

    if($request->status =='on')
            {
                $status=1;
            }else
            {
                $status=0;
            }
            $idAdmin=Auth::guard('admin')->user()->id;

            $row=gendercategoryproducts::findOrFail($id_gendercategoryproducts);
            $row->status=$status;
            $row->name=$request->name;
            $row->slug=Str::slug($request->name);
            $row->metadesc=$request->metadesc;
            $row->metakey=$request->metakey;
            $row->updated_by=$idAdmin;
            $row->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
            $row->save();
            return redirect()->back()->with("message",["type"=>"success","msg"=>"Sửa Thành Công"]);
    }
    public function post_add_gendercategoryproducts(Request $request)
    {
        if($request->ajax()){
            $v=Validator::make($request->all(), [
                'name'=>'required',


            ],
            [
                'name.required'=>'Tên Không Được Bỏ Trống',



            ] );
            if($v->fails())
                {
                    return response()->json(['errors' => $v->errors()->all()]);
                }
        if(gendercategoryproducts::where([['name','=',$request->name]])->count())
                {
                    return response()->json(['errors' => 'Tên Đã Tồn Tại . Nhập lại']);
                }

        if($request->status =='on')
                {
                    $status=1;
                }else
                {
                    $status=0;
                }
                $idAdmin=Auth::guard('admin')->user()->id;

                $row=new gendercategoryproducts;
                $row->status=$status;
                $row->name=$request->name;
                $row->slug=Str::slug($request->name);
                $row->metadesc=$request->metadesc;
                $row->metakey=$request->metakey;
                $row->created_by=$idAdmin;
                $row->created_at=Carbon::now('Asia/Ho_Chi_Minh');
                $row->save();
                return response()->json(['success' => 'Thêm thành cồng.']);
        }
    }
}
