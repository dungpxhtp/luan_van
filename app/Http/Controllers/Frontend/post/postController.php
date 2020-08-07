<?php

namespace App\Http\Controllers\Frontend\post;

use App\Http\Controllers\Controller;
use App\Models\post;
use App\Models\users;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class postController extends Controller
{
    //
    public function index()
    {
        return view('admin.post.index');
    }

    public function fetchindex(Request $request)
    {
        if($request->ajax())
        {
            $getData=post::join('topic','post.id_topic','=','topic.id')->select('post.*','topic.name as nametopic')->get();
                return Datatables::of($getData)
                ->addColumn('nametopic',function($getData){
                    $nametopic=$getData->nametopic;
                    return $nametopic;

                })->addColumn('title',function($getData){
                    $title=$getData->title;
                    return $title;
                })->addColumn('image',function($getData){
                    $img='<img src="'.$getData->image.'" style=" background-position: center center;
                    background-size: cover; width: 200px;" />';
                    return $img;
                })->addColumn('update_by',function($getData){
                    $status=$getData->nameAdminUpdate;
                    if($status)
                    {
                        return $status->fullname;
                    }else
                    {
                        $status="chưa cập nhật";
                        return $status;

                    }

                })->addColumn('create_by',function($getData){
                    $action=$getData->nameAdminCreated->fullname;
                    return $action;
                })->addColumn('action',function($getData){
                    if($getData->status==1){
                        $button='<a type="button" href="'.$getData->id.'" name="update_status"  class="update_status btn btn-danger btn-sm"><i class="fas fa-power-off"></i>Tắt</a>';


                    }else{
                        $button ='<a type="button" href="'.$getData->id.'" name="update_status" class="update_status btn btn-success btn-sm"><i class="fas fa-power-off"></i>Bật</a>';

                    }
                      $button.='<a type="button" href="'.$getData->id.'" name="update_status"  class="delete btn btn-secondary btn-sm"> <i class="fas fa-trash"></i> Xóa</a>';
                      $button.='<a type="button" href="update_gendercategoryproducts/'.$getData->id.'/'.$getData->slug.'" name="update_status"  class="update_brands btn btn-info btn-sm">Sửa</a>';

                      return $button;

                })
                ->rawColumns(['nametopic','title','image','update_by','create_by','action'])->make('true');
        }
    }
        /* update status , đầu vào id đầu ra messgae */
        public function update_status(Request $request,$id)
        {
            if($request->ajax())
            {
                try{
                    $post=post::findOrFail($id);
                    if($post->status ==1 )
                    {
                        $post->status= 0;
                        $post->save();
                        return response()->json(['success'=>'Tắt Hoạt Động Chủ Đề Bài Viết Thành Công']);
                    }else if($post->status==0)
                    {
                        $post->status= 1;
                        $post->save();
                        return response()->json(['success'=>'Bật Lại Hoạt Động Chủ Đề']);
                    }
                }catch(Exception $e)
                {
                    return response()->json(['danger'=>'Không thể thay đổi trạng thái']);
                }
            }
        }

        public function delete_news(Request $request,$id)
        {
            if($request->ajax()){
                $post=post::findOrFail($id);

                    $post->delete();
                    return response()->json(['success'=>'Đã Xóa Bài Viết Này']);
            }
        }
}
