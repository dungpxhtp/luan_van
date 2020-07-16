<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;
use Exception;
use Validator;

class APIController extends Controller
{
    /**
     * @var bool
     */
    public $loginAfterSignUp = true;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
public function login(Request $request)
    {
        $email=$request->get('email');
        $password=$request->get('password');
        $input = ['email'=>$email, 'password'=>$password];
        $token = null;
        $findUser=User::where('email','=',$request->email)->firstOrFail();
        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Nhập lại Email OR PASSWORD',
            ], 401);
        }

        return response()->json([
            'data'=>[
                    'success' => true,
                    'token' => $token,

                    'dataUserLogin'=>[
                        'user'=>$findUser
                    ],
                    ],
            'status' =>'200'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'Đăng Xuất Thành Công'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể đăng xuất'
            ], 500);
        }
    }

    /**
     * @param RegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try {
            $v= Validator::make($request->all(),  [
                'name' => 'required',
                'email' => 'required|unique:users|email',
                'password'=>'required|min:6|max:200',
                'password_confirmation' => 'required|same:password',


            ], [
                'name.required'=>'Vui Lòng Nhập Tên ',
                'email.unique'=>'Email đã đăng Ký',
                'email.required'=>'Vui Lòng Nhập Email',
                'email.email'=>'Không Đúng Định Dạng Email',
                'password.min'=>'Mật Khẩu Phải Hơn 6 Ký Tự',
                'password_confirmation.required'=>'Vui lòng nhập mật khẩu confirmation',
                'password_confirmation.same'=>'Mật Khẩu Bắt Buộc Trùng Nhau',



            ]);



            if ($v->fails())
            {
                return response()->json([
                    'error'=>[
                        'messagess'=>$v->messages()
                    ],
                    'status'=>200,
                ],200);
            }


            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->phoneUser=$request->phoneUser;
            $user->gender=$request->gender;
            if($user->gender==1){
                $user->codeuser='M'.mt_rand();
            }else
            {
                $user->codeuser='W'.mt_rand();
            }
            $user->save();

            if ($this->loginAfterSignUp) {
                return $this->login($request);
            }

            return response()->json([
                'success'   =>  true,
                'data'      =>  $user
            ], 200);
        } catch (Exception $e) {
            //throw $th;
            return response()->json([
                'error'=>[
                    'messagess'=>$e->messages()
                ],
                'status'=>500,
            ]);
        }

    }
}
