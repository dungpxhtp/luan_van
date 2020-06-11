<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\brandproductsResource;
use App\Models\brandproducts;
use Illuminate\Http\Request;

class Home extends Controller
{
    //
    public function brandproducts()
    {

        $getAll=brandproducts::where('status','=','1')->orderBy('created_at','desc')->get();
        return response()->json(
            brandproductsResource::collection($getAll)
        );
    }

}
