<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\users;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('admin.user.index');
    }

    /*
    fetch user DataTable
    @param request
    return list user
    */
    public function fetchUserAjax(Request $request)
    {
        if($request->ajax())
        {
            $userGetAll=users::query();
            return Datatables::of($userGetAll)
            ->addColumn('codeuser',function($userGetAll){
                $codeuser=$userGetAll->codeuser;
                return $codeuser;
            })->addColumn('email',function($userGetAll){
                $email=$userGetAll->email;
                return $email;
            })->addColumn('phoneuser',function($userGetAll){
                $phoneuser=$userGetAll->phoneuser;
                return $phoneuser;
            })->addColumn('name',function($userGetAll){
                $name=$userGetAll->name;
                return $name;
            })->addColumn('gender',function($userGetAll){
                if($userGetAll->gender !=1)
                {
                    $gender='Nữ';
                }else
                {
                    $gender='Nam';
                }
                return $gender;
            })->addColumn('status',function($userGetAll){
                if($userGetAll->status ==1){
                    $status='<span class="bg-success"><i class="fas fa-toggle-on"></i> Đang Hoạt Động</span>';

               }else{
                $status='<span class="bg-danger"><i class="fas fa-toggle-off"></i>Tắt Hoạt Động</span>';
               }
               return $status;
            })->addColumn('action',function($userGetAll){
                $action=\Carbon\Carbon::parse($userGetAll->created_at)->format('d m Y H:i:s');
                return $action;
            })->addColumn('chucnang',function($userGetAll){
                $button='<a href="'.$userGetAll->id.'" class="btn btn-sm btn-success update_status">Trạng thái</a>';
                return $button;
            })


            ->rawColumns(['codeuser','email','phoneuser','name','gender','status','action','chucnang'])->make('true');
        }
    }
    public function update_status($id,Request $request)
    {
        if($request->ajax())
        {
           try{
            $user=users::find($id);
            if($user->status==1)
            {
                $user->status=0;
                $user->save();
                return response()->json(['success'=>'Tắt trạng thái thành công']);
            }else
            {
            $user->status=1;
            $user->save();

            return response()->json(['success'=>'Bật trạng thái thành công']);
            }


           }catch(Exception $e)
           {
            return response()->json(['danger'=>'Phát sinh lỗi']);
           }
        }
    }
}
