<?php

namespace App\Http\Controllers\Frontend\post;

use App\Http\Controllers\Controller;
use App\Models\post;
use App\Models\topic;
use App\Models\users;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;
use Exception;

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
                      $button.='<a type="button" href="update-news-detail/'.$getData->slug.'/'.$getData->id.'" name="update_status"  class="update_brands btn btn-info btn-sm">Sửa</a>';

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
                        $post->updated_by=Auth::guard('admin')->user()->id;
                        $post->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
                        $post->status= 0;
                        $post->save();
                        return response()->json(['success'=>'Tắt Hoạt Động Chủ Đề Bài Viết Thành Công']);
                    }else if($post->status==0)
                    {
                        $post->updated_by=Auth::guard('admin')->user()->id;
                        $post->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
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
        public function insert()
        {
            $topic=topic::where([['status','=',1]])->get();

            return view('admin.post.insert',compact('topic'));
        }
        public function postInsert(Request $request)
        {
           try{
            $v=Validator::make($request->all(), [
                'title'=>'required|unique:post',
                'detail'=>'required',
                'id_topic'=>'required',
                'filepath'=>'required',

            ],
            [
                'title.required'=>'Tên bài viết Không Được Bỏ Trống',

                'title.unique'=>'Đã có bài viết này',
                'detail.required'=>'Không Được Bỏ Trống',
                'filepath.required'=>'Vui Lòng Chọn Hình',
                'id_topic.required'=>'Không dược bỏ trống',


            ] );
            if($v->fails())
                {
                    return redirect()->back()
                    ->withErrors($v)
                    ->withInput();
                }
            $post=new post;
            $post->id_topic=$request->get('id_topic');
            $post->title=$request->get('title');
            $post->slug=Str::slug($request->get('title'));
            $post->detail=$request->get('detail');
            $post->image=$request->get('filepath');
            $post->metaDesc=$request->get('metadesc');
            $post->metakey=$request->get('metakey');
            $post->status=$request->get('status')=="on"?"1":"0";
            $post->created_at=Carbon::now('Asia/Ho_Chi_Minh');
            $post->created_by=Auth::guard('admin')->user()->id;
            $post->save();
            return redirect()->back()->with("message",["type"=>"success","msg"=>"Thêm Thành Công"]);
           }catch(Exception $e)
           {
            return redirect()->back()->with("danger",["type"=>"success","msg"=>"Thêm Không Thành Công"]);
           }

        }
        public function get_update($slug,$id)
        {   $post=post::where([['post.id','=',$id]])->join('topic','post.id_topic','=','topic.id')->select('post.*','topic.id as id_topic')
                    ->firstOrFail();
            $topic=topic::get();
            return view('admin.post.repair',compact('post','topic'));
        }
        public function post_update(Request $request,$id)
        {

                $v=Validator::make($request->all(), [
                    'title'=>'required',
                    'detail'=>'required',
                    'id_topic'=>'required',
                    'filepath'=>'required',

                ],
                [
                    'title.required'=>'Tên bài viết Không Được Bỏ Trống',

                    'title.unique'=>'Đã có bài viết này',
                    'detail.required'=>'Không Được Bỏ Trống',
                    'filepath.required'=>'Vui Lòng Chọn Hình',
                    'id_topic.required'=>'Không dược bỏ trống',


                ] );
                if($v->fails())
                    {
                        return redirect()->back()
                        ->withErrors($v)
                        ->withInput();
                    }
                    if(post::where([['title','=',$request->get('title')],['id','<>',$id]])->count())
                    {
                        return redirect()->back()->with("message",["type"=>"danger","msg"=>"Tên bài viết đã tồn tại Tại "]);
                    }

                $post=post::find($id);
                $post->id_topic=$request->get('id_topic');
                $post->title=$request->get('title');
                $post->slug=Str::slug($request->get('title'));
                $post->detail=$request->get('detail');
                $post->image=$request->get('filepath');
                $post->metaDesc=$request->get('metadesc');
                $post->metakey=$request->get('metakey');
                $post->status=$request->get('status')=="on"?"1":"0";
                $post->created_at=Carbon::now('Asia/Ho_Chi_Minh');
                $post->created_by=Auth::guard('admin')->user()->id;
                $post->save();
                session()->flash("danger",["type"=>"success","msg"=>"Sửa Không Thành Công"]);
                return redirect()->back()->with("message",["type"=>"success","msg"=>"Sửa Bài Viết Thành Công "]);

        }
}
