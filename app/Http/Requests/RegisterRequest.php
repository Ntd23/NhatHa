<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|max:255',
						'email'=>'required|string|email|unique:users,email',
						'password'=>'required|min:6'
        ];
    }
		public function messages(): array {
			return [
				'name.required'=>'Tên người dùng không được để trống',
				'email.required'=>'Email không được để trống',
				'email.email'=>'Email không hợp lệ',
				'email.unique' => 'Email đã tồn tại. Vui lòng sử dụng email khác.',
				'password.required'=>'Mật khẩu không được để trống',
				'password.min'=>'Mật khẩu tối thiểu 6 kí tự'
			];
		}
}
