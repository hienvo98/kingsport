<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'description' => 'required|string|max:255',
            'regular_price' => 'required|integer|regex:/^[0-9]+$/',
            'sale_price' => 'integer|regex:/^[0-9]+$/',
            // 'image_color.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_color*' => 'required|array',
            'image_color.*' => 'required|array',
            'image_color.*.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'discount' => 'integer|between:1,50',
            'color' => 'required',
            'quantity' => 'required|integer|regex:/^[0-9]+$/',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được bỏ trống',
            'category_id.required' => 'Danh mục sản phẩm chưa được chọn',
            'regular_price.required' => 'Giá chưa sale chưa được nhập',
            'image_color.required' => 'Chưa chọn hình cho sản phẩm',
            'sale_price.integer' => 'Giá tiền sản phẩm phải ở dạng số',
            'image_color.mines' => 'Ảnh có dạng jpeg,png,jpg,gif,web',
            'color.required' => 'Vui lòng chọn màu cho sản phẩm',
            'description.required' => 'Chưa nhập mô tả',
            'status.required' => 'Chưa chọn trạng thái',
            'quantity.regex' => 'admin cố tình nhập bậy, đã ghi log để xử phạt',
            'quantity.required' => 'chưa nhập số lượng sản phẩm',
            'discount.integer' => 'giá trị discount phải ở dạng số',
            'discount.between' => 'giá trị discount nằm trong khoảng 1-50'
        ];
    }
}
