<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowroomUpdateRequest extends FormRequest
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
            'name' => 'required|unique:showroom|max:255',
            'url' => 'required|unique:showroom|max:255',
            'imageThumb' => 'image|mimes:png,jpg,webp,jpeg|max:3072',
            'images*' => 'image|mimes:png,jpg,webp,jpeg|max:3072',
            'region_id' => 'required|integer',
            'seo_title' => 'nullable|max:255',
            'seo_description' => 'nullable|max:400',
            'seo_keywords' => 'nullable|max:255',
            'status' => 'nullable|in:on,off',
            'phone' => ['required', 'regex:/^[0-9]{10}$/', 'unique:showroom'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên showroom không được để trống',
            'name.unique' => 'tên showroom đã tồn tại',
            'name.max' => 'tên tối đa 255 ký tự',
            'url.required' => 'url không để trống',
            'url.unique' => 'url đã tồn tại',
            'url.max' => 'url tối đa 255 ký tự',
            'imageThumb.image' => 'file thumbnail bạn tải lên không phải ảnh',
            'imageThumb.mines' => 'file thumbnail phải ở dạng png, jpg, webp, jpeg',
            'imageThumb.max' => 'file thumbnail phải nhỏ hơn 3MB',
            'image.*.image'=> 'file ảnh chi tiết tải lên không phải dạng ảnh',
            'image.*.mines'=>'file ảnh chi tiết có đuôi png, jpeg, jpg, webp',
            'image.*.max'=>'file ảnh chi tiết phải nhỏ hơn 3MB',
            'region_id.required' => 'vui lòng chọn khu vực',
            'seo_title.max' => 'tiêu đề seo tối đa 255 ký tự',
            'seo_description.max' => 'mô tả seo tối đa 400 ký tự',
            'seo_keywords.max' => 'seo_keywords tối đa 255 ký tự',
            'phone.required' => 'vui lòng nhập số điện thoại',
            'phone.regex' => 'số điện thoại sai định dạng',
            'phone.unique' => 'số điện thoại đã tồn tại'
        ];
    }
}
