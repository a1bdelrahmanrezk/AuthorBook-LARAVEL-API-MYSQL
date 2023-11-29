<?php

namespace Modules\Book\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'author_id' => 'required|numeric|exists:authors,id',
            'book_id' => 'required|numeric|exists:books,id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
