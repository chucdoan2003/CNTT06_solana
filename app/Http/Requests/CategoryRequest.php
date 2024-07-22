<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class CategoryRequest extends BaseRequest
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

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:categories',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name là bắt buộc.',
            'name.string' => 'name phải là chuỗi.',
            'name.max' => 'Tên danh mục không vượt quá 255 ký tự.',
            'name.unique' => 'name đã tồn tại.',    
           
        ];
    }

   


}
