<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\products;
use App\Models\brandproducts;
use App\Models\categoryproducts;
use App\Models\commentproducts;
use App\Models\gendercategoryproducts;
use App\Models\post;
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
        $postnew=post::where([['status','=',1]])->orderBy('created_at','asc')->take(5)->get();

        \View::share(['brandsproducts'=> $brandsproducts,'categoryproducts'=>$categoryproducts,'gendercategoryproducts'=>$gendercategoryproducts,'topic'=>$topic,'postnew'=>$postnew]);
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
        $comment=commentproducts::where([['commentproducts.id_product','=',$product->id],['commentproducts.status','=','1']])->join('users','commentproducts.id_user','=','users.id')->select('commentproducts.*','users.name as nameuser')->orderBy('created_at','desc')->paginate(10);

        return view('user.detail',compact('product','comment'));
    }
    // hãng parram slug //
    public function brands_products($slug,Request $request)
    {
        $brandShow=brandproducts::where([['slug','=',$slug],['status','=','1']])->firstOrFail();
        $products=products::where([['status','=','1'],['id_brandproducts','=',$brandShow->id]])->orderBy('created_at','desc')->paginate(8);
        if ($request->ajax()) {
            $brandShow=brandproducts::where([['slug','=',$slug],['status','=','1']])->firstOrFail();
            $products=products::where([['status','=','1'],['id_brandproducts','=',$brandShow->id]])->orderBy('created_at','desc')->paginate(8);
            return view('user.layout.brands-show-pagination',['brandShow'=>$brandShow,'products'=>$products])->render();
        }
        return view('user.brands-show',compact('brandShow','products'));
    }
    public function brands_filter_products($slug,Request $request)
    {
        if($request->ajax()){
            if($request->get('filter')==1)
            {
                $brandShow=brandproducts::where([['slug','=',$slug],['status','=','1']])->firstOrFail();
                $products=products::where([['status','=','1'],['id_brandproducts','=',$brandShow->id]])->orderBy('price','asc')->paginate(8);
                return view('user.layout.brands-show-pagination',['brandShow'=>$brandShow,'products'=>$products])->render();
            }else if($request->get('filter')==2){
                $brandShow=brandproducts::where([['slug','=',$slug],['status','=','1']])->firstOrFail();
                $products=products::where([['status','=','1'],['id_brandproducts','=',$brandShow->id]])->orderBy('price','desc')->paginate(8);
                return view('user.layout.brands-show-pagination',['brandShow'=>$brandShow,'products'=>$products])->render();
            }

        }
    }
    //loai san pham
    public function category($slug,Request $request){
        $loaisanpham=categoryproducts::where([['slug','=',$slug],['status','=','1']])->firstOrFail();
        $products=products::where([['status','=','1'],['id_categoryproducts','=',$loaisanpham->id]])->orderBy('created_at','desc')->paginate(8);
        if ($request->ajax()) {
            $loaisanpham=categoryproducts::where([['slug','=',$slug],['status','=','1']])->firstOrFail();
            $products=products::where([['status','=','1'],['id_categoryproducts','=',$loaisanpham->id]])->orderBy('created_at','desc')->paginate(8);
            return view('user.layout.loaiSanPham.loai_pagination',['loaisanpham'=>$loaisanpham,'products'=>$products])->render();
        }
        return view('user.loai-san-pham',compact('loaisanpham','products'));
    }
    public function category_filter_products($slug,Request $request)
    {
        if($request->ajax())
        {
            if($request->get('filter')==1)
            {
                $loaisanpham=categoryproducts::where([['slug','=',$slug],['status','=','1']])->firstOrFail();
                $products=products::where([['status','=','1'],['id_categoryproducts','=',$loaisanpham->id]])->orderBy('price','asc')->paginate(8);
                return view('user.layout.loaiSanPham.loai_pagination',['loaisanpham'=>$loaisanpham,'products'=>$products])->render();

            }else if($request->get('filter')==2)
            {
                $loaisanpham=categoryproducts::where([['slug','=',$slug],['status','=','1']])->firstOrFail();
                $products=products::where([['status','=','1'],['id_categoryproducts','=',$loaisanpham->id]])->orderBy('price','desc')->paginate(8);
                return view('user.layout.loaiSanPham.loai_pagination',['loaisanpham'=>$loaisanpham,'products'=>$products])->render();

            }
        }
    }
    public function gender($slug , Request $request)
    {
        $doituong=gendercategoryproducts::where([['slug','=',$slug],['status','=','1']])->firstOrFail();
        $products=products::where([['status','=','1'],['id_gendercategoryproducts','=',$doituong->id]])->orderBy('created_at','desc')->paginate(8);
        if ($request->ajax()) {
            $doituong=gendercategoryproducts::where([['slug','=',$slug],['status','=','1']])->firstOrFail();
            $products=products::where([['status','=','1'],['id_gendercategoryproducts','=',$doituong->id]])->orderBy('created_at','desc')->paginate(8);
            return view('user.layout.doiTuong.doituong_pagination',['loaisanpham'=>$doituong,'products'=>$products])->render();
        }
        return view('user.doituong',compact('doituong','products'));
    }
    public function gender_filter_products($slug , Request $request)
    {
        if($request->ajax())
        {
            if($request->get('filter')==1)
            {
                $doituong=gendercategoryproducts::where([['slug','=',$slug],['status','=','1']])->firstOrFail();
                $products=products::where([['status','=','1'],['id_gendercategoryproducts','=',$doituong->id]])->orderBy('price','asc')->paginate(8);
                return view('user.layout.doiTuong.doituong_pagination',['loaisanpham'=>$doituong,'products'=>$products])->render();

            }else if($request->get('filter')==2)
            {
                $doituong=gendercategoryproducts::where([['slug','=',$slug],['status','=','1']])->firstOrFail();
                $products=products::where([['status','=','1'],['id_gendercategoryproducts','=',$doituong->id]])->orderBy('price','desc')->paginate(8);
                return view('user.layout.doiTuong.doituong_pagination',['loaisanpham'=>$doituong,'products'=>$products])->render();

            }
        }
    }
    //tin tuc index
    public function topic(Request $request)
    {
        $post=post::where([['status','=',1]])->paginate(5);
        if($request->ajax())
        {
            $post=post::where([['status','=',1]])->paginate(5);
            return view('user.layout.tinTuc.tintuc_paginaton',['post'=>$post])->render();

        }
        return view('user.topic',compact('post'));
    }

    public function topicPost(Request $request,$slug)
    {
        $topicPost=topic::where([['slug','=',$slug],['status','=','1']])->firstOrFail();
        $post=post::where([['status','=',1],['id_topic','=',$topicPost->id]])->paginate(5);
        if($request->ajax())
        {
            $post=post::where([['status','=',1],['id_topic','=',$topicPost->id]])->paginate(5);
            return view('user.layout.tinTuc.tintuc_paginaton',['post'=>$post])->render();

        }
        return view('user.topic',compact('post','topicPost'));
    }
    public function postdetail($slug)
    {
        $postdetail=post::where([['status','=','1'],['slug','=',$slug]])->firstOrFail();

        return view('user.topicdetail',compact('postdetail'));
    }
    public function contact()
    {
        return view('user.lienhe');
    }
}
