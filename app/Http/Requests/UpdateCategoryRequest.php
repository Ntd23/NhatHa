<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
			$id= $this->route('id');
        return [
            'slug'=>'required|unique:categories,slug,' . $id,
        ];
    }
		public function messages(): array {
			return [
				'slug.required'=>'Nhập slug: (vd: giay-the-thao)',
				'slug.unique'=>'Nhập slug khác'
			];
		}
}