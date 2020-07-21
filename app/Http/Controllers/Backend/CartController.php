<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\library\Cart;
use App\Models\products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function add(Cart $cart ,$id)
    {


        $product=products::find($id);

        $cart->add($product);
        if(session('cart',new Cart()))
        {
        return response()->json(['success'=>'Thêm Vào Giỏ Hàng Thành Công']);
        }
    }
    public function update(Cart $cart , $id,$quantity)
    {
        if($quantity==0)
        {
            $cart->remove($id);
            return response()->json(['success'=>'Đã Xóa Sản Phẩm']);
        }
        $cart->update($id,$quantity);

        return response()->json(['success'=>'Giảm Số Lượng Thành Công']);


    }
    public function remove(Cart $cart ,$id)
    {
        $cart->remove($id);
        return response()->json(['success'=>'Đã Xóa Sản Phẩm']);
    }
    public function showCartOrder(Cart $cart,Request $request)
    {

        if($request->ajax())
        {
            $cartoder=$cart;
            return view('user.layout.cart',compact('cartoder'));


        }
    }
    public function clear(Cart $cart )
    {
        $cart->clear();
        return response()->json(['success'=>'Xóa Tất Cả Sản Phẩm Trong Giỏ Hàng']);
    }
}
