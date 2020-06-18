<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\commentproducts;
use App\Models\orders;
use App\Models\products;
use Illuminate\Support\Facades\Auth;
use Request;
class Backend extends Controller
{
    //

    public function dashboard()
    {
   //Auth::guard('admin')->user()->fullname;
    $countComment=commentproducts::where('status','=','1')->get()->count();
    $countOrders=orders::where('status','=','1')->orderBy('created_at','desc')->get()->count();
    $coutProducts=products::where('status','=','1')->get()->count();
    $orderNew=orders::where('orders.status','=','1')->join('users','orders.id_users','users.id')->select('orders.*','users.name as nameUser')
                            ->orderBy('orders.created_at','desc')->get();

    return view('admin.dashboard.main',compact('countComment','countOrders','coutProducts','orderNew'));
    }
    public function logOutAdmin()
    {

        if(Auth::guard('admin')->check())
        {
            Auth::guard('admin')->logout();

            Request::session()->flush();
            return  redirect()->route('getLogin');
        }
    }
}
