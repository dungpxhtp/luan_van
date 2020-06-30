<?php

namespace App\Http\Controllers\Frontend\orders;

use App\Http\Controllers\Controller;
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
        if($request->ajax()){

        }
    }
}
