<?php

namespace App\Http\Controllers\Frontend\BrandProducts;

use App\Http\Controllers\Controller;
use App\Models\brandproducts;
use App\Models\products;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class brandproductsController extends Controller
{
    //
    public function index()
    {

        return view('admin.brandproducts.index');
    }

    public function ajaxbrandproduct(Request $request)
    {
        if($request->ajax())
        {
            $getData=brandproducts::query();
            return Datatables::of($getData)
            ->setRowAttr(['align'=>'center'])
            ->addColumn('status_brandproduct',function($getData){
                    if($getData->status==1){
                            $span='<span class="btn btn-sm btn-success" style="cursor: default;"><i class="fas fa-toggle-on"></i>Bật</span>';
                            return $span;

                    }else{
                             $span='<span class="btn btn-sm btn-danger" style="cursor: default;"><i class="fas fa-toggle-on"></i>Tắt</span>';
                             return $span;
                    }
            })
            ->addColumn('created_at_brandproduct',function($getData){
                $time=  \Carbon\Carbon::parse($getData->created_at)->format('d/m/Y');
                $time.="<br> <br>".$getData->getNameCreate->fullname;
                return $time;
            })
            ->addColumn('action',function($getData){
                        if($getData->status==1){
                            $button='<a type="button" href="'.$getData->id.'" name="update_status"  class="update_status btn btn-danger btn-sm"><i class="fas fa-power-off"></i>Tắt</a>';


                        }else{
                            $button ='<a type="button" href="'.$getData->id.'" name="update_status" class="update_status btn btn-success btn-sm"><i class="fas fa-power-off"></i>Bật</a>';

                        }
                          $button.='<a type="button" href="'.$getData->id.'" name="update_status"  class="delete_brands btn btn-secondary btn-sm"> <i class="fas fa-trash"></i> Xóa</a>';
                          $button.='<a type="button" href="update_brandproduct/'.$getData->id.'/'.$getData->slug.'" name="update_status"  class="update_brands btn btn-info btn-sm">Sửa</a>';

                          return $button;

            })->addColumn('image_brands',function($getData){
                $image= '<img src="'.$getData->image .' " alt="image thuong hieu" style="height:150px;width:150px;" />' ;
                return $image;
            })->addColumn('stt',function($getData){
                $status=$getData->updateName;
                if($status)
                {   $time=  \Carbon\Carbon::parse($getData->updated_at)->format('d/m/Y');
                    $time.="<br> <br>".$status->fullname;
                    return $time;
                }else
                {
                    $status="chưa cập nhật";
                    return $status;

                }
            })
            ->addColumn('soluong',function($getData){
                $quantity=products::where('id_brandproducts','=',$getData->id)->get()->count();

                return $quantity;
            })
            ->rawColumns(['status_brandproduct','created_at_brandproduct','action','image_brands','stt','soluong'])
            ->make('true');
        }
    }

    public function update_status(Request $request,$id)
    {
      if($request->ajax())
      {
        $row=brandproducts::find($id);
        if($row->status==0)
        {
            $row->status=1;
            $row->updated_by=Auth::guard('admin')->user()->id;
            $row->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
            $row->save();
            return response()->json(['success'=>'Bật Trạng Thái Thành Công']);
        }else
        {
            $row->status=0;
            $row->updated_by=Auth::guard('admin')->user()->id;
            $row->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
            $row->save();
            return response()->json(['success'=>'Tắt Trạng Thái Thành Công']);
        }
      }

    }
    public function update_brandproduct($id_brandproducts,$slug)
    {
        $getData=brandproducts::findOrFail($id_brandproducts);
        return view('admin.brandproducts.update_brandproduct',compact('getData'));
    }
    public function post_brandproduct(Request $request,$id_brandproducts)
    {
        $v=Validator::make($request->all(), [
            'name'=>'required',
            'code'=>'required',
            'detail'=>'required',
            'filepath'=>'required',

        ],
        [
            'name.required'=>'Tên Không Được Bỏ Trống',
            'code.required'=>'Mã Sản Phẩm Không Được Bỏ Trống',
            'detail.required'=>'Không Được Bỏ Trống',
            'filepath.required'=>'Không Được Bỏ Trống',


        ] );
        if($v->fails())
            {
                return redirect()->back()
                ->withErrors($v)
                ->withInput();
            }
    if(brandproducts::where([['name','=',$request->name],['id','<>',$id_brandproducts]])->count())
            {
                return redirect()->back()->with("message",["type"=>"danger","msg"=>"Tên Sản Phẩm Đã Tồn Tại. Nhập Lại "]);
            }
    if(brandproducts::where([['code','=',$request->code],['id','<>',$id_brandproducts]])->count())
            {
                return redirect()->back()->with("message",["type"=>"danger","msg"=>"Mã Sản Phẩm Đã Tồn Tại.Nhập Lại"]);
            }
    if($request->status =='on')
            {
                $status=1;
            }else
            {
                $status=0;
            }
            $idAdmin=Auth::guard('admin')->user()->id;

            $str_code=Str::slug($request->code);
            $row=brandproducts::findOrFail($id_brandproducts);
            $row->status=$status;
            $row->name=$request->name;
            $row->code=strtoupper($str_code);
            $row->slug=Str::slug($request->name);
            $row->image=$request->filepath;
            $row->metadesc=$request->metadesc;
            $row->metakey=$request->metakey;
            $row->detail=$request->detail;
            $row->created_by=$idAdmin;
            $row->created_at=Carbon::now('Asia/Ho_Chi_Minh');
            $row->save();
            return redirect()->back()->with("message",["type"=>"success","msg"=>"Sửa Thành Công"]);
    }
    public function destroy(Request $request,$id_brandproducts)
    {
        if($request->ajax())
        {
            if(products::where([['id_brandproducts','=',$id_brandproducts]])->count())
            {
                return response()->json('Không Thể Xóa Do Còn Sản Phẩm Liên Quan');
            }
            $getData=brandproducts::findOrFail($id_brandproducts);
            if($getData->delete())
            {
                return response()->json('Xóa Thành Công');
            }

        }
    }
    public function add_brandproduct()
    {
        return view('admin.brandproducts.add_brandproduct');
    }
    public function post_add_brandproduct(Request $request)
    {

        $v=Validator::make($request->all(), [
            'name'=>'required',
            'code'=>'required',
            'detail'=>'required',
            'filepath'=>'required',

        ],
        [
            'name.required'=>'Tên Không Được Bỏ Trống',
            'code.required'=>'Mã Sản Phẩm Không Được Bỏ Trống',
            'detail.required'=>'Không Được Bỏ Trống',
            'filepath.required'=>'Không Được Bỏ Trống',


        ] );
        if($v->fails())
            {
                return redirect()->back()
                ->withErrors($v)
                ->withInput();
            }
    if(brandproducts::where([['name','=',$request->name]])->count())
            {
                return redirect()->back()->with("message",["type"=>"danger","msg"=>"Tên Sản Phẩm Đã Tồn Tại. Nhập Lại "]);
            }
    if(brandproducts::where([['code','=',$request->code]])->count())
            {
                return redirect()->back()->with("message",["type"=>"danger","msg"=>"Mã Sản Phẩm Đã Tồn Tại.Nhập Lại"]);
            }
    if($request->status =='on')
            {
                $status=1;
            }else
            {
                $status=0;
            }
            $idAdmin=Auth::guard('admin')->user()->id;
            $str_code=Str::slug($request->code);
            $row=new brandproducts;
            $row->status=$status;
            $row->name=$request->name;
            $row->code=strtoupper($str_code);
            $row->slug=Str::slug($request->name);
            $row->image=$request->filepath;
            $row->metadesc=$request->metadesc;
            $row->metakey=$request->metakey;
            $row->detail=$request->detail;
            $row->created_by=$idAdmin;
            $row->created_at=Carbon::now('Asia/Ho_Chi_Minh');
            $row->save();
            return redirect()->back()->with("message",["type"=>"success","msg"=>"Thêm Thành Công"]);
    }
}
