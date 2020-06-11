<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password'=>'required|min:8',
            'password_confirmation'=> 'required|same:password',
        ];
    }
    public function messages()
    {
        return  [
            'name.required'=>'Vui Lòng Nhập Tên ',
            'email.unique'=>'Email đã đăng Ký',
            'email.required'=>'Vui Lòng Nhập Email',
            'password.required'=>'Vui lòng nhập Mật Khẩu',
            'password.min'=>'Password lớn hơn 6 kí tự',
            'password_confirmation.required'=>'Vui lòng nhập lại mật khẩu confirmation',
            'password_confirmation.same:password'=>'Mật Khẩu Không Trùng',



        ]
        ;
    }
}
