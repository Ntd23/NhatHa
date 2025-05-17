<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
           'title'=>'required',
					 'category_id'=>'required',
					 'sub_category_id'=>'required',
					 'brand_id'=>'required',
					 'price'=>'required',
					 'old_price'=>'required',
        ];
    }
			public function messages(): array
		{
			return [
				'title.required'=>'Tiêu đề sản phẩm không được để trống',
				'category_id.required'=>'Danh mục không được để trống',
				'sub_category_id.required'=>'Danh mục con không được để trống',
				'brand_id.required'=>'Thương hiệu không được để trống',
				'price.required'=>'Giá tiền không được để trống',
				'old_price.required'=>'Giá cũ không được để trống',
			];
		}
}
