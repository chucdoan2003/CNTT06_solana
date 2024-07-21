<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends BaseRequest
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
            'name' => 'required|string|max:50',
            'ngayphathanh' => 'required|date',
            'ngayketthuc' => 'required|date',
            'diachi' => 'required|string|max:100',
            'giatien' => 'required|numeric',
            'mota' => 'required|string|max:250',
            'nguoitochuc' => 'nullable|string',
            'noitochuc' => 'nullable|string',
            'cateID' => 'required|exists:categories,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên vé là bắt buộc.',
            'name.string' => 'Tên vé phải là một chuỗi.',
            'name.max' => 'Tên vé không được vượt quá 50 ký tự.',
            'ngayphathanh.required' => 'Ngày phát hành là bắt buộc.',
            'ngayphathanh.date' => 'Ngày phát hành không hợp lệ.',
            'ngayketthuc.required' => 'Ngày kết thúc là bắt buộc.',
            'ngayketthuc.date' => 'Ngày kết thúc không hợp lệ.',
            'diachi.required' => 'Địa chỉ là bắt buộc.',
            'diachi.string' => 'Địa chỉ phải là một chuỗi.',
            'diachi.max' => 'Địa chỉ không được vượt quá 100 ký tự.',
            'giatien.required' => 'Giá tiền là bắt buộc.',
            'giatien.numeric' => 'Giá tiền phải là số.',
            'mota.required' => 'Mô tả là bắt buộc.',
            'mota.string' => 'Mô tả phải là một chuỗi.',
            'mota.max' => 'Mô tả không được vượt quá 250 ký tự.',
            'cateID.required' => 'Danh mục là bắt buộc.',
            'cateID.exists' => 'Danh mục không tồn tại.',
        ];
    }



}
