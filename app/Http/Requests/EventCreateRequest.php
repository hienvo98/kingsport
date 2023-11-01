<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventCreateRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:event',
            'url' => 'required|string|max:255|unique:event',
            'imageThumb'=>'required|image|mimes:jpeg,png,jpg,webp|max:3072',
            'seo_title' => 'required|string|max:255',
            'seo_description' => 'required|string',
            'seo_keywords' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'chưa nhập tên sự kiện',
            'name.string' => 'tên sự kiện phải ở dạng ký tự chuỗi',
            'name.max' => 'tên sự kiện không được quá 255 ký tự',
            'name.unique' => 'tên sự kiện đã tồn tại',
            'url.required' => 'chưa có url',
            'url.string' => 'url sự kiện phải ở dạng ký tự chuỗi',
            'url.max' => 'url sự kiện không được quá 255 ký tự',
            'imageThumb.required' => 'chưa tải ảnh banner',
            'imageThumb.image' => 'tệp tải lên không phải là ảnh',
            'imageThumb.mimes' => 'tệp tải lên phải ở dạng png, jpg, jpeg, webp',
            'imageThumb.max' => 'tệp tải lên không quá 3mb',
            'seo_title.required' => 'chưa nhập sao title',
            'seo_title.string' => 'seo title phải là ký tự dạng chuỗi',
            'seo_title.max' => 'seo title không quá 255 ký tự',
            'seo_description.required' => 'chưa nhập sao description',
            'seo_description.string' => 'seo description phải là ký tự dạng chuỗi',
            'seo_keywords.required' => 'chưa nhập sao keywords',
            'seo_keywords.string' => 'seo keywords phải là ký tự dạng chuỗi',
            'seo_keywords.max' => 'seo keywords không quá 255 ký tự',
        ];
    }
}
