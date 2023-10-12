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
            'desc' => 'required|string',
            'regular_price' => 'required|integer',
            'sale_price' => 'integer',
            // 'image_color.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'image_color*' => 'required|array',
            'image_color.*' => 'required',
            'image_color.*.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'discount' => 'nullable|integer|between:0,50',
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
            'regular_price.integer' => 'Giá tiền chưa sale sản phẩm phải ở dạng số nguyên',
            'image_color.required' => 'Chưa chọn hình cho sản phẩm',
            'sale_price.integer' => 'Giá tiền đã sale sản phẩm phải ở dạng số nguyên',
            'image_color.*.*.mines' => 'Ảnh có dạng jpeg,png,jpg,gif,webp',
            'color.required' => 'Vui lòng chọn màu và ảnh chi tiết cho sản phẩm',
            'description.required' => 'Chưa nhập mô tả',
            'status.required' => 'Chưa chọn trạng thái',
            'quantity.regex' => 'admin cố tình nhập bậy, đã ghi log để xử phạt',
            'quantity.required' => 'chưa nhập số lượng sản phẩm',
            'discount.integer' => 'giá trị discount phải ở dạng số',
            'discount.between' => 'giá trị discount nằm trong khoảng 1-50'
        ];
    }
}
