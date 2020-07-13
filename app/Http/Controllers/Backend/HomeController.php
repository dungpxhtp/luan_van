<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\products;
use App\Models\brandproducts;
use App\Models\categoryproducts;
use App\Models\gendercategoryproducts;
use App\Models\topic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $brandsproducts=brandproducts::where('status','=','1')->get();
        $categoryproducts=categoryproducts::where('status','=','1')->get();
        $gendercategoryproducts=gendercategoryproducts::where('status','=','1')->get();
        $topic=topic::where('status','=','1')->get();
        \View::share(['brandsproducts'=> $brandsproducts,'categoryproducts'=>$categoryproducts,'gendercategoryproducts'=>$gendercategoryproducts,'topic'=>$topic]);
    }
    public function home(){
        $productsnew=products::where([['status','=','1']])->orderBy('created_at','desc')->take(4)->get();

        return view('user.home',compact('productsnew'));
    }
    public function productDetail($slug)
    {   
        $product=products::where([['products.status','=','1'],['products.slug','=',$slug]])
         ->join('gendercategoryproducts','products.id_gendercategoryproducts','=','gendercategoryproducts.id')    
         ->join('productmodel','products.id_productmodel','=','productmodel.id')
         ->join('productssize','products.id_productssize','=','productssize.id')
         ->join('productwaterproorf','products.id_productwaterproorf','=','productwaterproorf.id')
         ->join('productglasses','products.id_productglasses','=','productglasses.id')
         ->join('categoryproducts','products.id_categoryproducts','=','categoryproducts.id')
         ->join('productborderscolor','products.id_productboder','=','productborderscolor.id')
         ->join('brandproducts','products.id_brandproducts','=','brandproducts.id')
         ->select('gendercategoryproducts.name as name_gendercategoryproducts','productmodel.name as name_productmodel',
                'productssize.name as name_productssize','productwaterproorf.name as name_productwaterproorf','productglasses.name as name_productglasses',
                'categoryproducts.name as name_categoryproducts','productborderscolor.name as name_productborderscolor','brandproducts.name as name_brandproducts','products.*','brandproducts.image as image_brandproducts','brandproducts.slug as slug_brandproducts' )       
        ->firstOrFail();
     
        return view('user.detail',compact('product'));
    } 
}
