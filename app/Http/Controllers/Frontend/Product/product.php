<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use App\Models\products;
use Illuminate\Http\Request;

class product extends Controller
{
    //
    function index()
    {
        $getData=products::where('status','=','1')->paginate(5);
        dd($getData);
    }

}
