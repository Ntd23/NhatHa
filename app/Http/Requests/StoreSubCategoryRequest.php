<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubCategoryRequest extends FormRequest
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
           'slug' => 'required|unique:sub_categories',
        ];
    }
		public function messages(): array
		{
			return [
				'slug.required'=>'Nhập slug: (vd: giay-the-thao-nam-nike-mau-trang)',
				'slug.unique'=>'Nhập slug khác'
			];
		}
}