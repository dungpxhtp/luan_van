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
use Yajra\Datatables\Datatables;

class HomeController extends Controller
{
    //

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
    // điều kiện lọc filter của hãng
    public function brands_filter_products($slug,Request $request)
    {
        $brandShow=brandproducts::where([['slug','=',$slug],['status','=','1']])->firstOrFail();
        $products=products::where([['status','=','1'],['id_brandproducts','=',$brandShow->id]])->orderBy('price','asc')->paginate(8);
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
        return view('user.layout.brands-show-pagination',compact('brandShow','products'));
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
    //lọc filter cho loại sản phẩm
    public function category_filter_products($slug,Request $request)
    {
        $loaisanpham=categoryproducts::where([['slug','=',$slug],['status','=','1']])->firstOrFail();
        $products=products::where([['status','=','1'],['id_categoryproducts','=',$loaisanpham->id]])->orderBy('created_at','desc')->paginate(8);
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
        return view('user.layout.loaiSanPham.loai_pagination',compact('loaisanpham','products'))->render();

    }
    // đối tượng
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
    //lọc theo đối tượng
    public function gender_filter_products($slug , Request $request)
    {
        $doituong=gendercategoryproducts::where([['slug','=',$slug],['status','=','1']])->firstOrFail();
        $products=products::where([['status','=','1'],['id_gendercategoryproducts','=',$doituong->id]])->orderBy('created_at','desc')->paginate(8);
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
        return view('user.layout.doiTuong.doituong_pagination',compact('doituong','products'));
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
    //đăng nhập
    function postdangnhap(Request $request){
        $email = $request->get('email');
        $password =$request->get('password');


        if(Auth::guard('khachhang')->attempt(['email'=>$email,'password'=>$password]))
        {
            if(Auth::guard('khachhang')->user()->status==0)
            {   $emailLogin=Auth::guard('khachhang')->user()->email;
                Auth::guard('khachhang')->logout();

                $request->session()->flush();
                return redirect()->route('getxacthuc')->with("message",["type"=>"danger","msg"=>"Yêu Cầu Nhập Mã Xác Thực"])->with('emailLogin',$emailLogin);
            }

            return redirect()->back()->with("message",["type"=>"success","msg"=>"Đăng Nhập Thành Công"]);
        }else
        {
            return redirect()->back()->with("message",["type"=>"danger","msg"=>"Tài Khoản Và Mật Khẩu Chưa Chính Xác "]);
        }


    }
    public function getxacthuc()
    {
        return view('user.getxacthuc');
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
                                'vnp_Amount' => $cart->total_price.'00',
                                'vnp_ReturnUrl' => "https://watchstore.vn/kiem-tra-thanh-toan",
                            ])->send();

                            if ($response->isRedirect()) {
                                $redirectUrl = $response->getRedirectUrl();
                                return response()->json(['success'=>'Đặt Hàng Thành Công Chuyển Hướng Sang Trang Thanh Toán ','url'=>$redirectUrl]);
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
            'title'=>'Xin chào, mật khẩu của bạn được yêu cầu thay đổi (từ chức năng Quên mật khẩu của website):',
            'content'=>'Mật khẩu mới:',
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

            if($request->ajax())
            {

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
                    return response()->json(['danger'=>$v->errors()]);
                }
                    $verification =rand(1000,9999);
                        $user = new users();
                        $user->name = $request->get('name');
                        $user->email = $request->get('email');
                        $user->password = bcrypt($request->get('password'));
                        $user->phoneuser=$request->get('password');
                        $user->codeuser='W'.mt_rand();
                        $user->verification=$verification;
                        $user->created_at=Carbon::now('Asia/Ho_Chi_Minh');
                        $user->status=0;
                        $user->save();

                        $detail=[
                            'title'=>'Xin chào Bạn Đã Đăng Ký Tài Khoản Tại WatchStore:',
                            'content'=>'Mã Xác Thực Của Bạn Là :',
                            'passwordNew'=>$verification,
                        ];
                        $user->save();

                        \Mail::to($request->get('email'))->send(new \App\Mail\resetPassword($detail));
                return response()->json(['success'=>'Bạn Hãy Nhập Mã Xác Thực']);
            }
        }catch(Exception $e)
        {
            return redirect()->back()->with("message",["type"=>"danger","msg"=>"Phát Sinh Lỗi Liên Hệ Với Nhân Viên Cửa Hàng"]);
        }


    }
    public function xacthucgmail(Request $request)
    {
        if($request->ajax())
        {

           $email=$request->get('email_active');
           $user=users::where([['email','=',$email],['verification','=',$request->get('code_active')]])->first();
            if($user)
            {
                $user->status=1;
                $user->save();
                Auth::guard('khachhang')->login($user);
                return response()->json(['success'=>'Xác Thực Thành Công Tài Khoản ! Chuyển Hướng Trang Chủ']);
            }
            return response()->json(['danger'=>'Sai mã xác thực nhập lại']);

        }
    }
    //đơn hàng đã mua
    public function cart_order_user()
    {
        return view('user.don_hang_da_mua');
    }
    public function fetch_order(Request $request)
    {
        if($request->ajax())
        {
            $getData=orders::where([['id_users','=',Auth::guard('khachhang')->user()->id],['status','<>','3']])->orderBy('created_at','desc')->get();
            return Datatables::of($getData)->setRowAttr(['align'=>'center'])
            ->addColumn('codeOder',function($getData){
                return $getData->codeOder;
            })->addColumn('fullName',function($getData){
                return $getData->fullName;
            })->addColumn('phoneOder',function($getData){
                return $getData->phoneOder;
            })->addColumn('TotalOrder',function($getData){
                return library_my::formatMoney($getData->TotalOrder);
            })->addColumn('Address',function($getData){
                return $getData->Address;
            })->addColumn('notes',function($getData){
                return $getData->notes;
            })->addColumn('Payments',function($getData){
                if($getData->Payments ==1)
                {
                    $span='Trả Tiền Mặt Khi Nhận Hàng ';
                    return $span;
                }else
                {
                    $span='<span class="" style="color:#005aab;"><i class="fab fa-cc-amazon-pay"></i> Chuyển Khoản Ngân Hàng</span>';
                    return $span;
                }

            })->addColumn('status',function($getData){
                if($getData->Payments ==1)
                {
                    if($getData->status	==1)
                    {
                        $status	='<span class="btn-warning btn btn-sm disabled ">Đang Xử Lý</span>';
                    }else
                    {
                        $status	='<span class="btn btn-sm btn-success btn-default disabled ">Đã Xác Nhận</span>';
                    }
                    return $status	;
                }else
                {
                    if($getData->status	==2)
                    {
                        $status	='<span class="btn btn-sm btn-success disabled "><i class="fas fa-money-check-alt"></i> Đã Thanh Toán</span>';
                    }
                    else
                    {
                        $status	='<a class="btn-danger btn btn-sm text-white " href="thanh-toan-vnpay/'.$getData->codeOder.'">Chưa Thanh Toán</a>';
                    }
                    return $status	;
                }

            })->addColumn('created_at',function($getData){
                $time=  \Carbon\Carbon::parse($getData->created_at)->format('d/m/Y');
                return $time;
            })->addColumn('action',function($getData){
                $button='<a class="btn btn-sm btn-info view_order" href="danh-sach-san-pham/'.$getData->id.'"><i class="fas fa-eye"></i></a>';
                return $button;
            })
            ->rawColumns(['codeOder','fullName','phoneOder','TotalOrder','Address','notes','Payments','status','action'])
            ->make('true');
        }
    }
    public function fetch_order_accept(Request $request)
    {
        if($request->ajax())
        {
            $getData=orders::where([['id_users','=',Auth::guard('khachhang')->user()->id],['status','=','3']])->orderBy('created_at','desc')->get();
            return Datatables::of($getData)->setRowAttr(['align'=>'center'])
            ->addColumn('codeOder',function($getData){
                return $getData->codeOder;
            })->addColumn('fullName',function($getData){
                return $getData->fullName;
            })->addColumn('phoneOder',function($getData){
                return $getData->phoneOder;
            })->addColumn('TotalOrder',function($getData){
                return library_my::formatMoney($getData->TotalOrder);
            })->addColumn('Address',function($getData){
                return $getData->Address;
            })->addColumn('notes',function($getData){
                return $getData->notes;
            })->addColumn('Payments',function($getData){
                if($getData->Payments ==1)
                {
                    $span='Trả Tiền Mặt Khi Nhận Hàng ';
                    return $span;
                }else
                {
                    $span='<span class="" style="color:#005aab;"><i class="fab fa-cc-amazon-pay"></i> Chuyển Khoản Ngân Hàng</span>';
                    return $span;
                }

            })->addColumn('status',function($getData){
                if($getData->Payments ==1)
                {
                    if($getData->status	==1)
                    {
                        $status	='<span class="btn-warning btn btn-sm disabled ">Đang Xử Lý</span>';
                    }else
                    {
                        $status	='<span class="btn btn-sm btn-success btn-default disabled ">Đã Xác Nhận</span>';
                    }
                    return $status	;
                }else
                {
                    if($getData->status	==2)
                    {
                        $status	='<span class="btn btn-sm btn-success disabled "><i class="fas fa-money-check-alt"></i> Đã Thanh Toán</span>';
                    }
                    if($getData->status=3)
                    {
                        $status	='<span class="btn btn-sm btn-success btn-default disabled ">Đã Xác Nhận</span>';

                    }
                    else
                    {
                        $status	='<a class="btn-danger btn btn-sm text-white " href="thanh-toan-vnpay/'.$getData->codeOder.'">Chưa Thanh Toán</a>';
                    }
                    return $status	;
                }

            })->addColumn('created_at',function($getData){
                $time=  \Carbon\Carbon::parse($getData->created_at)->format('d/m/Y');
                return $time;
            })->addColumn('action',function($getData){
                $button='<a class="btn btn-sm btn-info view_order" href="danh-sach-san-pham/'.$getData->id.'"><i class="fas fa-eye"></i></a>';
                return $button;
            })
            ->rawColumns(['codeOder','fullName','phoneOder','TotalOrder','Address','notes','Payments','status','action'])
            ->make('true');
        }
    }
    public function fetch_order_error(Request $request)
    {
        if($request->ajax()){
            $getData=orders::where([['id_users','=',Auth::guard('khachhang')->user()->id],['status','=','0']])->orderBy('created_at','desc')->get();
            return Datatables::of($getData)->setRowAttr(['align'=>'center'])
            ->addColumn('codeOder',function($getData){
                return $getData->codeOder;
            })->addColumn('fullName',function($getData){
                return $getData->fullName;
            })->addColumn('phoneOder',function($getData){
                return $getData->phoneOder;
            })->addColumn('TotalOrder',function($getData){
                return library_my::formatMoney($getData->TotalOrder);
            })->addColumn('Address',function($getData){
                return $getData->Address;
            })->addColumn('notes',function($getData){
                return $getData->notes;
            })->addColumn('Payments',function($getData){
                if($getData->Payments ==1)
                {
                    $span='Trả Tiền Mặt Khi Nhận Hàng ';
                    return $span;
                }else
                {
                    $span='<span class="" style="color:#005aab;"><i class="fab fa-cc-amazon-pay"></i> Chuyển Khoản Ngân Hàng</span>';
                    return $span;
                }

            })->addColumn('status',function($getData){

                if($getData->status==0)
                {
                    $status='<span class="btn-danger btn btn-sm disabled ">Đơn hàng Lỗi</span>';
                }


                    return $status;


            })->addColumn('created_at',function($getData){
                $time=  \Carbon\Carbon::parse($getData->created_at)->format('d/m/Y');
                return $time;
            })->addColumn('action',function($getData){
                $button='<a class="btn btn-sm btn-info view_order" href="danh-sach-san-pham/'.$getData->id.'"><i class="fas fa-eye"></i></a>';
                return $button;
            })
            ->rawColumns(['codeOder','fullName','phoneOder','TotalOrder','Address','notes','Payments','status','action'])
            ->make('true');
        }
    }
    // đơn hàng giao thành công
    public function order_success(Request $request)
    {
        if($request->ajax()){
            $getData=orders::where([['id_users','=',Auth::guard('khachhang')->user()->id],['status','=','4']])->orderBy('created_at','desc')->get();
            return Datatables::of($getData)->setRowAttr(['align'=>'center'])
            ->addColumn('codeOder',function($getData){
                return $getData->codeOder;
            })->addColumn('fullName',function($getData){
                return $getData->fullName;
            })->addColumn('phoneOder',function($getData){
                return $getData->phoneOder;
            })->addColumn('TotalOrder',function($getData){
                return library_my::formatMoney($getData->TotalOrder);
            })->addColumn('Address',function($getData){
                return $getData->Address;
            })->addColumn('notes',function($getData){
                return $getData->notes;
            })->addColumn('Payments',function($getData){
                if($getData->Payments ==1)
                {
                    $span='Trả Tiền Mặt Khi Nhận Hàng ';
                    return $span;
                }else
                {
                    $span='<span class="" style="color:#005aab;"><i class="fab fa-cc-amazon-pay"></i> Chuyển Khoản Ngân Hàng</span>';
                    return $span;
                }

            })->addColumn('status',function($getData){

                if($getData->status==4)
                {
                    $status='<span class="btn-success btn btn-sm disabled ">Đơn hàng Giao Thanh Công</span>';
                }


                    return $status;


            })->addColumn('created_at',function($getData){
                $time=  \Carbon\Carbon::parse($getData->created_at)->format('d/m/Y');
                return $time;
            })->addColumn('action',function($getData){
                $button='<a class="btn btn-sm btn-info view_order" href="danh-sach-san-pham/'.$getData->id.'"><i class="fas fa-eye"></i></a>';
                return $button;
            })
            ->rawColumns(['codeOder','fullName','phoneOder','TotalOrder','Address','notes','Payments','status','action'])
            ->make('true');
        }
    }
    public function ds_order(Request $request,$id)
    {
        if($request->ajax())
        {
            $ordersproducts=ordersproducts::where('ordersproducts.id_orders','=',$id)
            ->join('products','ordersproducts.id_products','=','products.id')->select('ordersproducts.*','products.name as nameproducts')
            ->paginate(4);
            return view('user.layout.don_hang.danhsach',['ordersproducts'=>$ordersproducts])->render();
        }
    }

    //tìm kiếm sản phẩm auto complete
    //đầu vào name đầu ra json
    public function search_complete(Request $request)
    {
        if($request->ajax())
        {
            $keyword=$request->input('keyword');
            $products=products::where([['name','LIKE',"%$keyword%"]])->select('products.name')->orderBy('created_at','desc')->take(8)->get();
            return response()->json($products);
        }
    }
    public function view_search_result(Request $request)
    {
       $keyword=$request->get('keyword');
       $products=products::where([['name','LIKE',"%$keyword%"]])->get();
       return view('user.search_show',compact('products'));

    }

}

