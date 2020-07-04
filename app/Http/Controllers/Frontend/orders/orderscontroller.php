<?php

namespace App\Http\Controllers\Frontend\orders;

use App\Http\Controllers\Controller;
use App\Http\Resources\viewOrder;
use App\library\library_my;
use App\Models\orders;
use App\Models\ordersproducts;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
class orderscontroller extends Controller
{
    //
    public function indexorders()
    {
        return view('admin.orders.index');
    }
    public function fetchorders(Request $request)
    {


        $getData=orders::where('orders.status','=',1)->join('users','orders.id_users','=','users.id')->select('orders.*','users.codeuser as codeuser','users.email','users.phoneuser','users.name as tenkhachhang')->orderBy('orders.created_at','desc')->get();

            return Datatables::of($getData)
            ->addColumn('codeOder',function($getData){
                $codeOder=$getData->codeOder;
                return $codeOder;
            })->addColumn('fullName',function($getData){
                $fullName=$getData->fullName;
                return $fullName;
            })->addColumn('phoneOder',function($getData){
                $phoneOder=$getData->phoneOder;
                return $phoneOder;
            })->addColumn('exportDate',function($getData){
                $exportDate =\Carbon\Carbon::parse($getData->created_at)->format('d m Y H:i:s');
                return $exportDate;
            })->addColumn('TotalOrder',function($getData){
                $TotalOrder=library_my::formatMoney($getData->TotalOrder);
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
                if($getData->status){
                        $status='<span class="bg-warning"><i class="fas fa-pause"></i>Đang Chờ</span>';
                        return $status;
                }
            })->addColumn('action',function($getData){
                $action='<a type="button" href="'.$getData->id.'" name="viewOrder"   class="viewOrder btn bg-info  text-white  btn-sm"><i class="fas fa-box-open"></i> Xem</a>';
                return $action;
            })
            ->rawColumns(['codeOder','fullName','phoneOder','exportDate','TotalOrder','Address','Payments','status','action'])->make('true');


    }
    public function viewOrder($id_orders)
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
