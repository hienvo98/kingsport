<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
            'title' => 'required|max:255',
            'url' => 'required|max:255',
            'category_id' => 'required|integer',
            'thumbnailArticle'=>'image|mimes:jpeg,png,jpg,webp|max:3072',
            'seo_title' => 'nullable|max:255',
            'seo_description' => 'nullable|max:255',
            'seo_key' => 'nullable|max:255',
            'form_status' => 'nullable|in:on,off',
            'publish_date' => 'nullable|date',
            'status' => 'nullable|in:on,off',
            'description' => 'min:12',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Bạn Chưa Nhập Tiêu Đề Cho Bài Viết',
            'title.max' => 'Tiêu đề tối đa 255 ký tự',
            'category_id.required' => 'bạn chưa chọn danh mục cho bài viết',
            'seo_title.max'=> 'seo title tối đa 255 ký tự',
            'seo_description' => 'seo_description tối đa 255 ký tự',
            'description.min' => 'bạn chưa viết blog content',
            'thumbnailArticle.image' => 'Thumbnail tải lên không phải tệp ảnh',
            'thumbnailArticle.mimes' => 'Thumbnail tải lên phải có dạng jpeg,png,jpg,webp',
            'thumbnailArticle.max'=>'Thumbnail tải lên tối đa 3MB'
        ];
    }
}
