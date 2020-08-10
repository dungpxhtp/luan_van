<?php

namespace App\Http\Controllers\Frontend\Topic;

use App\Http\Controllers\Controller;
use App\Models\post;
use App\Models\topic;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

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
                ->addColumn('update',function($getData){
                    $status=$getData->nameAdminUpdate;
                    if($status)

                    {
                        $update='<span>'.$status->fullname.'</span>';
                        $update.='<br>'.$getData->updated_at;
                        return $update;
                    }else
                    {
                        $status="chưa cập nhật";
                        return $status;

                    }
                })
                ->rawColumns(['nameadmin','name','created_at','status','action','update'])->make('true');


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
                    $topic->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
                    $topic->updated_by=Auth::guard('admin')->user()->id;
                    $topic->save();
                    return response()->json(['success'=>'Tắt Hoạt Động Chủ Đề Bài Viết Thành Công']);
                }else if($topic->status==0)
                {
                    $topic->status= 1;
                    $topic->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
                    $topic->updated_by=Auth::guard('admin')->user()->id;
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
    public function insert(Request $request)
    {
        if($request->ajax()){

            $v=Validator::make($request->all(),[
                'name'=>'required|unique:topic',
                'metadesc'=>'required|min:11',
                'metakey'=>'required|min:11',

            ],[
                'name.required'=>'Không Được Bỏ Trống',
                'name.unique'=>'Đề tài đã có',
                'metakey.required'=>'không Được Bỏ Trống',
                'metadesc.min'=>"Số ký tự ít nhất 11",
                'metakey.min'=>"Số ký tự ít nhất 11",

                'metadesc.required'=>'không Được Bỏ Trống',

            ]);
            if($v->fails())
            {
                return response()->json(['danger'=>$v->errors()]);
            }
            if($request->status=='on')
            {
                $status=1;

            }else
            {
                $status=0;
            }
            $new=new topic;
            $new->admin=Auth::guard('admin')->user()->id;
            $new->name=$request->get('name');
            $new->slug=Str::slug($request->get('name'));
            $new->metadesc=$request->get('metadesc');
            $new->metakey=$request->get('metakey');
            $new->status=$status;
            $new->created_at=Carbon::now('Asia/Ho_Chi_Minh');
            $new->created_by=Auth::guard('admin')->user()->id;
            $new->save();
            return response()->json(['success'=>'Thêm thành công']);
        }
    }
    public function find(Request $request , $id)
    {
        try{
            if($request->ajax())
            {
                $find=topic::find($id);
                return response()->json(['success'=>$find]);
            }
        }catch(Exception $e)
        {
            return response()->json(['danger'=>'Không tìm thấy ']);
        }
    }
    public function update(Request $request , $id)
    {
        if($request->ajax())
        {   $find=topic::find($id);
            $find->name=$request->get('name_update');
            $find->slug=Str::slug($request->get('name_update'));
            $find->metadesc=$request->get('metadesc_update');
            $find->metakey=$request->get('metakey_update');
            $find->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
            $find->updated_by=Auth::guard('admin')->user()->id;
            $find->save();
            return response()->json(['success'=>'Cập nhật thành công']);
        }
    }
}
