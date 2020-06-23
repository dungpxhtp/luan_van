<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;
use App\library\library_my;
use App\Models\brandproducts;
use App\Models\categoryproducts;
use App\Models\products;
use Illuminate\Http\Request;

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

    public function repair($id)
    {
        //dd($id);
        return view('admin.products.repair');
    }
}
