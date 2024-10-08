<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title'=>['required','string','max:255'],
            'image'=>['required','image','mimes:png,jpg,jpeg'],
            'description'=>['required','string'],
            'content'=>['required','string'],
            'published_at'=>['required','date'],
            'category_id'=>['required','integer','exists:categories,id']
        ];
    }
}
