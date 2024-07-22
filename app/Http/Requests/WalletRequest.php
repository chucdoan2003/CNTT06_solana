<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class WalletRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'wallet' => 'required|string|max:255',
            'gmail' => 'nullable|email',
        ];
    }

    public function messages()
    {
        return [
            'wallet.required' => 'Wallet không được bỏ trống.',
            'wallet.string' => 'Wallet phải là chuỗi.',
            'wallet.max' => 'Wallet không được vượt quá 255 ký tự.',
            'gmail.email' => 'Địa chỉ email không hợp lệ.',
        ];
    }

}
