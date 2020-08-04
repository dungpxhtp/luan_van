<?php

namespace App\Http\Controllers\Frontend\Topic;

use App\Http\Controllers\Controller;
use App\Models\post;
use App\Models\topic;
use Exception;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class topicController extends Controller
{
    //
    public function index(){
        return view('admin.topic.index');

    }
    public function fetchindex(Request $request){
        if($request->ajax())
        {
            $getData=topic::join('admin','topic.admin','=','admin.id')->select('topic.*','admin.fullname as nameadmin')->get();
                return Datatables::of($getData)
                ->addColumn('nameadmin',function($getData){
                    $nameadmin=$getData->nameadmin;
                    return $nameadmin;
                })->addColumn('name',function($getData){
                    $name=$getData->name;
                    return $name;
                })->addColumn('created_at',function($getData){
                    $time=\Carbon\Carbon::parse($getData->created_at)->format('d m Y H:i:s');
                    return $time;

                })->addColumn('status',function($getData){
                    if($getData->status ==1)
                    {
                        $span='<span class="btn btn-sm btn-success">Đang Hoạt Động</span>';
                        return $span;
                    }else if($getData->status==0)
                    {
                        $span='<span class="btn btn-sm btn-danger">Tạm Dừng</span>';
                        return $span;

                    }
                })->addColumn('action',function($getData){
                    $action='<a href="'.$getData->id.'" class="btn btn-sm btn-success update_status">Đổi Trạng Thái</a>';
                    $action.='<a href="'.$getData->id.'" class="btn btn-sm btn-info edit">Chỉnh Sửa</a>';
                    $action.='<a href="'.$getData->id.'" class="btn btn-sm btn-danger delete">Xóa </a> ';
                    return $action;
                })
                ->rawColumns(['nameadmin','name','created_at','status','action'])->make('true');


        }
    }
    /* update status , đầu vào id đầu ra messgae */
    public function update_status(Request $request,$id)
    {
        if($request->ajax())
        {
            try{
                $topic=topic::findOrFail($id);
                if($topic->status ==1 )
                {
                    $topic->status= 0;
                    $topic->save();
                    return response()->json(['success'=>'Tắt Hoạt Động Chủ Đề Bài Viết Thành Công']);
                }else if($topic->status==0)
                {
                    $topic->status= 1;
                    $topic->save();
                    return response()->json(['success'=>'Bật Lại Hoạt Động Chủ Đề']);
                }
            }catch(Exception $e)
            {
                return response()->json(['danger'=>'Không thể thay đổi trạng thái']);
            }
        }
    }
    public function delete_topic(Request $request,$id)
    {
        if($request->ajax()){
            $topic=topic::findOrFail($id);
            $post=post::where('id_topic','=',$id)->get();
            if($post->isEmpty()){
                $topic->delete();
                return response()->json(['success'=>'Đã Xóa Chủ Đề Này']);

            }else
            {
                return response()->json(['danger'=>'Không thể xóa do còn bài viết liên quan ']);
            }
        }
    }
}
