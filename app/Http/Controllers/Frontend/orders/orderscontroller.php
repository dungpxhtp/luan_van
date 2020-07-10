<?php

namespace App\Http\Controllers\Frontend\orders;

use App\Http\Controllers\Controller;
use App\Http\Resources\viewOrder;
use App\library\library_my;
use App\Models\orders;
use App\Models\ordersproducts;
use Barryvdh\DomPDF\PDF as BarryvdhPDF;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;
class orderscontroller extends Controller
{
    //
    public function indexorders()
    {
        return view('admin.orders.index');
    }
    public function fetchorders(Request $request)
    {

        if($request->ajax())
        {
        $getData=orders::where('orders.status','=',1)->join('users','orders.id_users','=','users.id')->select('orders.*','users.codeuser as codeuser','users.email','users.phoneuser','users.name as tenkhachhang','users.codeuser as codeuser')->orderBy('orders.created_at','desc')->get();

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
                if($getData->status ==1){
                        $status='<span class="bg-warning"><i class="fas fa-pause"></i>Đang Chờ</span>';
                        return $status;
                }
            })->addColumn('action',function($getData){
                $action='<div class="col">';
                $action.='<a type="button" href="'.$getData->id.'" name="viewOrder"   class="viewOrder btn bg-info  text-white  btn-sm"><i class="fas fa-box-open"></i> Xem</a>';
                $action.='<a type="button" href="'.$getData->id.'" name="viewOrder"   class="confirm-order btn bg-info  text-white  btn-sm"><i class="fas fa-people-carry"></i> Xác Nhận</a>';
                $action.='</div>';
                return $action;
            })
            ->rawColumns(['codeOder','fullName','phoneOder','exportDate','TotalOrder','Address','Payments','status','action'])->make('true');

        }
    }
    public function update_status_orders($id_orders,Request $request)
    {
        if($request->ajax())
        {
            $find=orders::findOrFail($id_orders);
            $find->status=2;
            $find->created_by=Auth::guard('admin')->user()->id;
            $find->save();
             return response()->json(['data'=>'success']);
        }
    }
    public function fetchordersconfirm(Request $request)
    {
        if($request->ajax())
        {
        $getData=orders::where('orders.status','=',2)->join('users','orders.id_users','=','users.id')->select('orders.*','users.codeuser as codeuser','users.email','users.phoneuser','users.name as tenkhachhang','users.codeuser as codeuser')->orderBy('orders.created_at','desc')->get();

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
                if($getData->status ==2){
                        $status='<span class="bg-warning"><i class="fas fa-shipping-fast"></i>Đã Xác Nhận</span>';
                        return $status;
                }
            })->addColumn('action',function($getData){
                $action='<a type="button" href="'.$getData->id.'" name="viewOrder"   class="viewOrder btn bg-info  text-white  btn-sm"><i class="fas fa-box-open"></i> Xem</a>';
                $action.='<a type="button" href="export-pdf-order/'.$getData->id.'/hoadon"   class=" btn bg-info  text-white  btn-sm"><i class="fas fa-people-carry"></i> Xuất Hóa Đơn</a>';
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
            $findOrders->save();
            return response()->json(['success'=>'Cập Nhật Thành Công']);
      }
    }
    public function export_pdf_order($id_orders)
    {
        $orders=orders::findOrFail($id_orders);
        $ordersproducts=ordersproducts::where([['ordersproducts.id_orders','=',$orders->id]])->join('products','ordersproducts.id_products','=','products.id')->select('ordersproducts.*','products.name as nameproducts','products.code as codeproducts')->get();
        return view('admin.pdfexportorder.index',compact('orders','ordersproducts'));
    }
    public function post_export_pdf_order(Request $request)
    {
        $v=Validator::make($request->all(), [
            'fullName'=>'required',
            'phoneOder'=>'required',
            'Address'=>'required',
            'Address'=>'required',




        ], [
            'fullName.required'=>'Không Được Bỏ Trống',
            'phoneOder.required'=>'Không Được Bỏ Trống',
            'Address.required'=>'Không Được Bỏ Trống',
            'Address.required'=>'Không Được Bỏ Trống',


        ]);

    }
    public function export($id_order)
    {
        $orders=orders::findOrFail($id_order);
        $ordersproducts=ordersproducts::where([['ordersproducts.id_orders','=',$orders->id]])->join('products','ordersproducts.id_products','=','products.id')->select('ordersproducts.*','products.name as nameproducts','products.code as codeproducts')->get();
        $pdf = PDF::loadView('admin.pdfexportorder.export', compact('orders','ordersproducts') );
        return $pdf->stream();
    }
}
