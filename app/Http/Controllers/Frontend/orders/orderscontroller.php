<?php

namespace App\Http\Controllers\Frontend\orders;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Product\product;
use App\Http\Resources\viewOrder;
use App\library\library_my;
use App\Models\exportorders;
use App\Models\exportproducts;
use App\Models\orders;
use App\Models\ordersproducts;
use App\Models\products;
use Barryvdh\DomPDF\PDF as BarryvdhPDF;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;
use PDF;
class orderscontroller extends Controller
{
    /*
    status =3 đơn hàng duyệt thành công
    status =1  đơn hàng đang chờ duyệt hoặc chưa thanh toán
    status =0 đơn hàng bị lỗi
    status =2 đơn hàng đã thanh toán rồi
    status =4 giao hàng thành công




    */
    public function indexorders()
    {
        return view('admin.orders.index');
    }
    public function fetchorders(Request $request)
    {

        if($request->ajax())
        {
        $getData=orders::where([['orders.status','<>',3],['orders.status','<>',0]])->join('users','orders.id_users','=','users.id')->select('orders.*','users.codeuser as codeuser','users.email','users.phoneuser','users.name as tenkhachhang','users.codeuser as codeuser')->orderBy('orders.created_at','asc')->get();

            return Datatables::of($getData)
            ->addColumn('codeOder',function($getData){
                $codeOder=$getData->codeOder;
                return $codeOder;
            })->addColumn('codeuser',function($getData){
                $codeuser =$getData->codeuser;
                return $codeuser;
            })
            ->addColumn('fullName',function($getData){
                $fullName=$getData->fullName;
                return $fullName;
            })->addColumn('phoneOder',function($getData){
                $phoneOder=$getData->phoneOder;
                return $phoneOder;
            })->addColumn('exportDate',function($getData){
                $exportDate =\Carbon\Carbon::parse($getData->created_at)->format('d m Y H:i:s');
                return $exportDate;
            })->addColumn('TotalOrder',function($getData){
                $formatMoney=library_my::formatMoney($getData->TotalOrder);
                $TotalOrder='<span  style="cursor: default;">'.$formatMoney.' VNĐ</span>';

                return $TotalOrder;
            })->addColumn('Address',function($getData){
                $Address=$getData->Address;
                return $Address;
            })->addColumn('Payments',function($getData){
                if($getData->Payments ==1)
                {
                    $span='<span class="btn btn-sm btn-success" style="cursor: default;"><i class="fas fa-shipping-fast"></i>Thanh Toán Trực Tiếp</span>';
                    return $span;
                }else if($getData->Payments==2)
                {
                    $span='<span class="btn btn-sm btn-success" style="cursor: default;"><i class="fab fa-cc-paypal"></i>Chuyển tiền</span>';
                    return $span;
                }
            })->addColumn('status',function($getData){
                if($getData->Payments ==1)
                {
                    if($getData->status	==1)
                    {
                        $status	='<span class="btn-warning btn btn-sm disabled ">Đang Xử Lý</span>';
                    }
                    return $status	;
                }else
                {
                    if($getData->status	==2)
                    {
                        $status	='<span class="btn btn-sm btn-success disabled "><i class="fas fa-money-check-alt"></i> Đã Thanh Toán</span>';
                    }
                    else
                    {
                        $status	='<span class="btn-danger btn btn-sm text-white disabled" >Chưa Thanh Toán</span>';
                    }
                    return $status	;
                }
            })->addColumn('action',function($getData){
                $action='<div class="col">';
                $action.='<a type="button" href="'.$getData->id.'" name="viewOrder"   class="viewOrder btn bg-info  text-white  btn-sm"><i class="fas fa-box-open"></i> Xem</a>';
                $action.='<a href="'.$getData->id.'" class="btn btn-sm btn-danger error-btn "><i class="fas fa-phone-slash"></i>Báo Lỗi Đơn Hàng</a>';
                $action.='<a type="button" href="'.$getData->id.'" name="viewOrder"   class="confirm-order btn bg-info  text-white  btn-sm"><i class="fas fa-people-carry"></i> Xác Nhận</a>';
                $action.='</div>';
                return $action;
            })
            ->rawColumns(['codeOder','fullName','phoneOder','exportDate','TotalOrder','Address','Payments','status','action'])->make('true');

        }
    }
    //Cập nhật đơn hàng thành công
    public function update_status_orders($id_orders,Request $request)
    {
        if($request->ajax())
        {
            $find=orders::findOrFail($id_orders);
            if($find->Payments==2)
            {
                if($find->status==1)
                {
                    return response()->json(['danger'=>'Đơn Hàng Này Chưa Thanh Toán ']);
                }
            }
            $orders=ordersproducts::where('ordersproducts.id_orders','=',$find->id)->join('products','ordersproducts.id_products','=','products.id')
            ->select('products.*','products.quantity as soluongsanpham','ordersproducts.quantity as soluongdathang')
            ->get();
            foreach($orders as $item){
                if($item->soluongdathang > $item->soluongsanpham)
                {
                    return response()->json(['danger'=>'Không Đủ Số  Lượng Sản Giao ! Vui Lòng Kiểm Tra Lại <br> Code : '. $item->code]);
                }else
                {
                    $updatequantity=products::find($item->id);
                    $updatequantity->quantity=$item->soluongsanpham - $item->soluongdathang;
                    $updatequantity->save();
                }
            }
            $find->status=3;
            $find->id_admin=Auth::guard('admin')->user()->id;
            $find->save();
            return response()->json(['success'=>'Duyệt thành công']);
        }
    }
    //update đơn hàng bị lỗi
    public function update_erorr($id_order,Request $request)
    {
        if($request->ajax())

        {
            $find=orders::findOrFail($id_order);
            $find->status=0;
            $find->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
            $find->updated_by=Auth::guard('admin')->user()->fullname;


            if($find->save())
            {
            return response()->json(['success'=>'Một  đơn hàng đã hủy']);
            }
        }

    }
    //khách hàng hủy đơn hàng khi đã tạo hóa đơn cập nhật lại số lượng
    /*
    input id đơn hàng
    out put huỷ đơn
    */
    public function update_erorr_products($id_order,Request $request)
    {
        if($request->ajax())

        {

            $find=orders::findOrFail($id_order);
            $find->status=0;
            $find->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
            $find->updated_by=Auth::guard('admin')->user()->fullname;

            $orders=ordersproducts::where('ordersproducts.id_orders','=',$find->id)->join('products','ordersproducts.id_products','=','products.id')
            ->select('products.*','products.quantity as soluongsanpham','ordersproducts.quantity as soluongdathang')
            ->get();
            foreach ($orders as $item)
            {
                $updatequantity=products::find($item->id);
                $updatequantity->quantity=$item->soluongsanpham + $item->soluongdathang;
                $updatequantity->save();
            }
            if($find->save())
            {
            return response()->json(['success'=>'Hủy đơn hàng thành công']);
            }
        }

    }
    //lấy danh sách đơn hàng đã duyệt
    public function fetchordersconfirm(Request $request)
    {
        if($request->ajax())
        {
        $getData=orders::where('orders.status','=',3)->join('users','orders.id_users','=','users.id')->join('admin','orders.id_admin','=','admin.id')
        ->select('orders.*','users.codeuser as codeuser','users.email','users.phoneuser','users.name as tenkhachhang','users.codeuser as codeuser','admin.fullname as fullnameadmin')->orderBy('orders.created_at','desc')->get();

            return Datatables::of($getData)
            ->addColumn('codeOder',function($getData){
                $codeOder=$getData->codeOder;
                return $codeOder;
            })->addColumn('codeuser',function($getData){
                $codeuser =$getData->codeuser;
                return $codeuser;
            })
            ->addColumn('fullName',function($getData){
                $fullName=$getData->fullName;
                return $fullName;
            })->addColumn('phoneOder',function($getData){
                $phoneOder=$getData->phoneOder;
                return $phoneOder;
            })->addColumn('exportDate',function($getData){
                $exportDate =\Carbon\Carbon::parse($getData->created_at)->format('d m Y H:i:s');
                return $exportDate;
            })->addColumn('TotalOrder',function($getData){
                $formatMoney=library_my::formatMoney($getData->TotalOrder);
                $TotalOrder='<span  style="cursor: default;">'.$formatMoney.' VNĐ</span>';

                return $TotalOrder;
            })->addColumn('Address',function($getData){
                $Address=$getData->Address;
                return $Address;
            })->addColumn('Payments',function($getData){
                if($getData->Payments ==1)
                {
                    $span='<span class="btn btn-sm btn-success" style="cursor: default;"><i class="fas fa-shipping-fast"></i>Thanh Toán Trực Tiếp</span>';
                    return $span;
                }else if($getData->Payments==2)
                {
                    $span='<span class="btn btn-sm btn-success" style="cursor: default;"><i class="fab fa-cc-paypal"></i>Chuyển tiền</span>';
                    return $span;
                }
            })->addColumn('status',function($getData){
                if($getData->status ==3){
                        $status='<span class="bg-warning"><i class="fas fa-shipping-fast"></i>Đã Xác Nhận</span>';
                        return $status;
                }
            })->addColumn('fullnameadmin',function($getData){
                $span=$getData->fullnameadmin;
                return $span;
            })
            ->addColumn('action',function($getData){
                $action='<a type="button" href="'.$getData->id.'" name="viewOrder"   class="viewOrder btn bg-info  text-white  btn-sm"><i class="fas fa-box-open"></i> Xem</a>';
                $action.='<a type="button" href="export-pdf-order/'.$getData->id.'/hoadon"   class=" btn bg-info  text-white  btn-sm"><i class="fas fa-people-carry"></i> Tạo Hóa Đơn</a>';
                return $action;
            })
            ->rawColumns(['codeOder','fullName','phoneOder','exportDate','TotalOrder','Address','Payments','status','action'])->make('true');

        }
    }
    public function viewOrder($id_orders , Request $request)
    {
        if($request->ajax())
        {
        $getData=ordersproducts::where([['ordersproducts.id_orders','=',$id_orders]])->join('products','ordersproducts.id_products','=','products.id')->select('ordersproducts.*','products.name as nameproducts','products.image as image')->get();

        if($getData->isEmpty())
        {
            return response()->json(['error'=>'Không có dữ liệu']);
        }

        return response()->json([
            'success'=>viewOrder::collection($getData)
        ]);
        }
    }
    public function update_quantity_order($id_order_products,Request $request)
    {
        if($request->ajax())
        {
            $findOrdersproducts=ordersproducts::find($id_order_products);
            $value=$request->get('quantity');
            $findOrdersproducts->quantity=$value;
            $findOrdersproducts->TotalProducts=$value*$findOrdersproducts->price;
            $findOrdersproducts->save();

            $priceOrders=ordersproducts::where('id_orders','=',$findOrdersproducts->id_orders)->select('price','quantity')->get();
            $Total=0;
            foreach ($priceOrders as $item)
            {
                $Total= $Total+($item->price*$item->quantity);
            }
            $findOrders=orders::find($findOrdersproducts->id_orders);
            $findOrders->TotalOrder=$Total;
            $findOrders->updated_by=Auth::guard('admin')->user()->id;;
            $findOrders->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
            if($findOrders->save())
            return response()->json(['success'=>'Cập Nhật Thành Công']);
            else
            return response()->json(['danger'=>'Cập nhật không thành công thử lại']);

      }
    }
    public function export_pdf_order($id_orders)
    {
        $orders=orders::findOrFail($id_orders);
        $ordersproducts=ordersproducts::where([['ordersproducts.id_orders','=',$orders->id]])->join('products','ordersproducts.id_products','=','products.id')->select('ordersproducts.*','products.name as nameproducts','products.code as codeproducts','products.serinumber as serinumber','products.id as id_products')->get();
        return view('admin.pdfexportorder.index',compact('orders','ordersproducts'));
    }
    public function post_export_pdf_order(Request $request,$id_order)
    {

        try{
            $v=Validator::make($request->all(), [
                'fullName'=>'required',
                'phoneOder'=>'required',
                'Address'=>'required',
                'name_product'=>'required',
                'serinumber'=>'required',
                'quantity'=>'required',
                'price'=>'required',
                'payments_'=>'required'




            ], [
                'fullName.required'=>'Không Được Bỏ Trống',
                'phoneOder.required'=>'Không Được Bỏ Trống',
                'Address.required'=>'Không Được Bỏ Trống',
                'name_product.required'=>'Không Được Bỏ Trống',
                'serinumber.required'=>'Không Được Bỏ Trống',
                'quantity.required'=>'Không Được Bỏ Trống',
                'price.required'=>'Không Được Bỏ Trống',
                'payments_.required'=>'Không Được Bỏ Trống',





            ]);
            if($v->fails())
            {
                return redirect()->back()
                    ->withErrors($v)
                    ->withInput();
            }
            $orders=orders::findOrfail($id_order);
            $orders->fullName=$request->get('fullName');
            $orders->phoneOder=$request->get('phoneOder');
            $orders->Address=$request->get('Address');
            $orders->exportDate=Carbon::now('Asia/Ho_Chi_Minh');
            $orders->save();
            $id=$orders->id;

            $codeproduct=$request->get('codeproduct');
            $serinumber=$request->get('serinumber');
            $quantity=$request->get('quantity');
            $price=$request->get('price');
            $pricecost=$request->get('pricecost');
            $id_products=$request->get('id_product');
            $result=exportproducts::where('id_order','=',$id)->delete();

            foreach($request->get('name_product') as $key=>$value)
            {
                $exportproducts=new exportproducts;
                $exportproducts->codeproducts=$codeproduct[$key];
                $exportproducts->nameproducts=$value;
                $exportproducts->serinumber=$serinumber[$key];
                $exportproducts->quantity=$quantity[$key];
                $exportproducts->price=$price[$key];
                $exportproducts->pricecost=$pricecost[$key];
                $exportproducts->id_products=$id_products[$key];
                $exportproducts->id_order=$id;
                $exportproducts->save();
            }
            return redirect()->route('orders')->with("message",["type"=>"success","msg"=>"Tạo Hóa Đơn Thành Công"]);
        }catch(Exception $e)
        {
            return redirect()->route('orders')->with("danger",["type"=>"success","msg"=>"Lỗi Không Tạo Được Hóa Đơn"]);
        }


    }
    public function export($id_order)
    {
        $ordersexport=orders::findOrFail($id_order);
        $exportproducts=exportproducts::where('exportproducts.id_order','=',$id_order)->join('products','exportproducts.id_products','products.id')->select('exportproducts.*','products.name as nameproducts')->get();
        $pdf = PDF::loadView('admin.pdfexportorder.export', compact('ordersexport','exportproducts') );
        return $pdf->stream();
    }
    public function view_exportorders()
    {
        return view('admin.orders.exportOrder');
    }
    public function fetch_view_export_orders(Request $request)
    {
        if($request->ajax())
        {
            $getData=orders::where('orders.status','=',3)
            ->join('admin','orders.id_admin','=','admin.id')
            ->join('exportproducts','orders.id','=','exportproducts.id_order')
            ->select('orders.*','admin.fullname as fullNameAdmin')->get();
            return Datatables::of($getData)
            ->setRowAttr(['align'=>'center'])
            ->addColumn('codeOder',function($getData){
                $span=$getData->codeOder;
                return $span;
            })->addColumn('fullName',function($getData){
                $span=$getData->fullName;
                return $span;
            })->addColumn('phoneOder',function($getData){
                $span=$getData->phoneOder;
                return $span;
            })->addColumn('totalOrder',function($getData){
                $span=$getData->TotalOrder;
                return $span;

            })->addColumn('Address',function($getData){
                $span=$getData->Address;
                return $span;
            })->addColumn('fullNameAdmin',function($getData){
                $span=$getData->fullNameAdmin;
                return $span;
            })->addColumn('exportDate',function($getData){
                $span=$getData->exportDate;
                return $span;
            })->addColumn('Payments',function($getData){
               if($getData->Payments==1)
               {
                $span='Trả Tiền Mặt Khi Nhận Hàng';

               }else
               {
                $span='Chuyển Khoản Ngân Hàng';

               }
               return $span;
            })->addColumn('action',function($getData){

                $button='<a href="export/'.$getData->id.'" class="btn btn-sm btn-warning text-white"><i class="fas fa-file-pdf"></i>Xuất Hóa Đơn</a>';
                $button.='<a class="btn btn-sm btn-success text-white"><i class="fas fa-people-carry"></i>Giao thành công</a>';
                $button.='<a class="btn btn-sm btn-danger text-white update_erorr_products" href="'.$getData->id.'"><i class="fas fa-phone-slash"></i>Đơn hàng bị lỗi</a>';

                return $button;
            })->rawColumns(['codeOder','fullName','phoneOder','totalOrder','Address','fullNameAdmin','exportDate','payments','action'])->make('true');
        }
    }
    //Đơn Hàng Bị Lỗi
    public function error_order()
    {
        return view('admin.orders.errorOrder');
    }
    // lấy ds đơn hàng bị lỗi
    public function fetch_error_order(Request $request){
        if($request->ajax())
        {
        $getData=orders::where([['orders.status','=',0]])->join('users','orders.id_users','=','users.id')->select('orders.*','users.codeuser as codeuser','users.email','users.phoneuser','users.name as tenkhachhang','users.codeuser as codeuser')->orderBy('orders.created_at','asc')->get();

            return Datatables::of($getData)
            ->addColumn('codeOder',function($getData){
                $codeOder=$getData->codeOder;
                return $codeOder;
            })->addColumn('codeuser',function($getData){
                $codeuser =$getData->codeuser;
                return $codeuser;
            })
            ->addColumn('fullName',function($getData){
                $fullName=$getData->fullName;
                return $fullName;
            })->addColumn('phoneOder',function($getData){
                $phoneOder=$getData->phoneOder;
                return $phoneOder;
            })->addColumn('exportDate',function($getData){
                $exportDate =\Carbon\Carbon::parse($getData->created_at)->format('d m Y H:i:s');
                return $exportDate;
            })->addColumn('TotalOrder',function($getData){
                $formatMoney=library_my::formatMoney($getData->TotalOrder);
                $TotalOrder='<span  style="cursor: default;">'.$formatMoney.' VNĐ</span>';

                return $TotalOrder;
            })->addColumn('Address',function($getData){
                $Address=$getData->Address;
                return $Address;
            })->addColumn('Payments',function($getData){
                if($getData->Payments ==1)
                {
                    $span='<span class="btn btn-sm btn-success" style="cursor: default;"><i class="fas fa-shipping-fast"></i>Thanh Toán Trực Tiếp</span>';
                    return $span;
                }else if($getData->Payments==2)
                {
                    $span='<span class="btn btn-sm btn-success" style="cursor: default;"><i class="fab fa-cc-paypal"></i>Chuyển tiền</span>';
                    return $span;
                }
            })->addColumn('status',function($getData){
                {
                    $status='<span class="btn btn-sm btn-danger ">Đơn Hàng Lỗi</span>';
                    return $status	;
                }
            })->addColumn('action',function($getData){
                $action='<div class="col">';
                $action.='<a type="button" href="'.$getData->id.'" name="viewOrder"   class="viewOrder btn bg-info  text-white  btn-sm"><i class="fas fa-box-open"></i> Xem</a>';
                $action.='</div>';
                return $action;
            })
            ->rawColumns(['codeOder','fullName','phoneOder','exportDate','TotalOrder','Address','Payments','status','action'])->make('true');

        }
    }
}
