<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlbumRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3'],
            'content' => ['required', 'min:20'],
            'category_id' => ['required', 'exists:categories,id'],
            'slug' => ['required', Rule::unique('posts')],
            'status' => ['required', 'boolean'],
            'image' => ['image', 'mimes:jpeg,png,jpg', 'max:2048']
        ];
    }
}
