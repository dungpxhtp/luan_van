<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\brandproductsResource;
use App\Http\Resources\categoryproductsResource;
use App\Http\Resources\productsResource;
use App\Models\brandproducts;
use App\Models\categoryproducts;
use App\Models\products;
use Exception;
use Illuminate\Http\Request;

class Home extends Controller
{
    //
    public function brandproducts()
    {
        try {
            $getAll=brandproducts::where('status','=','1')->orderBy('created_at','desc')->get();
            if($getAll->isEmpty())
            {
                return response()->json([
                    'data'=>'Not Data'
                ]);
            }
            return response()->json(
                brandproductsResource::collection($getAll)
            );
        } catch (Exception $e) {
            return response()->json([
                'error'=>[
                    'messagess'=>$e->messages()
                ],
                'status'=>500,
            ],200);
        }

    }
    public function categoryproducts()
    {
        try {
            $getAll=categoryproducts::where([['categoryproducts.status','=','1'],['brandproducts.status','=',1]])->join('brandproducts','brandproducts.id','categoryproducts.id_categoryproducts')->select('categoryproducts.*')->orderBy('created_at','desc')->get();
            if($getAll->isEmpty())
            {
                return response()->json([
                    'data'=>'Not Data'
                ]);
            }
            return response()->json(
                [
                    categoryproductsResource::collection($getAll)
                ],200
            );
        } catch (Exception $e) {
            return response()->json([
                'error'=>[
                    'messagess'=>$e->messages()
                ],
                'status'=>500,
            ],200);
        }


    }
    public function products()
    {
            return  response()->json('ok');
    }

}
