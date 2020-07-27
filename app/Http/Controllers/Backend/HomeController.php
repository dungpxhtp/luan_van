<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\library\Cart;
use App\library\library_my;
use App\Models\products;
use App\Models\brandproducts;
use App\Models\categoryproducts;
use App\Models\commentproducts;
use App\Models\gendercategoryproducts;
use App\Models\post;
use App\Models\topic;
use App\Models\contact;
use DB;
use Carbon\Carbon;
use Validator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\orders;
use App\Models\ordersproducts;
use App\Models\users;

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
    public function productDetail(Request $request,$slug)
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
        $comment=commentproducts::where([['commentproducts.id_product','=',$product->id],['commentproducts.status','=','1']])->join('users','commentproducts.id_user','=','users.id')->select('commentproducts.*','users.name as nameuser')->orderBy('created_at','desc')->paginate(20);
        if($request->ajax())
        {
            $comment=commentproducts::where([['commentproducts.id_product','=',$product->id],['commentproducts.status','=','1']])->join('users','commentproducts.id_user','=','users.id')->select('commentproducts.*','users.name as nameuser')->orderBy('created_at','desc')->paginate(20);

            return view('user.layout.comment.replyComment',['comment'=>$comment])->render();
        }
        return view('user.detail',compact('product','comment'));
    }
    public function commentProduct(Request $request, $idProducts)
    {
        if($request->ajax())
        {
            try{
                $v=Validator::make($request->all(),[
                    'input-comment'=>'required',
                ],[
                    'input-comment.required'=>'Vui Lòng Nhập Nội Dung Bình Luận ',
                ]);
                if($v->fails())
                {
                    return response()->json(['error'=>'Vui Lòng Nhập Nội Dung Bình Luận ']);
                }


                if(Auth::guard('khachhang')->check())
                {
                $commentproducts = new commentproducts;
                $commentproducts->id_user=Auth::guard('khachhang')->user()->id;
                $commentproducts->status=1;
                $commentproducts->commentText=$request->get('input-comment');
                $commentproducts->parentid=0;
                $commentproducts->id_product=$idProducts;
                $commentproducts->created_at=Carbon::now('Asia/Ho_Chi_Minh');
                $commentproducts->save();
                return response()->json(['success'=>'Bình Luận Thành Công']);
                }else
                {
                    return response()->json(['error'=>'Yêu Cầu Đăng Nhập']);
                }


            }catch(Exception $e)
            {
                return response()->json(['error'=>'Lỗi Server']);
            }
        }

    }
    public function replyCommentProduct($idProducts,$parentid,Request $request)
    {
        if($request->ajax())
        {
            try{
                $v=Validator::make($request->all(),[
                    'text-comment'=>'required',
                ],[
                    'text-comment.required'=>'Vui Lòng Nhập Nội Dung Bình Luận ',
                ]);
                if($v->fails())
                {
                    return response()->json(['error'=>'Vui Lòng Nhập Nội Dung Bình Luận ']);
                }


                if(Auth::guard('khachhang')->check())
                {
                $commentproducts = new commentproducts;
                $commentproducts->id_user=Auth::guard('khachhang')->user()->id;
                $commentproducts->status=1;
                $commentproducts->commentText=$request->get('text-comment');
                $commentproducts->parentid=$parentid;
                $commentproducts->id_product=$idProducts;
                $commentproducts->created_at=Carbon::now('Asia/Ho_Chi_Minh');
                $commentproducts->save();
                return response()->json(['success'=>'Bình Luận Thành Công']);
                }else
                {
                    return response()->json(['success'=>'Đăng Nhập Để Bình Luận ']);
                }


            }catch(Exception $e)
            {
                return response()->json(['success'=>'Lỗi Server']);
            }
        }
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
    public function getdangnhap()
    {
        return view('user.dangnhap');
    }
    function postdangnhap(Request $request){
        $email = $request->get('email');
        $password =$request->get('password');


        if(Auth::guard('khachhang')->attempt(['email'=>$email,'password'=>$password,'status'=>1]))
        {
            return redirect()->back()->with("message",["type"=>"success","msg"=>"Đăng Nhập Thành Công"]);
        }else
        {
            return redirect()->back()->with("message",["type"=>"danger","msg"=>"Tài Khoản Và Mật Khẩu Chưa Chính Xác "]);
        }


    }
    public function logoutUser(Request $request)
    {

        if(Auth::guard('khachhang')->check())
        {
            Auth::guard('khachhang')->logout();

            $request->session()->flush();
            return  redirect()->route('home');
        }
    }
    public function postContact(Request $request)
    {
        try{

        $v=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'content'=>'required|min:20'
        ],[
            'name.required'=>'Không được bỏ trống',
            'email.required'=>'Không được bỏ trống',
            'email.email'=>'Kiểm tra lại định dạng email',
            'phone.required'=>'Không được bỏ trống',
            'content.required'=>'Không được bỏ trống',
            'content.min'=>'Không được dưới 20 kí tự '

        ]);
        if($v->fails())
        {
            return redirect()->back()
            ->withErrors($v)
            ->withInput();
        }
        $newRow=new contact;
        $newRow->contactText=$request->get('content');
        $newRow->fullName=$request->get('name');
        $newRow->phone=$request->get('phone');
        $newRow->status=0;
        $newRow->email=$request->get('email');

        $newRow->created_at=Carbon::now('Asia/Ho_Chi_Minh');
        $newRow->save();
        return redirect()->back()->with("message",["type"=>"success","msg"=>"Xin chân thành cảm ơn  nhân viên sẽ liên hệ lại sau "]);
        }catch(Exception $e)
        {
         return redirect()->back()->with("error",["type"=>"danger","msg"=>"Lỗi phát sinh vui lòng liên hệ admin"]);
        }

    }
    public function paycart(Cart $cart)
    {
        return view('user.pay-cart',compact('cart'));
    }
     //send Mail
    public function sendmail($details,$email)
    {

        \Mail::to($email)->send(new \App\Mail\SendMail($details));


    }
    /*
    *
    *
    *       Bắt đầu transaction với DB::beginTransaction();
    *        Việc thực hiện câu lệnh SQL DB::table('users')->update(['votes' => 1]); và DB::table('posts')->delete();  bỏ vào khối try catch
    *       Nếu try thực hiện 2 lệnh thành công thì DB::commit(); => Xác nhận transaction hoàn thành và lưu lại các thay đổi trong database từ lệnh SQL update.
    *
    *        Nếu có lỗi và nhảy vào catch thì DB::rollBack(); => Quay lại từ lúc transaction chưa được thực hiện (không lưu các thay đổi trong database từ lệnh SQL update ) đồng thời bắn ra 1 exception.
    */
    public function postPayCart(Cart $cart,Request $request)
    {

        if($cart->total_quanlity>0)
        {
            $v=Validator::make($request->all(),[
                'name'=>'required',
                'phone'=>'required',
                'address'=>'required',
                'notes'=>'required',
                'option'=>'required',

            ],[
                'name.required'=>'Không được bỏ trống',

            ]);
                if($v->fails())
                {
                    return response()->json('Vui lòng điền đầy đủ thông tin');
                }

                //try catch
                // Bắt đầu các hành động trên CSDL
                DB::beginTransaction();
                try{

                        $code_donhang=Auth::guard('khachhang')->user()->codeuser.'-'.rand();
                        $orders=new orders();
                        $orders->id_users=Auth::guard('khachhang')->user()->id;
                        $orders->codeOder =$code_donhang;
                        $orders->fullName=$request->get('name');
                        $orders->phoneOder=$request->get('phone');
                        $orders->Address=$request->get('address');
                        $orders->notes=$request->get('notes');
                        $orders->Payments=$request->get('option');
                        $orders->status=1;
                        $orders->created_at=Carbon::now('Asia/Ho_Chi_Minh');
                        $orders->TotalOrder=$cart->total_price;
                        $orders->save();
                        //end
                        $id=orders::where('codeOder','=',$code_donhang)->first();
                        foreach($cart->items as $item)
                        {
                            $ordersproducts =new ordersproducts();
                            $ordersproducts->id_orders=$id->id;
                            $ordersproducts->id_products=$item['id'];
                            $ordersproducts->price=$item['price'];
                            $ordersproducts->quantity=$item['quantity'];
                            $ordersproducts->TotalProducts=$item['quantity']*$item['price'];
                            $ordersproducts->save();

                        }
                        if($request->get('option')==1)
                        {
                            $message='Trả Tiền Mặt Khi Nhận Hàng';

                        }else
                        {
                            $message='Chuyển Khoản Ngân Hàng';
                        }
                        $email=Auth::guard('khachhang')->user()->email;
                        $details = [
                            'title' => 'Xin Chân Thành Cảm Ơn Quý Khách Hàng  Đã Mua Hàng  Tại WatchStore',
                            'payments'=>$message,
                            'codeorder'=>$code_donhang,
                            'body' => 'Đơn Hàng Của Quý Khách Cần Thanh Toán  : '.library_my::formatMoney($cart->total_price).'VNĐ ',
                            'product'=>$cart,
                        ];



                        $this->sendmail($details,$email);
                        $cart->clear();
                        DB::commit();
                        //Commit dữ liệu khi hoàn thành kiểm tra
                        if($request->get('option')==2)
                        {
                            $response = \VNPay::purchase([
                                'vnp_TxnRef' => $code_donhang,
                                'vnp_OrderType' => 200000,
                                'vnp_OrderInfo' => 'Thanh Toán Hóa Đơn Mua Hàng  : '.$code_donhang,
                                'vnp_IpAddr' => '127.0.0.1',
                                'vnp_Amount' => $cart->total_price,
                                'vnp_ReturnUrl' => "https://watchstore.vn/kiem-tra-thanh-toan",
                            ])->send();

                            if ($response->isRedirect()) {
                                $redirectUrl = $response->getRedirectUrl();
                                return response()->json(['success'=>'Đặt Hàng Thành Công Chuyển Hướng Trang Thanh Toán','url'=>$redirectUrl]);
                            }
                        }
                        return response()->json(['success'=>'Đặt Hàng Thành Công Nhân Viên Sẽ Liên Hệ Lại Sau']);


                             //orders



                }catch(Exception $e)
                {
                    //Gặp lỗi nào đó mới rollback
                    DB::rollBack();
                    return response()->json('Phát Sinh Lỗi Liên Hệ Với Nhân Viên Cửa Hàng');
                }





        }else
        {
            return response()->json(['success'=>'Hãy chọn cho mình 1 chiếc đồng hồ ưng ý trước khi thanh toán nhé ']);
        }




    }
    //Quên Mật Khẩu
    public function resetPassword()
    {
        return view('user.resetPassword');
    }
    public function postResetPassword(Request $request)
    {
      try{

        $user=users::where([['email','=',$request->get('email')],['socialnetworks','=','0']])->first();
        if(!$user)
        {
            return redirect()->back()->with("message",["type"=>"danger","msg"=>"Email Này Chưa Được Đăng Ký "]);


        }
        $newPass=rand ( 10000 , 99999 );
        $user->password=bcrypt($newPass);
        $detail=[
            'passwordNew'=>$newPass,
        ];
        $user->save();

        \Mail::to($request->get('email'))->send(new \App\Mail\resetPassword($detail));
        return redirect()->back()->with("message",["type"=>"success",'msg'=>"Mật Khẩu Mới Đã Được Gửi Tới Email"]);
      }catch(Exception $e )
      {
        return redirect()->back()->with("message",["type"=>"danger","msg"=>"Phát Sinh Lỗi Liên Hệ Với Nhân Viên Cửa Hàng"]);
    }
    }
    //thông tin tài khoản
    public function accountUser()
    {
        return view('user.thongtintaikhoan');
    }
    public function postAccountUser(Request $request )
    {

        try{
            $v =Validator::make($request->all(),[
                'name'=>'required',
                'phone'=>'required',

            ],[
                'name.required'=>'Không Được Bỏ Trống',
                'phone.required'=>'Không Được Bỏ Trống',

            ]);
            if($v->fails())
            {
                return redirect()->back()
                ->withErrors($v)
                ->withInput();
            }
            $user = users::findOrFail(Auth::guard('khachhang')->user()->id);
            if($request->get('password-new')==null)
            {
                $user->name=$request->get('name');
                $user->phoneuser=$request->get('phone');

            }else

            {
                $user->name=$request->get('name');
                $user->phoneuser=$request->get('phone');
                $user->password=bcrypt($request->get('password-new'));

            }
                $user->save();

            return redirect()->back()->with("message",["type"=>"success",'msg'=>"Cập Nhật Thành Công"]);
        }catch(Exception $e)
        {
            return redirect()->back()->with("message",["type"=>"danger","msg"=>"Phát Sinh Lỗi Liên Hệ Với Nhân Viên Cửa Hàng"]);

        }
    }
    //Đăng Ký
    public function register()
    {
        if(Auth::guard('khachhang')->check())
        {

            return  redirect()->route('home');
        }
        return view('user.dang_ky');
    }
    public function postRegister(Request $request)
    {

        try{

            $v=Validator::make($request->all(),[
                'name'=>'required',
                'email'=>'required|unique:users',
                'password'=>'required|min:11',
                'phone'=>'required|min:10'
            ],[
                'name.required'=>'Không Được Bỏ Trống',
                'email.required'=>'không Được Bỏ Trống',
                'email.unique'=>'Email Đã Tồn Tại',
                'password.required'=>'Không được bỏ Trống',
                'password.min'=>'Không được dưới 11 kí tự ',
                'phone.required'=>'Không được bỏ trống',
                'phone.min'=>'Không đúng định dạng số điện thoại'
            ]);
            if($v->fails())
            {
                return redirect()->back()
                ->withErrors($v)
                ->withInput();
            }
                    $user = new users();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = bcrypt($request->password);
                    $user->phoneuser=$request->phone;
                    $user->codeuser='W'.mt_rand();
                    $user->save();
             return redirect()->back()->with("message",["type"=>"success",'msg'=>"Đăng Ký Thành Công"]);
        }catch(Exception $e)
        {
            return redirect()->back()->with("message",["type"=>"danger","msg"=>"Phát Sinh Lỗi Liên Hệ Với Nhân Viên Cửa Hàng"]);
        }


    }
}
