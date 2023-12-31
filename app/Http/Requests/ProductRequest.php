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
            'name' => 'required|string|max:255|unique:products',
            'category_id' => 'required',
            'desc' => 'required|string|min:12',
            'regular_price' => 'required|integer',
            'sale_price' => 'integer',
            'avatarThumb'=>'required|image|mimes:jpeg,png,jpg,webp|max:3072',
            'image_color.*' => 'required',
            'image_color.*.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
            'discount' => 'nullable|integer|between:0,50',
            'color' => 'required',
            'quantity' => 'required|integer|regex:/^[0-9]+$/',
        ];
    }

    public function messages()
    {
        return [
            'avatar.required' => 'Vui lòng chọn ảnh avatar sản phẩm',
            'avatar.image' => 'file avatar bạn vừa tải không phải là ảnh',
            'avatar.mines' => 'file avatar có đuôi định là jpeg,png,jpg,gif,webp',
            'avatar.max' => 'kích thước tối đa file avatar được tải lên là 3MB',
            'name.required' => 'Tên sản phẩm không được bỏ trống',
            'name.unique' => 'Tên Sản Phẩm Đã Tồn Tại',
            'category_id.required' => 'Danh mục sản phẩm chưa được chọn',
            'regular_price.required' => 'Giá chưa sale chưa được nhập',
            'regular_price.integer' => 'Giá tiền chưa sale sản phẩm phải ở dạng số nguyên',
            'image_color.required' => 'Chưa chọn hình cho sản phẩm',
            'sale_price.integer' => 'Giá tiền đã sale sản phẩm phải ở dạng số nguyên',
            'image_color.*.*.mines' => 'Ảnh có dạng jpeg,png,jpg,gif,webp',
            'color.required' => 'Vui lòng chọn màu và ảnh chi tiết cho sản phẩm',
            'desc.min' => 'viết mô tả cho sản phẩm để người ta biết mình bán cái con mẹ gì',
            'status.required' => 'Chưa chọn trạng thái',
            'quantity.regex' => 'admin cố tình nhập bậy, đã ghi log để xử phạt',
            'quantity.required' => 'chưa nhập số lượng sản phẩm',
            'discount.integer' => 'giá trị discount phải ở dạng số',
            'discount.between' => 'giá trị discount nằm trong khoảng 1-50'
        ];
    }
}
