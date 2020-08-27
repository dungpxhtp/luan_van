<?php

namespace App\Http\Controllers\Frontend\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin as AppAdmin;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
class admin extends Controller
{
    //
        public function __construct()
    {
        $this->middleware('auth.auth');
        $this->middleware(function ($request, $next) {
            if(Auth::guard('admin')->user()->access ==0)
            {
                return redirect()->back();
            }else
            {

            return $next($request);
            }
        });
    }
    public function index()
    {

        return view('admin.admin.index');
    }
    public function fetchindex(Request $request){
        if($request->ajax())
        {
            $getData=AppAdmin::where('id','<>',Auth::guard('admin')->user()->id)->get();
            return Datatables::of($getData)
            ->addColumn('fullName',function($getData){
                $fullName=$getData->fullname;
                return $fullName;
            })->addColumn('email',function($getData){
                $email=$getData->email;
                return $email;
            })->addColumn('phone',function($getData){
                $phone=$getData->phone;
                return $phone;
            })->addColumn('access',function($getData){
                if($getData->access==1)
                {
                    $span='Người Quản Lý';
                    return $span;
                }else
                {
                    $span='Nhân Viên';
                    return $span;
                }
            })->addColumn('status',function($getData){
                if($getData->status ==1){
                    $status='<span class="bg-success"><i class="fas fa-toggle-on"></i> Đang Hoạt Động</span>';

               }else if($getData->status==0){
                $status='<span class="bg-danger"><i class="fas fa-toggle-off"></i>Tắt Hoạt Động</span>';
               }
               return $status;
            })->addColumn('action',function($getData){
                $action='<a href="'.$getData->id.'" class="btn btn-sm btn-success update_status">Đổi Trạng Thái</a>';
                $action.='<a href="'.$getData->id.'" class="btn btn-sm btn-info edit">Chỉnh Sửa</a>';

                return $action;
            })->addColumn('nameAdminCreated',function($getData){
                $nameAdminCreated='<span>'.$getData->nameAdminCreated->fullname.'</span>';
                $nameAdminCreated.='<br>'.$getData->created_at;
                return $nameAdminCreated;
            })->addColumn('update_by',function($getData){
                $update_by=$getData->nameAdminUpdated;
                if($update_by)

                {
                    $update='<span>'.$update_by->fullname.'</span>';
                    $update.='<br>'.$update_by->updated_at;
                    return $update;
                }else
                {
                    $update="chưa cập nhật";
                    return $update;

                }
            })
            ->rawColumns(['fullName','email','phone','access','status','action','nameAdminCreated','update_by'])->make('true');
        }
    }
    //Update trạng thái
    public function update_status(Request $request,$id)
    {
        if($request->ajax())
        {
            try{
                $row=AppAdmin::findOrFail($id);
                if($row->status ==1 )
                {
                    $row->status= 0;
                    $row->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
                    $row->updated_by=Auth::guard('admin')->user()->id;
                    $row->save();
                    return response()->json(['success'=>'Tắt Hoạt Động Thành Công']);
                }else if($row->status==0)
                {
                    $row->status= 1;
                    $row->updated_at=Carbon::now('Asia/Ho_Chi_Minh');
                    $row->updated_by=Auth::guard('admin')->user()->id;
                    $row->save();
                    return response()->json(['success'=>'Bật Lại Hoạt Động']);
                }
            }catch(Exception $e)
            {
                return response()->json(['danger'=>'Không thể thay đổi trạng thái']);
            }
        }
    }
    public function find(Request $request , $id)
    {
        try{
            if($request->ajax())
            {
                $find=AppAdmin::find($id);
                return response()->json(['success'=>$find]);
            }
        }catch(Exception $e)
        {
            return response()->json(['danger'=>'Không tìm thấy ']);
        }
    }
    public function update_admin(Request $request,$id)
    {
        if($request->ajax())
        {
            try{

                $find=AppAdmin::find($id);
                $find->fullname=$request->get('fullname');
                $find->phone=$request->get('phone');
                $find->access=$request->get('access');
                $find->save();

                return response()->json(['success'=>'Chỉnh sửa thành công']);
            }catch(Exception $e){
                return response()->json(['danger'=>'Phát sinh lỗi']);
            }

        }
    }
    public function insert(Request $request)
    {
        if($request->ajax())
        {
            try {
                $v=Validator::make($request->all(),[
                    'fullname'=>'required',
                    'email'=>'required|unique:admin',
                    'password'=>'required',
                    'phone'=>'required|min:10|max:12',
                    'access'=>'required',

            ],[
                    'fullname.required'=>'Không Được Bỏ Trống Tên ',
                    'email.required'=>'Không Được Bỏ Trống Email ',
                    'password.required'=>'Không Được Bỏ Trống Password ',
                    'phone.required'=>'Không Được Bỏ Trống số điện thoại ',
                    'access.required'=>'Không Được Bỏ Trống quyền ',
                    'phone.min'=>'Không đúng định dạng',
                    'phone.max'=>'Không đúng định dạng',
                    'email.unique'=>'Email Này Đã Tồn Tại',

            ]);
            if($v->fails())
            {
                return response()->json(['danger'=>$v->errors()]);
            }

                $newAdmin=new AppAdmin;
                $newAdmin->fullname=$request->get('fullname');
                $newAdmin->email=$request->get('email');
                $newAdmin->password=bcrypt($request->get('password'));
                $newAdmin->phone=$request->get('phone');
                $newAdmin->access=$request->get('access');
                $newAdmin->created_at=Carbon::now('Asia/Ho_Chi_Minh');
                $newAdmin->created_by=Auth::guard('admin')->user()->id;
                $newAdmin->status=1;
                $newAdmin->save();
                return response()->json(['success'=>'Nhân viên tạo ra thành công']);
            }catch(Exception $e)
            {
                return response()->json(['danger'=>'Lỗi phát sinh']);
            }
        }
    }

}
