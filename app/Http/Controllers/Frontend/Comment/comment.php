<?php

namespace App\Http\Controllers\Frontend\Comment;

use App\Http\Controllers\Controller;
use App\Models\commentproducts;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class comment extends Controller
{
    //
    public function index()
    {
        return view('admin.comment.index');
    }
    public function fetchindex(Request $request)
    {
        if($request->ajax())
        {
            $getData=commentproducts::where([['status','=',0]])->get();
            return DataTables::of($getData)
            ->addColumn('nameUser',function($getData){
                $nameadmin= $getData->getNameComment->name;
                return $nameadmin;
            })->addColumn('commentText',function($getData){
                $commentText=$getData->commentText;
                return $commentText;
            })->addColumn('status',function($getData){
                $span="<span class='btn btn-sm btn-warning'>Chưa Duyệt</span>";
                return $span;
            })->addColumn('created_at',function($getData){
                $time=  \Carbon\Carbon::parse($getData->created_at)->format('d/m/Y H:i');
                return $time;
            })->addColumn('products',function($getData){
                $nameproducts=$getData->getNameProducts->name;
                return $nameproducts;
            })->addColumn('chucnang',function($getData){
                $button ="<a href='".$getData->id."' class='btn btn-sm btn-success update_status'>Duyệt Bình Luận</a>";
                $button.="<a href='".$getData->id."' class='btn btn-sm btn-danger delete'>Xóa Bình Luận</a>";
                return $button;
            })
            ->rawColumns(['nameUser','commentText','status','created_at','products','chucnang'])->make('true');
        }
    }
    public function update_status($id,Request $request)
    {
        if($request->ajax())
        {
           try{
            $comment=commentproducts::find($id);
            $comment->status=1;
            $comment->save();
            return response()->json(['success'=>'Duyệt Bình Luận Thành Công']);
           }catch(Exception $e)
           {
            return response()->json(['danger'=>'Phát sinh lỗi']);
           }
        }
    }
    public function fecthindexcheck(Request $request)
    {
        if($request->ajax())
        {
            $getData=commentproducts::where([['status','=',1]])->get();
            return DataTables::of($getData)
            ->addColumn('nameUser',function($getData){
                $nameadmin= $getData->getNameComment->name;
                return $nameadmin;
            })->addColumn('commentText',function($getData){
                $commentText=$getData->commentText;
                return $commentText;
            })->addColumn('status',function($getData){
                $span="<span class='btn btn-sm btn-success'>Đã Duyệt</span>";
                return $span;
            })->addColumn('created_at',function($getData){
                $time=  \Carbon\Carbon::parse($getData->created_at)->format('d/m/Y H:i');
                return $time;
            })->addColumn('products',function($getData){
                $nameproducts=$getData->getNameProducts->name;
                return $nameproducts;
            })->addColumn('chucnang',function($getData){

                $button="<a href='".$getData->id."' class='btn btn-sm btn-danger delete'>Xóa Bình Luận</a>";
                return $button;
            })
            ->rawColumns(['nameUser','commentText','status','created_at','products','chucnang'])->make('true');
        }
    }
    public function delete($id,Request $request)
    {
        if($request->ajax())
        {
            try{
                $comment=commentproducts::find($id);
                if($comment->parentid==0)
                {
                    $comment->delete();
                    return response()->json(['success'=>'Xóa bình luận thành công']);
                }
                return response()->json(['danger'=>'Không thể xóa do còn bình luận liên quan ']);
            }catch(Exception $e)
            {
                return response()->json(['danger'=>'Phát sinh lỗi']);
            }
        }
    }
}
