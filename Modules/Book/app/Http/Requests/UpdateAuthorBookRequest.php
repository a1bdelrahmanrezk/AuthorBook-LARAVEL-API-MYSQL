<?php

namespace Modules\Book\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateAuthorBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'old_author'=>'exists:author_book,author_id|exists:authors,id',
            'new_author'=>'required_with:old_another|exists:authors,id',
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
