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
            'subcategory_id' => 'required',
            'description' => 'required|string|max:255',
            'regular_price' => 'required|integer|regex:/^[0-9]+$/',
            'sale_price' => 'integer|regex:/^[0-9]+$/',
            //'image_color' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
            'sorting' => 'required|integer|regex:/^[0-9]+$/',
            'quantity' => 'required|integer|regex:/^[0-9]+$/',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Tên sản phẩm không được bỏ trống',
            'category_id.required' => 'Danh mục sản phẩm chưa được chọn',
            'subcategory_id.required' => 'Danh mục thuộc tính chưa được chọn',
            'regular_price.required' => 'Giá chưa sale chưa được nhập',
            //'image_color.required' => 'Chưa chọn hình cho sản phẩm',
            'sale_price.integer'=>'Giá tiền sản phẩm phải ở dạng số',
            'sorting.regex' => 'Nhập số thứ tự bậy bạ',
            'sorting.required' => 'chưa nhập số thứ tự',
            'description.required' => 'Chưa nhập mô tả',
            'status.required' => 'Chưa chọn trạng thái',
            'quantity.regex' => 'admin cố tình nhập bậy, đã ghi log để xử phạt',
            'quantity.required' => 'chưa nhập thứ tự'
        ];
    }
}
