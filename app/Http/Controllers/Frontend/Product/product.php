<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use App\library\library_my;
use App\Models\brandproducts;
use App\Models\categoryproducts;
use App\Models\gendercategoryproducts;
use App\Models\ordersproducts;
use App\Models\productdorderscolor;
use App\Models\productglasses;
use App\Models\productmodel;
use App\Models\products;
use App\Models\productssize;
use App\Models\productwaterproorf;
use Carbon\Carbon;
use Exception;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class product extends Controller
{
    //
    function index()
    {
        $getData=brandproducts::where('status','=','1')->get();
        return view('admin.products.main',compact('getData'));
    }
    function productbrands($slug)
    {   $getIdCate=brandproducts::where('slug','=',$slug)->first();
        //get array list id cate
        $getData=products::where([['products.id_brandproducts','=',$getIdCate->id]])
                ->join('categoryproducts','products.id_categoryproducts','=','categoryproducts.id')
                ->join('gendercategoryproducts','products.id_gendercategoryproducts','gendercategoryproducts.id')
                ->select('products.*','categoryproducts.name as NameLoai','gendercategoryproducts.name as nameGender')
                ->orderBy('products.created_at','desc')
                ->get();

        $idCate=library_my::getId_CateProduct($getData);


        $getCate=categoryproducts::where([['status','=','1']])->whereIn('id',$idCate)->get();

        $getNameCate=$getIdCate->name;
        $getId_brandproducts=$getIdCate->slug;

        return view('admin.products.productbrands',compact('getData','getNameCate','getCate','getId_brandproducts'));
    }
    function get_products_cat_brands($id_brandproducts,$id_cate)
    {

        $id_Brand=brandproducts::where([['slug','=',$id_brandproducts],['status','=','1']])->firstOrFail();
        $id_Cates=categoryproducts::where([['slug','=',$id_cate],['status','=','1']])->firstOrFail();
        $id_categoryproducts=$id_Cates->id;
        $id_brandproducts=$id_Brand->id;
        $NameCate=$id_Cates->name;
        $NameBrand=$id_Brand->name;
        $getData=products::where([['id_categoryproducts','=',$id_categoryproducts],['id_brandproducts','=',$id_brandproducts],['products.status','=','1']])
        ->join('gendercategoryproducts','products.id_gendercategoryproducts','gendercategoryproducts.id')
        ->select('products.*','gendercategoryproducts.name as nameGender')
        ->orderBy('products.created_at','desc')
        ->get();


        return view('admin.products.get_products_cat_brands',compact('NameCate','NameBrand','getData'));
    }
    public function updateStatusProduct($idProducts)
    {
        try {
            //code...
            $findProducts=products::findOrFail($idProducts);

                if($findProducts->status==0)
                {
                    $findProducts->status=1;
                    $findProducts->save();
                }else
                {
                $findProducts->status=0;
                $findProducts->save();
                }
                return response()->json(
                    [
                        'status'=>200,
                        'data'=>$findProducts,
                    ]


                );

        } catch (Exception $e) {
            //throw $th;
        }

    }
    //sua product

    public function repair($slug_products ,$id_product)
    {
        //dd($id);
        $products=products::findOrFail($id_product);
        //size
        $Size=productssize::get();
        //độ chống nước
        $WaterProorf=productwaterproorf::get();
        //Model/
        $Model=productmodel::get();
        //màu viền sản phẩm
        $Borderscolor=productdorderscolor::get();
        //Độ Chịu Lực
        $Glass=productglasses::get();
        //thương Hiệu
        $Brands=brandproducts::get();

        //Đối Tượng
        $genderCate=gendercategoryproducts::get();
        //Loại
        $categoryproducts=categoryproducts::get();


        return view('admin.products.repair',compact('products','Size','WaterProorf','Model','Glass','Brands','genderCate','categoryproducts','Borderscolor'));
    }
    public function save_repair(Request $request,$id)
    {


        $v=Validator::make($request->all(), [
            'name'=>'required',
            'code'=>'required',
            'detail'=>'required',
            'id_gendercategoryproducts'=>'required',
            'filepath'=>'required',
            'id_productmodel'=>'required',
            'id_productssize'=>'required',
            'id_productwaterproorf'=>'required',
            'id_productglasses'=>'required',
            'id_categoryproducts'=>'required',
            'id_productboder'=>'required',
            'id_brandproducts'=>'required',

            'price'=>'required',
        ],
        [
            'name.required'=>'Tên Không Được Bỏ Trống',
            'code.required'=>'Mã Sản Phẩm Không Được Bỏ Trống',
            'name.unique'=>'Trùng Tên Sản Phẩm',
            'code.unique'=>'Trùng Mã Sản Phẩm',
            'detail.required'=>'Không Được Bỏ Trống',
            'filepath.required'=>'Vui Lòng Chọn Hình',
            'id_productmodel.required'=>'Không Được Bỏ Trống',
            'id_productssize.required'=>'Không Được Bỏ Trống',
            'id_productwaterproorf.required'=>'Không Được Bỏ Trống',
            'id_productglasses.required'=>'Không Được Bỏ Trống',
            'id_categoryproducts.required'=>'Không Được Bỏ Trống',
            'id_productboder.required'=>'Không Được Bỏ Trống',
            'price.required'=>'Không Được Bỏ Trống',

        ] );
        if($v->fails())
            {
                return redirect()->back()
                ->withErrors($v)
                ->withInput();
            }
        if(products::where([['name','=',$request->name],['id','<>',$id]])->count())
        {
            return redirect()->back()->with("message",["type"=>"danger","msg"=>"Tên Sản Phẩm Đã Toàn Tại "]);
        }
        if(products::where([['code','=',$request->code],['id','<>',$id]])->count())
        {
            return redirect()->back()->with("message",["type"=>"danger","msg"=>"Mã Sản Phẩm Đã Tồn Tại"]);
        }
        if($request->serinumber=='on')
        {
            $serinumber=1;

        }else
        {
            $serinumber=0;
        }
        $idAdmin=Auth::guard('admin')->user()->id;
        $str_code=Str::slug($request->code);
        $row=products::findOrFail($id);
        $row->name=$request->name;
        $row->code=strtoupper($str_code);
        $row->slug=Str::slug($request->name);
        $row->image=$request->filepath;
        $row->price=$request->price;
        $row->pricesale=$request->price_km;

        $row->serinumber=$serinumber;
        $row->id_brandproducts=$request->id_brandproducts;
        $row->id_productboder=$request->id_productboder;
        $row->id_categoryproducts=$request->id_categoryproducts;
        $row->id_productglasses=$request->id_productglasses;
        $row->id_productwaterproorf=$request->id_productwaterproorf;
        $row->id_productssize=$request->id_productssize;
        $row->id_productmodel=$request->id_productmodel;
        $row->id_gendercategoryproducts=$request->id_gendercategoryproducts;
        $row->metadesc=$request->metadesc;
        $row->metakey=$request->metakey;
        $row->detail=$request->detail;
        $row->update_by=$idAdmin;
        $row->update_at=Carbon::now('Asia/Ho_Chi_Minh');
        $row->save();
        return redirect()->back()->with("message",["type"=>"success","msg"=>"Sửa Thành Công"]);

    }
    public function deleteProducts($id)
    {
        $row=products::findOrFail($id);
        if(ordersproducts::where('id_products','=',$id)->count())
        {
            return redirect()->back()->with("message",["type"=>"danger","msg"=>"Xóa Không Thành Công Vì Có Đơn Hàng Liên Quan "]);
        }
        $row->delete();

        return redirect()->back()->with("message",["type"=>"success","msg"=>"Xóa  Sản Phẩm thành Công"]);

    }
    public function getSaveProducts()
    {     $Size=productssize::get();
        //độ chống nước
        $WaterProorf=productwaterproorf::get();
        //Model/
        $Model=productmodel::get();
        //màu viền sản phẩm
        $Borderscolor=productdorderscolor::get();
        //Độ Chịu Lực
        $Glass=productglasses::get();
        //thương Hiệu
        $Brands=brandproducts::get();

        //Đối Tượng
        $genderCate=gendercategoryproducts::get();
        //Loại
        $categoryproducts=categoryproducts::get();
        return view('admin.products.getSaveProducts',compact('Size','WaterProorf','Model','Glass','Brands','genderCate','categoryproducts','Borderscolor'));
    }
    public function postSaveProducts(Request $request)
    {

        $v=Validator::make($request->all(), [
            'name'=>'required',
            'code'=>'required',
            'detail'=>'required',
            'id_gendercategoryproducts'=>'required',
            'filepath'=>'required',
            'id_productmodel'=>'required',
            'id_productssize'=>'required',
            'id_productwaterproorf'=>'required',
            'id_productglasses'=>'required',
            'id_categoryproducts'=>'required',
            'id_productboder'=>'required',
            'id_brandproducts'=>'required',

            'price'=>'required|regex:/^\d+(\.\d{1,2})?$/',
        ],
        [
            'name.required'=>'Tên Không Được Bỏ Trống',
            'code.required'=>'Mã Sản Phẩm Không Được Bỏ Trống',
            'name.unique'=>'Trùng Tên Sản Phẩm',
            'code.unique'=>'Trùng Mã Sản Phẩm',
            'detail.required'=>'Không Được Bỏ Trống',
            'filepath.required'=>'Vui Lòng Chọn Hình',
            'id_productmodel.required'=>'Không Được Bỏ Trống',
            'id_productssize.required'=>'Không Được Bỏ Trống',
            'id_productwaterproorf.required'=>'Không Được Bỏ Trống',
            'id_productglasses.required'=>'Không Được Bỏ Trống',
            'id_categoryproducts.required'=>'Không Được Bỏ Trống',
            'id_productboder.required'=>'Không Được Bỏ Trống',
            'price.required'=>'Không Được Bỏ Trống',
            'price.regex'=>''

        ] );
        if($v->fails())
            {
                return redirect()->back()
                ->withErrors($v)
                ->withInput();
            }
            if($request->status =='on')
        {
            $status=1;
        }else
        {
            $status=0;
        }
        if($request->serinumber=='on')
        {
            $serinumber=1;

        }else
        {
            $serinumber=0;
        }

        if(products::where([['name','=',$request->name]])->count())
        {
            return redirect()->back()->with("message",["type"=>"danger","msg"=>"Tên Sản Phẩm Đã Tồn Tại. Nhập Lại "]);
        }
        if(products::where([['code','=',$request->code]])->count())
        {
            return redirect()->back()->with("message",["type"=>"danger","msg"=>"Mã Sản Phẩm Đã Tồn Tại.Nhập Lại"]);
        }


        $idAdmin=Auth::guard('admin')->user()->id;
        $str_code=Str::slug($request->code);
        $row=new products;
        $row->status=$status;
        $row->name=$request->name;
        $row->code=strtoupper($str_code);
        $row->slug=Str::slug($request->name);
        $row->image=$request->filepath;
        $row->price=$request->price;
        $row->pricesale=$request->price_km;
        $row->serinumber=$serinumber;
        $row->id_brandproducts=$request->id_brandproducts;
        $row->id_productboder=$request->id_productboder;
        $row->id_categoryproducts=$request->id_categoryproducts;
        $row->id_productglasses=$request->id_productglasses;
        $row->id_productwaterproorf=$request->id_productwaterproorf;
        $row->id_productssize=$request->id_productssize;
        $row->id_productmodel=$request->id_productmodel;
        $row->id_gendercategoryproducts=$request->id_gendercategoryproducts;
        $row->metadesc=$request->metadesc;
        $row->metakey=$request->metakey;
        $row->detail=$request->detail;
        $row->created_by=$idAdmin;
        $row->created_at=Carbon::now('Asia/Ho_Chi_Minh');
        $row->save();
        return redirect()->back()->with("message",["type"=>"success","msg"=>"Thêm Thành Công"]);
    }
    public function view_product_quantity()
    {
        return view('admin.products.products_quantity');
    }
    public function fetch_view_product_quantity(Request $request)
    {
        if($request->ajax())
        {
            $getData=products::where('status','=','1')->orderBy('created_at','desc')->get();
            return Datatables::of($getData)
            ->addColumn('name',function($getData){
                $name=$getData->name;
                return $name;
            })->addColumn('code',function($getData){
                $code=$getData->code;
                return $code;
            })
            ->addColumn('image',function($getData){
                $image='<img src="'.$getData->image.'"  style="width:100px; height:100px;"/>';
                return $image;
            })->addColumn('quantity',function($getData){
                $quantity=$getData->quantity;
                return $quantity;
            })->addColumn('action',function($getData){
                $button='<a href="'.$getData->id.'" class="btn btn-sm btn-success update_quantity" style="color:white;">Nhập Thêm Số Lượng</a>';
                return $button;
            })
            ->rawColumns(['name','code','image','quantity','action'])->make('true');
        }
    }
    public function update_quantity(Request $request ,$id_product)
    {
            if($request->ajax())
            {
               try{
                $products=products::find($id_product);
                $products->quantity= $products->quantity+ $request->get('quantity');
                $products->save();
                return response()->json(['success'=>'Thêm số lượng thành công']);
               }catch(Exception $e)
               {
                return response()->json(['danger'=>'Thêm số lượng không thành công']);

               }
            }
    }
}
