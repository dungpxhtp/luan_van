<?php

namespace App\Http\Controllers\Frontend\Categoryproduct;

use App\Http\Controllers\Controller;
use App\Models\categoryproducts;
use App\Models\products;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
class categoryProductsController extends Controller
{
    //
    public function indexcategoryproducts()
    {
        return view('admin.categoryproducts.index');
    }
    public function fetchcategoryproducts(Request $request)
    {
        if($request->ajax())
        {
            $getData=categoryproducts::query();
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
                              $button.='<a type="button" href="update_categoryproducts/'.$getData->id.'/'.$getData->slug.'" name="update_status"  class="update_brands btn btn-info btn-sm">Sửa</a>';

                              return $button;

                })->addColumn('image_brands',function($getData){
                    $image= '<img src="'.$getData->image .' " alt="image thuong hieu" />' ;
                    return $image;
                })
                ->rawColumns(['status_brandproduct','created_at_brandproduct','action','image_brands'])
                ->make('true');

        }
    }
    public function update_status(Request $request,$id)
    {
      if($request->ajax())
      {
        $row=categoryproducts::findOrFail($id);
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
    public function destroy(Request $request,$id_categoryproducts)
    {
        if($request->ajax())
        {
            if(products::where([['id_categoryproducts','=',$id_categoryproducts]])->count())
            {
                return response()->json('Không Thể Xóa Do Còn Sản Phẩm Liên Quan');
            }
            $getData=categoryproducts::findOrFail($id_categoryproducts);
            if($getData->delete())
            {
                return response()->json('Xóa Thành Công');
            }

        }
    }
    public function update_categoryproducts($id_brandproducts,$slug)
    {
        $getData=categoryproducts::findOrFail($id_brandproducts);
        return view('admin.categoryproducts.update_categoryproducts',compact('getData'));
    }
    public function post_update_categoryproducts(Request $request ,$id_categoryproducts)
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
    if(categoryproducts::where([['name','=',$request->name],['id','<>',$id_categoryproducts]])->count())
            {
                return redirect()->back()->with("message",["type"=>"danger","msg"=>"Tên Loại Đã Tồn Tại. Nhập Lại "]);
            }

    if($request->status =='on')
            {
                $status=1;
            }else
            {
                $status=0;
            }
            $idAdmin=Auth::guard('admin')->user()->id;

            $row=categoryproducts::findOrFail($id_categoryproducts);
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
    public function add_categoryproducts()
    {
        return view('admin.categoryproducts.add_categoryproducts');
    }
    public function post_add_categoryproducts(Request $request)
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
    if(categoryproducts::where([['name','=',$request->name]])->count())
            {
                return redirect()->back()->with("message",["type"=>"danger","msg"=>"Tên Loại Đã Tồn Tại. Nhập Lại "]);
            }

    if($request->status =='on')
            {
                $status=1;
            }else
            {
                $status=0;
            }
            $idAdmin=Auth::guard('admin')->user()->id;

            $row=new categoryproducts;
            $row->created_at=Carbon::now('Asia/Ho_Chi_Minh');
            $row->created_by=$idAdmin;
            $row->status=$status;
            $row->name=$request->name;
            $row->slug=Str::slug($request->name);
            $row->metadesc=$request->metadesc;
            $row->metakey=$request->metakey;
            $row->updated_by=$idAdmin;
            $row->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
            $row->save();
            return redirect()->back()->with("message",["type"=>"success","msg"=>"Thêm Thành Công"]);
    }
}
