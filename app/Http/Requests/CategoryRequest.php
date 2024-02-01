<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        return Category::rules($this->route('category'));
    }

    //the messages I want to return with the errors if I want the message to be different from the Laravel custom messages
    public function messages(): array
    {
        return [
            'name.unique' => 'This field is already exists'
        ];

    }
}
