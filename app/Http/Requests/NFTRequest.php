<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NFTRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'wallet' => 'required|string|max:255',
            'soluong' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name là bắt buộc.',
            'name.string' => 'name phải là chuỗi.',
            'name.max' => 'name không vượt quá 255 ký tự.',
            'wallet.required' => 'wallet là bắt buộc.',
            'wallet.string' => 'wallet phải là chuỗi.',
            'wallet.max' => 'wallet không vượt quá 255 ký tự.',
            'soluong.required' => 'soluong là bắt buộc.',
           
        ];
    }
}
