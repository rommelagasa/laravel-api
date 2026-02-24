<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            "title" => "required|string|max:255|min:5",
            "content" => "required|string",
            "author_id" => "required|exists:users,id",
            // "tags" => "array"
            // "tags.*" => "string|min:2"
        ];
    }

    public function messages(): array
    {
        return [
            "title.required" => "Title is required",
            "title.string" => "Title must be a string",
            "title.max" => "Title must not exceed :max characters",
            "title.min" => "Title must be at least :min characters",
            "content.required" => "Content is required",
            "content.string" => "Content must be a string",
            "author_id.required" => "Author ID is required",
            "author_id.exists" => "Author ID must exist in users table"
        ];
    }
}
