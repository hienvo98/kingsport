<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FAQRequest extends FormRequest
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
            'title' => 'required|string',
            'answer' => 'required|string',
            'question' => 'required|string',
            'url' => 'required|string',
            'category_id' => 'required', 
            'meta_title' => 'nullable|string|max:255', 
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'required', 
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Trường tiêu đề là bắt buộc.',
            'answer.required' => 'Trường ask là bắt buộc.',
            'question.required' => 'Trường question là bắt buộc.',
            'url.required' => 'Trường URL là bắt buộc.',
            'category_id.required' => 'Trường category_id là bắt buộc.',
            'meta_title.max' => 'Trường SEO Title không được dài hơn :max ký tự.',
            'meta_description.max' => 'Trường SEO Description không được dài hơn :max ký tự.',
            'meta_meta_keywords.max' => 'Trường SEO Key không được dài hơn :max ký tự.',
            'status.required' => 'Trường status là bắt buộc.',
        ];
    }
}
